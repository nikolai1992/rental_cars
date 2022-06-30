<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Models\Translation;
use App\Models\Word;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class TranslationController extends Controller
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
        $data = [
            "title"=>    "Добавление нового перевода",
            "model"=>new Word(),
            "languages"=>Language::all()
        ];

        return view('admin.language.translation.form')->with($data);
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
        $this->validate($request, [
            'name'=> 'required|max:191|regex:#^[\w-]#|unique:words,name',
        ]);

        $word = Word::create([
           'name'=>$request->name
        ]);

        if (isset($request->lang)) {
            foreach ($request->lang as $key => $value) {
                $model2 = Translation::create([
                   "language_id"=> $key,
                    "word_id" => $word->id,
                    "value" => $value
                ]);
                $word->translations()->attach($model2->id);
            }
        }

        Session::flash('flash_message', "Перевод успешно добавлен");

        return redirect()->route('language.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function show(Translation $translation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = [
            "title"=>    "Редактирование перевода",
            "model"=> Word::find($id),
            "languages"=>Language::all()
        ];

        return view('admin.language.translation.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name'=> 'required|max:191|regex:#^[\w-]#|unique:words,name,'.$id,
        ]);

        $word = Word::find($id);
        $word->update([
            'name'=>$request->name
        ]);

        if (isset($request->lang)) {
            foreach ($request->lang as $key => $value) {
                $model2 = $word->translations->where("language_id", $key)->where('field', "name")->first();
                if ($model2) {
                    $model2->update([
                        "value"=>$value
                    ]);
                } else {
                    $model2 = new Translation();
                    $model2 = $model2->create([
                        "language_id"=>$key,
                        "field"=>"name",
                        "value"=>$value
                    ]);
                    $word->translations()->attach($model2->id);
                }
            }
        }

        Session::flash('flash_message', "Перевод успешно обновлен");

        return redirect()->route('language.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Word::destroy($id);

        Session::flash('flash_message', "Перевод успешно удален");

        return redirect()->back();
    }
}
