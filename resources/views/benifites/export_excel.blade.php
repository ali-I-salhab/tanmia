<table>
    <thead>
        <tr>
            <th>#</th>
            <th>الاسم</th>
            <th>اسم الأم</th>
            <th>الرقم الوطني</th>
            <th>العمر</th>
            <th>رقم الهاتف</th>
            <th>الموقع</th>
            <th>الحالة الاجتماعية</th>
            <th>يحتاج حليب</th>
            <th>أطفال في المدرسة</th>
            <th>كفيل</th>
            <th>أطفال في الجامعة</th>
            <th>نوع المرض</th>
            <th>نوع المرضى</th>
            <th>عدد المرضى</th>
            <th>الإعاقة</th>
            <th>الوحدة الإدارية</th>
            <th>القرية</th>
            <th>إجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->mother_name }}</td>
                <td>{{ $item->national_id }}</td>
                <td>{{ $item->age }}</td>
                <td>{{ $item->mobile }}</td>
                <td>{{ $item->location }}</td>
                <td>{{ $item->social_status }}</td>
                <td>{{ $item->childs_need_milk }}</td>
                <td>{{ $item->childs_in_school }}</td>
                <td>{{ $item->supporter }}</td>
                <td>{{ $item->childs_in_univercity }}</td>
                <td>{{ $item->sick_type }}</td>
                <td>{{ $item->sickers_type }}</td>
                <td>{{ $item->sickers_num }}</td>
                <td>{{ $item->eaka }}</td>
                <td>{{ $item->adminstratour_unit }}</td>
                <td>{{ $item->village }}</td>
            </tr>
        @endforeach
    </tbody>
</table>