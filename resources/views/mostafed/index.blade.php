@extends('layouts.app')
@section('content')
    

<div class="container mt-5">
    <div class="row text-center">

        <div class="col-md-4">
            <a href="{{route('mostafed.mostafed')}}" class="text-decoration-none text-dark">
                <div class="card shadow-sm p-3 mb-4 bg-light rounded">
                    <h4>المستفيدون</h4>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{route('supporters.index')}}" class="text-decoration-none text-dark">
                <div class="card shadow-sm p-3 mb-4 bg-light rounded">
                    <h4>الداعمون</h4>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="" class="text-decoration-none text-dark">
                <div class="card shadow-sm p-3 mb-4 bg-light rounded">
                    <h4>تقارير</h4>
                </div>
            </a>
        </div>

    </div>
</div>
<div style=""></div>
    
@endsection