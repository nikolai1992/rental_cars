<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Car\CarStoreRequest;
use App\Http\Requests\Admin\Car\CarUpdateRequest;
use App\Models\CarBrand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use Image;
use File;
use App\Models\Rent;
use App\Models\CarImage;
use App\Models\DriverRent;
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
        $cars = Car::all();
        $title = "Список автомобилей";

        return view('admin.cars.index', compact('cars', 'title'));
    }
    public function imageMoveUpper($order_id, $id)
    {
        $model = Car::find($id);
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

        Session::flash('flash_message', "Картинка помещенна выше");

        return redirect()->back();
    }
    public function imageMoveLower($order_id, $id)
    {
        $model = Car::find($id);
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

        Session::flash('flash_message', "Картинка помещенна ниже");

        return redirect()->back();
    }
    public function imageMoveToTop($order_id, $id)
    {
        $model = Car::find($id);
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

        Session::flash('flash_message', "Картинка помещенна 1-ой");

        return redirect()->back();
    }
    public function imageRotate($id)
    {
        $car_image = CarImage::find($id);
        $img = Image::make(public_path($car_image->url));
        $img->rotate(90);
        $filename = random_int(10000000, 99999999).time().".jpg";
        $url =  '/images/uploads/'.$filename;
        Image::make($img)->save(public_path($url));
        File::delete(public_path($car_image->url));
        $car_image->url = $url;
        $car_image->save();

        Session::flash('flash_message', "Картинка была перевернута");

        return redirect()->back();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
          "title"   => "Добавление нового авто",
          "model"   => new Car(),
          "partners" =>  User::whereHas('role', function ($q) {
              $q->where('alias', 'partner');
          })->get(),
          "brands2"  => CarBrand::all()
        ];

        return view('admin.cars.form')->with($data);
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
        $car_data = $request->car;
        $car_data["saved"] = isset($request->car["saved"]) ? true : false;
        $rent_data = $request->rent;

        $model = new Car();
        $model = $model->create($car_data);
        $rent_data["car_id"] = $model->id;

        if ($model->rent_type == "simple_rent") {
            $rent = new Rent();
            $rent->create($rent_data);
        }
        if ($model->rent_type == "with_driver") {
            $rent = new DriverRent();
            $rent->create($rent_data);
        }

        Session::flash('flash_message', "Автомобиль успешно добавлен");

        return redirect()->route('car.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = [
            "title"   => "Редактирование авто",
            "model"   => Car::find($id),
            "partners" =>  User::whereHas('role', function($q){ $q->where('alias', 'partner'); })->get(),
            "brands2"  => CarBrand::all()
        ];

        return view('admin.cars.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarUpdateRequest $request, $id)
    {
        //

        $car_data = $request->car;
        $rent_data = $request->rent;
        $car_data["saved"] = isset($request->car["saved"]) ? true : false;

        $model = Car::find($id);
        $model->update($car_data);
        $rent_data["car_id"] = $model->id;
        if ($model->rent_type == "simple_rent") {
            $rent = $model->simpleRent;

            if ($rent==null) {
                $rent = new Rent();
                $rent->create($rent_data);
            } else {
                $rent->update($rent_data);
            }
            if ($model->driverRent) {
                $model->driverRent->delete();
            }

        }
        if ($model->rent_type == "with_driver") {
            $rent = $model->driverRent;

            if ($rent == null) {
                $rent = new DriverRent();
                $rent->create($rent_data);
            } else {
                $rent->update($rent_data);
            }
        }

        Session::flash('flash_message', "Автомобиль успешно обновлен");

        return redirect()->route('car.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
