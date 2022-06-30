<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Translation;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Article\ArticleStoreRequest;
use App\Http\Requests\Admin\Article\ArticleUpdateRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Session;
use Image;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        date_default_timezone_set('Europe/Kiev');
    }
    public function index()
    {
        //
        $articles = Article::all();

        return view('admin.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Добавление новой статьи";
        $langs = Language::all();

        $model = new Article();

        return view('admin.article.form', compact('model', 'title', 'langs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleStoreRequest $request)
    {
        //

        $data = $request->all();
        unset($data["trans"]);
        $data["date_in"] = Carbon::parse($data["date_in"])->format("Y-m-d H:i");

        if ($request->file('image')) {
            $logo = $request->file('image');
            $filename = random_int(10000000, 99999999).time().".".$logo->getClientOriginalExtension();
            Image::make($logo)->save(public_path('images/uploads/'.$filename));
            $image = '/images/uploads/'.$filename;
            $data["image"] = $image;
        }

        $trans = $request->trans;

        $model = new Article();
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

        Session::flash('flash_message', "Новость успешно добавлена");

        return redirect()->route('article.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
        $title = "Редактирование статьи";
        $langs = Language::all();

        $model = $article;

        return view('admin.article.form', compact('model', 'title', 'langs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        //

        $data = $request->all();
        unset($data["trans"]);
        $data["date_in"] = Carbon::parse($data["date_in"])->format("Y-m-d H:i");
        $trans = $request->trans;
        if($request->file('image'))
        {
            $logo = $request->file('image');
            $filename = random_int(10000000, 99999999).time().".".$logo->getClientOriginalExtension();
            Image::make($logo)->save(public_path('images/uploads/'.$filename));
            $image = '/images/uploads/'.$filename;
            $data["image"] = $image;
        }

        $model = $article;
        $model->update($data);

        foreach ($trans as $lang_id => $fields) {
            foreach ($fields as $field => $value) {
                $model2 = $model->translates->where("language_id", $lang_id)->where('field', $field)->first();
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

        Session::flash('flash_message', "Новость успешно обновлена");

        return redirect()->route('article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
        $article->delete();
        Session::flash('flash_message', "Новость успешно удалена");

        return redirect()->route('article.index');
    }
}
