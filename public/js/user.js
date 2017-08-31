(function(userpage){
    userpage(window.jQuery);
}(function($){
    $(processProfileUser);
    function processProfileUser(){
        var userForm = $('formData');
        var $inputName = $('#name');
        var $inputAge = $('#age');
        var $inputId = $('#id');
        var $inputImg = $('#img');
        var $areaMessageError = $('#message-error');
        var $areaListProfile = $('#user-view');
        var $rowUserId = $('.user-id');
        var $rowUserName = $('.user-name');
        var $rowUserAge = $('.user-age');
        var $buttonAdd = $('#Add');
        var $buttonUpdate = $('#Update');

        $buttonAdd.click(addProfileUser);
        $rowUserId.click(displayEditUser);
        $buttonUpdate.click(editProfileUser);

        function addProfileUser(event){
            var name = $inputName.val();
            var age = $inputAge.val();
            var img = $inputImg.val();
            var $addingProfile = $.ajax({
                type: "post",
                url: "public/user/add",
                dataType: "json",
                data: {name: name, age: age, img: img}
            });

            event.preventDefault();
            $addingProfile.then(appendProfileToList);
            $addingProfile.fail(displayError);
        }

        function appendProfileToList(profileUser){
            tdRowProfile = "<tr id='"+ profileUser.id +"'><td>" + profileUser.name + "</td><td>" + profileUser.age + "</td<td></td</tr>";
            $areaListProfile.append(tdRowProfile);
        }

        function displayError(listError){
            var errors = listError.responseJSON;
            var errorInput = errors.data;
            var paragraghMessage = "";
            $.each(errorInput, function (inputId, errorMessage) {
                listErrorMessages = errorInput.inputId;
                $.each(errorMessage, function(aMessageError, listErrorMessages){
                    paragraghMessage += "<p>"+ listErrorMessages +"</p>";
                    
                })
                $areaMessageError.html(paragraghMessage);
            })
            
        }

        function displayEditUser(){
            var id = $(this).attr('data-id');
            var rowId = $(this).attr('id');
            var name = $("#" + rowId + " .user-name").text();
            var age = $("#" + rowId + " .user-age").text();

            $inputName.val(name);
            $inputAge.val(age);
            $inputId.val(id);

        }

        function editProfileUser(event){
            var id = $inputId.val();
            var name = $inputName.val();
            var age = $inputAge.val();
            var edittingProfileUser = $.ajax({
                type: "post",
                url: "public/user/edit",
                dataType: "json",
                data: {id: id, name: name, age: age}
            });
            
            event.preventDefault();

            edittingProfileUser.then(editProfile);
            edittingProfileUser.fail(displayError);
            
        }

        function editProfile(userEdited){
            $('#user'+userEdited.id + ' .user-name').text(userEdited.name);
            $('#user'+userEdited.id + ' .user-age').text(userEdited.age);
        }
    }
}));