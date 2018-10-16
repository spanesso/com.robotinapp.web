var CORE_SERVICES = URL_CONNECTIONS.core;

$(document).ready(function () {

   selectMenuItem(5);
    $('#promotion_date').dateRangePicker({
        separator: ' - ',
        format: 'DD/MM/YYYY',
        autoClose: true
    });


    $("#promotion_create_button").click(function () {
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

                var code = $("#promotion_code").val();
                var discount = $("#promotion_discount").val();


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

                            console.log(data_parse);



                            if (data_parse == false) {
                                create_promotion();
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



            } else {
                console.log("=== 5 ====");

                show_alert_dialog("Error", "The date range is incorrect, the dates must be greater or equal to today and the range must be at least one day.");

            }
        } else {
            console.log("=== 6 ====");

            show_alert_dialog("Error", "All fields are required.");

        }
    });
});

function create_promotion() {
    $("#promotion_create_button").hide();


    var data_range_array = get_date_range();

    var title = $("#promotion_title").val();
    var code = $("#promotion_code").val();
    var discount = $("#promotion_discount").val();
    var init_date = data_range_array[0];
    var finish_date = data_range_array[1];

    var promotion_data = {
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
        url: CORE_SERVICES + "promotions/create_promotion",
        type: "POST",
        data: data,
        success: function (data) {
            var data_parse = JSON.parse(data);

            if (data_parse.status == 200) {
                $("#promotion_modal_button").attr("href", CORE_SERVICES + "promotions");

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
    var data_range = $("#promotion_date").val();


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


function show_alert_dialog(title, message) {
    $("#promotion_modal_title").text(title);
    $("#promotion_modal_desc").text(message);
    $('#promotion_modal').openModal({
        dismissible: false
    });
}