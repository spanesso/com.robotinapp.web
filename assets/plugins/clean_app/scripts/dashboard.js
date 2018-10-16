var CORE_SERVICES = URL_CONNECTIONS.core;

$(document).ready(function () {
    $('#cheking_services_modal').openModal();
    show_chart_data();
    verify_acvtive_services();
    selectMenuItem(0);
});


function show_chart_data() {





    $.ajax({
        url: CORE_SERVICES + "dashboard/get_charts_data",
        type: "POST",
        success: function (data) {
            console.log("data: " + data);
            var data_parse = JSON.parse(data);
            var pay_services = parseInt(data_parse.pay_services);
            var pending_pay_services = parseInt(data_parse.pending_pay_services);
            var assing_services = parseInt(data_parse.assing_services);
            var finished_services = parseInt(data_parse.finished_services);
            var expire_services = parseInt(data_parse.expire_services);
            var closed_services = parseInt(data_parse.closed_services);
            var active_empoyees = parseInt(data_parse.active_empoyees);
            var unactive_empoyees = parseInt(data_parse.unactive_empoyees);


            console.log("assing_services: " + assing_services);

            var ctx2 = document.getElementById("chart2").getContext("2d");
            var data2 = {
                labels: ["Confirm Payment", "Pending Pay", "Assigned", "Finish", "Close", "Canceled"],
                datasets: [
                    {
                        label: "Services",
                        fillColor: "#9575CD",
                        strokeColor: "transparent",
                        highlightFill: "#9575CD",
                        highlightStroke: "#B3B3B3",
                        data: [
                            pay_services,
                            pending_pay_services,
                            assing_services,
                            finished_services,
                            expire_services,
                            closed_services
                        ]
                    }
                ]
            };

            var chart2 = new Chart(ctx2).Bar(data2, {
                scaleBeginAtZero: true,
                scaleShowGridLines: true,
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleGridLineWidth: 1,
                scaleShowHorizontalLines: true,
                scaleShowVerticalLines: false,
                barShowStroke: true,
                barStrokeWidth: 2,
                barDatasetSpacing: 1,
                legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                responsive: true,
                scaleOverride: true,
                scaleSteps: 2,
                scaleStepWidth: 1,
                scaleStartValue: 0,
                barValueSpacing: 20,
                tooltipCornerRadius: 2
            });

            var ctx4 = document.getElementById("chart4").getContext("2d");
            var data4 = [
                {
                    value: active_empoyees,
                    color: "#9575CD",
                    highlight: "#9575CD",
                    label: "Active"
                },
                {
                    value: unactive_empoyees,
                    color: "#33AC71",
                    highlight: "#33AC71",
                    label: "Inactive"
                }
            ];

            var myPieChart = new Chart(ctx4).Pie(data4, {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false,
                legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
                responsive: true,
                tooltipCornerRadius: 2
            });


        },
        error: function () {
            console.log("error: ");
        }
    });


}
function verify_acvtive_services() {

    var data = {
        u: ""
    };

    $.ajax({
        url: CORE_SERVICES + "dashboard/verify_active_services",
        type: "POST",
        data: data,
        success: function (data) {
            if (data) {

                setTimeout(function () {
                    $('#cheking_services_modal').closeModal();
                }, 2000);


            }
        },
        error: function () {
            show_alert_dialog("Conection error",
                    "There was a connection error, try again.");
        }
    });

}

function show_alert_dialog(title, message) {
    $("#sig_in_modal_title").text(title);
    $("#sig_in_modal_desc").text(message);
    $('#sig_in_modal').openModal({
        dismissible: false
    });
}