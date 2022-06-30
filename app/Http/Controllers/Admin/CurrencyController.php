<?php

namespace App\Http\Controllers\Admin;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Currency\CurrencyStoreRequest;
use App\Http\Requests\Admin\Currency\CurrencyUpdateRequest;
use Session;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $currencies = Currency::all();

        return view('admin.currency.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $model = new Currency();
        $title = "Добавление новой валюты";

        return view('admin.currency.form', compact('model', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyStoreRequest $request)
    {
        //

        $data = $request->all();
        $data["active"] = isset($data["active"]) ? true : false;

        $currency = new Currency();
        $currency->create($data);

        Session::flash('flash_message', "Валюта успешно добавлена");

        return redirect()->route('currency.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        //
        $model = $currency;
        $title = "Редактирование валюты";

        return view('admin.currency.form', compact('model', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyUpdateRequest $request, Currency $currency)
    {
        //

        $data = $request->all();
        $data["active"] = isset($data["active"]) ? true : false;

        $currency->update($data);

        Session::flash('flash_message', "Валюта успешно обновлена");

        return redirect()->route('currency.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        //
        $currency->delete();

        Session::flash('flash_message', "Валюта успешно удалена");

        return redirect()->route('currency.index');
    }
}
