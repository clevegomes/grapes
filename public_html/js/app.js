
!function ($) {

	$(function(){

		$('[data-toggle="confirmation"]').confirmation({singleton: true});


	})

}(window.jQuery)


$(document).ready(function() {


	$(".ddatepicker" ).datepicker({ dateFormat: 'dd/mm/yy',minDate:new Date(new Date().getTime() + 24 * 60 * 60 * 1000)});

	$(".ddatepicker" ).datepicker({ dateFormat: 'dd/mm/yy',minDate:new Date(new Date().getTime() + 24 * 60 * 60 * 1000)});



	$( "#arr_datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
    $( "#dep_datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });

    $('#paxDetails').hide();
    $.get("roomConfigAjax",{hotel_id:$('#hotel_id').val()},function(data){
        $('#roomConfigDiv').html(data);
        var room_config_arr         = $('#room_config option:selected').val().split('$');
        var room_config_id          = room_config_arr[0];
        var room_type_arr           = room_config_arr[1].split('@');
        var room_type               = room_type_arr[0];
        var pax_details_arr         = room_type_arr[1].split('#');
        var pax_details             = pax_details_arr[0].split('^');
        var std_adults              = pax_details[0];
        var extra_pax               = pax_details[1];
        var std_child               = pax_details[2];
        var comb_flag               = pax_details[3];
        if(comb_flag == 1) {
            paxHtml = ' (Adults: ' + std_adults + ' Extra Pax: ' + extra_pax + ') or ( Adults: ' + std_adults + ' Child: ' + std_child + ')';
        }else{
            paxHtml = ' (Adults: ' + std_adults + ' Extra Pax: ' + extra_pax +' Child: ' + std_child + ')';
        }

        $('#paxInfo').html(paxHtml);
    });

   // $('#room_config').on('change','select',function(){alert(1);});


    $('#search_button').click(function(){
        var room_config_arr         = $('#room_config option:selected').val().split('$');
        var room_config_id          = room_config_arr[0];
        var room_type_arr           = room_config_arr[1].split('@');
        var room_type               = room_type_arr[0];

        $.get("roomListAjax", {room_config_id:room_config_id,hotel_id:$('#hotel_id').val(),room_type:room_type,no_room:$('#no_of_rooms').val(),no_adults:$('#no_adults').val(),no_child:$('#no_child').val()},
            function(data)
            {


                var script_data ='<script>';
                for(var i=1;i<=$('#no_of_rooms').val();i++){
                    for(var j=1;j<=$('#no_child').val();j++){
                        script_data += '$( "#dob_'+i+'_'+j+'").datepicker({ dateFormat: \'dd/mm/yy\' });';
                    }
                }
                script_data += '</script>';
                $('#paxDetails').html(data+script_data);
              // $(document).write(script_data);
                $('.adultsCnt').html($('#no_adults').val());
                $('.childCnt').html($('#no_child').val());
                $('#paxDetails').show();

            });
    });
    $('#hotel_id').change(function(){
        $.get("roomConfigAjax",{hotel_id:$(this).val()},function(data){
            $('#roomConfigDiv').html(data);

        })
    });
});
var app = angular.module('todoApp', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

app.controller('todoController', function($scope, $http) {

    $scope.todos = [];
    $scope.loading = false;

    $scope.init = function() {
        $scope.loading = true;
        $http.get('todos').
            success(function(data, status, headers, config) {
                $scope.todos = data;
                $scope.loading = false;

            });
    }

    $scope.addTodo = function() {
        $scope.loading = true;

        $http.post('todos', {
            title: $scope.todo.title,
            done: $scope.todo.done
        }).success(function(data, status, headers, config) {
            $scope.todos.push(data);
            $scope.todo = '';
            $scope.loading = false;

        });
    };

    $scope.updateTodo = function(todo) {
        $scope.loading = true;

        $http.put('todos/' + todo.id, {
            title: todo.title,
            done: todo.done
        }).success(function(data, status, headers, config) {
            todo = data;
            $scope.loading = false;

        });;
    };

    $scope.deleteTodo = function(index) {
        $scope.loading = true;

        var todo = $scope.todos[index];

        $http.delete('todos/' + todo.id)
            .success(function() {
                $scope.todos.splice(index, 1);
                $scope.loading = false;

            });;
    };


    $scope.init();

});
