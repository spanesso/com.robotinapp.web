var CORE_SERVICES = URL_CONNECTIONS.core;

$(document).ready(function () {

   selectMenuItem(1);

    $("#create_admin_btn").click(function () {

        var is_empty_files = false;


        $(".validate-form").each(function () {
            if ($(this).val() === "" || $(this).val() === " ")
                is_empty_files = true;
        });

        if (!is_empty_files) {
         

                var name = $("#create_admin_name").val();
                var last_name = $("#create_admin_last_name").val();
                var email = $("#create_admin_email").val();
                var pass = $("#create_admin_email").val();

                if (validateEmail(email)) {



                    var new_admin_data = {
                        name: name,
                        last_name: last_name,
                        email: email,
                        pass: pass
                    };
                    var data = {
                        user: new_admin_data
                    };


                    $.ajax({
                        url: CORE_SERVICES + "admins/create_admin",
                        type: "POST",
                        data: data,
                        success: function (data) {
                            var data_parse = JSON.parse(data);


                            if (data_parse.status == 200) {
                                $("#trigger_admin_error_modal_modal_button").attr("href", CORE_SERVICES + "admins");

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
                    show_alert_dialog("Error", "The email entered is invalid.");

                }
          
        } else {
            show_alert_dialog("Error", "All fields are required.");

        }
    });
});




function show_alert_dialog(title, message) {
    $("#admin_error_modal_title").text(title);
    $("#admin_error_modal_desc").text(message);
    $('#admin_error_modal').openModal({
        dismissible: false
    });
}