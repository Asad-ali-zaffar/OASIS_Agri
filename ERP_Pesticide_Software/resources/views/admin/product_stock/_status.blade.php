@if ($patient['status'] == 'Not Available')
    <div class="text-center  btn btn-danger"> {{ $patient['status'] }} </div>
@else
    <div class="text-center  btn btn-info"> {{ $patient['status'] }} </div>
@endif
