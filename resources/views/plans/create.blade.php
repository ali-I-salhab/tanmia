@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">إضافة خطة دعم</h2>

    <form action="{{ route('plans.store-step1') }}" method="POST">
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

          <div class="form-group">
                    <label for="beneficiaries_count">عدد المستفيدين</label>
                    <input type="number" class="form-control" id="beneficiaries_count" 
                           name="beneficiaries_count" min="1" required>
                </div>
                
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-arrow-right ml-2"></i> التالي
                    </button>
                </div>
    </form>
</div>
@endsection
