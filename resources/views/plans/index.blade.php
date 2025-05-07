@extends('layouts.app')

@section('content')
<div class="container" dir="rtl">
    <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeInDown">
        <h2 class="mb-0">قائمة الخطط</h2>
        <a href="{{ route('plans.create') }}" class="btn btn-primary">
            <i class="fas fa-plus ml-2"></i> إضافة خطة جديدة
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success animate__animated animate__fadeIn">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm animate__animated animate__fadeInUp">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>نوع الدعم</th>
                            <th>رقم الدعم</th>
                            <th>الداعم</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($plans as $plan)
                            <tr class="animate__animated animate__fadeIn" style="animation-delay: {{ $loop->index * 0.05 }}s">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $plan->name }}</td>
                                <td>{{ $plan->type_of_support }}</td>
                                <td>{{ $plan->support_number ?? 'غير محدد' }}</td>
                                <td>{{ $plan->supporter->name ?? '-' }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('plans.edit', $plan->id) }}" class="btn btn-sm btn-outline-primary mr-2" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('plans.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه الخطة؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="حذف">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">لا توجد خطط مسجلة</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4 animate__animated animate__fadeIn">
        {{ $plans->links() }}
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
    body {
        font-family: 'Tajawal', sans-serif;
    }
    .table th, .table td {
        vertical-align: middle;
        text-align: right;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        line-height: 1.5;
        border-radius: 0.2rem;
    }
    .pagination {
        justify-content: center;
    }
    .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
    }
    .table-hover tbody tr:hover {
        transform: translateX(-5px);
        transition: transform 0.3s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add animation when scrolling to elements
        const animateOnScroll = function() {
            const elements = document.querySelectorAll('.animate__animated');
            
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                
                if (elementPosition < windowHeight - 100) {
                    element.style.opacity = 1;
                }
            });
        };
        
        window.addEventListener('scroll', animateOnScroll);
        animateOnScroll(); // Run once on page load
    });
</script>
@endpush