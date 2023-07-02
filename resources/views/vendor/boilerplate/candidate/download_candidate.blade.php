<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>User Credits History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 15px;
            padding-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .user_details {
            margin-bottom: 5px !important;
        }
    </style>
</head>

<body>
    {{-- @dd("im here", $filter_dates, $downloadType, $tableData) --}}
    <div style="margin: 0 auto;display: block;width: 600px;">
        <div>
            <h3 align="center">Candidate List ({{ date('m/d/Y', strtotime($filter_dates['start_date'])) }} to
                {{ date('m/d/Y', strtotime($filter_dates['end_date'])) }})</h3>
        </div>

        @if ($downloadType == 'excel')
            <br>
        @endif

        @if (isset($tableData) && !empty($tableData))
            <table border="1" cellspacing="0">
                <thead>
                    <tr>
                        <th><b>Institute Name</b></th>
                        <th><b>Camp</b></th>
                        <th><b>Activity</b></th>
                        <th><b>Serial Number</b></th>
                        <th><b>Regiment Number</b></th>
                        <th><b>Candidate Name</b></th>
                        <th><b>Rank</b></th>
                        <th><b>Contact Number</b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tableData as $info)
                        <tr>
                            {{-- <td>{{ date('m/d/Y', strtotime($info['created_at'])) }}</td> --}}
                            <td>{{ $info['institute']['institute_name'] }}</td>
                            <td>{{ $info['camp'] }}</td>
                            <td>{{ $info['activity'] }}</td>
                            <td>{{ $info['sr_no'] }}</td>
                            <td>{{ $info['regiment_no'] }}</td>
                            <td>{{ $info['name'] }}</td>
                            <td>{{ $info['rank'] }}</td>
                            <td>{{ $info['contact_no'] }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div><span>No Records Found</span></div>
        @endif
    </div>
</body>

</html>
