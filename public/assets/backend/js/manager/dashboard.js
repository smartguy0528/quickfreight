var fn = {
    /**
     *  Initialize DOM
     */


    init_chart_monthly: function (monthly_data) {

        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: monthly_data.map(obj => obj.date),
                datasets: [{
                    label: "Num of Request",
                    lineTension: 0.3,
                    backgroundColor: "rgba(2,117,216,0.2)",
                    borderColor: "rgba(2,117,216,1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(2,117,216,1)",
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    data: monthly_data.map(obj => obj.count),
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 16
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: monthly_data.reduce((max, obj) => obj.count > max ? obj.count : max, -Infinity) + 3,
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, .125)",
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });
    },

    init_chart_yearly: function (yearly_data) {
        // Bar Chart Example
        var ctx = document.getElementById("myBarChart");
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: yearly_data.map(obj => obj.month_name),
                datasets: [{
                    label: "Num of Quotes",
                    backgroundColor: "rgba(2,117,216,1)",
                    borderColor: "rgba(2,117,216,1)",
                    data: yearly_data.map(obj => obj.count),
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 12
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: Math.ceil(yearly_data.reduce((max, obj) => obj.count > max ? obj.count : max, -Infinity)/20)*20,
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            display: true
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });
    },

    init_chart_rate: function () {
        var rate_data = {
            "Completed": $("#num_total_quotes").val(),
            "On Going": $("#num_ongoing_quotes").val(),
            "Rejected": $("#num_deleted_quotes").val()
        };
        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: Object.keys(rate_data),
                datasets: [{
                    data: Object.values(rate_data),
                    backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
                }],
            },
        });
    },

    init_table: function () {
        $('#datatablesSimple').DataTable({
            columnDefs: [{ orderable: false, targets: [-1] }],
            pageLength: 10,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
        });
    },

    /**
     *  Initialize Applications
     */
    init: function () {
        // Monthly Chart Init
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/manager/dashboard/get_monthly_data',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                fn.init_chart_monthly(response);
            }
        });


        // Yearly Chart Init
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/manager/dashboard/get_yearly_data',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                fn.init_chart_yearly(response);
            }
        });

        // Rate Chart Init
        fn.init_chart_rate();

        // DataTable Init
        fn.init_table();
    }
}

fn.init();
