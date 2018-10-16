var CORE_SERVICES = URL_CONNECTIONS.core;

$(document).ready(function () {


   selectMenuItem(5);
    $(".btn_edit_promotion").click(function () {
        var promotion_id = $(this).attr("data-id");
        get_promotion_data_and_show_profile(promotion_id);
    });

    $(".btn_enable_promotion").click(function () {
        var promotion_id = $(this).attr("data-id");
        var promotion_status = $(this).attr("data-status");
        enable_or_disabled_promotion(promotion_id, promotion_status);
    });

    $("#promotion_edit_button").click(function () {
        var promotion_id = $(this).attr("data-id");
        update_promotion_profile(promotion_id);
    });



    $('#promotions_table').DataTable();

    $('#edit_promotion_date').dateRangePicker({
        separator: ' - ',
        format: 'DD/MM/YYYY',
        autoClose: true
    });
});


function enable_or_disabled_promotion(promotion_id, promotion_status) {
    var promotion_data = {
        id: promotion_id,
        status: promotion_status
    };
    var data = {
        promotion: promotion_data
    };
    $.ajax({
        url: CORE_SERVICES + "promotions/enable_or_disabled_promotion",
        type: "POST",
        data: data,
        success: function (data) {
            $("#promotion_error_modal_modal_button").attr("href", CORE_SERVICES + "promotions");

            show_alert_dialog("Success",
                    "Promotion user successfull.");
        },
        error: function () {
            $("#promotion_error_modal_modal_button").attr("href", CORE_SERVICES + "promotions");
            show_alert_dialog("Conection error",
                    "There was a connection error, try again.");
        }
    });
}

function get_promotion_data_and_show_profile(promotion_id) {
    var data = {
        id: promotion_id
    };

    $.ajax({
        url: CORE_SERVICES + "promotions/get_promotion_data_by_id",
        type: "POST",
        data: data,
        success: function (data) {



            var data_parse = JSON.parse(data);
            if (data_parse.status == 200) {
                var promotion = data_parse.data;
                show_promotion_profile(promotion);
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


function show_promotion_profile(promotion) {


    $("#edit_promotion_title").val(promotion.title);
    $("#edit_promotion_code").val(promotion.code);
    $("#edit_promotion_code_old").val(promotion.code);
    $("#edit_promotion_date").val(promotion.init_date + " - " + promotion.finish_date);
    $("#edit_promotion_discount").val(promotion.discount);
    $("#promotion_edit_button").attr("data-id", promotion.id_promotion);

    $('#promotion_edit_profile_modal').openModal();
}


function update_promotion_profile(promotion_id) {

    var is_empty_files = false;
    var is_valid_date_range = compare_date_range();


    $(".validate-form").each(function () {
        if ($(this).val() === "" || $(this).val() === " ")
            is_empty_files = true;
    });

    if (!is_empty_files) {

        console.log("=== 1 ====");

        if (is_valid_date_range) {

            console.log("=== 2 ====");

            var code = $("#edit_promotion_code").val();
            var code_old = $("#edit_promotion_code_old").val();
            var discount = $("#edit_promotion_discount").val();

            var is_valid_code = false;

            if (code === code_old) {
                upate_promotion(promotion_id);
            } else {

                if (isNumber(discount)) {

                    console.log("=== 3 ====");

                    var data = {
                        code: code
                    };
                    $.ajax({
                        url: CORE_SERVICES + "promotions/is_code_exists",
                        type: "POST",
                        data: data,
                        success: function (data) {


                            var data_parse = JSON.parse(data);

                            if (data_parse == false) {
                                upate_promotion(promotion_id);
                            } else {
                                show_alert_dialog("Error", "The promotional code already exists.");
                            }
                        },
                        error: function () {

                            show_alert_dialog("Conection error",
                                    "There was a connection error, try again.");
                        }
                    });

                } else {

                    console.log("=== 4 ====");
                    show_alert_dialog("Error", "The discount vale is only numeric.");
                }

            }

        } else {
            console.log("=== 5 ====");

            show_alert_dialog("Error", "The date range is incorrect, the dates must be greater or equal to today and the range must be at least one day.");

        }
    } else {
        console.log("=== 6 ====");

        show_alert_dialog("Error", "All fields are required.");

    }
}

function compare_date_range() {

    var today = get_today();
    var data_range_array = get_date_range();
    var is_range_date_valid = false;

    var parse_today = parse_date(today);
    var parse_init_date = parse_date(data_range_array[0]);
    var parse_finish_date = parse_date(data_range_array[1]);



    if (daysBetween(parse_today, parse_init_date) >= 0) {
        if (daysBetween(parse_today, parse_finish_date) >= 1) {
            if (daysBetween(parse_init_date, parse_finish_date) >= 1) {
                is_range_date_valid = true;
            }
        }
    }


    return is_range_date_valid;
}


function parse_date(date) {
    var date_array = date.split('/');
    var today = date_array[1] + '/' + date_array[0] + '/' + date_array[2];
    return today;
}
function daysBetween(date1, date2) {
    dt1 = new Date(date1);
    dt2 = new Date(date2);
    return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate())) / (1000 * 60 * 60 * 24));
}
function get_date_range() {
    var data_range = $("#edit_promotion_date").val();


    var data_range_array = data_range.split(' - ');
    return data_range_array;
}


function get_today() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!

    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd;
    }
    if (mm < 10) {
        mm = '0' + mm;
    }
    var today = dd + '/' + mm + '/' + yyyy;

    return today;
}


function upate_promotion(promotion_id) {


    var data_range_array = get_date_range();

    var title = $("#edit_promotion_title").val();
    var code = $("#edit_promotion_code").val();
    var discount = $("#edit_promotion_discount").val();
    var init_date = data_range_array[0];
    var finish_date = data_range_array[1];

    var promotion_data = {
        id: promotion_id,
        title: title,
        code: code,
        discount: discount,
        init_date: init_date,
        finish_date: finish_date
    };
    var data = {
        promotion: promotion_data
    };
    $.ajax({
        url: CORE_SERVICES + "promotions/update_promotion",
        type: "POST",
        data: data,
        success: function (data) {
            var data_parse = JSON.parse(data);

            console.log("---->" + data);

            if (data_parse.status == 200) {
                $("#promotion_error_modal_modal_button").attr("href", CORE_SERVICES + "promotions");

                show_alert_dialog("Success",
                        data_parse.message);
            } else {
                $("#promotion_create_button").show();
                show_alert_dialog("Error",
                        data_parse.message);
            }
        },
        error: function () {


            $("#promotion_create_button").show();
            show_alert_dialog("Conection error",
                    "There was a connection error, try again.");
        }
    });
}

function show_alert_dialog(title, message) {
    $("#promotion_error_modal_title").text(title);
    $("#promotion_error_modal_desc").text(message);
    $('#promotion_error_modal').openModal({
        dismissible: false
    });
}