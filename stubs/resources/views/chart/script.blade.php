<script>
    (function() {
        var options = {!! \Illuminate\Support\Js::from($chart->toScriptOptions()) !!};
        var chart = new ApexCharts(
            document.querySelector({!! \Illuminate\Support\Js::from('#' . $chart->id()) !!}),
            options
        );

        chart.render();
    })();
</script>
