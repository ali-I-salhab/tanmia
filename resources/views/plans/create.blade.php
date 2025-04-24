@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create New Plan</h2>
    <form action="{{ route('plans.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Plan Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Type of Support</label>
            <input type="text" name="type_of_support" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Select Supporter</label>
            <select name="supporter_id" class="form-control" required>
                @foreach($supporters as $supporter)
                    <option value="{{ $supporter->id }}">{{ $supporter->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save Plan</button>
    </form>
</div>
@endsection
