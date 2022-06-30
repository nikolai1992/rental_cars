<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Banner\BannerStoreRequest;
use App\Http\Requests\Admin\Banner\BannerUpdateRequest;
use File;
use Session;

class BannerController extends Controller
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
        $model_name = "App\\".$_GET["model"];
        $id = $_GET["id"];
        $model = $model_name::find($_GET["id"]);

        if ($_GET["model"] == "Page") {
            $title = "Добавление нового баннера к странице ".$model->name;
        }
        if ($_GET["model"] == "Car") {
            $title = "Добавление нового баннера к автомобилю ".$model->carBrand->name." ".$model->model;
        }

        $model = new Banner();
        return view('admin.banner.form', compact('title', 'model', 'id', 'model_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerStoreRequest $request)
    {

        $banner = new Banner();
        $model = $request->model_name;
        $data = $request->all();
        $model = $model::find($request->id);
        unset($data["id"]);
        unset($data["model_name"]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('/images/uploads/'), $filename);
            $svg_filename = '/images/uploads/'.$filename;
            $data["image"] = $svg_filename;
        }

        $banner = $banner->create($data);
        $model->banners()->attach($banner->id);

        Session::flash('flash_message', "Баннер успешно додабавленый");
        if ($request->model_name == "App\Page") {
            return redirect()->route('page.edit', $model->id);
        }
        if ($request->model_name == "App\Car") {
            return redirect()->route('car.edit', $model->id);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
        $model_name = "App\\".$_GET["model"];
        $id = $_GET["id"];
        $model = $model_name::find($_GET["id"]);

        if ($_GET["model"] == "Page") {
            $title = "Добавление нового баннера к странице ".$model->name;
        }
        if ($_GET["model"] == "Car") {
            $title = "Добавление нового баннера к автомобилю ".$model->carBrand->name." ".$model->model;
        }

        $model = $banner;
        return view('admin.banner.form', compact('title', 'model', 'id', 'model_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(BannerUpdateRequest $request, Banner $banner)
    {
        //
        $banner = $banner;
        $model = $request->model_name;
        $data = $request->all();
        $model = $model::find($request->id);
        unset($data["id"]);
        unset($data["model_name"]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('/images/uploads/'), $filename);
            $svg_filename = '/images/uploads/'.$filename;
            $data["image"] = $svg_filename;
        }

        $banner->update($data);

        Session::flash('flash_message', "Баннер успешно обновлен");

        if ($request->model_name == "App\Page") {
            return redirect()->route('page.edit', $model->id);
        }
        if ($request->model_name=="App\Car") {
            return redirect()->route('car.edit', $model->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        //
        $banner->delete();

        Session::flash('flash_message', "Баннер успешно удален");

        return redirect()->back();
    }
}
