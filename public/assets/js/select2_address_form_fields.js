function insert(street, home, arr, location) {
    arr.push({
        street: street,
        home: home,
        location: location
    });
    return arr;
}


if($( "#street" ).length&&$('#house').length||$( "#street2" ).length&&$('#house2').length)
{
    var data = {
        _token: $('meta[name="csrf-token" ]').attr('content')
    };

    $.ajax
    ({
        type: 'POST',
        url: '/objects',
        data: data,
        success: function (result) {

            var locations = result.location;
            var streets = new Array();
            var streets_detail = new Array();

            var key_storage = localStorage.getItem('selected_street');
            localStorage.removeItem('selected_street');
            var street_for_form = "";
            var house_for_form = "";

            if(key_storage!=null)
            {
                street_for_form = key_storage.split(',')[1];
                house_for_form = key_storage.split(',')[2];
            }


            for(var i=0; i<locations.length; i++)
            {
                console.log(locations[i]);
                var parse_arr = locations[i].labels.split(',');

                if(streets.indexOf(parse_arr[1])==-1)
                {
                    var selected = street_for_form==parse_arr[1] ? 'selected' : '';
                    var html_option = '<option value="'+parse_arr[1]+'" '+selected+'>'+parse_arr[1]+'</option>';
                    $('#street').append(html_option);
                    $('#street2').append(html_option);

                    streets.push(parse_arr[1]);
                }

                streets_detail = insert(parse_arr[1], parse_arr[2], streets_detail, locations[i]);
            }
            findHomes(street_for_form, house_for_form)
            console.log(streets);
            console.log(streets_detail);
            $( "#street, #street2" ).on('change', function(){
                var this_street = $(this).val();

                findHomes(this_street);
            });
            function findHomes(this_street, selected_home=false)
            {
                var houses_result = filter(streets_detail, this_street);
                console.log(houses_result)
                var house_id_name = '';
                if($('#house').length)
                {
                    $('#house option').not(":eq(0)").remove();
                    house_id_name = 'house';
                }
                if($('#house2').length)
                {
                    $('#house2 option').not(":eq(0)").remove();
                    house_id_name = 'house2';
                }
                if(houses_result.length)
                {
                    for(var j=0; j<houses_result.length; j++)
                    {
                        var selected = selected_home==houses_result[j]['home'] ? 'selected' : '';
                        var new_home_html = "<option "+selected+">"+houses_result[j]['home']+"</option>"
                        $('#'+house_id_name).append(new_home_html);
                    }
                }
            }
            function filter(d, f){
                var new_homes = new Array();
                for(var ii=0; ii<d.length; ii++)
                {
                    if(d[ii]["street"]==f)
                    {
                        new_homes.push(d[ii]);
                    }
                }

                return new_homes;
            }

        }
    });
    $("#street, #street2").select2({
        placeholder: street_label,
        allowClear: true
    });
    $("#house, #house2").select2({
        placeholder: home_label,
        allowClear: true
    });
}
