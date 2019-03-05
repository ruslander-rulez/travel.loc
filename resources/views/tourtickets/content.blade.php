@extends("tourtickets.layout")

@section("content")
    @php
        use App\Domain\Client\Client;
        /**
          * @var Client[] $tourists
          * @var array $exits
        */
    @endphp
    @foreach($tourists as $tourist)
        @foreach($exits as $key => $exit)

            @if(!(in_array($tourist->id, $excludeTourists)))
                @if (!(in_array($tourist->id, array_get($exit, "excludeIds", []))))
                    @include("tourtickets.ticket", [
                        "groupNumber" => $groupNumber,
                        "tourist" => $tourist,
                        "ship" => $ship,
                        "date"=> $key,
                        "time" => array_get($exit, "time.HH") . ":" . array_get($exit, "time.mm"),
                        "program" => array_get($exit, "programName")
                     ])
                @endif
                @if(array_get($exit, "eveningProgram") && !(in_array($tourist->id, array_get($exit, "excludeEveningIds", []))))
                    @include("tourtickets.ticket", [
                        "groupNumber" => $groupNumber,
                        "tourist" => $tourist,
                        "ship" => $ship,
                        "date"=> $key,
                        "time" => array_get($exit, "eveningTime.HH") . ":" . array_get($exit, "eveningTime.mm"),
                        "program" => array_get($exit, "eveningProgramName")
                    ])
                @endif
            @endif
        @endforeach
    @endforeach
@endsection