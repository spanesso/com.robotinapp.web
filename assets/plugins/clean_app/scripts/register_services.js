var CORE_SERVICES = URL_CONNECTIONS.core;

var id_service_selected = "";
var id_service_selected_detail = "";
var status_service_selected_detail = "";
var id_cleaning_user_selected = "";

$(document).ready(function () {
    
      selectMenuItem(4);

    var cleaning_users_for_assing_table = $('#cleaning_users_for_assing_table').DataTable();


    $("#assing_housekeeping_to_service").click(function () {


        cleaning_users_for_assing_table.$('input[type="radio"]').each(function () {
            if (this.checked) {
                id_cleaning_user_selected = $(this).attr("data-id");

            }
        });

        if (id_cleaning_user_selected !== "") {
            assigned_service_to_house_keeping();
        }


    });

    $("#approve_recurring_payment_service").click(function () {

        $('#sure_approve_payment').openModal();
        $('#approve_payment_service_modal').closeModal();

    });

    $("#confirm_approve_payment").click(function () {

        confirm_approve_payment_service();
    });

    $(".btn_assign_service").click(function () {
        id_service_selected = $(this).attr("data-id");
        get_service_info();

    });

    $(".btn_approve_payment_service").click(function () {
        id_service_selected = $(this).attr("data-id");
        get_service_info_for_approve();

    });


    $(".btn_detail_service").click(function () {
        id_service_selected_detail = $(this).attr("data-id");
        status_service_selected_detail = $(this).attr("data-status");
        get_service_info_detail();

    });


    $('#registered_services_table').DataTable();


});


function confirm_approve_payment_service() {


    var data = {
        service: id_service_selected
    };


    $.ajax({
        url: CORE_SERVICES + "registered_services/confirm_approve_payment_service",
        type: "POST",
        data: data,
        success: function (data) {
            var data_parse = JSON.parse(data);
            if (data_parse.status == 200) {
                show_alert_dialog("Payment register!!",
                        data_parse.message);


                setTimeout(function () {
                    location.reload();
                }, 5000);

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


function get_service_info_detail() {

    var data = {
        service: id_service_selected_detail,
        status: status_service_selected_detail
    };

    $.ajax({
        url: CORE_SERVICES + "registered_services/get_service_info_detail",
        type: "POST",
        data: data,
        success: function (data) {


            var data_parse = JSON.parse(data);
            if (data_parse.status == 200) {
                var service_detail = data_parse.data;
                show_service_detail_modal(service_detail);
            } else {
            }



            //TODO: Show service detail modal dialog


        },
        error: function () {
            show_alert_dialog("Conection error",
                    "There was a connection error, try again.");
        }
    });


}


function get_service_info() {

    var data = {
        service: id_service_selected
    };

    $.ajax({
        url: CORE_SERVICES + "registered_services/get_service_info",
        type: "POST",
        data: data,
        success: function (data) {

            var data_parse = JSON.parse(data);
            if (data_parse.status == 200) {
                var service = data_parse.data;
                show_assigned_service_to_housekeeping_modal(service);
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



function get_service_info_for_approve() {

    var data = {
        service: id_service_selected
    };

    $.ajax({
        url: CORE_SERVICES + "registered_services/get_service_info",
        type: "POST",
        data: data,
        success: function (data) {

            var data_parse = JSON.parse(data);
            if (data_parse.status == 200) {
                var service = data_parse.data;
                show_approve_payment_modal(service);
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


function show_service_detail_modal(service_detail) {

    console.log("--->" + JSON.stringify(service_detail));

    if (parseInt(service_detail.service_status) >= 4) {
        $('#service_houserkeeping_info_container').show();

        $("#svc_dtl_cleaning_photo").attr("src", service_detail.uh_photo);
        $('#svc_dtl_cleaning_name').text(service_detail.uh_name + " " + service_detail.uh_last_name);
        $('#svc_dtl_cleaning_email').text(service_detail.uh_email);
        $('#svc_dtl_cleaning_phone').text(service_detail.uh_phone);
        $('#svc_dtl_cleaning_other_phone').text(service_detail.uh_other_phone);

    } else {
        $('#service_houserkeeping_info_container').hide();
    }


    $('#svc_dtl_client_name').text(service_detail.uc_name);
    $('#svc_dtl_service_status').text(service_detail.status);
    $('#svc_dtl_client_address').text(service_detail.place_address);
    $('#svc_dtl_service_date').text(service_detail.date);
    $('#svc_dtl_service_plan').text(service_detail.plan_name);



    $('#assing_service_detail_modal').openModal();
}


function show_assigned_service_to_housekeeping_modal(service) {

    $('#assing_service_client').text(service.client_name);
    $('#assing_service_status').text(service.status);
    $('#assing_service_address').text(service.place_address);
    $('#assing_service_date').text(service.date);
    $('#assing_service_plan').text(service.plan_name);

    $('#assing_service_housekeeping_modal').openModal();
}


function show_approve_payment_modal(service) {

    $('#approve_payment_client').text(service.client_name);
    $('#approve_payment_status').text(service.status);
    $('#approve_payment_address').text(service.place_address);
    $('#approve_payment_service_date').text(service.date);
    $('#approve_payment_plan').text(service.plan_name);
    $('#approve_payment_plan_desc').text(service.description);
    $('#approve_payment_category').text(service.category_name);
    $('#approve_payment_register_date').text(service.pay_service_date);
    $('#approve_payment_total').text("$ " + service.total_payment);

    $('#approve_payment_service_modal').openModal();
}

function assigned_service_to_house_keeping() {


    var data = {
        service: id_service_selected,
        cleaning: id_cleaning_user_selected
    };

    console.log(JSON.stringify(data))

    $.ajax({
        url: CORE_SERVICES + "registered_services/assing_service",
        type: "POST",
        data: data,
        success: function (data) {
            var data_parse = JSON.parse(data);
            if (data_parse.status == 200) {
                show_alert_dialog("Service assigned!!",
                        data_parse.message);


                setTimeout(function () {
                    location.reload()
                }, 5000);

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

function get_user_data_and_show_profile(id_user) {
    var data = {
        id: id_user
    };

    $.ajax({
        url: CORE_SERVICES + "cleaning_users/get_user_data_by_id",
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
        var new_img = $("#housekeeping_edit_profile_img").attr('src');
        var old_img = $("#housekeeping_edit_profile_img_old").val();

        var name = $("#cleaning_user_edit_name").val();
        var last_name = $("#cleaning_user_edit_last_name").val();
        var medicare = $("#cleaning_user_edit_medicare").val();
        var email = $("#cleaning_user_edit_email").val();
        var address = $("#cleaning_user_edit_address").val();
        var phone = $("#cleaning_user_edit_phone").val();
        var other_phone = $("#cleaning_user_edit_other_phone").val();
        var folder = $("#housekeeping_edit_profile_token").val();
        var status = 0;

        if ($('#cleaning_user_edit_status').is(":checked")) {
            status = 1;
        }

        if (validateEmail(email)) {
            if (isNumber(phone) && isNumber(other_phone) && isNumber(medicare)) {

                console.log("new_img: " + new_img);
                console.log("old_img: " + old_img);

                if (new_img.indexOf("profile_user_icon") > -1) {
                    new_img = "";
                } else {
                    if (new_img.indexOf(old_img) !== 0) {


                        if (new_img.indexOf(old_img) > -1) {
                            new_img = "";

                        } else {
                            new_img = new_img.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
                        }
                    } else if (new_img === old_img) {
                        new_img = "";
                        console.log("new_img: " + new_img);
                    } else {
                        new_img = new_img.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
                    }

                }
                var new_user_data = {
                    id: user_id,
                    status: status,
                    folder: folder,
                    img: new_img,
                    name: name,
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
                    url: CORE_SERVICES + "cleaning_users/update_data_user",
                    type: "POST",
                    data: data,
                    success: function (data) {
                        var data_parse = JSON.parse(data);


                        if (data_parse.status == 200) {
                            $("#trigger_housekeeping_error_modal_modal_button").attr("href", CORE_SERVICES + "cleaning_users");

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
        url: CORE_SERVICES + "cleaning_users/get_user_data_by_id",
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
    if (user.photo != "") {
        $("#housekeeping_profile_img").attr("src", user.photo);
    }
    var status_user = "";
    if (user.status == 1) {
        status_user = "User Enabled";
    } else {
        status_user = "User Unabled";
    }

    $("#housekeeping_profile_status").text(status_user);

    $("#housekeeping_profile_name").text(user.name + " " + user.last_name);
    $("#housekeeping_profile_medicare").text(user.medicare);
    $("#housekeeping_profile_addresss").text(user.home_address);
    $("#housekeeping_profile_email").text(user.email);
    $("#housekeeping_profile_phone").text(user.phone);
    $("#housekeeping_profile_other_phone").text(user.other_phone);
    $('#housekeeping_profile_modal').openModal();
}


function show_user_profile_for_edition(user) {
    if (user.photo != "") {
        $("#housekeeping_edit_profile_img").attr("src", user.photo);
        $("#housekeeping_edit_profile_img_old").val(user.photo);

    }
    $("#housekeeping_edit_profile_token").val(user.folder);
    var status_user = "";
    if (user.status == 1) {
        $('#cleaning_user_edit_status').trigger('click').prop('checked', true);
    } else {
        $('#cleaning_user_edit_status').trigger('click').prop('checked', false);
    }

    $("#housekeeping_profile_status").text(status_user);

    $("#cleaning_user_edit_name").val(user.name);
    $("#cleaning_user_edit_last_name").val(user.last_name);
    $("#cleaning_user_edit_medicare").val(user.medicare);
    $("#cleaning_user_edit_address").val(user.home_address);
    $("#cleaning_user_edit_email").val(user.email);
    $("#cleaning_user_edit_phone").val(user.phone);
    $("#cleaning_user_edit_other_phone").val(user.other_phone);


    $("#cleaning_user_edit_btn").attr("data-id", user.id_housekeeping);

    $('#housekeeping_edit_profile_modal').openModal();
}


function show_alert_dialog(title, message) {
    $("#housekeeping_error_modal_title").text(title);
    $("#housekeeping_error_modal_desc").text(message);
    $('#housekeeping_error_modal').openModal({
        dismissible: false
    });
}