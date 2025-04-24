@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Plans List</h2>
    <a href="{{ route('plans.create') }}" class="btn btn-primary mb-3">Add New Plan</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type of Support</th>
                <th>Supporter</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plans as $plan)
                <tr>
                    <td>{{ $plan->name }}</td>
                    <td>{{ $plan->type_of_support }}</td>
                    <td>{{ $plan->supporter->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $plans->links() }}
</div>
@endsection
