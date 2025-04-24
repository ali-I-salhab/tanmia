@extends('layouts.app') {{-- assuming you're using a master layout --}}

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Supporters List</h2>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Joined At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($supporters as $supporter)
                <tr>
                    <td>{{ $supporter->id }}</td>
                    <td>{{ $supporter->name }}</td>
                    <td>{{ $supporter->email }}</td>
                    <td>{{ $supporter->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No supporters found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
