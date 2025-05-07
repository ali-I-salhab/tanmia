@extends('layouts.app')

@section('content')
<div class="container" dir="rtl">
    <div class="row">
        <!-- Main Selection Section -->
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">اختيار المستفيدين (المطلوب: {{ $required_count }} - المختار: {{ $selected_count }})</h4>
                </div>
                
                <div class="card-body">
                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('plans.select-beneficiaries') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <label>الوحدة الإدارية</label>
                                <select name="administrative_unit" class="form-control">
                                    <option value="">جميع الوحدات</option>
                                    @foreach($administrative_units as $unit)
                                        <option value="{{ $unit }}" {{ request('administrative_unit') == $unit ? 'selected' : '' }}>
                                            {{ $unit }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <label>نوع المرض</label>
                                <select name="sick_type" class="form-control">
                                    <option value="">جميع الأنواع</option>
                                    {{-- @foreach($sick_types as $type)
                                        <option value="{{ $type }}" {{ request('sick_type') == $type ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                    @endforeach --}}
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <label>الحالة</label>
                                <select name="status" class="form-control">
                                    <option value="">جميع الحالات</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>نشط</option>
                                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>غير نشط</option>
                                </select>
                            </div>
                            
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-filter ml-2"></i> تصفية
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Select All Button -->
                    <div class="mb-3">
                        <button type="button" class="btn btn-secondary" id="select-all-filtered">
                            <i class="fas fa-check-circle ml-2"></i> اختيار كل النتائج المصفاة
                        </button>
                    </div>

                    <!-- Beneficiaries Table -->
                    <form action="{{ route('plans.store-step2') }}" method="POST" id="beneficiaryForm">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="50px">اختيار</th>
                                        <th>الاسم</th>
                                        <th>الوحدة الإدارية</th>
                                        <th>نوع المرض</th>
                                        <th>الحالة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($beneficiaries as $beneficiary)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="beneficiaries[]" 
                                                   value="{{ $beneficiary->id }}"
                                                   class="beneficiary-checkbox"
                                                   {{ in_array($beneficiary->id, $selected_beneficiaries) ? 'checked' : '' }}>
                                        </td>
                                        <td>{{ $beneficiary->name }}</td>
                                        <td>{{ $beneficiary->adminstratour_unit }}</td>
                                        <td>{{ $beneficiary->sick_type }}</td>
                                        <td>
                                            <span class="badge bg-{{ $beneficiary->status == 'active' ? 'success' : 'warning' }}">
                                                {{ $beneficiary->status == 'active' ? 'نشط' : 'غير نشط' }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Compact Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $beneficiaries->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                        
                        <div class="d-flex justify-content-between mt-3">
                            <div>
                                <span id="selected-counter">{{ $selected_count }}</span> / {{ $required_count }} مختار
                            </div>
                            <button type="submit" class="btn btn-primary" id="submit-btn" 
                                    {{ $selected_count != $required_count ? 'disabled' : '' }}>
                                <i class="fas fa-save ml-2"></i> حفظ الخطة
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Selected Beneficiaries Review Section -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">المستفيدون المختارون</h4>
                </div>
                <div class="card-body">
                    <div id="selected-beneficiaries-list">
                        @if(count($selected_beneficiaries) > 0)
                            <ul class="list-group">
                                {{-- @foreach(Benifite::whereIn('id', $selected_beneficiaries)->get() as $beneficiary)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $beneficiary->name }}
                                    <button class="btn btn-sm btn-danger remove-beneficiary" data-id="{{ $beneficiary->id }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </li>
                                @endforeach --}}
                            </ul>
                        @else
                            <div class="alert alert-warning">لا يوجد مستفيدون مختارون بعد</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.beneficiary-checkbox');
        const form = document.getElementById('beneficiaryForm');
        const selectedCounter = document.getElementById('selected-counter');
        const submitBtn = document.getElementById('submit-btn');
        const requiredCount = {{ $required_count }};
        const selectAllBtn = document.getElementById('select-all-filtered');
        
        // Update counter on page load
        updateCounter();
        
        // Handle checkbox changes
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateCounter();
                saveSelection();
                updateSelectedList();
            });
        });
        
        // Select all filtered results
        selectAllBtn.addEventListener('click', function() {
            const currentPageIds = Array.from(document.querySelectorAll('.beneficiary-checkbox'))
                .map(checkbox => checkbox.value);
            
            fetch('{{ route("plans.save-selection") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ 
                    beneficiaries: currentPageIds,
                    action: 'add' 
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    currentPageIds.forEach(id => {
                        const checkbox = document.querySelector(`.beneficiary-checkbox[value="${id}"]`);
                        if (checkbox) checkbox.checked = true;
                    });
                    updateCounter();
                    updateSelectedList();
                }
            });
        });
        
        // Remove beneficiary from selection
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-beneficiary')) {
                const beneficiaryId = e.target.dataset.id;
                
                fetch('{{ route("plans.save-selection") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ 
                        beneficiaries: [beneficiaryId],
                        action: 'remove' 
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const checkbox = document.querySelector(`.beneficiary-checkbox[value="${beneficiaryId}"]`);
                        if (checkbox) checkbox.checked = false;
                        updateCounter();
                        updateSelectedList();
                    }
                });
            }
        });
        
        function updateCounter() {
            const checked = document.querySelectorAll('.beneficiary-checkbox:checked').length;
            selectedCounter.textContent = checked;
            submitBtn.disabled = checked != requiredCount;
        }
        
        function saveSelection() {
            const selected = Array.from(document.querySelectorAll('.beneficiary-checkbox:checked'))
                                .map(cb => cb.value);
            
            fetch('{{ route("plans.save-selection") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ beneficiaries: selected })
            });
        }
        
        function updateSelectedList() {
            fetch('{{ route("plans.get-selected") }}')
                .then(response => response.json())
                .then(data => {
                    if (data.html) {
                        document.getElementById('selected-beneficiaries-list').innerHTML = data.html;
                    }
                });
        }
    });
</script>
@endpush
@endsection