var CORE_SERVICES = URL_CONNECTIONS.core;
var mCategory = 0;
$(document).ready(function () {
  selectMenuItem(3);
  $('#plan_edit_price').inputmask({
        mask: "999,99",
        autoUnmask: true,
        placeholder: "",
        removeMaskOnSubmit: true
    });

    $("#plan_edit_btn").click(function () {
        var plan_id = $(this).attr("data-id");
        var old_category = $("#plan_edit_old_category").val();
        update_plan_data(plan_id, old_category);
    });

    $(".btn_see_plan").click(function () {
        var id_plan = $(this).attr("data-id");
        get_plan_data_and_show_desc(id_plan);
    });

    $(".btn_edit_plan").click(function () {
        var id_plan = $(this).attr("data-id");
        get_plan_data_and_edit(id_plan);
    });

    $(".btn_block_housekeeping").click(function () {
        alert("btn_block_housekeeping");
    });


    $("#plan_edit_category_select").on('change', function () {

        mCategory = parseInt(this.value);

        if (mCategory !== 1) {
            $("#plan_edit_url_payment_container").removeClass("hide");
        } else {
            $("#plan_edit_url_payment_container").addClass("hide");
        }

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
    $('#plans_table').DataTable();

});

function get_plan_data_and_show_desc(id_plan) {
    var data = {
        id: id_plan
    };

    $.ajax({
        url: CORE_SERVICES + "plans/get_plan_data_by_id",
        type: "POST",
        data: data,
        success: function (data) {
            var data_parse = JSON.parse(data);
            if (data_parse.status == 200) {
                var plan = data_parse.data;
                show_plan_data(plan);
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



function update_plan_data(id_plan, old_category) {

    var category = 0;

    var is_empty_files = false;

    $(".validate-form").each(function () {
        if ($(this).val() === "" || $(this).val() === " ")
            is_empty_files = true;
    });

    if (!is_empty_files) {

        var name = $("#plan_edit_name").val();
        var price = $("#plan_edit_price").val();
        var desc = $("#plan_edit_desc").val();
        var url_pay = $("#plan_edit_url_payment").val();
        var status = 0;

        var category_name = $(".selected").children().html();
        if (category_name === undefined) {
            category = old_category;
            mCategory = parseInt(category);
        } else {
            $("#plan_edit_category_select option").each(function ()
            {
                if ($(this).text() === category_name) {
                    category = $(this).val();
                }
            });
        }


        if ($('#plan_edit_status').is(":checked")) {
            status = 1;
        }

console.log("mCategory "+mCategory);
        if (isNumber(price)) {
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
             


                    var new_plan_data = {
                        id: id_plan,
                        name: name,
                        url: url_pay,
                        price: price,
                        desc: desc,
                        status: status,
                        category: category

                    };
                    var data = {
                        plan: new_plan_data
                    };

                    $.ajax({
                        url: CORE_SERVICES + "plans/update_data_plan",
                        type: "POST",
                        data: data,
                        success: function (data) {
                            var data_parse = JSON.parse(data);


                            if (data_parse.status == 200) {
                                $("#trigger_plan_error_modal_modal_button").attr("href", CORE_SERVICES + "plans");

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
                    show_alert_dialog("Error", "All fields are required.");
                }
            } else {
                show_alert_dialog("Error", "All fields are required.");
            }
        } else {
            show_alert_dialog("Error", "The price only accept numbers.");
        }

    } else {
        show_alert_dialog("Error", "All fields are required.");
    }
}
function get_plan_data_and_edit(id_plan) {
    var data = {
        id: id_plan
    };

    $.ajax({
        url: CORE_SERVICES + "plans/get_plan_data_by_id",
        type: "POST",
        data: data,
        success: function (data) {
            var data_parse = JSON.parse(data);
            if (data_parse.status == 200) {
                var plan = data_parse.data;
                show_plan_data_for_edition(plan);
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


function show_plan_data(plan) {

    var id_category = parseInt(plan.id_category);

    if (id_category === 1) {
        $("#plan_data_url_payment_container").addClass("hide");
    } else {
        $("#plan_data_url_payment_container").removeClass("hide");
        $("#plan_data_url_payment").text(plan.url_payment);
    }



    var status_user = "";
    if (plan.status == 1) {
        status_user = "Plan Enabled";
    } else {
        status_user = "Plan Unabled";
    }



    $("#plan_data_status").text(status_user);
    $("#plan_data_name").text(plan.name);
    $("#plan_data_category").text(plan.category);
    $("#plan_data_price").text("$ " + plan.price);
    $("#plan_data_desc").text(plan.description);
    $('#plan_data_modal').openModal();
}


function show_plan_data_for_edition(plan) {
    
     var id_category = parseInt(plan.id_category);

    if (plan.status == 1) {
        $('#plan_edit_status').trigger('click').prop('checked', true);
    } else {
        $('#plan_edit_status').trigger('click').prop('checked', false);
    }


    if (id_category !== 1) {
        $("#plan_edit_url_payment_container").removeClass("hide");
        $("#plan_edit_url_payment").val(plan.url_payment);
    } else {
        $("#plan_edit_url_payment_container").addClass("hide");
    }



    $("#plan_edit_name").val(plan.name);
    $("#plan_edit_old_category").val(plan.id_category);
    $("#plan_edit_price").val(plan.price);
    $("#plan_edit_desc").val(plan.description);
    $(".select-dropdown").attr("value", plan.category);
    $("#plan_edit_category_select option[value=" + plan.id_category + "]").attr("selected", "selected");
    $("#plan_edit_btn").attr("data-id", plan.id_plan);
    $('#plan_edit_modal').openModal();
}


function show_alert_dialog(title, message) {
    $("#plan_error_modal_title").text(title);
    $("#plan_error_modal_desc").text(message);
    $('#plan_error_modal').openModal({
        dismissible: false
    });
}