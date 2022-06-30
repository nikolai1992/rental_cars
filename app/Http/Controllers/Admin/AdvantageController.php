<?php

namespace App\Http\Controllers\Admin;

use App\Models\Advantage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class AdvantageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $advantages = Advantage::all();

        return view('admin.advantages.index', compact('advantages'));
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
     * @param  \App\Advantage  $advantage
     * @return \Illuminate\Http\Response
     */
    public function show(Advantage $advantage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advantage  $advantage
     * @return \Illuminate\Http\Response
     */
    public function edit(Advantage $advantage)
    {
        //
        $model = $advantage;
        $title = "Редактирование преимущества";

        return view('admin.advantages.form', compact('model', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Advantage  $advantage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advantage $advantage)
    {
        //
        $this->validate($request, [
            'name' => 'required|string|max:40',
            'text' => 'required|string|max:310',
        ]);

        $data = $request->all();

        $advantage->update($data);

        Session::flash('flash_message', "Общая информация обновлена");

        return redirect()->route('advantage.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advantage  $advantage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advantage $advantage)
    {
        //
    }
}
