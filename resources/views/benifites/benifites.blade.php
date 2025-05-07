@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

<style>
    .filter-card {
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: none;
        overflow: hidden;
    }
    
    .filter-card:hover {
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
    }
    
    .btn-action {
        transition: all 0.3s ease;
        border-radius: 8px;
        font-weight: 500;
        padding: 0.5rem 1.25rem;
    }
    
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .table {
        margin-bottom: 0;
    }
    
    .table thead th {
        background: linear-gradient(135deg, #4361ee, #3f37c9);
        color: white;
        font-weight: 500;
        text-align: center;
        vertical-align: middle;
    }
    
    .table-hover tbody tr {
        transition: all 0.2s ease;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(67, 97, 238, 0.05);
    }
    
    .badge-status {
        padding: 0.35em 0.65em;
        font-size: 0.85em;
        border-radius: 8px;
    }
    
    .pagination {
        justify-content: center;
    }
    
    .pagination .page-item.active .page-link {
        background-color: #4361ee;
        border-color: #4361ee;
    }
    
    .select2-container--default .select2-selection--single {
        height: 38px;
        border: 1px solid #ced4da;
        border-radius: 6px;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 36px;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }
    
    .action-btns .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        border-radius: 6px;
    }
    
    .record-count-badge {
        font-size: 1rem;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        background: linear-gradient(135deg, #4cc9f0, #4895ef);
        color: white;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in {
        animation: fadeIn 0.5s ease forwards;
    }
    
    .animate-delay-1 { animation-delay: 0.1s; }
    .animate-delay-2 { animation-delay: 0.2s; }
    .animate-delay-3 { animation-delay: 0.3s; }
</style>

<div class="container py-4">
    <div class="row mb-4 animate__animated animate__fadeIn">
        <div class="col-md-8">
            <h2 class="mb-0" style="color: #4361ee;">
                <i class="fas fa-users me-2"></i> إدارة المستفيدين
            </h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('benifites.create') }}" class="btn btn-success btn-action">
                <i class="fas fa-plus-circle me-1"></i> إضافة مستفيد جديد
            </a>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card filter-card mb-4 animate__animated animate__fadeIn">
        <div class="card-header bg-white">
            <h5 class="mb-0">
                <i class="fas fa-filter me-2 text-primary"></i> فلترة المستفيدين
            </h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('benifites.benifites') }}" class="row g-3">
                <div class="col-md-4 animate-fade-in animate-delay-1">
                    <label for="city" class="form-label">المدينة:</label>
                    <select name="city" id="city" class="form-control select2">
                        <option value="">اختر المدينة</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" @if(request('city') == $city->id) selected @endif>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 animate-fade-in animate-delay-1">
                    <label for="unit" class="form-label">الوحدة الإدارية:</label>
                    <select name="unit" id="unit" class="form-control select2">
                        <option value="">اختر الوحدة</option>
                    </select>
                </div>

                <div class="col-md-4 animate-fade-in animate-delay-1">
                    <label for="village" class="form-label">القرية:</label>
                    <select name="village" id="village" class="form-control select2">
                        <option value="">اختر القرية</option>
                    </select>
                </div>

                <div class="col-md-4 animate-fade-in animate-delay-2">
                    <label class="form-label">الاسم:</label>
                    <input type="text" name="name" class="form-control" value="{{ request('name') }}" placeholder="ابحث بالاسم">
                </div>

                <div class="col-md-4 animate-fade-in animate-delay-2">
                    <label class="form-label">نوع المرض:</label>
                    <input type="text" name="sick_type" class="form-control" value="{{ request('sick_type') }}" placeholder="ابحث بنوع المرض">
                </div>

                <div class="col-md-2 animate-fade-in animate-delay-2">
                    <label class="form-label">العمر من:</label>
                    <input type="number" name="min_age" class="form-control" value="{{ request('min_age') }}" placeholder="الحد الأدنى">
                </div>

                <div class="col-md-2 animate-fade-in animate-delay-2">
                    <label class="form-label">العمر إلى:</label>
                    <input type="number" name="max_age" class="form-control" value="{{ request('max_age') }}" placeholder="الحد الأقصى">
                </div>

                <div class="col-md-4 animate-fade-in animate-delay-3">
                    <label class="form-label">عدد النتائج:</label>
                    <div class="d-flex align-items-center">
                        <span class="record-count-badge me-3">
                            <i class="fas fa-users me-1"></i> {{ $querylenght }} نتيجة
                        </span>
                        <input type="number" name="data_count" class="form-control" value="{{ request('data_count') }}" placeholder="عدد البيانات">
                    </div>
                </div>

                <div class="col-md-12 animate-fade-in animate-delay-3">
                    <div class="d-flex justify-content-between mt-3">
                        <button type="submit" class="btn btn-primary btn-action">
                            <i class="fas fa-filter me-1"></i> تطبيق الفلترة
                        </button>
                        <a href="{{ route('benifites.benifites') }}" class="btn btn-secondary btn-action">
                            <i class="fas fa-undo me-1"></i> إعادة تعيين
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Export Buttons -->
    <div class="mb-4 animate__animated animate__fadeIn">
        <div class="d-flex gap-3">
            <a href="{{ route('benifites.export', request()->query()) }}" class="btn btn-success btn-action">
                <i class="fas fa-file-excel me-1"></i> تصدير إلى Excel
            </a>
            <a href="{{ route('benifites.export.pdf', request()->query()) }}" class="btn btn-danger btn-action">
                <i class="fas fa-file-pdf me-1"></i> تصدير إلى PDF
            </a>
        </div>
    </div>

    <!-- Beneficiaries Table -->
    <div class="table-responsive animate__animated animate__fadeInUp">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th>الاسم</th>
                    <th>اسم الأم</th>
                    <th>الرقم الوطني</th>
                    <th>العمر</th>
                    <th>الهاتف</th>
                    <th>الحالة الاجتماعية</th>
                    <th>الكفيل</th>
                    <th>نوع المرض</th>
                    <th>الوحدة الإدارية</th>
                    <th width="150">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $item)
                    <tr class="animate-fade-in" style="animation-delay: {{ $index * 0.05 }}s">
                        <td>{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->mother_name }}</td>
                        <td>{{ $item->national_id }}</td>
                        <td>
                            <span class="badge bg-primary">{{ $item->age }}</span>
                        </td>
                        <td>{{ $item->mobile }}</td>
                        <td>
                            @php
                                $statusColors = [
                                    'single' => 'info',
                                    'married' => 'success',
                                    'divorced' => 'warning',
                                    'widowed' => 'secondary'
                                ];
                            @endphp
                            <span class="badge badge-status bg-{{ $statusColors[$item->social_status] ?? 'primary' }}">
                                {{ $item->social_status }}
                            </span>
                        </td>
                        <td>{{ $item->supporter ?: 'لا يوجد' }}</td>
                        <td>{{ $item->sick_type ?: 'لا يوجد' }}</td>
                        <td>{{ $item->adminstratour_unit }}</td>
                        <td class="action-btns">
                            <a href="{{ route('benifites.edit', $item->id) }}" class="btn btn-sm btn-warning" title="تعديل">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('benifites.destroy', $item->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="حذف">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 animate__animated animate__fadeIn">
        {{ $data->withQueryString()->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            placeholder: "اختر من القائمة",
            allowClear: true,
            width: '100%'
        });

        // Load units when city changes
        $('#city').on('change', function() {
            let cityId = $(this).val();
            $('#unit').html('<option value="">تحميل...</option>').trigger('change');
            $('#village').html('<option value="">اختر القرية</option>').trigger('change');

            if (cityId) {
                $.get('{{ route("get.units") }}', { city_id: cityId }, function(data) {
                    let options = '<option value="">اختر الوحدة</option>';
                    data.forEach(unit => {
                        options += `<option value="${unit.id}" ${unit.id == '{{ request('unit') }}' ? 'selected' : ''}>${unit.name}</option>`;
                    });
                    $('#unit').html(options).trigger('change');
                });
            }
        });

        // Load villages when unit changes
        $('#unit').on('change', function() {
            let unitId = $(this).val();
            $('#village').html('<option value="">تحميل...</option>').trigger('change');

            if (unitId) {
                $.get('{{ route("get.villages") }}', { unit_id: unitId }, function(data) {
                    let options = '<option value="">اختر القرية</option>';
                    data.forEach(village => {
                        options += `<option value="${village.id}" ${village.id == '{{ request('village') }}' ? 'selected' : ''}>${village.name}</option>`;
                    });
                    $('#village').html(options).trigger('change');
                });
            }
        });

        // Initialize city if already selected
        @if(request('city'))
            $('#city').trigger('change');
        @endif

        // Delete confirmation with SweetAlert
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من استعادة هذا المستفيد بعد الحذف!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'نعم، احذف',
                cancelButtonText: 'إلغاء',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>
@endpush