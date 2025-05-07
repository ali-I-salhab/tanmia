@extends('layouts.app')

@section('content')
<div class="container" dir="rtl">
    <div class="card shadow-sm animate__animated animate__fadeIn">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">تفاصيل الخطة: {{ $plan->name }}</h4>
        </div>
        
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>معلومات أساسية</h5>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>نوع الدعم:</strong> {{ $plan->type_of_support }}
                        </li>
                        <li class="list-group-item">
                            <strong>الداعم:</strong> {{ $plan->supporter->name ?? 'غير محدد' }}
                        </li>
                        <li class="list-group-item">
                            <strong>عدد المستفيدين:</strong> {{ $plan->beneficiaries_count }}
                        </li>
                    </ul>
                </div>
                
                <div class="col-md-6">
                    <h5>معلومات إضافية</h5>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>تاريخ الإنشاء:</strong> {{ $plan->created_at->format('Y-m-d') }}
                        </li>
                        <li class="list-group-item">
                            <strong>آخر تحديث:</strong> {{ $plan->updated_at->format('Y-m-d') }}
                        </li>
                    </ul>
                </div>
            </div>
            
            <h5 class="mt-4">قائمة المستفيدين</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>اسم المستفيد</th>
                            <th>رقم الهوية</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($plan->beneficiaries as $beneficiary)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $beneficiary->name }}</td>
                            <td>{{ $beneficiary->id_number }}</td>
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
            
            <div class="mt-4">
                <a href="{{ route('plans.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right ml-2"></i> العودة للقائمة
                </a>
            </div>
        </div>
    </div>
</div>
@endsection