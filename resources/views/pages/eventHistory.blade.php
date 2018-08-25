@extends('layouts.layout')

@section('title')
@parent
Card Release Graph | enstars.info
@stop

@section('content')
<style>
#chartdiv {
  width: 100%;
  height: 300px;
}
</style>
<div class="container">
  <h1>Event Border History - Max 5 Stars</h1>
    <div class="row">
        <div class="col-md-12">
	       	<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
			<script src="https://www.amcharts.com/lib/3/serial.js"></script>
			<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
			<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
			<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
			<script src="https://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js"></script>
      <script src="https://www.amcharts.com/lib/3/plugins/responsive/responsive.min.js"></script>
			<div id="chartdiv"></div>
        </div>

    </div>
</div>
<script>
AmCharts.useUTC = true;
var chart = AmCharts.makeChart("chartdiv", {
    "type": "serial",
    "theme": "light",
    "marginRight": 50,
    "dataDateFormat": "YYYY-MM-DD JJ:NN:SS",
    "dataLoader": {
    "url": "/data/event-border-history",
    "format": "json"
  },
    "valueAxes": [{
        "axisAlpha": 0,
        "position": "left"
    }],
    "graphs": [{
        "id":"39",
        "title": "Toyland",
        "bullet": "round",
        "balloonText": "Border: [[39_rank]] <b>[[value]]</b>",
        "valueField": "78_2000"
    },{
        "id":"40",
        "title": "StarFes",
        "bullet": "round",
        "balloonText": "Border: [[40_rank]] <b>[[value]]</b>",
        "valueField": "79_2000"
    },{
        "id":"41",
        "title": "Holiday Party",  
        "bullet": "round",
        "balloonText": "Border: [[41_rank]] <b>[[value]]</b>",
        "valueField": "80_2000"
    },
    {
        "id":"44",
        "title": "Setsubun",
        "bullet": "round",
        "balloonText": "Border: [[44_rank]] <b>[[value]]</b>",
        "valueField": "81_2000"
    },    {
        "id":"45",
        "title": "Chocolate Fest 2",
        "bullet": "round",
        "balloonText": "Border: [[45_rank]] <b>[[value]]</b>",
        "valueField": "82_2000"
    }],
    "chartCursor": {
        //"categoryBalloonDateFormat": "YYYY",
        "categoryBalloonEnabled": false,
        "cursorAlpha": 1,
        //"valueLineEnabled":true,
        //"valueLineBalloonEnabled":true,
        "valueLineAlpha":0.5,
        //"fullWidth":true
    },
    "categoryField": "timestamp",
    "categoryAxis": {
      "parseDates": true,
      //"minPeriod": "ss",
      "labelFunction": function(label) {


        if (label == "Jan 02") {
          label = 'Day 2';
        } else if (label == "Jan 03") {
          label = 'Day 3';
        } else if (label == 6) {
          label = 'Day 3';
        } else if (label == 8) {
          label = 'Day 4';
        } else if (label == 10) {
          label = 'Day 5';
        } else if (label == 12) {
          label = 'Day 6';
        } else if (label == 14) {
          label = 'Day 7';
        } else if (label == 16) {
          label = 'Day 8';
        } else if (label == 18) {
          label = 'Day 9';
        } else if (label == 20) {
          label = 'End';
        } else {
          label = '';
        }

        return label;
      },
    },
    "legend": {
      "position": "left",
      "valueText": ''
    },
    "export": {
        "enabled": true
    }
});
</script>
@endsection
