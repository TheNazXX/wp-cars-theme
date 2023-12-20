jQuery(document).ready(function($){
  $('#thenaz_booking_submit').on('click', function(e){
    e.preventDefault();

    $.ajax({
      url: thenaz_bookingform_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'booking_form',
        nonce: thenaz_bookingform_vars.nonce,
        name: $('#thenaz_name').val(),
        email: $('#thenaz_email').val(),
        phone: $('#thenaz_phone').val(),
        price: $('#thenaz_price').val()
      },
      success: function(data){
          $('#thenaz_result').html(data)
      },
      error: function(err){
        console.log(err);
      }
    })
  });

  $('#fileInput').on('change', function(e){
    let file = $(this);

    if(file.length){
      let reader = new FileReader();
      
      reader.onload = function(e){
        $('#fileImg').css('display', 'block');
        $('#mockFileImg').css('display', 'none');
        $('#fileImg').attr('src', e.target.result)
      };

      reader.readAsDataURL(file[0].files[0]);
    }

  });
});