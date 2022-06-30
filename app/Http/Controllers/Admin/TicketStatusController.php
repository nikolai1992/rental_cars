<?php

namespace App\Http\Controllers\Admin;

use App\Models\TicketStatus;
use App\Models\Translation;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class TicketStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tickets = TicketStatus::all();

        return view('admin.ticket.status.index', compact('tickets'));
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
           "title"=> "Добавление нового статуса тикета",
           "langs"=> Language::where('active', true)->get(),
           "model"=> new TicketStatus()
        ];

        return view('admin.ticket.status.form')->with($data);
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
        $model = new TicketStatus();
        $model = $model->create([]);
        $trans = $request->trans;

        foreach ($trans as $lang_id => $fields) {
            foreach ($fields as $field => $value) {
                $model2 = new Translation();
                $model2 = $model2->create([
                    "language_id"=>$lang_id,
                    "field"=>$field,
                    "value"=>$value
                ]);
                $model->translates()->attach($model2->id);
            }
        }

        Session::flash('flash_message', "татус тикета успешно добавлен");
        return redirect()->route('ticket_status.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TicketStatus  $ticketStatus
     * @return \Illuminate\Http\Response
     */
    public function show(TicketStatus $ticketStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TicketStatus  $ticketStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketStatus $ticketStatus)
    {
        //
        $data = [
            "title"=> "Редактирование статуса тикета",
            "langs"=> Language::where('active', true)->get(),
            "model"=> $ticketStatus
        ];

        return view('admin.ticket.status.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TicketStatus  $ticketStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TicketStatus $ticketStatus)
    {
        //
        $trans = $request->trans;
        foreach ($trans as $lang_id => $fields) {
            foreach ($fields as $field => $value) {
                $model2 = $ticketStatus->translates->where("language_id", $lang_id)
                    ->where('field', $field)
                    ->first();
                if ($model2) {
                    $model2->update([
                        "value"=>$value
                    ]);
                } else {
                    $model2 = new Translation();
                    $model2 = $model2->create([
                        "language_id"=>$lang_id,
                        "field"=>$field,
                        "value"=>$value
                    ]);
                    $ticketStatus->translates()->attach($model2->id);
                }

            }
        }

        Session::flash('flash_message', "Статус тикета успешно обновлен");

        return redirect()->route('ticket_status.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TicketStatus  $ticketStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketStatus $ticketStatus)
    {
        //
        $ticketStatus->delete();

        Session::flash('flash_message', "Cтатус тикета успешно удален");

        return redirect()->route('ticket_status.index');
    }
}
