<div class="user-block__top">
    <div class="user-block__profile">
        <div>
            <form style="display: none;" enctype="multipart/form-data" action="{{route("change_avatar")}}" method="post">
                @csrf
                <input id="user-block-img" class="user-block-img" name="image" type="file" accept="image/*"  style="opacity: 0">
            </form>
                <label for="user-block-img"></label><span>JS</span>
               <img src="{{asset(auth()->user()->image)}}" style="{{!auth()->user()->image ? 'display:none' : ''}}" alt="">


        </div>
        <div><span>{{auth()->user()->first_name}}</span></div>

    </div>
    <a href="#" class="user-block__logout">{{getTranslWord($words, $sel_lang, "exit")}}</a>
</div>
<ul class="user-block__menu">
    <li class="{{\Request::route()->getName()=='client.profile' ? 'active' : ''}}"><a href="{{route('client.profile')}}">{{getTranslWord($words, $sel_lang, "profile")}}</a></li>
    <li class="{{\Request::route()->getName()=='client.my_orders' ? 'active' : ''}}"><a href="{{route('client.my_orders')}}">{{getTranslWord($words, $sel_lang, "my_reservations")}}</a></li>
    <li class="{{\Request::route()->getName()=='client_ticket.index' ? 'active' : ''}}"><a href="{{route('client_ticket.index')}}">{{getTranslWord($words, $sel_lang, "my_tickets")}}</a></li>
    <li class="{{\Request::route()->getName()=='client_payment_method.index' ? 'active' : ''}}"><a href="{{route('client_payment_method.index')}}">{{getTranslWord($words, $sel_lang, "payment_methods")}}</a></li>
</ul>