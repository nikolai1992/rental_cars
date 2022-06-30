<?php

namespace App\Http\Controllers\Admin;

use App\Models\FAQ;
use App\Models\Translation;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FAQ\FAQStoreRequest;
use App\Http\Requests\Admin\FAQ\FAQUpdateRequest;
use Session;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $faqs = FAQ::all();

        return view('admin.faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $model = new FAQ();
        $title = "Добавление нового FAQ";
        $langs = Language::all();

        return view('admin.faq.form', compact('model', 'title', 'langs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FAQStoreRequest $request)
    {
        //
        $model = new FAQ();
        $data = $request->all();
        unset($data["trans"]);
        $trans = $request->trans;

        $model = $model->create($data);

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

        Session::flash('flash_message', "FAQ успешно добавлен");

        return redirect()->route('faq.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function show(FAQ $fAQ)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $model = FAQ::find($id);
        $title = "Редактирование FAQ";
        $langs = Language::all();

        return view('admin.faq.form', compact('model', 'title', 'langs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function update(FAQUpdateRequest $request, $id)
    {
        //
        $model = FAQ::find($id);
        $data = $request->all();
        unset($data["trans"]);
        $trans = $request->trans;

        $model->update($data);

        foreach ($trans as $lang_id => $fields) {
            foreach ($fields as $field => $value) {
                $model2 = $model->translates->where("language_id", $lang_id)
                    ->where('field', $field)->first();
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
                    $model->translates()->attach($model2->id);
                }

            }
        }

        Session::flash('flash_message', "FAQ успешно обновлен");

        return redirect()->route('faq.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        FAQ::destroy($id);

        Session::flash('flash_message', "FAQ успешно удален");

        return redirect()->route('faq.index');
    }
}
