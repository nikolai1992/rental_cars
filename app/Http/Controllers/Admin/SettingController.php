<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Models\PaymentMethodIcon;
use App\Models\SocialMedia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Setting\SettingUpdateRequest;
use Session;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Ilfluminate\Http\Response
     */
    public function index()
    {
        //
        $data = [
            "model"=>Setting::first(),
            "socials"=>SocialMedia::all(),
            "pm_icons"=>PaymentMethodIcon::all(),
            "title"=> "Редактирование общей информации"
        ];

        return view('admin.setting.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingUpdateRequest $request, Setting $setting)
    {
        //
        $data = $request->all();
        unset($data['social']);
        unset($data['statistic']);
        $statistic = $request->statistic;
        $setting->update($data);
        $setting->update($statistic);

        foreach ($request->social as $name => $value) {
            $media = SocialMedia::where('name', $name)->first();
            $media->update([
               "url" => $value,
            ]);
        }

        Session::flash('flash_message', "Общая информация обновлена");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
