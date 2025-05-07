@extends('layouts.app')

@section('content')
<div class="container mt-5 animate__animated animate__fadeIn">
    <!-- Page Title Section -->
    <div class="row mb-4">
        <div class="col text-center">
            <h2 class="text-primary fw-bold">إدارة المستفيدين والداعمين</h2>
            <p class="lead text-muted">إدارة البيانات الخاصة بالمستفيدين والداعمين بشكل سهل وفعال</p>
        </div>
    </div>

    <!-- Main Navigation Section -->
    <div class="row g-4 text-center">
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('benifites.benifites') }}" class="text-decoration-none">
                <div class="card bg-light shadow-sm p-4 rounded animate__animated animate__zoomIn">
                    <h4 class="text-primary">المستفيدون</h4>
                    <p class="text-muted">عرض جميع المستفيدين وإجراء الفلاتر عليها</p>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-3">
            <a href="{{ route('supporters.index') }}" class="text-decoration-none">
                <div class="card bg-light shadow-sm p-4 rounded animate__animated animate__zoomIn animate__delay-1s">
                    <h4 class="text-primary">الداعمون</h4>
                    <p class="text-muted">عرض جميع الداعمين وإضافة دعم جديد</p>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-3">
            <a href="#" class="text-decoration-none">
                <div class="card bg-light shadow-sm p-4 rounded animate__animated animate__zoomIn animate__delay-2s">
                    <h4 class="text-primary">التقارير</h4>
                    <p class="text-muted">إنشاء تقارير شاملة حول المستفيدين والداعمين</p>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-3">
            <a href="{{ route('plans.create') }}" class="text-decoration-none">
                <div class="card bg-light shadow-sm p-4 rounded animate__animated animate__zoomIn animate__delay-3s">
                    <h4 class="text-primary">إضافة خطة دعم</h4>
                    <p class="text-muted">ربط المستفيدين بالداعمين من خلال خطة</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    h2.text-primary {
        font-family: 'Roboto', sans-serif;
        font-weight: bold;
        color: #007bff;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card h4 {
        font-weight: bold;
    }

    .card p {
        font-size: 14px;
        color: #6c757d;
    }

    a.text-decoration-none:hover {
        text-decoration: none;
    }
</style>
@endpush
