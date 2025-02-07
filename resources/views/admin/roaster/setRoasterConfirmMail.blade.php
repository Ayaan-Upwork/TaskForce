<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>

    <h2>Roaster Table</h2>
    <h3>Name : {{ $employee->employe_name }}</h3>

    <table>
        <tr>
            <th>Friday</th>
            <th>Saturday</th>
            <th>Sunday</th>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
        </tr>
        @foreach ($roasterDetail as $detail)
            @if ($detail->end_time != null)
                <td>
                    <div class="row">
                        {{ $detail->daily_date }}
                    </div>
                </td>
            @else
                <td>-</td>
            @endif
        @endforeach
        <tr>
            @foreach ($roasterDetail as $detail)
                @if ($detail->end_time != null)
                    <td>
                        <div class="row">
                            {{ $detail->start_time }} - {{ $detail->end_time }}
                        </div>
                    </td>
                @else
                    <td>-</td>
                @endif
            @endforeach
        </tr>
        <tr>
            @foreach ($roasterDetail as $detail)
                @if ($detail->end_time != null)
                    <td>
                        <div class="row">
                            {{ $detail->locations->client_name }}
                        </div>
                    </td>
                @else
                    <td>-</td>
                @endif
            @endforeach
        </tr>

    </table>

</body>

</html>
