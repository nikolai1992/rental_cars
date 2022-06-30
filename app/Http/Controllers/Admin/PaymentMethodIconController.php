<?php

namespace App\Http\Controllers\Admin;

use App\Models\PaymentMethodIcon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Page\PageStoreRequest;
use App\Http\Requests\Admin\Page\PageUpdateRequest;
use Session;
use File;

class PaymentMethodIconController extends Controller
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
        $model = new PaymentMethodIcon();
        $title = "Добавление иконки способа оплаты";

        return view('admin.setting.payment_method.form', compact('model', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageStoreRequest $request)
    {
        //

        $data = $request->all();
        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('/images/uploads/'), $filename);
            $svg_filename = '/images/uploads/'.$filename;
            $data["icon"] = $svg_filename;
        }

        $model = new PaymentMethodIcon();
        $model->create($data);

        Session::flash('flash_message', "Способ оплаты успешно добавлен");

        return redirect()->intended(route('setting.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentMethodIcon  $paymentMethodIcon
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethodIcon $paymentMethodIcon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaymentMethodIcon  $paymentMethodIcon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $model = PaymentMethodIcon::find($id);
        $title = "Редактирование иконки способа оплаты";

        return view('admin.setting.payment_method.form', compact('model', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymentMethodIcon  $paymentMethodIcon
     * @return \Illuminate\Http\Response
     */
    public function update(PageUpdateRequest $request, $id)
    {
        //

        $data = $request->all();
        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('/images/uploads/'), $filename);
            $svg_filename = '/images/uploads/'.$filename;
            $data["icon"] = $svg_filename;
        }

        $model = PaymentMethodIcon::find($id);
        $model->update($data);

        Session::flash('flash_message', "Способ оплаты успешно отредактирован");

        return redirect()->intended(route('setting.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentMethodIcon  $paymentMethodIcon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        PaymentMethodIcon::destroy($id);
        Session::flash('flash_message', "Способ оплаты успешно удален");

        return redirect()->intended(route('setting.index'));
    }
}
