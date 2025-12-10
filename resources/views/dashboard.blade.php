<x-layouts.app :title="__('Dashboard')">
    
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div id="chart_div" class="absolute inset-0 w-full h-full"></div>

            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
</div>

        </div>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Day', 'Total Donations'],
            @foreach ($dailyTotals as $item)
                ['{{ $item->day }}', {{ $item->total }}],
            @endforeach
        ]);

        var options = {
            title: 'Daily Funeral Donations',
            legend: { position: 'none' },
            colors: ['#3b82f6'],
            hAxis: { title: 'Day' },
            vAxis: { title: 'Total Amount' },

            animation: {
                startup: true,
                duration: 1200,
                easing: 'out'
            },

            bar: { groupWidth: "70%" }
        };

        var chart = new google.visualization.ColumnChart(
            document.getElementById('chart_div')
        );

        chart.draw(data, options);
    }
</script>


    </div>
</x-layouts.app>
