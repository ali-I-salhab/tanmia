@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <div class="container mt-4">
            <h2 class="mb-4 text-center">فلترة المستفيدين</h2>

            <form method="GET" action="{{ route('mostafed.mostafed') }}" class="row g-3 mb-4">

                <div class="col-md-4">
                    <label for="village" class="form-label">القرية</label>
                    <select name="village" id="village" class="form-select">
                        <option value="">-- اختر القرية --</option>

                        @foreach($villages as $village)
                            <option value="{{ $village }}" {{ request('village') == $village ? 'selected' : '' }}>
                                {{ $village }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="main_village" class="form-label">الوحدة الادارية</label>
                    <select name="main_village" id="main_village" class="form-select">
                        <option value="">-- اختر القرية --</option>

                        @foreach($mainvillages as $mainvillage)
                            <option value="{{ $mainvillage }}" {{ request('main_village') == $mainvillage ? 'selected' : '' }}>
                                {{ $mainvillage }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="name" class="form-label">بحث بالاسم</label>
                    <input type="text" name="name" id="search" class="form-control" placeholder="أدخل الاسم"
                        value="{{ request('name') }}">
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">بحث</button>
                </div>
                <div class="col-md-2">
                    <label for="min_age" class="form-label">العمر من</label>
                    <input type="number" name="min_age" id="min_age" class="form-control" value="{{ request('min_age') }}"
                        placeholder="من">
                </div>

                <div class="col-md-2">
                    <label for="max_age" class="form-label">إلى</label>
                    <input type="number" name="max_age" id="max_age" class="form-control" value="{{ request('max_age') }}"
                        placeholder="إلى">
                </div>

            </form>




            <a href="{{ route('mostafed.export', request()->query()) }}" class="btn btn-success mb-3">
                تحميل البيانات Excel
            </a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>data </th>
                        <th>الاسم</th>
                        <th> الوحدةالادارية</th>

                        <th>الرقم الوظني</th>
                        <th>اسم الام</th>
                        <th>العمر</th>
                        <th> القرية</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)


                        <tr>
                          
                            <td>
                                <form action="{{ route('mostafed.destroy', $d->id) }}" method="POST" class="delete-form d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i> حذف
                                    </button>
                                </form>
                                <a href="{{ route('mostafed.edit', $d->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> تعديل
                                </a>
                            </td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->main_village }}</td>
                            <td>{{ $d->national_id }}</td>
                            <td>{{ $d->mother_name }}</td>
                            <td>{{ $d->age }}</td>
                            <td>{{ $d->village }}</td>



                        </tr>
                        {{-- @empty --}}

                    @endforeach
                </tbody>
            </table>

            {{ $data->withQueryString()->links() }}

            {{-- {{ $data->links() }} Laravel pagination --}}

        </div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.delete-form');
    
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // prevent the form from submitting
    
                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: "لن تتمكن من التراجع بعد الحذف!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'نعم، احذفه!',
                    cancelButtonText: 'إلغاء'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // submit if confirmed
                    }
                });
            });
        });
    });
    </script>
    
    
@endpush