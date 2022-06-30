<?php

namespace App\Providers;

use App\Models\Currency;
use App\Models\Language;
use App\Models\SocialMedia;
use App\Models\PaymentMethodIcon;
use App\Models\Word;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\CarBrand;
use App\Models\Setting;
use App\Models\Page;
use Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        view()->composer('*', function ($view) {
            $brands = CarBrand::whereHas('cars', function($q){
                $q->where('saved', true)->whereHas('simpleRent')->whereHas('images');
            })->get();
            $setting = Setting::first();
            $pages = Page::all();
            $other_pages = Page::where("basic", false)->where("footer", true)->get();
            $other_pages2 = Page::where("basic", false)->where("footer_right", true)->get();

            $half = ceil($other_pages->count() / 2);
            $other_pages = $other_pages->chunk($half);

            $langs = Language::where("active", true)->get();
            $sel_lang = $langs->where('code', app()->getLocale())->first();
            $words = Word::all();
            $curs = Currency::where('active', true)->get();
            $currency_id = Session::get('current_currency');
            $car_currency = Currency::find($currency_id);
            if($car_currency==null)
            {
                Session::put('current_currency', 1);
                $car_currency = Currency::find(1);
            }else
            {
                if(!$car_currency->active)
                {
                    Session::put('current_currency', 1);
                    $car_currency = Currency::find(1);
                }
            }
            $medias = SocialMedia::all();
            $payment_icons = PaymentMethodIcon::all();
            $view->with('brands',$brands)->with('setting', $setting)->with("langs",  $langs)
                ->with("words",  $words)->with('sel_lang', $sel_lang)->with('curs', $curs)
                ->with('pages', $pages)
                ->with('other_pages', $other_pages)
                ->with('other_pages2', $other_pages2)
                ->with('payment_icons', $payment_icons)
                ->with('medias', $medias)
                ->with("car_currency", $car_currency);
        });
    }
}
