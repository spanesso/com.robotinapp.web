var CORE_SERVICES = URL_CONNECTIONS.core;

$(document).ready(function () {
   selectMenuItem(1);
    $("#admin_user_edit_btn").click(function () {
        var user_id = $(this).attr("data-id");
        update_user_profile(user_id);
    });

    $(".btn_see_admin").click(function () {
        var user_id = $(this).attr("data-id");
        get_user_data_and_show_profile(user_id);
    });

    $(".btn_edit_admin").click(function () {
        var user_id = $(this).attr("data-id");
        get_user_data_and_edit(user_id);
    });


    $('#admin_users_table').DataTable();

});

function get_user_data_and_show_profile(id_user) {
    var data = {
        id: id_user
    };

    $.ajax({
        url: CORE_SERVICES + "admins/get_user_data_by_id",
        type: "POST",
        data: data,
        success: function (data) {
            var data_parse = JSON.parse(data);
            if (data_parse.status == 200) {
                var user = data_parse.data;
                show_user_profile(user);
            } else {
                show_alert_dialog("Error", data_parse.message);
            }
        },
        error: function () {
            show_alert_dialog("Conection error",
                    "There was a connection error, try again.");
        }
    });

}


function update_user_profile(id_user) {
    var user_id = id_user;

    var is_empty_files = false;

    $(".validate-form").each(function () {
        if ($(this).val() === "" || $(this).val() === " ")
            is_empty_files = true;
    });

    if (!is_empty_files) {

        var name = $("#admin_user_edit_name").val();
        var last_name = $("#admin_user_edit_last_name").val();
        var email = $("#admin_user_edit_email").val();
        var password = $("#admin_user_edit_password").val();

        var status = 0;

        if ($('#admin_user_edit_status').is(":checked")) {
            status = 1;
        }

        if (validateEmail(email)) {

            var new_user_data = {
                id: user_id,
                status: status,
                name: name,
                last_name: last_name,
                email: email,
                password: password
            };
            var data = {
                user: new_user_data
            };
            $.ajax({
                url: CORE_SERVICES + "admins/update_data_user",
                type: "POST",
                data: data,
                success: function (data) {
                    var data_parse = JSON.parse(data);


                    if (data_parse.status == 200) {
                        $("#trigger_admin_error_modal_modal_button").attr("href", CORE_SERVICES + "admins");

                        show_alert_dialog("Success",
                                data_parse.message);
                    } else {
                        show_alert_dialog("Error",
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
function get_user_data_and_edit(id_user) {
    var data = {
        id: id_user
    };

    $.ajax({
        url: CORE_SERVICES + "admins/get_user_data_by_id",
        type: "POST",
        data: data,
        success: function (data) {
            var data_parse = JSON.parse(data);
            if (data_parse.status == 200) {
                var user = data_parse.data;
                show_user_profile_for_edition(user);
            } else {
                show_alert_dialog("Error", data_parse.message);
            }
        },
        error: function () {
            show_alert_dialog("Conection error",
                    "There was a connection error, try again.");
        }
    });


}


function show_user_profile(user) {

    var status_user = "";
    if (user.status == 1) {
        status_user = "User Enabled";
    } else {
        status_user = "User Unabled";
    }

    $("#admin_profile_status").text(status_user);
    $("#admin_profile_email").text(user.email);
    $("#admin_profile_pass").text(user.password);

    $("#admin_profile_name").text(user.name + " " + user.last_name);

    $('#admin_profile_modal').openModal();
}


function show_user_profile_for_edition(user) {

    if (user.status == 1) {
        $('#admin_user_edit_status').trigger('click').prop('checked', true);
    } else {
        $('#admin_user_edit_status').trigger('click').prop('checked', false);
    }


    $("#admin_user_edit_name").val(user.name);
    $("#admin_user_edit_last_name").val(user.last_name);
    $("#admin_user_edit_password").val(user.password);
    $("#admin_user_edit_email").val(user.email);


    $("#admin_user_edit_btn").attr("data-id", user.id_admin);

    $('#admin_edit_profile_modal').openModal();
}


function show_alert_dialog(title, message) {
    $("#admin_error_modal_title").text(title);
    $("#admin_error_modal_desc").text(message);
    $('#admin_error_modal').openModal({
        dismissible: false
    });
}