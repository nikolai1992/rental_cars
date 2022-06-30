@for($i=1; $i<=24; $i++)
    <div class="form-group">
        {!! Form::label('price_per_hour_'.$i,"За $i час(a), $ ") !!}
        <input type="number" name="rent[price_per_hour_{{$i}}]" id="price_per_hour_{{$i}}" class="form-control" value="<?php echo $model->driverRent ? $model->driverRent->{'price_per_hour_'.$i} : '';?>" step="0.01">
    </div>
@endfor