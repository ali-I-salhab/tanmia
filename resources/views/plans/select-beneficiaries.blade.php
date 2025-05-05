@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">فلترة المستفيدين للمخطط: {{ $plan->name }}</h2>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('plans.show', $plan->id) }}" class="row g-3 mb-4">
        <div class="dropdown-group col-md-4">
            <label for="plan_id">اختر المخطط:</label>
            <select name="plan_id" id="plan_id" class="form-control">
                <option value="">اختر المخطط</option>
                <option value="{{ $plan->id }}" selected>{{ $plan->name }}</option>
            </select>
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary mt-4">تصفية</button>
        </div>
    </form>

    <!-- Beneficiaries Table -->
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>الاسم</th>
                <th>نوع الدعم</th>
                <th>تاريخ الإنشاء</th>
            </tr>
        </thead>
        <tbody>
            @foreach($benifites as $benifite)
                <tr>
                    <td>{{ $benifite->id }}</td>
                    <td>{{ $benifite->name }}</td>
                    <td>{{ $benifite->supporter_id }}</td>
                    {{-- <td>{{ $benifite->created_at->format('Y-m-d') }}</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    {{ $benifites->links() }}
</div>
@endsection
