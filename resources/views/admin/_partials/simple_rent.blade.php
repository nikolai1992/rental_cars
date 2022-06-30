<div class="col-md-3">
    {!! Form::label('deposit',"Депозит, $") !!}
    <input type="number" name="rent[deposit]" id="deposit" class="form-control" value="{{$model->simpleRent ? $model->simpleRent->deposit : ''}}" step="0.01">
</div>
<div class="col-md-3">
    {!! Form::label('mileage_limit',"Лимит пробега в сутки, км. ") !!}
    <input type="number" name="rent[mileage_limit]" id="mileage_limit" class="form-control" value="{{$model->simpleRent ? $model->simpleRent->mileage_limit : ''}}">
</div>
<div class="col-md-3">
    {!! Form::label('const_for_one_km',"Стоимость за 1 км. при превышении лимита, $") !!}
    <input type="number" name="rent[const_for_one_km]" id="const_for_one_km" class="form-control" value="{{$model->simpleRent ? $model->simpleRent->const_for_one_km : ''}}" step="0.01">
</div>
<div class="col-md-3">
    {!! Form::label('age_limit',"Ограничение по возрасту") !!}
    <input type="number" name="rent[age_limit]" id="age_limit" class="form-control" value="{{$model->simpleRent ? $model->simpleRent->age_limit : ''}}">
</div>
<div class="col-md-3">
    {!! Form::label('driving_experience',"Водительский стаж") !!}
    <input type="number" name="rent[driving_experience]" id="driving_experience" class="form-control" value="{{$model->simpleRent ? $model->simpleRent->driving_experience : ''}}" step="0.1">
</div>
<div class="col-md-3">
    {!! Form::label('price_day_1',"За 1 сутки, $ ") !!}
    <input type="number" name="rent[price_day_1]" id="price_day_1" class="form-control" value="{{$model->simpleRent ? $model->simpleRent->price_day_1 : ''}}" step="0.01">
</div>
<div class="col-md-3">
    {!! Form::label('price_day_2',"За 2-е суток, $ ") !!}
    <input type="number" name="rent[price_day_2]" id="price_day_2" class="form-control" value="{{$model->simpleRent ? $model->simpleRent->price_day_2 : ''}}" step="0.01">
</div>

<div class="col-md-3">
    {!! Form::label('price_day_3_6',"За 3-6 суток, $ ") !!}
    <input type="number" name="rent[price_day_3_6]" id="price_day_3_6" class="form-control" value="{{$model->simpleRent ? $model->simpleRent->price_day_3_6 : ''}}" step="0.01">
</div>
<div class="col-md-3">
    {!! Form::label('price_day_7_13',"За 7-13 суток, $ ") !!}
    <input type="number" name="rent[price_day_7_13]" id="price_day_7_13" class="form-control" value="{{$model->simpleRent ? $model->simpleRent->price_day_7_13 : ''}}" step="0.01">
</div>
<div class="col-md-3">
    {!! Form::label('price_day_14_20',"За 14-20 суток, $ ") !!}
    <input type="number" name="rent[price_day_14_20]" id="price_day_14_20" class="form-control" value="{{$model->simpleRent ? $model->simpleRent->price_day_14_20 : ''}}" step="0.01">
</div>
<div class="col-md-3">
    {!! Form::label('price_day_21_29',"За 21-29 суток, $ ") !!}
    <input type="number" name="rent[price_day_21_29]" id="price_day_21_29" class="form-control" value="{{$model->simpleRent ? $model->simpleRent->price_day_21_29 : ''}}" step="0.01">
</div>
<div class="col-md-3">
    {!! Form::label('price_day_30',"За 30+ суток, $ ") !!}
    <input type="number" name="rent[price_day_30]" id="price_day_30" class="form-control" value="{{$model->simpleRent ? $model->simpleRent->price_day_30 : ''}}" step="0.01">
</div>