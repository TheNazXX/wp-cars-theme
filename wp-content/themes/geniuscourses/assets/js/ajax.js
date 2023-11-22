jQuery(document).ready(function($){

    $('#button_car').on('click',function(e){
        e.prevendDefault;

        $.ajax({
            url:geniuscourses_ajax_script.ajaxurl,
            data: {
                'action' : 'geniuscourses_ajax_example',
                'nonce' : geniuscourses_ajax_script.nonce,
                'string_one' : geniuscourses_ajax_script.string_box,
                'string_two' : geniuscourses_ajax_script.string_new
            },
            success: function(data){
                $('#car_content').html(data);
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    });
    
});