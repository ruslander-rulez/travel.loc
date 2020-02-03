@extends("book-program.layout")

@section("content")
    <table>
        <tr>
            <td style="padding-right: 10px; vertical-align: top; text-decoration: underline">Количество туристов</td>
            <td>
                Взрослые: {{ array_get($book->total_tourists, "adults", "-") }} <br>
                Студенты: {{ array_get($book->total_tourists, "students", "-") }} <br>
                Школьники: {{ array_get($book->total_tourists, "schoolchildren", "-") }} <br>
                Дошкольники: {{ array_get($book->total_tourists, "preschoolers", "-") }}
            </td>
        </tr>
    </table>
    <br>
    <p>
        <span style="text-decoration: underline">{{ $book->type_type === "App\Domain\Hotel\Hotel" ? "Отель" : "Круиз" }}:</span>
        {{ $book->type ? $book->type->name : ""}}
    </p>
    <div>
        <p style="float: right">
        <span style="text-decoration: underline"><b>WIFI</b></span> I Love Travel &nbsp;&nbsp;&nbsp;&nbsp;
        <span style="text-decoration: underline;"><b>Пароль</b></span> 00000000
        </p>
        <p>
            <span style="text-decoration: underline">Гид</span>: &nbsp;{{ $book->guide ?? "-" }} <br>
            <span style="text-decoration: underline">Водитель</span>: &nbsp;{{ $book->driver ?? "-" }} <br>
        </p>
    </div>
    <table>

    @foreach($book->program as $key => $program)
                <tr>
                    <td style="vertical-align: top">{{ array_get($program, "date") }}</td>
                    <td style="vertical-align: top; padding: 0 5px"><b>{{ array_get($program, "time") }}</b></td>
                    <td>
                        {{ array_get($program, "place.name") }}
                        @if( array_get($program, "place.dinner"))
                            <br>
                            Меню:
                            @foreach(array_get($program, "place.menu", []) as $menuItem)
                                <div>
                                    &nbsp; - {{ array_get($menuItem, "name") }}
                                </div>
                            @endforeach
                        @endif
                    </td>
                </tr>
    @endforeach
    </table>
    @if($book->notes)
    <p>Заметки:</p>
    <blockquote style="white-space: pre-wrap;">{{$book->notes}}</blockquote>
    @endif
    @if($book->booking && $book->booking->tourists->count())
    <div class="page_break"></div>
    <h1>Список туристов</h1>
    <table id="tourists">
        <thead>
        <tr>
            <th>Имя</th>
            <th>Год рождения</th>
            <th>Паспорт</th>
            <th>Национальность</th>
        </tr>
        </thead>
        <tbody>
        @foreach($book->booking->tourists as $tourist)
        <tr>
            <td>{{ $tourist->name }}</td>
            <td>{{ $tourist->birthday->format("d.m.Y") }}</td>
            <td> {{ $tourist->passport }}</td>
            <td>{{ $tourist->nationality }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="page_break"></div>
    <h1>Примечания</h1>
    @foreach($book->booking->tourists as $tourist)
        @if($tourist->notes)
            <p><b>{{ $tourist->name }}:</b></p>
            <blockquote>{!! nl2br($tourist->notes) !!}</blockquote>
            <br>
        @endif
    @endforeach
    @endif
@endsection