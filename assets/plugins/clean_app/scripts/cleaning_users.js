var CORE_SERVICES = URL_CONNECTIONS.core;

$(document).ready(function () {
    
    
       selectMenuItem(2);
    
    $("#cleaning_user_edit_birthdate").inputmask();
    $("#cleaning_user_edit_medicare").inputmask();
    $("#cleaning_user_edit_btn").click(function () {
        var user_id = $(this).attr("data-id");
        update_user_profile(user_id);
    });

    $(".btn_see_housekeeping").click(function () {
        var user_id = $(this).attr("data-id");
        get_user_data_and_show_profile(user_id);
    });

    $(".btn_edit_housekeeping").click(function () {
        var user_id = $(this).attr("data-id");
        get_user_data_and_edit(user_id);
    });

    $(".btn_block_housekeeping").click(function () {
        alert("btn_block_housekeeping");
    });


    $("#housekeeping_edit_profile_img_change_image").click(function () {
        $("#housekeeping_edit_profile_img_photo_select_file").trigger('click');
    });

    $("#housekeeping_edit_profile_img_photo_select_file").change(function () {
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
                            $("#housekeeping_edit_profile_img").attr('src', image.src).fadeIn();
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
    $('#cleaning_users_table').DataTable();

});

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
        var birthdate = $("#cleaning_user_edit_birthdate").val();
        var address = $("#cleaning_user_edit_address").val();
        var phone = $("#cleaning_user_edit_phone").val();
        var other_phone = $("#cleaning_user_edit_other_phone").val();
        var folder = $("#housekeeping_edit_profile_token").val();
        var status = 0;

        if ($('#cleaning_user_edit_status').is(":checked")) {
            status = 1;
        }

        if (validateEmail(email)) {
            //  if (isNumber(phone) && isNumber(other_phone) && isNumber(medicare)) {
            if (isNumber(phone) && isNumber(other_phone)) {

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
                    birthdate: birthdate,
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
                show_alert_dialog("Error", "The medicare, phone and other phone only accept numbers.");
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
    $("#housekeeping_profile_code").text(user.code);
    $("#housekeeping_profile_medicare").text(user.medicare);
    $("#housekeeping_profile_addresss").text(user.home_address);
    $("#housekeeping_profile_email").text(user.email);
    $("#housekeeping_profile_birthdate").text(user.birthdate);
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
    $("#cleaning_user_edit_birthdate").val(user.birthdate);
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