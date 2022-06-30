var ground_rate = 0;
var ocean_rate = 0;
$('input[name="auction"]').change(function(){
    var value = $(this).val();
    console.log("value = "+value)
    if(value=="")
    {
        $('select[name="location"] option').not(':eq(0)').remove();
        $('select[name="port1"] option').not(':eq(0)').remove();
        $('.amount').text('');
    }else
    {
        console.log(value);
        var data = {"model" : 'App\\Models\\Auction',
            'value':value, '_token':$('meta[name="csrf-token"]').attr('content')};
        $.ajax({
            url: '/small_calc_ajax',
            type: "POST",
            data: data,
            success: function (data) {
                // $(_form).find('.uploaded-table-div').html(data);
                // alert('{{__("admins.price_updated")}}')
                // deleteLookFromWindow();
                // var result = JSON.parse(data)
                $('select[name="location"] option').not(':eq(0)').remove();
                $('select[name="location"]').append(data.locations_options);
                $('select[name="location"]').trigger('refresh');
                $('select[name="port1"] option').not(':eq(0)').remove();
                $('select[name="port1"]').append(data.ports_options);
                $('select[name="port1"]').trigger('refresh');
                $('select[name="port2"] option').not(':eq(0)').remove();
                $('select[name="port2"]').trigger('refresh');
                $('select[name="country"]').val($("select[name='country'] option:first").val());
                $('select[name="country"]').trigger('refresh');
                ground_rate = 0;
                $('.amount').text('');
                console.log(data.locations_options)
            },
            error: function (data) {
                console.log(data);
            }
        });
    }

});
$('select[name="location"]').on('change', function(){
    var value = $(this).val();
    if(value=="")
    {
        $('select[name="port1"] option').not(':eq(0)').remove();
        $('.price_span').text('-');
        $('.ocean_price_span').text('-');
        $('.total_price_span').text('-');
    }else
    {
        var data = {"model" : 'App\\Models\\Location',
            'value':value, '_token':$('meta[name="csrf-token"]').attr('content')};
        $.ajax({
            url: '/small_calc_ajax',
            type: "POST",
            data: data,
            success: function (data) {

                $('select[name="port1"] option').not(':eq(0)').remove();
                $('select[name="port1"]').append(data.ports_options);
                $('select[name="port1"]').trigger('refresh');
                $('select[name="port2"] option').not(':eq(0)').remove();
                $('select[name="port2"]').trigger('refresh');
                $('select[name="country"]').val($("select[name='country'] option:first").val());
                $('select[name="country"]').trigger('refresh');
                $('.amount').text('');
                ground_rate = 0;
                console.log(data.locations_options)
            },
            error: function (data) {
                console.log(data);
            }
        });
    }

});
$('select[name="port1"]').on('change', function(){
    var value = $(this).val();
    if(value=="")
    {
        $('.amount').text('');
    }else
    {
        var location_id = $('select[name="location"]').val();

        var port1_id = $('select[name="port1"]').val();
        var port2_id = $('select[name="port2"]').val();
        var vehicle_type_id = $('select[name="vehicle_type"]').val();
        var country_id = $('select[name="country"]').val();

        var data = {"model" : 'App\\Models\\Port',
            'location_id' : location_id,
            'country_id' : country_id,
            'port1_id' : port1_id,
            'port2_id' : port2_id,
            'vehicle_type_id' : vehicle_type_id,
            'ground_rate':ground_rate,
            'value':value, '_token':$('meta[name="csrf-token"]').attr('content')};
        console.log(data)
        $.ajax({
            url: '/small_calc_ajax',
            type: "POST",
            data: data,
            success: function (data) {
                console.log("data.total_price = "+data.total_price=='')
                console.log(typeof data.total_price)
                console.log(data.total_price)
                if(data.total_price=="empty")
                {
                    $('select[name="port2"] option').not(':eq(0)').remove();
                    $('select[name="port2"]').trigger('refresh');
                    $('select[name="country"]').val($("select[name='country'] option:first").val());
                    $('select[name="country"]').trigger('refresh');
                    $('.amount').text('');
                }else
                {
                    $('.amount').text(data.total_price);
                }

                ground_rate = data.ground_rate;

                // $('select[name="port1"] option').not(':eq(0)').remove();
                // $('select[name="port1"]').append(data.ports_options);
                console.log(data)
            },
            error: function (data) {
                console.log(data);
            }
        });
    }

});
//Delivered port on changed
$('select[name="port2"]').on('change', function(){
    var value = $(this).val();
    if(value=="")
    {
        $('.amount').text('0');
    }else
    {
        var port1_id = $('select[name="port1"]').val();
        var port2_id = $('select[name="port2"]').val();
        var vehicle_type_id = $('select[name="vehicle_type"]').val()
        var country_id = $('select[name="country"]').val();
        var data = {"model" : 'App\\Models\\Port',
            'country_id' : country_id,
            'port1_id' : port1_id,
            'port2_id' : port2_id,
            'vehicle_type_id' : vehicle_type_id,
            'ground_rate':ground_rate,
            'value':value, '_token':$('meta[name="csrf-token"]').attr('content')};
        console.log(data)
        $.ajax({
            url: '/small_calc_ajax',
            type: "POST",
            data: data,
            success: function (data) {
                $('.amount').text(data.total_price);
                ocean_rate = data.ocean_price;
                // $('select[name="port1"] option').not(':eq(0)').remove();
                // $('select[name="port1"]').append(data.ports_options);
                console.log(data)
            },
            error: function (data) {
                console.log(data);
            }
        });
    }

});
//Vehicle Type on change
$('select[name="vehicle_type"]').on('change', function(){
    var value = $(this).val();
    var port1_id = $('select[name="port1"]').val();
    var port2_id = $('select[name="port2"]').val();
    var country_id = $('select[name="country"]').val();
    var data = {"model" : 'App\\Models\\VehicleType',
        'country_id' : country_id,
        'port1_id' : port1_id,
        'port2_id' : port2_id,
        'ground_rate':ground_rate,
        'value':value};
    console.log(data)
    $.ajax({
        url: '/small_calc_ajax',
        type: "POST",
        data: data,
        success: function (data) {
            ocean_rate = data.ocean_price;
            $('.ocean_price_span').text(data.ocean_price);
            $('.total_price_span').text(data.total_price);
            // ground_rate = data.price;
            // $('select[name="port1"] option').not(':eq(0)').remove();
            // $('select[name="port1"]').append(data.ports_options);
            console.log(data)
        },
        error: function (data) {
            console.log(data);
        }
    });
});
//Country on change
$('select[name="country"]').on('change', function(){
    var value = $(this).val();
    var port1_id = $('select[name="port1"]').val();
    console.log("value = "+value)
    if(value=="")
    {
        $('select[name="port2"] option').not(':eq(0)').remove();
        $('select[name="port2"]').trigger('refresh');
        $('.amount').text("");
    }else
    {
        var data = {"model" : 'App\\Models\\Country',
            'value':value,
            'port1_id' : port1_id,
            '_token':$('meta[name="csrf-token"]').attr('content')};
        console.log(data)
        $.ajax({
            url: '/small_calc_ajax',
            type: "POST",
            data: data,
            success: function (data) {
                $('select[name="port2"] option').not(':eq(0)').remove();
                $('select[name="port2"]').append(data.ports2_options);
                $('select[name="port2"]').trigger('refresh');

                $('.amount').text("");
                // $('.price_span').text(data.price);
                // ground_rate = data.price;
                // $('select[name="port1"] option').not(':eq(0)').remove();
                // $('select[name="port1"]').append(data.ports_options);
                console.log(data)
            },
            error: function (data) {
                console.log(data);
            }
        });
    }

});