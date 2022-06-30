<?php

namespace App\Http\Controllers\partner;

use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarImage;
use App\Models\DriverRent;
use App\Http\Controllers\Controller;
use App\Models\Rent;
use Image;
use File;
use Illuminate\Http\Request;
use App\Http\Requests\Partner\Car\CarStoreRequest;
use App\Http\Requests\Partner\Car\CarUpdateRequest;
use Session;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = auth()->user();
        $cars = Car::where('user_id', $user->id)->where('saved', true)->paginate(10);

        return view('partner.car.index', compact('cars', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id=false)
    {
        //
        if ($id) {
            $model = Car::find($id);
        } else {
            $model = new Car();
        }
        $brandss = CarBrand::all();

        return view('partner.car.create', compact('model', 'brandss'));
    }
    public function uploadPhoto(Request $request)
    {
        $added_car_id = $request->id;
        if ($request->images) {
            foreach ($request->images as $image) {

                $image = $image;
                $filename = random_int(10000000, 99999999).time().".".$image->getClientOriginalExtension();
                Image::make($image)->save(public_path('images/uploads/'.$filename));
                $image = '/images/uploads/'.$filename;
                $data["url"] = $image;
                $data["car_id"] = $added_car_id;
                CarImage::create($data);
            }
        }

        return redirect()->back();
    }
    public function createUpdate($id)
    {
        if (Session::has('added_car')) {
            $added_car_id = Session::get('added_car');
            Session::flash('added_car', $added_car_id);
            $model = Car::find($added_car_id);
        } else {
            Session::flash('added_car', $id);
            $model = Car::find($id);
        }
        $brandss = CarBrand::all();

        return view('partner.car.create', compact('model', 'brandss'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarStoreRequest $request)
    {
        //
        $added_car_id = Session::get('added_car');

        $car_data = $request->car;
        $rent_data = $request->rent;
        $alias = CarBrand::find($car_data["brand_id"])->name."-".$car_data["model"];
        $alias = mb_strtolower($alias);
        $alias = str_replace(" ","-",$alias);
        $checking_alias = Car::where('alias', $alias)->orWhere("alias", 'like', $alias."_%")->get();
        $car_data["user_id"] = auth()->user()->id;
        if ($added_car_id) {
            Session::flash('added_car', $added_car_id);
            $model = Car::find($added_car_id);
            if ($model->brand_id != $car_data["brand_id"] || $model->model != $car_data["model"]) {
                $checking_alias = Car::where("alias", 'like', $alias."_%")->where('alias', '!=', $alias)->get();
                if ($checking_alias->count()) {
                    $alias = $alias."-".$checking_alias->count();
                }
                $car_data["alias"] = $alias;
            }
            $model->update($car_data);
        } else {
            $model = new Car();
            if ($checking_alias->count()) {
                $alias = $alias."-".$checking_alias->count();
            }
            $car_data["alias"] = $alias;
            $model = $model->create($car_data);
        }
        $rent_data["car_id"] = $model->id;
        if ($model->rent_type == "simple_rent") {
            $rent = $model->simpleRent;
            if ($rent == null) {
                $rent = new Rent();
                $rent->create($rent_data);
            } else {
                $rent->update($rent_data);
            }
            if ($model->driverRent) {
                $model->driverRent->delete();
            }
        }
        if ($model->rent_type=="with_driver") {
            $rent = $model->driverRent;
            if ($rent == null) {
                $rent = new DriverRent();
                $rent->create($rent_data);
            } else {
                $rent->update($rent_data);
            }
            if ($model->simpleRent) {
                $model->simpleRent->delete();
            }
        }

        Session::flash('added_car', $model->id);

        return redirect()->route('partner_car.create.stage2', $model->id);
    }
    public function publish($id)
    {
        $car = Car::find($id);
        $car->saved = true;
        $car->save();

        return redirect()->route('partner_car.index');
    }
    public function storeStage2(Request $request)
    {
        $added_car_id = $request->id;
        $car = Car::find($added_car_id);
        $car->video = $request->video;
        $car->save();

        return redirect()->route('partner_car.show', $car->alias);
    }
    public function updateStage2(Request $request, $id)
    {
        $car = Car::find($id);
        $car->video = $request->video;
        $car->save();

        return redirect()->route('partner_car.show2', $car->alias);
    }
    public function editStage3($id)
    {
        Session::flash('edited_car', $id);
        $model = Car::find($id);

        return view('partner.car.edit_stage3', compact('model'));
    }
    public function createStage3($id)
    {
        $model = Car::find($id);

        return view('partner.car.create_stage3', compact('model'));
    }
    public function imageMoveUpper($order_id, $id=false)
    {
        if ($id) {
            $model = Car::find($id);
        } else {
            $added_car_id = Session::get('added_car');
            Session::flash('added_car', $added_car_id);
            if ($added_car_id) {
                $model = Car::find($added_car_id);
            } else {
                return redirect()->route('partner_car.create');
            }
        }
        $images = $model->images->sortBy('order_id');
        $i=1;
        foreach ($images as $image) {
            if ($i == $order_id-1) {
                $image->order_id = $i+1;
            } elseif ($i == $order_id) {
                $image->order_id = $i-1;
            } else {
                $image->order_id = $i;
            }

            $image->save();
            $i++;
        }

        return redirect()->back();
    }
    public function imageMoveLower($order_id, $id=false)
    {
        if ($id) {
            $model = Car::find($id);
        } else {
            $added_car_id = Session::get('added_car');
            Session::flash('added_car', $added_car_id);
            if ($added_car_id) {
                $model = Car::find($added_car_id);
            } else {
                return redirect()->route('partner_car.create');
            }
        }
        $images = $model->images->sortBy('order_id');

        $i=1;
        foreach ($images as $image) {
            if ($i == $order_id+1) {
                $image->order_id = $i-1;
            } elseif ($i == $order_id) {
                $image->order_id = $i+1;
            } else {
                $image->order_id = $i;
            }
            $image->save();
            $i++;
        }

        return redirect()->back();
    }
    public function imageMoveToTop($order_id, $id=false)
    {
        if ($id) {
            $model = Car::find($id);
        } else {
            $added_car_id = Session::get('added_car');
            Session::flash('added_car', $added_car_id);
            if ($added_car_id) {
                $model = Car::find($added_car_id);
            } else {
                return redirect()->route('partner_car.create');
            }
        }
        $images = $model->images->sortBy('order_id');

        $i=1;
        foreach ($images as $image) {
            if ($i == 1) {
                $image->order_id = $order_id;
            } elseif ($i == $order_id) {
                $image->order_id = 1;
            } else {
                $image->order_id = $i;
            }
            $image->save();
            $i++;
        }

        return redirect()->back();
    }

    public function imageDelete($id, $edit=false)
    {
        if (!$edit) {
            $added_car_id = Session::get('added_car');
            Session::flash('added_car', $added_car_id);
        }

        $car_image = CarImage::find($id);
        File::delete(public_path($car_image->url));
        $car_image->delete();

        return redirect()->back();
    }
    public function imageRotate($id, $edit=false)
    {
        if (!$edit) {
            $added_car_id = Session::get('added_car');
            Session::flash('added_car', $added_car_id);
            if (!$added_car_id) {
                return redirect()->route('partner_car.create');
            }
        }

        $car_image = CarImage::find($id);
        $img = Image::make(public_path($car_image->url));
        $img->rotate(90);

        $filename = random_int(10000000, 99999999).time().".jpg";
        $url =  '/images/uploads/'.$filename;
        Image::make($img)->save(public_path($url));
        File::delete(public_path($car_image->url));
        $car_image->url = $url;
        $car_image->save();

        return redirect()->back();
    }
    public function createStage2($id)
    {
        $model = Car::find($id);

        return view('partner.car.create_stage2', compact('model'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show2($alias)
    {
        $model = Car::where("alias", $alias)->first();

        return view('partner.car.show2', compact('model'));
    }
    public function show($alias)
    {
        //
        $added_car_id = Session::get('added_car');
        Session::flash('added_car', $added_car_id);

        if ($added_car_id) {
            $model = Car::find($added_car_id);
        } else {
            $model = Car::where('alias', $alias)->first();
            Session::flash('added_car', $model->id);
        }

        return view('partner.car.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if (Session::has('edited_car')) {
            $model = Car::find(Session::get('edited_car'));
        } else {
            $model = Car::find($id);
            Session::flash('added_car', $model->id);
        }
        $brandss = CarBrand::all();

        return view('partner.car.edit', compact('model', 'brandss'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(CarUpdateRequest $request, $id)
    {

        $added_car_id = Session::get('edited_car');

        $car_data = $request->car;
        $rent_data = $request->rent;
        $car_data["user_id"] = auth()->user()->id;
        $model = Car::find($id);

        if ($model->brand_id != $car_data["brand_id"] || $model->model != $car_data["model"]) {
            $alias = CarBrand::find($car_data["brand_id"])->name."-".$car_data["model"];
            $alias = mb_strtolower($alias);
            $alias = str_replace(" ","-",$alias);
            $checking_alias = Car::where("alias", 'like', $alias."_%")->where('alias', '!=', $alias)->get();

            if ($checking_alias->count()) {
                $alias = $alias."-".$checking_alias->count();
            }
            $car_data["alias"] = $alias;
        }
        if ($added_car_id) {
            Session::flash('added_car', $added_car_id);
        }
        $model->update($car_data);
        $rent_data["car_id"] = $model->id;
        if ($model->rent_type=="simple_rent") {
            $rent = $model->simpleRent;
            if ($rent == null) {
                $rent = new Rent();
                $rent->create($rent_data);
            } else {
                $rent->update($rent_data);
            }
            if ($model->driverRent) {
                $model->driverRent->delete();
            }
        }
        if ($model->rent_type=="with_driver") {
            $rent = $model->driverRent;

            if ($rent == null) {
                $rent = new DriverRent();
                $rent->create($rent_data);
            } else {
                $rent->update($rent_data);
            }
            if ($model->simpleRent) {
                $model->simpleRent->delete();
            }
        }

        Session::flash('edited_car', $model->id);

        return redirect()->route('partner_car.edit.stage2', $model->id);
    }

    public function editStage2($id)
    {
        $model = Car::find($id);
        return view('partner.car.edit_stage2', compact('model'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        //
    }
}
