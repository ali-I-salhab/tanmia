@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-primary">تعديل بيانات الداعم</h2>

    <form action="{{ route('supporters.update', $supporter->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" name="name" class="form-control" value="{{ $supporter->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control" value="{{ $supporter->email }}" required>
        </div>

        <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
        <a href="{{ route('supporters.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
</div>
@endsection
