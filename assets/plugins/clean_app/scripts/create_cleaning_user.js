var CORE_SERVICES = URL_CONNECTIONS.core;

$(document).ready(function () {


  selectMenuItem(2);

 $("#cleaning_user_birthdate").inputmask();
 $("#cleaning_user_medicare").inputmask();
    $("#cleaning_user_photo_change_image").click(function () {
        $("#cleaning_user_photo_select_file").trigger('click');
    });

    $("#cleaning_user_photo_select_file").change(function () {
        var i = 0, len = this.files.length, img, reader, file;
        for (; i < len; i++) {
            file = this.files[i];
            
            
		        
            if (window.FileReader) {
                reader = new FileReader();
                reader.onloadend = function (e) {
                    var reader = new FileReader();
                    var image = new Image();
                    reader.readAsDataURL(file);
                    reader.onload = function (_file) {
                        image.src = _file.target.result;
                        image.onload = function () {
                            $("#cleaning_user_photo").attr('src', image.src).fadeIn();
                        };
                        image.onerror = function () {
                            alert('Invalid file type: ' + file.type);
                        };
                    };
                };
                reader.readAsDataURL(file);
            }
       
	 
        }
    });

    $("#cleaning_user_create_button").click(function () {

        var is_empty_files = false;
      
     

        var create_user_img_profile = $("#cleaning_user_photo").attr('src');


        $(".validate-form").each(function () {
            if ($(this).val() === "" || $(this).val() === " ")
                is_empty_files = true;
        });

        if (!is_empty_files) {

            if (create_user_img_profile.indexOf("profile_user_icon") > 1) {
                create_user_img_profile = "null";
            } else {
                create_user_img_profile = create_user_img_profile.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
            }
  var birthdate = $("#cleaning_user_birthdate").val();
            var name = $("#cleaning_user_name").val();
            var last_name = $("#cleaning_user_last_name").val();
            var medicare = $("#cleaning_user_medicare").val();
            var email = $("#cleaning_user_email").val();
            var address = $("#cleaning_user_address").val();
            var phone = $("#cleaning_user_phone").val();
            var other_phone = $("#cleaning_user_other_phone").val();

            console.log("create_user_img_profile: " + create_user_img_profile);
            if (validateEmail(email)) {
                if (create_user_img_profile !== "null") {
                   // if (isNumber(phone) && isNumber(other_phone) && isNumber(medicare)) {
                    if (isNumber(phone) && isNumber(other_phone) ) {


                        $("#cleaning_user_create_button").hide();


                        var new_user_data = {
                            img: create_user_img_profile,
                            name: name,
                            birthdate: birthdate,
                            last_name: last_name,
                            medicare: medicare,
                            email: email,
                            address: address,
                            phone: phone,
                            other_phone: other_phone
                        };
                        var data = {
                            user: new_user_data
                        };
                        $.ajax({
                            url: CORE_SERVICES + "cleaning_users/create_user",
                            type: "POST",
                            data: data,
                            success: function (data) {
                                var data_parse = JSON.parse(data);


                                if (data_parse.status == 200) {
                                    $("#cleaning_user_modal_button").attr("href", CORE_SERVICES + "cleaning_users");

                                    show_alert_dialog("Success",
                                            data_parse.message);
                                } else {
                                    $("#cleaning_user_create_button").show();
                                    show_alert_dialog("Error",
                                            data_parse.message);
                                }

                            },
                            error: function () {
                                $("#cleaning_user_create_button").show();
                                show_alert_dialog("Conection error",
                                        "There was a connection error, try again.");
                            }
                        });
                    } else {
                        show_alert_dialog("Error", "The phone and other phone only accept numbers.");
                    }
                } else {
                    show_alert_dialog("Error", "The photo are required.");

                }

            } else {
                show_alert_dialog("Error", "The email entered is invalid.");

            }
        } else {
            show_alert_dialog("Error", "All fields are required.");

        }
    });
});



function show_alert_dialog(title, message) {
    $("#cleaning_user_modal_title").text(title);
    $("#cleaning_user_modal_desc").text(message);
    $('#cleaning_user_modal').openModal({
        dismissible: false
    });
}