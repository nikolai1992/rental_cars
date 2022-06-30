<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CarImage\CarImageStoreRequest;
use App\Http\Requests\Admin\CarImage\CarImageUpdateRequest;
use App\Models\CarImage;
use App\Models\Car;
use Session;
use Image;

class CarImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $car_id = $_GET["id"];
        $car = Car::find($car_id);
        $title = "Добавление нового изображение в автомобиль ".$car->carBrand->name." ".$car->model;
        $model = new CarImage();

        return view('admin.cars.image.form', compact('model', 'title', 'car_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarImageStoreRequest $request)
    {

        $data = $request->all();
        if ($request->file('url')) {
            $logo = $request->file('url');
            $filename = random_int(10000000, 99999999).time().".".$logo->getClientOriginalExtension();
            Image::make($logo)->save(public_path('images/uploads/'.$filename));
            $image = '/images/uploads/'.$filename;
            $data["url"] = $image;
        }

        $model = new CarImage();
        $model->create($data);

        Session::flash('flash_message', "Изображение автомобиля успешно добавлено");

        return redirect()->intended(route('car.edit', $request->car_id));
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
        $model = CarImage::find($id);
        $car_id = $model->car_id;
        $car = Car::find($car_id);
        $title = "Редактирование изображения к автомобилю ".$car->carBrand->name." ".$car->model;

        return view('admin.cars.image.form', compact('model', 'title', 'car_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarImageUpdateRequest $request, $id)
    {
        //

        $data = $request->all();
        $model = CarImage::find($id);
        if ($request->file('url')) {
            $logo = $request->file('url');
            $filename = random_int(10000000, 99999999).time().".".$logo->getClientOriginalExtension();
            Image::make($logo)->save(public_path('images/uploads/'.$filename));
            $image = '/images/uploads/'.$filename;
            $data["url"] = $image;
        }

        $model->update($data);

        Session::flash('flash_message', "Изображение автомобиля успешно обновлено");

        return redirect()->intended(route('car.edit', $model->car_id));
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
        CarImage::destroy($id);
        Session::flash('flash_message', "Изображение автомобиля успешно удалено");

        return redirect()->back();
    }
}
