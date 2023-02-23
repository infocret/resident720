@extends('layouts.app')

@section('content')


<div class="container">

    <div class="panel panel-primary">

        <div class="panel-heading">

            MY Calender    

        </div>

        <div class="panel-body" >

            {!! $calendar->calendar() !!}

         

        </div>

    </div>

</div>

@endsection



@section('scripts')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    {!! $calendar->script() !!}
@endsection

@section('css')
 {{--    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">   --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"  />
@endsection