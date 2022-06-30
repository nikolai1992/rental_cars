
<div class="user-block__top">
    <div class="user-block__profile">
        <div>
            <form style="display: none;" enctype="multipart/form-data" action="{{route("change_avatar")}}" method="post">
                @csrf
                <input id="user-block-img" class="user-block-img" name="image" type="file" accept="image/*" style="opacity: 0">
            </form>
            <label for="user-block-img"></label><span>JS</span>
            <img src="{{asset(auth()->user()->image)}}" style="{{!auth()->user()->image ? 'display:none' : ''}}" alt="">
        </div>
        <div><span>{{$user->name}}</span><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "balance")}}: <span class="font-medium text-accent2">50 $</span></span>
            <span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "number_orders")}}: <span class="font-medium text-accent2">{{$user->getUnresolvedOrders()}}</span></span>
            <span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "sum_orders")}}: <span class="font-medium text-accent2">{{$car_currency->symbol}} {{App\Models\Currency::CurrencyConverter($user->getUnresolvedOrdersPrice(),$car_currency->dollar_rate)}}</span></span>
        </div>
    </div>
    <a href="#" class="user-block__logout">{{App\Models\Translation::getTranslWord($words, $sel_lang, "exit")}}</a>
</div>
<ul class="user-block__menu user-block__menu--stretch">
    <li class="{{\Request::route()->getName()=='partner_car.index' ? 'active' : ''}}">
        <a href="{{route('partner_car.index')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "my_cars")}}</a>
    </li>
    <li class="{{\Request::route()->getName()=='partner.my_orders' ? 'active' : ''}}"><a href="{{route('partner.my_orders')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "order_history")}}</a></li>
    <li class="{{\Request::route()->getName()=='partner.index' ? 'active' : ''}}">
        <a href="{{route('partner.index')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "profile")}}</a>
    </li>
    <li class="{{\Request::route()->getName()=='partner.balance.index' ? 'active' : ''}}"><a href="{{route('partner.balance.index')}}" >{{App\Models\Translation::getTranslWord($words, $sel_lang, "top_balance")}}</a></li>
    <li class="{{\Request::route()->getName()=='partner_ticket.index' ? 'active' : ''}}"><a href="{{route('partner_ticket.index')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "ticket")}}</a></li>
    <li class="{{\Request::route()->getName()=='partner.ads.index' ? 'active' : ''}}"><a href="{{route('partner.ads.index')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "advertising_placement")}}</a></li>
</ul>