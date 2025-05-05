@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">قائمة الداعمين</h2>
        <form method="GET" action="{{ route('supporters.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="بحث بالاسم أو البريد" value="{{ request('search') }}">
            <button class="btn btn-outline-primary" type="submit">بحث</button>
        </form>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">قائمة الداعمين</h2>
        
        <div>
            <a href="{{ route('supporters.create') }}" class="btn btn-success">
                إضافة داعم جديد
            </a>
        </div>
    </div>
    
    <div class="card shadow-sm rounded">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>تاريخ الإضافة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($supporters as $supporter)
                            <tr>
                                <td>{{ $supporter->id }}</td>
                                <td>{{ $supporter->name }}</td>
                                <td>{{ $supporter->email }}</td>
                                <td>{{ $supporter->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('supporters.edit', $supporter->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                
                                    <form action="{{ route('supporters.destroy', $supporter->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">لا يوجد داعمين.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <strong>عدد النتائج:</strong> {{ $supporters->total() }}
                </div>
                <div>
                    {{ $supporters->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
