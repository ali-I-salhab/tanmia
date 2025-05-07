@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary: #4361ee;
        --secondary: #3f37c9;
        --accent: #4cc9f0;
        --light: #f8f9fa;
        --dark: #212529;
    }
    
    .form-container {
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        padding: 2rem;
        margin-bottom: 2rem;
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    
    .form-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
    }
    
    .form-header {
        color: var(--primary);
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 1rem;
        margin-bottom: 2rem;
    }
    
    .form-label {
        font-weight: 500;
        color: #555;
        margin-bottom: 0.5rem;
    }
    
    .form-control, .select2-selection {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        border: 1px solid #e0e0e0;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .select2-selection:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
    }
    
    .btn-submit {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border: none;
        padding: 0.75rem 2rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        border-radius: 10px;
        position: relative;
        overflow: hidden;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
    }
    
    .btn-submit::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.1);
        transform: translateX(-100%);
        transition: transform 0.4s ease;
    }
    
    .btn-submit:hover::after {
        transform: translateX(0);
    }
    
    .btn-back {
        transition: all 0.3s ease;
        border-radius: 10px;
    }
    
    .btn-back:hover {
        transform: translateY(-2px);
    }
    
    .error-message {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    
    .alert-danger {
        border-radius: 10px;
        border-left: 4px solid #dc3545;
    }
    
    .input-group-text {
        border-radius: 10px 0 0 10px;
        background-color: #f8f9fa;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-form {
        animation: fadeInUp 0.6s cubic-bezier(0.22, 0.61, 0.36, 1) forwards;
    }
    
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
</style>

<div class="container py-4" dir="rtl">
    <div class="form-container animate__animated animate__fadeIn">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="form-header">
                <i class="fas fa-user-plus me-2"></i> إضافة مستفيد جديد
            </h2>
            <a href="{{ route('benifites.benifites') }}" class="btn btn-back btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> رجوع
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger animate__animated animate__fadeIn mb-4">
                <h5 class="alert-heading">يوجد أخطاء في المدخلات:</h5>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('benifites.store') }}" class="animate-form">
            @csrf

            <!-- Personal Information Section -->
            <div class="mb-4 animate-fade-up">
                <h5 class="mb-3 text-primary">
                    <i class="fas fa-user-circle me-2"></i> المعلومات الشخصية
                </h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">الاسم الكامل</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="mother_name" class="form-label">اسم الأم</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-female"></i></span>
                            <input type="text" name="mother_name" id="mother_name" class="form-control" value="{{ old('mother_name') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="age" class="form-label">العمر</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            <input type="number" name="age" id="age" class="form-control" value="{{ old('age') }}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="national_id" class="form-label">الرقم الوطني</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input type="text" name="national_id" id="national_id" class="form-control" value="{{ old('national_id') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="mobile" class="form-label">رقم الهاتف</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input type="text" name="mobile" id="mobile" class="form-control" value="{{ old('mobile') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="social_status" class="form-label">الحالة الاجتماعية</label>
                        <select name="social_status" id="social_status" class="form-control" required>
                            <option value="" selected disabled>اختر الحالة الاجتماعية</option>
                            <option value="أعزب" {{ old('social_status') == 'أعزب' ? 'selected' : '' }}>أعزب</option>
                            <option value="متزوج" {{ old('social_status') == 'متزوج' ? 'selected' : '' }}>متزوج</option>
                            <option value="مطلق" {{ old('social_status') == 'مطلق' ? 'selected' : '' }}>مطلق</option>
                            <option value="أرمل" {{ old('social_status') == 'أرمل' ? 'selected' : '' }}>أرمل</option>
                        </select>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="location" class="form-label">الموقع</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Location Information Section -->
            <div class="mb-4 animate-fade-up delay-1">
                <h5 class="mb-3 text-primary">
                    <i class="fas fa-map-marked-alt me-2"></i> المعلومات الجغرافية
                </h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="adminstrative_unit_id" class="form-label">الوحدة الإدارية</label>
                        <select name="adminstrative_unit_id" id="adminUnitSelect" class="form-control" required>
                            <option value="" selected disabled>اختر الوحدة الإدارية</option>
                            @foreach($adminUnits as $unit)
                                <option value="{{ $unit->id }}" {{ old('adminstrative_unit_id') == $unit->id ? 'selected' : '' }}>
                                    {{ $unit->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="village_id" class="form-label">القرية</label>
                        <select name="village_id" id="villageSelect" class="form-control" required>
                            <option value="" selected disabled>اختر القرية</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Family Information Section -->
            <div class="mb-4 animate-fade-up delay-2">
                <h5 class="mb-3 text-primary">
                    <i class="fas fa-users me-2"></i> معلومات الأسرة
                </h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="childs_need_milk" class="form-label">الأطفال يحتاجون حليب</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-baby"></i></span>
                            <input type="number" name="childs_need_milk" id="childs_need_milk" class="form-control" value="{{ old('childs_need_milk', 0) }}" min="0">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="childs_in_school" class="form-label">الأطفال في المدرسة</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-school"></i></span>
                            <input type="number" name="childs_in_school" id="childs_in_school" class="form-control" value="{{ old('childs_in_school', 0) }}" min="0">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="childs_in_univercity" class="form-label">الأطفال في الجامعة</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                            <input type="number" name="childs_in_univercity" id="childs_in_univercity" class="form-control" value="{{ old('childs_in_univercity', 0) }}" min="0">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="supporter" class="form-label">الداعم</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-hand-holding-heart"></i></span>
                            <input type="text" name="supporter" id="supporter" class="form-control" value="{{ old('supporter') }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Health Information Section -->
            <div class="mb-4 animate-fade-up delay-3">
                <h5 class="mb-3 text-primary">
                    <i class="fas fa-heartbeat me-2"></i> المعلومات الصحية
                </h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="sick_type" class="form-label">نوع المرض</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-disease"></i></span>
                            <input type="text" name="sick_type" id="sick_type" class="form-control" value="{{ old('sick_type') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="sickers_type" class="form-label">أنواع المرضى</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-procedures"></i></span>
                            <input type="text" name="sickers_type" id="sickers_type" class="form-control" value="{{ old('sickers_type') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="sickers_num" class="form-label">عدد المرضى</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user-injured"></i></span>
                            <input type="number" name="sickers_num" id="sickers_num" class="form-control" value="{{ old('sickers_num', 0) }}" min="0">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="eaka" class="form-label">الإعاقة</label>
                        <select name="eaka" id="eaka" class="form-control">
                            <option value="" selected disabled>اختر حالة الإعاقة</option>
                            <option value="نعم" {{ old('eaka') == 'نعم' ? 'selected' : '' }}>نعم</option>
                            <option value="لا" {{ old('eaka') == 'لا' ? 'selected' : '' }}>لا</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="d-flex justify-content-between mt-4 animate-fade-up delay-3">
                <button type="submit" class="btn btn-submit">
                    <i class="fas fa-save me-1"></i> حفظ المستفيد
                </button>
                <a href="{{ route('benifites.benifites') }}" class="btn btn-back btn-outline-secondary">
                    <i class="fas fa-times me-1"></i> إلغاء
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Include jQuery and Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2
        $('#adminUnitSelect, #villageSelect, #social_status, #eaka').select2({
            placeholder: "اختر من القائمة",
            allowClear: true,
            width: '100%'
        });

        // Load villages when admin unit changes
        $('#adminUnitSelect').change(function() {
            var adminUnitId = $(this).val();
            $('#villageSelect').empty().append('<option value="" selected disabled>تحميل...</option>').trigger('change');

            if (adminUnitId) {
                $.ajax({
                    url: '/benifites/get-villages/' + adminUnitId,
                    method: 'GET',
                    success: function(response) {
                        $('#villageSelect').empty().append('<option value="" selected disabled>اختر القرية</option>');
                        response.forEach(function(village) {
                            $('#villageSelect').append('<option value="' + village.id + '">' + village.name + '</option>');
                        });
                        
                        // Select old value if exists
                        @if(old('village_id'))
                            $('#villageSelect').val('{{ old("village_id") }}').trigger('change');
                        @endif
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", error);
                        $('#villageSelect').empty().append('<option value="" selected disabled>خطأ في تحميل القرى</option>');
                    }
                });
            }
        });

        // Trigger change if admin unit has old value
        @if(old('adminstrative_unit_id'))
            $('#adminUnitSelect').val('{{ old("adminstrative_unit_id") }}').trigger('change');
        @endif
    });
</script>
@endsection