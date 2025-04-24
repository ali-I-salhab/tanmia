@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">تعديل بيانات المستفيد</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('mostafed.update', $mostafed->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" name="name" id="name" class="form-control"
                   value="{{ old('name', $mostafed->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="village" class="form-label">القرية</label>
            <input type="text" name="village" id="village" class="form-control"
                   value="{{ old('village', $mostafed->village) }}" required>
            @error('village')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">العمر</label>
            <input type="number" name="age" id="age" class="form-control"
                   value="{{ old('age', $mostafed->age) }}" required>
            @error('age')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">تحديث</button>
        <a href="{{ route('mostafed.mostafed') }}" class="btn btn-secondary">رجوع</a>
    </form>
</div>
@endsection
