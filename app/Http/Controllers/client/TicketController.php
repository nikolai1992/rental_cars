<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Dialog;
use App\Models\TicketStatus;
use File;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $tickets = Ticket::where('user_id', auth()->user()->id)->paginate(10);
        return view('clients.ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $model = new Ticket();
        $themes = TicketStatus::all();

        return view('clients.ticket.form', compact('model', 'themes'));
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
        $model = new Ticket();
        $dialog = new Dialog();
        $data = $request->all();
        $data["file"] = "";
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('/files/'), $filename);
            $filename = '/files/'.$filename;
            $data["file"] = $filename;
        }

        $model = $model->create([
            "user_id"=>auth()->user()->id,
            "theme"=>$request->theme
        ]);

        $dialog->create([
            "user_id"=>auth()->user()->id,
            "ticket_id"=>$model->id,
            "text"=>$request->text,
            "file"=>$data["file"]
        ]);

        return redirect()->route('client_ticket.index');
    }
    public function addAnswer(Request $request)
    {
        //
        $dialog = new Dialog();
        $data = $request->all();
        $data["file"] = "";
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('/files/'), $filename);
            $filename = '/files/'.$filename;
            $data["file"] = $filename;
        }

        $dialog->create([
            "user_id"=>auth()->user()->id,
            "ticket_id"=>$request->ticket_id,
            "text"=>$request->text,
            "file"=>$data["file"]
        ]);

        return redirect()->back();
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
        $model = Ticket::find($id);
        $model->dialogs()->where('opened', false)->where("user_id", '!=', auth()->user()->id)->update(['opened' => 1]);

        return view('clients.ticket.edit', compact('model'));
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
        Ticket::destroy($id);
        return redirect()->back();
    }
}
