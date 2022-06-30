<div class="form-group">
    {!! Form::label('phone2',"Телефон 2") !!}
    <input type="text" name="phone2" id="phone2" class="form-control">
</div>
<div class="form-group">
    {!! Form::label('phone3',"Телефон 3") !!}
    <input type="text" name="phone3" id="phone3" class="form-control">
</div>
<div class="form-group">
    {!! Form::label('site',"Сайт") !!}
    <input type="text" name="site" class="form-control">
</div>
<div class="form-group">
    {!! Form::label('role',"Штат") !!}
    <div class="input-group">
        <select class="custom-select" name="state" data-minimum-results-for-search="0" required>
            <option label="Выберите из списка"></option>
            <option value="1">Эр-Рияд</option>
            <option value="2">Мекка</option>
            <option value="3">Медина</option>
            <option value="4">Эль-Касим</option>
            <option value="5">Эш-Шаркия</option>
            <option value="6">Асир</option>
            <option value="7">Табук</option>
            <option value="8">Хаиль</option>
            <option value="9">Эль-Худуд-эш-Шамалия</option>
            <option value="10">Джизан</option>
            <option value="11">Наджран</option>
            <option value="12">Эль-Баха</option>
            <option value="13">Эль-Джауф</option>
        </select>
    </div>
</div>