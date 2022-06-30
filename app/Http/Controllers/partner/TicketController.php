<?php

namespace App\Http\Controllers\partner;

use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\Dialog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $statuses = TicketStatus::first();

        View::share(['statuses' => $statuses]);
    }
    public function index()
    {
        //
        $user = auth()->user();
        $tickets = Ticket::where('user_id', auth()->user()->id)->paginate(10);

        return view('partner.ticket.index', compact('tickets', 'user'));
    }
    public function addAnswer(Request $request)
    {
        //
        $data = $request->all();
        $data["file"] = "";

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('/files/'), $filename);
            $svg_filename = '/files/'.$filename;
            $data["file"] = $svg_filename;
        }

        $dialog = new Dialog();
        $dialog->create([
            "user_id"=>auth()->user()->id,
            "ticket_id"=>$request->ticket_id,
            "text"=>$request->text,
            "file"=>$data["file"]
        ]);

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
        $model = new Ticket();
        $themes = TicketStatus::all();

        return view('partner.ticket.form', compact('model', 'themes'));
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
        $data = $request->all();
        $data["file"] = "";

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('/files/'), $filename);
            $svg_filename = '/files/'.$filename;
            $data["file"] = $svg_filename;
        }

        $model = $model->create([
            "user_id"=>auth()->user()->id,
            "theme"=>$request->theme
        ]);

        $dialog = new Dialog();
        $dialog->create([
            "user_id"=>auth()->user()->id,
            "ticket_id"=>$model->id,
            "text"=>$request->text,
            "file"=>$data["file"]
        ]);

        return redirect()->route('partner_ticket.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $model = Ticket::find($id);
        $model->dialogs()->where('opened', false)->where("user_id", '!=', auth()->user()->id)
            ->update(['opened' => 1]);

        return view('partner.ticket.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Ticket::destroy($id);

        return redirect()->back();
    }
}
