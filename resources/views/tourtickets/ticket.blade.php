<table style="width: 100%; border: none" class="row"><tr>
        <td style="width: 50%; text-align: center; vertical-align: center">
            <h1 style="text-align: center; color: red;">
                TOUR <br>
                TICKET
            </h1>

            <img src="{{public_path("tourticket/img/logo.png")}}" alt="">
            <p style="font-size: 11px">
                Limited Liability Company "I TRAVEL SPB"<br>
                Authorised Tour Operator PTO 013246 <br>
                192029 Санкт-Петербург, Б.Смоленский пр, д.2 <br>
                Tel: (812) 931 87 27   FAX: +7 (812) 386 20 81 <br>
                www.itravelspb.com info@itravelspb.com
            </p>
        </td>

        <td width="50%">
        <table style="width: 100%; border-spacing: 0px" class="internaltable">
            <tr style="width: 40%;">
                <td>Reservation № <br>
                    (Номер группы)
                </td>
                <td> {{ $groupNumber }}</td>
            </tr>
            <tr>
                <td>
                    Dates<br>
                    (Даты)
                </td>
                <td> {{ \Illuminate\Support\Carbon::createFromFormat("Y-m-d", $date)->format("d-m-Y") }}</td>
            </tr>
            <tr>
                <td>Ship <br>
                    (Корабль)
                </td>
                <td>{{ $ship }}</td>
            </tr>
            <tr>
                <td>Guest name<br>
                    (ФИО)
                </td>
                <td> {{ $tourist->name }}</td>
            </tr>
            <tr>
                <td>Passport number <br>
                    (Номер паспорта)
                </td>
                <td>{{ $tourist->passport }}</td>
            </tr>
            <tr>
                <td>Meeting time<br>
                    (Время выхода)
                </td>
                <td>{{ $time }}</td>
            </tr>
            @if ($program)
            <tr>
                <td>Program <br>
                    (Программа)
                </td>
                <td>{{ $program }}</td>
            </tr>
            @endif
        </table>
        </td>
    </tr>
</table>