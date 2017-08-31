(function(userpage){
    userpage(window.jQuery);
}(function($){
    $(processProfileUser);
    function processProfileUser(){  
        $("form").submit(function(evt){	 
      evt.preventDefault();
      var formData = new FormData($(this)[0]);
   $.ajax({
       url: 'public/post-form',
       type: 'POST',
       data: formData,
       async: false,
       cache: false,
       contentType: false,
       enctype: 'multipart/form-data',
       processData: false,
       success: function (response) {
         sonsole.log(response);
       }
   });
   return false;
 });
    }

    
}));