(function(filePage){
    filePage(window.jQuery);
}(function($){
    $(pageFileReady);
    function pageFileReady () {
        var $form = $("#formdata");
        var $inputImg = $("#img");
        var $buttonAdd = $("#Add");

        $buttonAdd.click(uploadFile);

        function uploadFile(event){
            var strUrl = {            
                url: "public/file/add",            
                type: 'post',
                dataType: "json",            
                data: {},            
                success: function(data) {                
                    alert(data.img.name);        
                },            
                error: function() {                
                    alert('0');
                }
            }
             $form.ajaxForm(strUrl);        // submit infor        
             //$form.submit();
        } //uploadFile


    } //pageFileReady
}));
