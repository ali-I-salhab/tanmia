@extends('layouts.app')

@section('content')
<div class="container" dir="rtl">
    <h2 class="mb-4">تعديل بيانات المستفيد</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('benifites.update', $benifites->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $benifites->name) }}" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="adminstrative_unit_id" class="form-label">الوحدة الإدارية</label>
                <select name="adminstrative_unit_id" id="adminUnitSelect" class="form-control" required>
                    <option value="" selected disabled>اختر الوحدة الإدارية</option>
                    @foreach($adminUnits as $unit)
                        <option value="{{ $unit->id }}" {{ old('adminstrative_unit_id', $benifites->adminstrative_unit_id) == $unit->id ? 'selected' : '' }}>
                            {{ $unit->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="village_id" class="form-label">القرية</label>
                <select name="village_id" id="villageSelect" class="form-control" required>
                    <option value="" selected disabled>اختر القرية</option>
                    {{-- @foreach($benifites->adminUnit->villages as $village)
                        <option value="{{ $village->id }}" {{ old('village_id', $benifites->village_id) == $village->id ? 'selected' : '' }}>
                            {{ $village->name }}
                        </option>
                    @endforeach --}}
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="age" class="form-label">العمر</label>
                <input type="number" name="age" id="age" class="form-control" value="{{ old('age', $benifites->age) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="national_id" class="form-label">الرقم الوطني</label>
                <input type="text" name="national_id" id="national_id" class="form-control" value="{{ old('national_id', $benifites->national_id) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="mobile" class="form-label">رقم الهاتف</label>
                <input type="text" name="mobile" id="mobile" class="form-control" value="{{ old('mobile', $benifites->mobile) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="location" class="form-label">الموقع</label>
                <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $benifites->location) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="social_status" class="form-label">الحالة الاجتماعية</label>
                <select name="social_status" id="social_status" class="form-control" required>
                    <option value="" selected disabled>اختر الحالة الاجتماعية</option>
                    <option value="single" {{ old('social_status', $benifites->social_status) == 'single' ? 'selected' : '' }}>أعزب</option>
                    <option value="married" {{ old('social_status', $benifites->social_status) == 'married' ? 'selected' : '' }}>متزوج</option>
                    <option value="divorced" {{ old('social_status', $benifites->social_status) == 'divorced' ? 'selected' : '' }}>مطلق</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="childs_need_milk" class="form-label">الأطفال يحتاجون حليب</label>
                <input type="text" name="childs_need_milk" id="childs_need_milk" class="form-control" value="{{ old('childs_need_milk', $benifites->childs_need_milk) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="childs_in_school" class="form-label">الأطفال في المدرسة</label>
                <input type="text" name="childs_in_school" id="childs_in_school" class="form-control" value="{{ old('childs_in_school', $benifites->childs_in_school) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="supporter" class="form-label">الداعم</label>
                <input type="text" name="supporter" id="supporter" class="form-control" value="{{ old('supporter', $benifites->supporter) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="childs_in_univercity" class="form-label">الأطفال في الجامعة</label>
                <input type="text" name="childs_in_univercity" id="childs_in_univercity" class="form-control" value="{{ old('childs_in_univercity', $benifites->childs_in_univercity) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="sick_type" class="form-label">نوع المرض</label>
                <input type="text" name="sick_type" id="sick_type" class="form-control" value="{{ old('sick_type', $benifites->sick_type) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="sickers_type" class="form-label">أنواع المرضى</label>
                <input type="text" name="sickers_type" id="sickers_type" class="form-control" value="{{ old('sickers_type', $benifites->sickers_type) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="sickers_num" class="form-label">عدد المرضى</label>
                <input type="text" name="sickers_num" id="sickers_num" class="form-control" value="{{ old('sickers_num', $benifites->sickers_num) }}">
            </div>
        </div>

        <div class="mb-3">
            <label for="eaka" class="form-label">الإعاقة</label>
            <input type="text" name="eaka" id="eaka" class="form-control" value="{{ old('eaka', $benifites->eaka) }}">
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">تحديث</button>
            <a href="{{ route('benifites.benifites') }}" class="btn btn-secondary">رجوع</a>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#adminUnitSelect').change(function() {
            var adminUnitId = $(this).val();

            if (!adminUnitId) {
                $('#villageSelect').empty().append('<option value="" selected disabled>اختر القرية</option>');
                return;
            }

            $.ajax({
                url: '/benifites/get-villages/' + adminUnitId,
                method: 'GET',
                success: function(response) {
                    $('#villageSelect').empty().append('<option value="" selected disabled>اختر القرية</option>');
                    response.forEach(function(village) {
                        $('#villageSelect').append('<option value="' + village.id + '">' + village.name + '</option>');
                    });
                }
            });
        });

        $('#adminUnitSelect').trigger('change');
    });
</script>

@endsection
