@extends('layouts.layout')

@section('title')
@parent
{{$scout->name}} | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

        	<h1>{{$scout->name_e}} <small>{{$scout->start}} - {{$scout->end}}</small></h1>
            <p>{!! $scout->text !!}</p>
            <div class="row">
                <div class="col-md-2">
                    @if ($scout->type_id == 1)
                        @if ($chapters != '')
                            <h3>Scout Story</h3>
                            @foreach ($chapters as $chapter)
                                @if ($chapter->complete == 1)
                                    <a href="/story/{{$story->id}}/{{$chapter->chapter}}">{{$chapter->name_e}}</a><br>
                                @else
                                    {{$chapter->name_e}}<br>
                                @endif
                            @endforeach
                        @endif
                    @else


                    @endif
                </div>
                <div class="col-md-10">
                <div class="row">
                    <?php $x=1; ?>
                    @foreach($cards as $card)
                        <div class="col-md-3">
                                        <a href="/card/{{$card->id}}">
                                            <div class="card-container"><img class="img-responsive" src="/images/cards/{{$card->boy_id}}_{{$card->card_id}}.png"></div>
                                        </a>                           
 
                        </div>             
                        <?php
                            if ($x%4==0) {
?>
                            </div>
                            <div class="row">
<?php                            
                            }
                            $x++;
                        ?>
                    @endforeach
                </div>                    
                </div>
            </div>



        </div>

    </div>
</div>
@endsection