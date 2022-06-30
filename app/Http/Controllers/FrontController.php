<?php

namespace App\Http\Controllers;

use App\Services\SendEmail;
use App\Filters\CarFilter;
use App\Filters\CarWithDriverFilter;
use App\Models\Currency;
use App\Models\Order;
use App\Models\OrderDriver;
use App\Models\PageTranslation;
use App\Models\Page;
use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarBrand;
use App\Models\Review;
use App\Models\FAQ;
use App\Http\Requests\SimpleRentMailRequest;
use App\Http\Requests\WithDriverRentMailRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Session;
use DB;
use Image;

class FrontController extends Controller
{
    //
    public function __construct()
    {
        date_default_timezone_set('Europe/Kiev');
    }
    public function test()
    {
        $data = DB::select('select * from ticket_status_translations');
        foreach ($data as $d)
        {
            $ticket_status_id = strval($d->ticket_status_id);

//            $t = new Translation();
//            $t = $t->create([
//                "field"=>$d->field,
//                "value"=>$d->value,
//                "language_id"=>$d->language_id
//            ]);
//            if($ticket_status_id)
//            {
//                $sql = "insert into translationsables (translation_id, translationsable_id, translationsable_type) values (".$t->id.",".$ticket_status_id.",'ticket status')";
//                DB::insert($sql);
//            }

        }
//        foreach ($data as $d)
//        {
//            $d->field = "name";
//            $d->save();
//            DB::insert('insert into translationsables (translation_id, translationsable_id, translationsable_type) values ('.$d->id.', '.$d->article_id.', "article")');
//        }
//        dd($data);
    }

    public function index()
    {
        $brandsSimpleRent = CarBrand::whereHas('cars', function($q){
            $q->whereHas('simpleRent');
        })->get();
        $faqs = FAQ::all();
        $half = ceil($faqs->count() / 2);
        $faqs = $faqs->chunk($half);

        $data = [
            "cars"  => Car::where('saved', true)->where('rent_type', 'simple_rent')->whereHas('carBrand')->whereHas('images')->get(),
            "brandsSimpleRent"=>$brandsSimpleRent,
            "faqs"=>$faqs,
            "current_page"=>Page::where('alias', 'main')->first(),
            "half"=>$half,

        ];

        return view('front.main')->with($data);
    }
    public function news()
    {
        $data = [
          "news"  => Article::paginate(10),
          "current_page"=>Page::where('alias', 'cars')->first()
        ];

        return view('front.news')->with($data);
    }
    public function writeComment(Request $request)
    {
        $data = $request->all();

        ArticleComment::create($data);

        return redirect()->back();
    }
    public function newRead($alias)
    {
        $current_page = Article::where('alias', $alias)->firstOrFail();
        $data = [
            "news"  => Article::where('alias', '!=', $alias)->get(),
            "current_page"=>$current_page
        ];

        $views = $current_page->views+1;
        $current_page->update([
            "views" => $views
        ]);

        return view('front.article_single')->with($data);
    }
    public function changeAvatar(Request $request)
    {
        $this->validate($request, [
            'image' =>'image|required|mimes:jpeg,png,jpg',
        ]);

        $user = auth()->user();
        $data = [];
        if ($request->file('image')) {
            $logo = $request->file('image');
            $filename = random_int(10000000, 99999999).time().".".$logo->getClientOriginalExtension();
            Image::make($logo)->save(public_path('images/uploads/'.$filename));
            $image = '/images/uploads/'.$filename;
            $data["image"] = $image;
        }

        $user->update($data);

        return redirect()->back();
    }
    public function sendReview(Request $request)
    {
        $data = $request->all();

        $model = new Review();
        $data["user_id"] = auth()->user()->id;

        $model->create($data);

        return redirect()->back();
    }
    public function payment()
    {
        return view('front.payment');
    }
    public function reviews()
    {

        $data = [
            "news"  => Article::all()->sortBy('date_in'),
            "reviews"  => Review::all()->sortBy('date_in'),
            "current_page"=> Page::where('alias', 'reviews')->first()
        ];

        return view('front.reviews')->with($data);
    }
    public function changeCur($id)
    {
        $currency = Currency::find($id);
        Session::put('current_currency_name', $currency->name);
        Session::put('current_currency', $currency->id);

        return redirect()->back();
    }
    public function contacts()
    {
        $current_page = Page::where('alias', 'contacts')->first();

        return view('front.contacts', compact('current_page'));
    }
    public function car($alias)
    {
        $car = Car::where("alias", $alias)->firstOrFail();

        $other_cars = Car::where('saved', true)->where('rent_type', 'simple_rent')->whereHas('images')
            ->where('cars.alias', '!=', $alias);
        $other_cars = $this->sortingCars($other_cars, "recommend", 'simple_rent');
        $other_cars = $other_cars->limit(4)->get();

        return view('front.one_car', compact('car', 'other_cars'));
    }
    public function mediaRequirements()
    {
        $page = Page::where('alias', 'partner-add-car-media-requirements')->first();
        $route = $_GET["route"];
        $id = $_GET["id"];

        if ($route == "partner_car.create.stage2") {
            Session::flash('added_car', $id);
        }

        return view('front.media_requirements', compact('page', 'route', 'id'));
    }
    public function carWithDriver($alias)
    {
        $car = Car::where("alias", $alias)->firstOrFail();
        $other_cars = Car::where('saved', true)->whereHas('carBrand')->whereHas('driverRent')->whereHas('images')
            ->where('id', '!=', $car->id)->limit(5)->get();

        return view('front.one_car_with_driver', compact('car', 'other_cars'));
    }
    function sortingCars($cars, $value, $rent_type)
    {
        if ($value == "recommend") {
            if ($rent_type == "simple_rent") {
                return $cars->leftJoin('orders', 'orders.car_id', '=', 'cars.id')->selectRaw('cars.*, count(orders.id) as ordersCount')->groupBy('cars.id')
                    ->orderByDesc('ordersCount');
            }
            if ($rent_type == "with_driver") {
                return $cars->leftJoin('order_drivers', 'order_drivers.car_id', '=', 'cars.id')->selectRaw('cars.*, count(order_drivers.id) as ordersCount')->groupBy('cars.id')
                    ->orderByDesc('ordersCount');
            }
        }
        if ($value == "fromHighPrice") {
            if ($rent_type == "simple_rent") {
                return $cars->join('rents', 'rents.car_id', '=', 'cars.id')->select("cars.*", "rents.price_day_30")
                    ->orderByDesc('rents.price_day_30');
            }
            if ($rent_type == "with_driver") {
                return $cars->join('driver_rents', 'driver_rents.car_id', '=', 'cars.id')
                    ->select("cars.*", "driver_rents.price_per_hour_3")
                    ->orderByDesc('driver_rents.price_per_hour_3');
            }
        }
        if ($value == "fromLowPrice") {
            if ($rent_type == "simple_rent") {
                return $cars->join('rents', 'rents.car_id', '=', 'cars.id')
                    ->select("cars.*", "rents.price_day_30")
                    ->orderBy('rents.price_day_30');
            }
            if ($rent_type == "with_driver") {
                return $cars->join('driver_rents', 'driver_rents.car_id', '=', 'cars.id')
                    ->select("cars.*", "driver_rents.price_per_hour_3")
                    ->orderBy('driver_rents.price_per_hour_3');
            }
        }
        if ($value == "alphabetOrder") {
            return $cars->join('car_brands', 'car_brands.id', '=', 'cars.brand_id')->select("cars.*", "car_brands.name", DB::raw("CONCAT(car_brands.name,' ',cars.model) as full_name"))->orderBy('full_name');
        }
    }

    public function carsWithDriver(CarWithDriverFilter $request)
    {
        $sortedBy = null;
        $date = Session::get('date');
        $selected_city = Session::get('work_location');
        $selected_car_class = isset($_GET['car_class']) ? $_GET['car_class'] : '';
        $time = Session::get('time');

        $cars = new Car();
        $cars = $cars->whereHas('carBrand')->where('rent_type', 'with_driver')->where('saved', true)->whereHas('images');

        if (isset($_GET["filter"])) {

            $selected_city = $_GET["city"];
            $date = $_GET["date"];
            $time = $_GET["time"];

            Session::put('date', $date);
            Session::put('time', $time);
            Session::put('work_location', $selected_city);
        }

        $cars_total_count = count($cars->get());
        $page_url =(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if (isset($_GET["page"])) {
            $page = $_GET["page"];
            $page_url = str_replace('page='.$page."&", "", $page_url);
            $page_url = str_replace('page='.$page, "", $page_url);
        }
        $page_url2 =$page_url;

        if (isset($_GET["sortBy"])) {
            $sortedBy = $_GET["sortBy"];
            $cars = $this->sortingCars($cars, $_GET["sortBy"], 'with_driver');

            $page_url2 = str_replace('sortBy='.$sortedBy."&", "", $page_url2);
            $page_url2 = str_replace('sortBy='.$sortedBy, "", $page_url2);
        } else {
            $cars = $this->sortingCars($cars, "recommend", 'with_driver');
        }

        $cars = $cars->filter2($request)->paginate(10);
        return view('front.cars_rent_driver', compact('cars', 'cars_total_count', 'page_url',
            'date', 'selected_city', 'time', 'page_url2', 'sortedBy', 'selected_car_class'));
    }

    public function cars(CarFilter $request)
    {
        $brandsSimpleRent = CarBrand::whereHas('cars', function($q){
            $q->whereHas('simpleRent');
        })->get();
        $sortedBy = null;
        $selected_brands = null;
        $selected_city = null;
        $selected_car_class = null;
        $only_free_cars = null;
        $from_date = Session::get('from_date');
        $to_date = Session::get('to_date');
        $cars = new Car();
        $cars = $cars->whereHas('carBrand')->where('rent_type', 'simple_rent')->where('saved', true)->whereHas('images');

        if (isset($_GET["filter"])) {
            $selected_brands = isset($_GET["brands"]) ? $_GET["brands"] : '';
            $selected_city = $_GET["city"];
            $selected_car_class = $_GET["car_class"];
            $from_date = $_GET["from_date"];
            $to_date = $_GET["to_date"];
            Session::put('from_date', $from_date);
            Session::put('to_date', $to_date);

            if (isset($_GET["free_cars"])) {
                $only_free_cars = true;
            }
        }

        $cars_total_count = count($cars->get());
        $page_url =(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
            $page_url = str_replace('page='.$page."&", "", $page_url);
            $page_url = str_replace('page='.$page, "", $page_url);
        }

        $page_url2 =$page_url;
        if (isset($_GET["sortBy"])) {
            $sortedBy = $_GET["sortBy"];
            $cars = $this->sortingCars($cars, $_GET["sortBy"], 'simple_rent');
            $page_url2 = str_replace('sortBy='.$sortedBy."&", "", $page_url2);
            $page_url2 = str_replace('sortBy='.$sortedBy, "", $page_url2);
        } else {
            $cars = $this->sortingCars($cars, "recommend", 'simple_rent');
        }

        $cars = $cars->filter($request)->paginate(10);
        return view('front.cars', compact('cars', 'brandsSimpleRent', 'page_url',
            'cars_total_count', 'selected_brands', 'selected_city', 'selected_car_class', 'from_date',
            'to_date', 'sortedBy', 'page_url2', 'only_free_cars'));
    }

    public function rentCondition()
    {
        $page = Page::where('alias', 'rent_condition')->first();
        $current_page = Page::where('alias', 'rent_condition')->first();
        return view('front.dynamical', compact('page', 'current_page'));
    }

    public function brands()
    {
        return view('front.brands');
    }

    function CurrencyConverter($price, $dollar_rate)
    {
        return round($price/$dollar_rate, 2);
    }

    public function bookingCarSimpleRent($id)
    {
        $car = Car::find($id);
        $data_from = $_GET["date_from"];
        $data_to = $_GET["date_to"];
        $city = isset($_GET["city"]) ? $_GET["city"] : '';
        $from = Carbon::parse($data_from);
        $to = Carbon::parse($data_to);
        $diffDays =  $to->diffInDays($from);
        $another_location = isset($_GET["another_location"]) ? true : false;
        $time = $_GET["time"] ? $_GET["time"]-1 : '';
        $total_price_per_days = $car->simpleRentGetPrice($diffDays);
        $setting = Setting::first();
        $vat_tax_price = $car->getPriceFromPercentVat($total_price_per_days, $setting->vat_tax);
        $final_price = $total_price_per_days+$vat_tax_price;

        return view('front.booking_simple', compact('car', 'data_from', 'data_to', 'time', 'another_location',
            'diffDays', 'total_price_per_days', 'vat_tax_price', 'final_price', 'city', 'time'));
    }

    public function bookingCarWithDriver($id)
    {
        $car = Car::find($id);
        $price = $car->driverRent ? $car->driverRent->price_per_hour_3 : 0;
        $setting = Setting::first();
        $vat_tax_price = $car->getPriceFromPercentVat($price, $setting->vat_tax);
        $final_price = $price+$vat_tax_price;

        return view('front.booking_with_driver', compact('car', 'final_price'));

    }
    /**
    Price with driver
     **/
    public function getPrice(Request $request)
    {
        $car = Car::find($request->car_id);
        $duration = $request->duration;
        $price = $car->driverRent->{'price_per_hour_'.$duration};
        $currency_id = Session::get('current_currency');
        $car_currency = Currency::find($currency_id);

        if ($car_currency == null) {
            Session::put('current_currency', 1);
            $car_currency = Currency::find(1);
        } else {
            if (!$car_currency->active) {
                Session::put('current_currency', 1);
                $car_currency = Currency::find(1);
            }
        }

        $setting = Setting::first();
        $vat_tax_price = $car->getPriceFromPercentVat($price, $setting->vat_tax);
        $final_price = $price+$vat_tax_price;
        $price = $car_currency->symbol." ".$this->CurrencyConverter($final_price,$car_currency->dollar_rate);

        return $price;
    }

    public function sendMailWithDriverRent(WithDriverRentMailRequest $request)
    {
        $order_number = $this->setNewOrderNum();
        $name = $request->fio;
        $price = $request->total_price;
        $time = $request->time;
        $time = $time<10 ? '0'.$time : $time;
        $phone = $request->phone;
        $email = $request->email;
        $duration = $request->duration;
        $date = $request->date;
        $location = $request->location;
        $car = Car::find($request->car_id);
        $user = auth()->user();

        $order = new OrderDriver();
        $order->fio = $name;
        $order->phone = $phone;
        $order->email = $email;
        $order->user_id = $user->id;
        $order->car_id = $request->car_id;
        $order->location = $location;
        $order->date = Carbon::parse($date)->format("Y-m-d H:i");
        $order->time = $time;
        $order->price = $price;
        $order->order_number = $order_number;
        $order->duration = $duration;
        $order->status = "in_process";
        $order->payment_status = "upon_receipt";
        $order->save();
        date_default_timezone_set('Europe/Kiev');
        $title = 'Клиент оставляет онлайн заявку на аренду автомобиля с водителем '.date('Y.m.d H:i:s'); // заголовок письма
        $body = view('_partials._email', compact('car', 'name', 'phone', 'email',
            'location', 'date', 'time', 'duration', 'price', 'user'))->render();
        $setting = Setting::first();

        $to    = $setting->email;
        if ($to != "") {
            SendEmail::sendMail($to, $title, $body);
        }

        $to = $email;
//        $to = "19nikolai92@gmail.com";
        if ($to!="") {
            $title = 'Ваша заявка на автомобиль взята на рассмотрение - RentalCars'; // заголовок письма
            $body = view('email.in_process2', compact('order'));

            // отправка письма
            if (SendEmail::sendMail($to, $title, $body)) {
                return redirect()->route('booking_thank_form', ["id"=>$request->car_id, "driver"=>true]);
            } else {
                echo "Возникла ошибка, попробуйте ещй раз!";
            };
        }

    }

    function setNewOrderNum()
    {
        $order_num = [];
        $order_num[] = Order::max('order_number') ? Order::max('order_number') : 0;
        $order_num[] = OrderDriver::max('order_number') ? OrderDriver::max('order_number') : 0;
        $order_number = max($order_num)+1;

        return $order_number;
    }

    public function sendMailSimpleRent(SimpleRentMailRequest $request)
    {
        $order_number = $this->setNewOrderNum();
        $total_per_days = $request->total_per_days;
        $vat_tax = $request->vat_tax;
        $total_price = $request->total_price;
        $time = $request->time;
        $time = $time<10 ? '0'.$time : $time;
        $diffDays = $request->diffDays;
        $phone = $request->phone;
        $email = $request->email;
        $message = $request->message;
        $from_date = $request->from_date;
        $date_to = $request->from_to;
        $fio = $request->fio;

        $user = auth()->user();

        $order = new Order();
        $order->user_id = $user->id;
        $order->fio = $fio;
        $order->email = $email;
        $order->phone = $phone;
        $order->car_id = $request->car_id;
        $order->message = $message;
        $order->city = $request->city;
        $order->another_location = $request->another_location ? true : false;
        $order->order_number = $order_number;
        $order->time = $time;

        $order->from_date = Carbon::parse($from_date)->format("Y-m-d H:i");
        $order->to_date = Carbon::parse($date_to)->format("Y-m-d H:i");

        $order->total_per_days = $total_per_days;
        $order->vat_tax = $vat_tax;
        $order->total_price = $total_price;
        $order->status = $request->pay_fifteen ? "approved" : "in_process";
        $order->payment_status = $request->pay_fifteen ? "payed" : "upon_receipt";
        $order->international_law = isset($request->international_law) ? true : false;
        $order->save();
        $car = Car::find($request->car_id);
        $setting = Setting::first();
        $city = "";

        if ($request->city == 1) {
            $city = "Дубай (международный аэропорт дубай (DXB)";
        }
        if ($request->city == 2) {
            $city = "Абу-даби";
        }
        if ($request->city == 3)
        {
            $city = "Шарджа";
        }
        if ($request->city == 4) {
            $city = "Рас-эль-хайм";
        }
        $international_law = $request->international_law;
        date_default_timezone_set('Europe/Kiev');
        $body = view('_partials._email2', compact('car', 'fio', 'phone', 'email', 'city', 'international_law',
            'message', 'from_date', 'date_to', 'diffDays', 'total_per_days', 'setting', 'vat_tax', 'total_price', 'user',
            'time'))->render();

        $to = $setting->email;

        if ($to != "") {
            $title = 'Ваша заявка на автомобиль взята на рассмотрение - RentalCars'; // заголовок письма
            SendEmail::sendMail($to, $title, $body);
        }

        if (auth()->user()->role->alias == "partner") {
            $redirect_profile_url = route('partner.my_orders');
        }
        if (auth()->user()->role->alias == "client") {
            $redirect_profile_url = route('client.my_orders');
        }
        if ($order->status == "in_process") {
            $to = $order->email;
            if ($to) {
                $order->approved_booking = null;
                $title = 'Ваша заявка на автомобиль взята на рассмотрение - RentalCars'; // заголовок письма

                if ($order->table == "order_drivers") {
                    $body = view('email.in_process2', compact('order'))->render();
                }
                if ($order->table == "orders") {
                    $body = view('email.in_process', compact('order'))->render();
                }

                SendEmail::sendMail($to, $title, $body);
            }
        }
        if ($order->status == "approved") {
            $to = $order->email;
            if ($to) {
                $order->approved_booking = Carbon::now()->format("Y-m-d H:i:s");

                $title = 'Ваша заявка на автомобиль успешно принята - RentalCars'; // заголовок письма

                if ($order->table == "order_drivers") {
                    $search_cars = route('cars_rent_with_driver.page');
                    $body = view('email.approved2', compact('order', 'search_cars', 'redirect_profile_url'))->render();
                }
                if ($order->table == "orders") {
                    $search_cars = route('cars.page');
                    $body = view('email.approved', compact('order', 'search_cars', 'redirect_profile_url'))->render();
                }
                SendEmail::sendMail($to, $title, $body);
            }
        }
        return redirect()->route('booking_thank_form', $car->id);
    }

    public function sendEmail(Request $request)
    {
        $subject = $request->subject;
        $name = $request->name;
        $email = $request->email;
        $booking_number = $request->booking_number;
        $description = $request->description;
        $setting = Setting::first();

        date_default_timezone_set('Europe/Kiev');
        $title = 'Клиент желает получить консультацию'; // заголовок письма
        $body = view('_partials._email_client_booking', compact('title', 'subject', 'name',
            'email', 'booking_number', 'description'));

        $to    = $setting->email;

        if($to != "")
        {
            $title = 'Клиент желает получить консультацию - RentalCars'; // заголовок письма
            SendEmail::sendMail($to, $title, $body);
        }

        return redirect()->back();
    }

    public function dynamicalPage($alias)
    {
        $current_page = Page::where('alias', $alias)->firstOrFail();

        return view('front.dynamical', compact('current_page'));
    }

    public function faq()
    {
        $current_page = Page::where('alias', "faq")->first();
        $faqs = FAQ::all();

        return view('front.faq', compact('current_page', 'faqs'));
    }

    public function thankFrom($id, $driver=false)
    {
        $car = Car::find($id);
        $car_page_url = $car->rent_type=="simple_rent" ? route('one_car.page', $car->alias) : route('cars_rent_with_driver.page', $car->alias);

        return view('front.thank_form', compact('car', 'driver', 'car_page_url'));
    }

    public function sortCarsByClass($class)
    {
        $cars = Car::where('saved', true)->where('car_class', $class)->whereHas('images');
        $cars_total_count = count($cars->get());

        $selected_brands = null;
        $selected_city = null;
        $sortedBy = null;
        $selected_car_class = null;
        $from_date = Session::get('from_date');
        $to_date = Session::get('to_date');
        $brandsSimpleRent = CarBrand::whereHas('cars', function($q){
            $q->whereHas('simpleRent');
        })->get();
        $only_free_cars = false;

        $page_url =(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
            $page_url = str_replace('page='.$page, "", $page_url);
        }

        $page_url2 = $page_url;
        if (isset($_GET["sortBy"])) {
            $sortedBy = $_GET["sortBy"];
            $cars = $this->sortingCars($cars, $_GET["sortBy"], 'simple_rent');

            $page_url2 = str_replace('sortBy='.$sortedBy."&", "", $page_url2);
            $page_url2 = str_replace('sortBy='.$sortedBy, "", $page_url2);
        }

        $cars = $cars->paginate(10);
        return view('front.cars', compact('cars', 'to_date', 'from_date', 'selected_car_class',
            'selected_city', 'selected_brands', 'brandsSimpleRent', 'page_url', 'cars_total_count', 'page_url2',
            'sortedBy', 'only_free_cars'));
    }

    public function sortCarsByBrand($alias)
    {
        $brandsSimpleRent = CarBrand::whereHas('cars', function($q){
            $q->whereHas('simpleRent');
        })->get();
        $cars =  Car::whereHas('carBrand', function($q) use ($alias){
            $q->where('name', $alias);
        })->where('saved', true)->whereHas('simpleRent')->whereHas('images');
        $cars_total_count = count($cars->get());
        $only_free_cars = false;

        $page_url =(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
            $page_url = str_replace('&page='.$page, "", $page_url);
        }

        $selected_brands = null;
        $selected_city = null;
        $sortedBy = null;
        $selected_car_class = null;
        $from_date = Session::get('from_date');
        $to_date = Session::get('to_date');

        $page_url2 = $page_url;
        if (isset($_GET["sortBy"])) {
            $sortedBy = $_GET["sortBy"];
            $cars = $this->sortingCars($cars, $_GET["sortBy"], 'simple_rent');

            $page_url2 = str_replace('sortBy='.$sortedBy."&", "", $page_url2);
            $page_url2 = str_replace('sortBy='.$sortedBy, "", $page_url2);
        }

        $cars = $cars->paginate(10);
        return view('front.cars', compact('cars', 'brandsSimpleRent', 'page_url', 'cars_total_count',
            'selected_car_class', 'selected_city', 'selected_brands', 'from_date', 'to_date', 'page_url2',
            'sortedBy', 'only_free_cars'));
    }
}
