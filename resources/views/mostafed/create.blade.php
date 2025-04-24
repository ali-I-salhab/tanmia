@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">إضافة مستفيد جديد</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('mostafed.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" name="name" id="name" class="form-control"
                   value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="village" class="form-label">القرية</label>
            <input type="text" name="village" id="village" class="form-control"
                   value="{{ old('village') }}" required>
            @error('village')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">العمر</label>
            <input type="number" name="age" id="age" class="form-control"
                   value="{{ old('age') }}" required>
            @error('age')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
</div>
@endsection
