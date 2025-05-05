@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-center">فلترة المستفيدين</h2>
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('benifites.create') }}" class="btn btn-success">
                إضافة مستفيد جديد <i class="fas fa-plus"></i>
            </a>
        </div>
        
        <!-- Filter Form -->
        <form method="GET" action="{{ route('benifites.benifites') }}" class="row g-3 mb-4">
            <div class="col-md-4">
                <label for="city">المدينة:</label>
                <select name="city" id="city" class="form-control">
                    <option value="">اختر المدينة</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}" @if(request('city') == $city->id) selected @endif>{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-4">
                <label for="unit">الوحدة الإدارية:</label>
                <select name="unit" id="unit" class="form-control">
                    <option value="">اختر الوحدة</option>
                    {{-- This will be filled dynamically --}}
                </select>
            </div>
            
            <div class="col-md-4">
                <label for="village">القرية:</label>
                <select name="village" id="village" class="form-control">
                    <option value="">اختر القرية</option>
                    {{-- This will be filled dynamically --}}
                </select>
            </div>
            
        
            <div class="col-md-4">
                <div class="dropdown-group">
                    <label>الاسم:</label>
                    <input type="text" name="name" class="form-control" value="{{ request('name') }}">
                </div>
            </div>
        
            <div class="col-md-4">
                <div class="dropdown-group">
                    <label>نوع المرض:</label>
                    <input type="text" name="sick_type" class="form-control" value="{{ request('sick_type') }}">
                </div>
            </div>
        
            <div class="col-md-4">
                <div class="dropdown-group">
                    <label>العمر من:</label>
                    <input type="number" name="min_age" class="form-control" value="{{ request('min_age') }}">
                </div>
            </div>
        
            <div class="col-md-4">
                <div class="dropdown-group">
                    <label>العمر إلى:</label>
                    <input type="number" name="max_age" class="form-control" value="{{ request('max_age') }}">
                </div>
            </div>

            <!-- Section for Number of Data to Display -->
            <div class="col-md-4">
                <div class="dropdown-group">
                    <label>عدد البيانات:</label>
                    <input type="number" name="data_count" class="form-control" value="{{ request('data_count') }}">
                </div>
            </div>
            <!-- Number of Results Display -->
<div class="col-md-12 mt-3">
    <div class="mb-3">
        <label for="record_count" class="form-label">عدد النتائج:</label>
        <input type="text" id="record_count" class="form-control" value="{{ $data->count() }}" readonly>
    </div>
</div>

            <div class="col-md-12">
                <div class="mt-3 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">تصفية</button>
                    <a href="{{ route('benifites.benifites') }}" class="btn btn-secondary">إعادة تعيين</a>
                </div>
            </div>

            <!-- Showing Results Count -->
            <div class="col-md-12 mt-3">
                <div class="mb-3">
                    <label for="record_count" class="form-label">عدد النتائج:</label>
                    <input type="text" id="record_count" class="form-control" value="{{ $data->total() }}" readonly>
                </div>
            </div>
        </form>
        
        <!-- Export Buttons -->
        <div class="mb-3 d-flex gap-2">
            <a href="{{ route('benifites.export', request()->query()) }}" class="btn btn-success">
                تحميل Excel <i class="fas fa-file-excel"></i>
            </a>
        
            <a href="{{ route('benifites.export.pdf', request()->query()) }}" class="btn btn-danger">
                تحميل PDF <i class="fas fa-file-pdf"></i>
            </a>
        </div>

        <!-- Table to Display Filtered Data -->
        <div class="table-responsive mt-4 mb-5">
            <table class="table table-bordered table-striped">
                <thead class="table-dark text-center">
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
                <tbody class="text-center">
                    @foreach ($data as $index => $item)
                        <tr>
                            <td>{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}</td>
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
                            <td>
                                <form action="{{ route('benifites.destroy', $item->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                </form>
                                <a href="{{ route('benifites.edit', $item->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        {{ $data->withQueryString()->links() }}
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Fetch units when city is selected
        $('#city').on('change', function () {
            let cityId = $(this).val();
            $('#unit').html('<option value="">جاري التحميل...</option>');
            $('#village').html('<option value="">اختر القرية</option>');

            if (cityId) {
                $.get('{{ route("get.units") }}', { city_id: cityId }, function (data) {
                    let options = '<option value="">اختر الوحدة</option>';
                    data.forEach(unit => {
                        options += `<option value="${unit.id}">${unit.name}</option>`;
                    });
                    $('#unit').html(options);
                });
            }
        });

        // Dropdown: Load Villages based on selected Unit
        $('#unit').on('change', function () {
            let unitId = $(this).val();
            $('#village').html('<option value="">جاري التحميل...</option>');

            if (unitId) {
                $.get('{{ route("get.villages") }}', { unit_id: unitId }, function (data) {
                    let options = '<option value="">اختر القرية</option>';
                    data.forEach(village => {
                        options += `<option value="${village.id}">${village.name}</option>`;
                    });
                    $('#village').html(options);
                });
            }
        });

        // SweetAlert delete confirmation (already in your code)
        document.addEventListener('DOMContentLoaded', function () {
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'هل أنت متأكد؟',
                        text: "لن تتمكن من التراجع بعد الحذف!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'نعم، احذفه!',
                        cancelButtonText: 'إلغاء'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
        // SweetAlert for delete confirmation
        document.addEventListener('DOMContentLoaded', function () {
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault(); // Prevent form submission

                    Swal.fire({
                        title: 'هل أنت متأكد؟',
                        text: "لن تتمكن من التراجع بعد الحذف!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'نعم، احذفه!',
                        cancelButtonText: 'إلغاء'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Submit if confirmed
                        }
                    });
                });
            });
        });
    </script>
@endpush
