@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Page Title Section -->
    <div class="row mb-4">
        <div class="col text-center">
            <h2 class="text-primary">إدارة المستفيدين والداعمين</h2>
            <p class="lead text-muted">إدارة البيانات الخاصة بالمستفيدين والداعمين بشكل سهل وفعال</p>
        </div>
    </div>

    <!-- Main Navigation Section -->
    <div class="row text-center">
        <div class="col-md-4">
            <a href="{{ route('benifites.benifites') }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm p-4 mb-4 bg-light rounded">
                    <h4 class="text-primary">المستفيدون</h4>
                    <p class="text-muted">عرض جميع المستفيدين وإجراء الفلاتر عليها</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('supporters.index') }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm p-4 mb-4 bg-light rounded">
                    <h4 class="text-primary">الداعمون</h4>
                    <p class="text-muted">عرض جميع الداعمين وإضافة دعم جديد</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="#" class="text-decoration-none text-dark">
                <div class="card shadow-sm p-4 mb-4 bg-light rounded">
                    <h4 class="text-primary">التقارير</h4>
                    <p class="text-muted">إنشاء تقارير شاملة حول المستفيدين والداعمين</p>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('plans.create') }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm p-3 mb-4 bg-light rounded">
                    <h4>إضافة خطة دعم</h4>
                </div>
            </a>
        </div>
    </div>

    <!-- New Section: Additional Features -->


    <!-- New Section: Notifications and Alerts -->
 
</div>


@endsection

@push('styles')
<style>
    /* Customize the section titles */
    h2.text-primary {
        font-family: 'Arial', sans-serif;
        font-weight: bold;
        color: #007bff;
    }

    h4.text-primary {
        font-family: 'Arial', sans-serif;
        font-weight: bold;
        color: #007bff;
    }

    h4.text-info {
        color: #17a2b8;
    }

    h4.text-warning {
        color: #ffc107;
    }

    h4.text-success {
        color: #28a745;
    }

    /* Customize card styles */
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card p {
        font-size: 14px;
    }

    /* Make buttons more stylish */
    .btn {
        font-weight: bold;
    }

    .btn-info {
        background-color: #17a2b8;
        color: white;
        border-radius: 5px;
    }

    .btn-warning {
        background-color: #ffc107;
        color: white;
        border-radius: 5px;
    }

    .btn-success {
        background-color: #28a745;
        color: white;
        border-radius: 5px;
    }

    .btn:hover {
        opacity: 0.8;
    }
</style>
@endpush
