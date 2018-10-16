var CORE_SERVICES = URL_CONNECTIONS.core;
var mCategory = 0;
$(document).ready(function () {
  selectMenuItem(3);
    $("#url_payment_container").addClass("hide");


    $('#create_plan_price').inputmask({
        mask: "999.999.999",
        autoUnmask: true,
        placeholder: "",
        removeMaskOnSubmit: true
    });

    $("#create_plan_select").on('change', function () {

        mCategory = parseInt(this.value);

        if (mCategory !== 1) {
            $("#url_payment_container").removeClass("hide");
        } else {
            $("#url_payment_container").addClass("hide");
        }

    });

    $("#create_plan_btn").click(function () {

        var is_empty_files = false;


        $(".validate-form").each(function () {
            if ($(this).val() === "" || $(this).val() === " ")
                is_empty_files = true;
        });

        if (!is_empty_files) {
            var category = 0;
            var category_name = $(".selected").children().html();
            if (category_name !== undefined) {

                $("#create_plan_select option").each(function ()
                {
                    if ($(this).text() === category_name) {
                        category = $(this).val();
                    }
                });

                var name = $("#create_plan_name").val();
                var price = $("#create_plan_price").val();
                var desc = $("#create_plan_desc").val();
                var url_pay = $("#create_plan_payment_url").val();

                if (mCategory !== 0) {

                    var isCategoryUrlPayment = false;

                    if (mCategory !== 1 && url_pay !== "" && url_pay !== " ") {
                        isCategoryUrlPayment = true;
                    } else if (mCategory === 1) {
                        isCategoryUrlPayment = true;
                        url_pay = "";
                    } else {
                        isCategoryUrlPayment = false;
                    }

                    if (isCategoryUrlPayment) {
                        if (isNumber(price)) {

                            var new_plan_data = {
                                name: name,
                                url: url_pay,
                                price: price,
                                desc: desc,
                                category: category
                            };
                            var data = {
                                plan: new_plan_data
                            };




                            $.ajax({
                                url: CORE_SERVICES + "plans/create_plan",
                                type: "POST",
                                data: data,
                                success: function (data) {
                                    var data_parse = JSON.parse(data);


                                    if (data_parse.status == 200) {
                                        $("#trigger_plan_error_modal_modal_button").attr("href", CORE_SERVICES + "plans");

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
                            show_alert_dialog("Error", "The price only accept numbers.");

                        }
                    } else {
                        show_alert_dialog("Error", "All fields are required.");
                    }

                } else {
                    show_alert_dialog("Error", "All fields are required.");

                }

            } else {
                show_alert_dialog("Error", "All fields are required.");

            }
        } else {
            show_alert_dialog("Error", "All fields are required.");

        }
    });
});




function show_alert_dialog(title, message) {
    $("#plan_error_modal_title").text(title);
    $("#plan_error_modal_desc").text(message);
    $('#plan_error_modal').openModal({
        dismissible: false
    });
}