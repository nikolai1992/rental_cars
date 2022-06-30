<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Role;
use App\Models\Word;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Middleware\Locale;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $locale = Locale::getLocale() ? "/".Locale::getLocale() : Locale::getLocale();

        $this->redirectTo = $locale.$this->redirectTo;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    function getTranslWord($words, $sel_lang, $code)
    {
        return $words->where('name', $code)->first() ? $words->where('name', $code)->first()->translations->where("language_id", $sel_lang->id)->first()->value : '';
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:191'],
            'g-recaptcha-response' => ['required'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $words = Word::all();
        $sel_lang = Language::where('code', app()->getLocale())->first();
        $model = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role_id' => $data['role_id']!=Role::where('alias', 'admin')->first()->id ? $data['role_id'] :  Role::where('alias', 'client')->first()->id,
            'notification' => isset($data['notification']) ? true : false,
            'password' => Hash::make($data['password']),
        ]);
        $to = $model->email;

        $title = $this->getTranslWord($words, $sel_lang, "dear_customer");
        $body = "<p>".$this->getTranslWord($words, $sel_lang, "dear_customer")."</p>";
        $body = $body."<p>".$this->getTranslWord($words, $sel_lang, "you_have_successfully_registered")."</p>";
        $body = $body."<p>Email: ".$to."</p>";
        $body = $body."<p>".$this->getTranslWord($words, $sel_lang, "password").": ".$data['password']."</p>";
        $this->sendMail($to, $title, $body);
        return $model;
    }
    function sendMail($to, $title, $body)
    {
        $headers = "MIME-Version: 1.0 \r\n";
        $headers .= "Content-Transfer-Encoding: 8bit \r\n";
        $headers .= "Content-type:text/html;charset=utf-8 \r\n"; //кодировка и тип контента
        $headers .= "From: " .'Rental Cars'. " \r\n"; // откуда письмо
        $headers .= "Reply-To: support@rentalcars.one/ \r\n"; // отвечать на адрес
        $headers .= 'X-Mailer: PHP/' . phpversion();

        // отправка письма
        if (!mail($to, $title, $body, $headers)) {
            echo "Возникла ошибка, попробуйте ещй раз!";
        };

    }
}
