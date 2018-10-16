var CORE_SERVICES =  URL_CONNECTIONS.core;

$(document).ready(function () {

    $("#sig_in_button").click(function () {
        login_user();
    });

});


function login_user() {
    var login_email_npt = $("#sig_in_email").val();
    var login_password_npt = $("#sig_in_password").val();

    if (login_email_npt !== "" && login_password_npt !== "") {
        if (validateEmail(login_email_npt)) {

            $("#login_btn").hide();

            var login_data = {
                email: login_email_npt,
                pass: login_password_npt 
            };


            $.ajax({
                url: CORE_SERVICES + "login/authorize_user_entry",
                type: "POST",
                data: login_data,
                success: function (data) {

                    var data_parse = JSON.parse(data);
                    console.log(data_parse.status);

                    if (data_parse.status == 200) {

                        $("#trigger_sig_in_modal_button").attr("href",CORE_SERVICES + "dashboard");

                        show_alert_dialog("Log in success",
                                 data_parse.message);
                    } else {
                        show_alert_dialog("Log in error",
                                data_parse.message);
                    }
                },
                error: function () {
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
}

function show_alert_dialog(title, message) {
    $("#sig_in_modal_title").text(title);
    $("#sig_in_modal_desc").text(message);
    $('#sig_in_modal').openModal({
        dismissible: false
    });
}