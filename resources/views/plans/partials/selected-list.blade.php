@if($beneficiaries->count() > 0)
    <ul class="list-group">
        @foreach($beneficiaries as $beneficiary)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $beneficiary->name }}
            <button class="btn btn-sm btn-danger remove-beneficiary" data-id="{{ $beneficiary->id }}">
                <i class="fas fa-times"></i>
            </button>
        </li>
        @endforeach
    </ul>
@else
    <div class="alert alert-warning">لا يوجد مستفيدون مختارون بعد</div>
@endif