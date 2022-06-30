<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Models\Language;
use App\Models\Translation;
use Session;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Page\PageStoreRequest;
use App\Http\Requests\Admin\Page\PageUpdateRequest;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $models = Page::all();

        return view('admin.menu.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $model = new Page();
        $langs = Language::all();

        return view("admin.menu.create", compact('model', 'langs'));
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
        unset($data["trans"]);
        $data["footer"] = isset($data["footer"]) ? true : false;
        $data["footer_right"] = isset($data["footer_right"]) ? true : false;
        $data["header"] = isset($data["header"]) ? true : false;
        $data["mob_menu"] = isset($data["mob_menu"]) ? true : false;
        $trans = $request->trans;

        $model = new Page();
        $model = $model->create($data);
        foreach ($trans as $lang_id => $fields) {
            foreach ($fields as $field => $value) {
                $model2 = new Translation();
                $model2 = $model2->create([
                    "language_id"=>$lang_id,
                    "field"=>$field,
                    "value"=>$value
                ]);
                $model->translations()->attach($model2->id);
            }
        }

        Session::flash('flash_message', "Страница успешно добавлена");

        return redirect()->route('page.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        //
        $title="Редактирование страницы ".$page->name;
        $model = $page;
        $languages = Language::all();

        return view('admin.menu.form', compact('title', 'model', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(PageUpdateRequest $request, Page $page)
    {
        //

        $data = $request->all();
        $data["footer"] = isset($data["footer"]) ? true : false;
        $data["header"] = isset($data["header"]) ? true : false;
        $data["mob_menu"] = isset($data["mob_menu"]) ? true : false;
        $data["footer_right"] = isset($data["footer_right"]) ? true : false;
        unset($data["trans"]);
        $trans = $request->trans;

        $page->update($data);
        foreach ($trans as $lang_id => $fields) {
            foreach ($fields as $field => $value) {
                $model2 = $page->translations->where("language_id", $lang_id)->where('field', $field)->first();
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
                    $page->translations()->attach($model2->id);
                }

            }
        }

        Session::flash('flash_message', "Страница успешно обновлена");

        return redirect()->intended(route('page.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
        $page->delete();
        Session::flash('flash_message', "Страница успешно удалена");

        return redirect()->intended(route('page.index'));
    }
}
