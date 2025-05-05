<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <style>
        @font-face {
            font-family: 'amiri';
            src: url('{{ public_path('fonts/Amiri-Regular.ttf') }}') format('truetype');
        }

        body {
            direction: rtl;
            font-family: 'amiri', DejaVu Sans, sans-serif;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
        }

        th, td {
            border: 1px solid #000;
            padding: 5px;
        }

        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">تقرير المستفيدين</h2>

    <table>
        <thead>
            <tr>
                <th>الاسم</th>
                <th>العمر</th>
                <th>القرية</th>
                <th>نوع المرض</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->age }}</td>
                    <td>{{ $row->village }}</td>
                    <td>{{ $row->sick_type }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
