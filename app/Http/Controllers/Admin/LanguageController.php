<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Models\Translation;
use App\Models\Word;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Language\LanguageStoreRequest;
use App\Http\Requests\Admin\Language\LanguageUpdateRequest;
use Session;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $languages = Language::all();
        $words = Word::all();

        return view('admin.language.index', compact('languages', 'words'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Добавление нового языка";
        $model = new Language();

        return view('admin.language.form', compact('model', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LanguageStoreRequest $request)
    {
        //
        $model = new Language();
        $words = Word::all();
        $data = $request->all();
        $data["active"] = isset($data["active"]) ? true : false;
        $data["main"] = isset($data["main"]) ? true : false;

        if ($data["main"]) {
            $lang = Language::where('main', true)->first();
            if ($lang) {
                $lang->update([
                    'main'=>false
                ]);
            }

        }

        $model = $model->create($data);
        foreach ($words as $word) {
            Translation::create([
               "word_id"=>$word->id,
                "language_id" => $model->id
            ]);
        }

        Session::flash('flash_message', "Язык успешно добавлен");

        return redirect()->route("language.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        //
        $title = "Редактирование языка";
        $model = $language;

        return view('admin.language.form', compact('model', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(LanguageUpdateRequest $request, Language $language)
    {
        //

        $data = $request->all();
        $data["active"] = isset($data["active"]) ? true : false;
        $data["main"] = isset($data["main"]) ? true : false;
        if ($data["main"]) {
            $lang = Language::where('main', true)->first();
            if ($lang) {
                $lang->update([
                    'main'=>false
                ]);
            }

        }

        $language->update($data);

        Session::flash('flash_message', "Язык успешно обновлено");

        return redirect()->route("language.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        //
        Translation::where('language_id', $language->id)->delete();
        $language->delete();
        Session::flash('flash_message', "Язык успешно удален");

        return redirect()->route("language.index");
    }
}
