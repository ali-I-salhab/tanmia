<table>
    <thead>
        <tr>
            <th>الاسم</th>
            <th>اسم الأم</th>
            <th>الرقم الوطني</th>
            <th>العمر</th>
            <th>القرية</th>
            <th>نوع المرض</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->mother_name }}</td>
                <td>{{ $item->national_id }}</td>
                <td>{{ $item->age }}</td>
                <td>{{ $item->village }}</td>
                <td>{{ $item->sick_type }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
