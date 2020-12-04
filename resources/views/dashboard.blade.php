<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (isset($users_data) && isset($movie_data))
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="container">
                        <div class="panel panel-default">
                         <div class="panel-heading">
                          <h3 class="panel-title text-center m-3 text-muted">Income statistics</h3>
                         </div>
                        </div>

                        <div class="block justify-content-around md:flex">
                            <div id="pie_chart"></div>
                            <div id="bar_chart"></div>
                        </div>

                    </div>
                </div>
            @else
                <h3 class="text-muted">An error has ocurred loading the info. Please try again</h3>
            @endif
        </div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        var analyticsUser = {!! ($users_data) !!};
        var analyticsMovie = {!! ($movie_data) !!};

        // Load Charts and the corechart and barchart packages.
        google.charts.load('current', {'packages':['corechart']});

        // Draw the pie chart and bar chart when Charts is loaded.
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            console.log(analyticsMovie)
            console.log(analyticsUser)

            var piechart_data = google.visualization.arrayToDataTable(analyticsUser);
            var piechart_options = {
                    title:'Users who have rented the most in the last week',
                    pieSliceText: 'value',
                    width:400,
                    height:500
                };
            var piechart = new google.visualization.PieChart(document.getElementById('pie_chart'));
            piechart.draw(piechart_data, piechart_options);

            var barchart_data = google.visualization.arrayToDataTable(analyticsMovie);
            var barchart_options = {
                    title:'Most rented movies in the last week',
                    width:400,
                    height:500,
                    colors:['#343a40'],
                    legend: 'none'
                };
            var barchart = new google.visualization.BarChart(document.getElementById('bar_chart'));
            barchart.draw(barchart_data, barchart_options);
        }

    </script>

</x-app-layout>
