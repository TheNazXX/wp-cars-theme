jQuery(document).ready(function($){
  $('#btn-action-wishlist').on('click', function(e){
    e.preventDefault(); 
    let form_id = $(this).attr('data-property-id');

    let action_wishlist = {
      success: function(){
        $('#btn-action-wishlist').hide();
      }
    }
    
    $('#wishlist-form_'+form_id).ajaxSubmit(action_wishlist);
  })

  if($('#thenaz_remove_property')){
    $('#thenaz_remove_property').on('click', function(e){
      e.preventDefault();
  
      $.ajax({
        url: $(this).attr('href'),
        type: 'POST',
        data: {
          property_id: $(this).data('property-id'),
          user_id: $(this).data('user-id'),
          action_with_bd: 'rm',
          action: "thenaz_action_wishlist"
        },
        dataType: 'html'
      })
    });
  }
});