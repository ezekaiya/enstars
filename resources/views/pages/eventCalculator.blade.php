@extends('layouts.layout')

@section('title')
@parent
Event Calculator | enstars.info
@stop

@section('content')
<script>
var eventEnd = "<?php print $event->end;?>";
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">

        	<h1>Event Calculator</h1>

        	<h3>{{$event->name_e}} <small>{{$event->start}} - {{$event->end}}</small></h3><br><br>

<?php
			//time math
			//need to set timezone to japan
			$date1 = new DateTime();
			$date1->setTimeZone(new DateTimeZone('Asia/Tokyo'));
			$date2 = new DateTime($event->end);
			$date2->setTimeZone(new DateTimeZone('Asia/Tokyo'));
			$interval = $date1->diff($date2);
			echo "Time Remaining: ".$interval->d." days ".$interval->h." hours ".$interval->i." minutes"; 

?>


    	<div class="col-md-3">
    		Da: <input type="text" id="da" value="371809" class="form-control"><br>
    		Vo: <input type="text" id="vo" value="374231" class="form-control"><br>
    		Pf: <input type="text" id="pf" value="330402" class="form-control"><br>
    		<button class="btn btn-primary" id="calculate">Calculate</button>
    	</div>
    	<div class="col-md-6">
			<div id="results">
				<div id="da-total"></div>
				<div id="vo-total"></div>
				<div id="pf-total"></div>
			</div>

    	</div>
   	</div>

        </div>

    </div>
</div>
<script src="/js/moment.min.js"></script>
	<script>
		$('body').on('click','#calculate',function () {
			var da = $('#da').val();
			var vo = $('#vo').val();
			var pf = $('#pf').val();
			var daTotal;
			var voTotal;
			var pfTotal;
			//calculate the 3 team bonus


			daTotal = da * 2;
			voTotal = vo * 2;
			pfTotal = pf * 2;

			$('#da-total').html(daTotal);


			console.log('clicked');
		});
		//i wouldnt even use JS for this
		//console.log(eventEnd);
		//console.log(moment(eventEnd, "YYYY-MM-DD hh:ii:ss").fromNow(true));
		//var a = moment('7/11/2010','M/D/YYYY');
		//var b = moment('12/12/2010','M/D/YYYY');
		//var diffDays = b.diff(a, 'days');
	</script>
    

@endsection
