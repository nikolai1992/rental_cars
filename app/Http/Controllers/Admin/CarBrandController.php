<?php

namespace App\Http\Controllers\Admin;

use App\Models\CarBrand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CarBrand\CarBrandStoreRequest;
use App\Http\Requests\Admin\CarBrand\CarBrandUpdateRequest;
use Image;
use Session;

class CarBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brands2 = CarBrand::all();

        return view('admin.brand.index', compact('brands2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Добавление новой марки автомобиля";
        $model = new CarBrand();

        return view('admin.brand.form', compact('title', 'model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarBrandStoreRequest $request)
    {
        //

        $data = $request->all();
        $model = new CarBrand();

        if ($request->file('icon')) {
            $logo = $request->file('icon');
            $filename = random_int(10000000, 99999999).time().".".$logo->getClientOriginalExtension();
            Image::make($logo)->save(public_path('images/uploads/'.$filename));
            $image = '/images/uploads/'.$filename;
            $data["icon"] = $image;
        }

        $model->create($data);

        Session::flash('flash_message', "Марка автомобиля успешно добавлена");

        return redirect()->intended(route('car_brand.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CarBrand  $carBrand
     * @return \Illuminate\Http\Response
     */
    public function show(CarBrand $carBrand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CarBrand  $carBrand
     * @return \Illuminate\Http\Response
     */
    public function edit(CarBrand $carBrand)
    {
        //
        $title = "Редактирование марки автомобиля";
        $model = $carBrand;

        return view('admin.brand.form', compact('title', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CarBrand  $carBrand
     * @return \Illuminate\Http\Response
     */
    public function update(CarBrandUpdateRequest $request, CarBrand $carBrand)
    {
        //

        $data = $request->all();
        $model = $carBrand;

        if ($request->file('icon')) {
            $logo = $request->file('icon');
            $filename = random_int(10000000, 99999999).time().".".$logo->getClientOriginalExtension();
            Image::make($logo)->save(public_path('images/uploads/'.$filename));
            $image = '/images/uploads/'.$filename;
            $data["icon"] = $image;
        }

        $model->update($data);

        Session::flash('flash_message', "Марка автомобиля успешно обновлена");

        return redirect()->intended(route('car_brand.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CarBrand  $carBrand
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarBrand $carBrand)
    {
        //
        $carBrand->delete();
        Session::flash('flash_message', "Марка автомобиля успешно удалена");

        return redirect()->back();
    }
}
