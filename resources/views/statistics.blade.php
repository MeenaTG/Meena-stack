<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Stack tags statistics</title>
        <!-- Favicon -->
        <link href="{{ asset('img/brand/favicon.png') }}" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Extra details for Live View on GitHub Pages -->

    </head>
    <body class="{{ $class ?? '' }}">
         
        @if(count($aStack) > 0)
        <div class="main-content">
            <a href="{{ url('stacktags.php') }}" style="  margin: auto;">
                <input type="button" value="Refresh Statistics Data">
            </a>

            <p>Last updated at : {{ date('d M Y, g:i a',strtotime($aStack[0]->updated_at))}}</p>

           <div id="chartContainer" style="height: 300px; width: 100%;"></div>

            <div id="chartContainerbar" style="height: 300px; width: 100%;margin-top: 30px;"></div>

        </div>

        

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        
        <script type="text/javascript">
            var aJsonPie = {!! $aJsonPie !!};
            var aBar1Stack = {!! $aBar1Stack !!};
            var aBar2Stack = {!! $aBar2Stack !!};
            var aBar3Stack = {!! $aBar3Stack !!};
            // console.log(aJsonPie);
            window.onload = function() {
                var options = {
                    title: {
                    text: "Stackovverflow Tags"
                    },
                    data: [{
                        type: "pie",
                        startAngle: 45,
                        showInLegend: "true",
                        legendText: "{label}",
                        indexLabel: "{label} ({y})",
                        yValueFormatString:"#,##0.#"%"",
                        dataPoints: aJsonPie
                    }]
                };
                $("#chartContainer").CanvasJSChart(options);

                var chart = new CanvasJS.Chart("chartContainerbar", {
                        title: {
                            text: "Question statistics"
                        },
                        axisY: {
                            labelFontSize: 20,
                            labelFontColor: "dimGrey"
                        },
                        axisX: {
                            labelAngle: -30
                        },
                        data: [
                        {
                            type: "column",
                            showInLegend: "true",
                            legendText: "No of questions",
                            dataPoints: aBar1Stack
                        },
                        {
                            type: "column",
                            showInLegend: "true",
                            legendText: "Frequent questions",
                            dataPoints:aBar2Stack
                        },
                        {
                            type: "column",
                            showInLegend: "true",
                            legendText: "Unanswered questions",
                            dataPoints: aBar3Stack
                        }
                        ]
                    });

                chart.render();

            }
        </script>
        <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
        @else 
            <div class="main-content">
            <a href="{{ url('stacktags.php') }}" style="  margin: auto;">
                <input type="button" value="Get Stackoverflow Datas">
            </a>
            </div>
        @endif
    </body>
</html>