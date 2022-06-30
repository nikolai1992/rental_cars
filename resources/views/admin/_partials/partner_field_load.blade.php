<div class="form-group">
    {!! Form::label('phone2',"Телефон 2") !!}
    <input type="text" name="phone2" id="phone2" class="form-control" value="{{$user->phone2}}">
</div>
<div class="form-group">
    {!! Form::label('phone3',"Телефон 3") !!}
    <input type="text" name="phone3" id="phone3" class="form-control" value="{{$user->phone3}}">
</div>
<div class="form-group">
    {!! Form::label('site',"Сайт") !!}
    <input type="text" name="site" class="form-control" value="{{$user->site}}">
</div>
<div class="form-group">
    {!! Form::label('role',"Штат") !!}
    <div class="input-group">
        <select class="custom-select" name="state" data-minimum-results-for-search="0" required>
            <option label="Выберите из списка"></option>
            <option value="1" {{$user->state=="1" ? 'selected' : ''}}>Эр-Рияд</option>
            <option value="2" {{$user->state=="2" ? 'selected' : ''}}>Мекка</option>
            <option value="3" {{$user->state=="3" ? 'selected' : ''}}>Медина</option>
            <option value="4" {{$user->state=="4" ? 'selected' : ''}}>Эль-Касим</option>
            <option value="5" {{$user->state=="5" ? 'selected' : ''}}>Эш-Шаркия</option>
            <option value="6" {{$user->state=="6" ? 'selected' : ''}}>Асир</option>
            <option value="7" {{$user->state=="7" ? 'selected' : ''}}>Табук</option>
            <option value="8" {{$user->state=="8" ? 'selected' : ''}}>Хаиль</option>
            <option value="9" {{$user->state=="9" ? 'selected' : ''}}>Эль-Худуд-эш-Шамалия</option>
            <option value="10" {{$user->state=="10" ? 'selected' : ''}}>Джизан</option>
            <option value="11" {{$user->state=="11" ? 'selected' : ''}}>Наджран</option>
            <option value="12" {{$user->state=="12" ? 'selected' : ''}}>Эль-Баха</option>
            <option value="13" {{$user->state=="13" ? 'selected' : ''}}>Эль-Джауф</option>
        </select>
    </div>
</div>