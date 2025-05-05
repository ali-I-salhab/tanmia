@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">إضافة خطة دعم</h2>

    <form action="{{ route('plans.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">اسم الخطة</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="type_of_support" class="form-label">نوع الدعم</label>
            <input type="text" name="type_of_support" id="type_of_support" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="supporter_id" class="form-label">الداعم</label>
            <select name="supporter_id" id="supporter_id" class="form-control" required>
                <option value="">اختر الداعم</option>
                @foreach ($supporters as $supporter)
                    <option value="{{ $supporter->id }}">{{ $supporter->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="{{ route('plans.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
@endsection
