@extends('layouts.app')

@section('content')
<div class="container" dir="rtl">
    <div class="card shadow-sm animate__animated animate__fadeInDown">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">تعديل الخطة</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('plans.update', $plan->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">اسم الخطة</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name', $plan->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="type_of_support">نوع الدعم</label>
                    <input type="text" class="form-control @error('type_of_support') is-invalid @enderror" 
                           id="type_of_support" name="type_of_support"
                           value="{{ old('type_of_support', $plan->type_of_support) }}" required>
                    @error('type_of_support')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="support_number">رقم الدعم</label>
                    <input type="text" class="form-control @error('support_number') is-invalid @enderror" 
                           id="support_number" name="support_number"
                           value="{{ old('support_number', $plan->support_number) }}">
                    @error('support_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="supporter_id">الداعم</label>
                    <select class="form-control @error('supporter_id') is-invalid @enderror" 
                            id="supporter_id" name="supporter_id">
                        <option value="">-- اختر الداعم --</option>
                        @foreach($supporters as $supporter)
                            <option value="{{ $supporter->id }}" 
                                {{ old('supporter_id', $plan->supporter_id) == $supporter->id ? 'selected' : '' }}>
                                {{ $supporter->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('supporter_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save ml-2"></i> حفظ التغييرات
                    </button>
                    <a href="{{ route('plans.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times ml-2"></i> إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection