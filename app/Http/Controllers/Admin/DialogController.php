<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dialog;
use Session;
use File;

class DialogController extends Controller
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
		/*
		$ticket = Ticket::find($_GET['id']);
		$model = new Dialog();
		$title = 
		dd($_GET);*/
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
		$model = new Dialog();
        $data = $request->all();
        $data["file"] = "";
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('/files/'), $filename);
            $filename = '/files/'.$filename;
            $data["file"] = $filename;
        }

		$model = $model->create($data);

		Session::flash('flash_message', "Ответ успешно написан");

        return redirect()->route('ticket.edit', $model->ticket_id);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $model = Dialog::find($id);
        $data = $request->all();
        $data["file"] = "";
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('/files/'), $filename);
            $filename = '/files/'.$filename;
            $data["file"] = $filename;
        }

        $model->update($data);

        Session::flash('flash_message', "Ответ успешно обновлен");

        return redirect()->back();
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
        Dialog::destroy($id);

        Session::flash('flash_message', "Ответ успешно удален");

        return redirect()->back();
    }
}
