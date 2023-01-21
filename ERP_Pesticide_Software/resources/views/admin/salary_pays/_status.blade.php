@if($patient['status'] == 'Paid')
    <div class="text-center btn btn-info"> {{$patient['status']}}</div>
{{-- @elseif($patient['status'] == 'Paid')
    <div class="text-center  btn btn-info"> {{$patient['status']}} </div> --}}
@else
    <div class="text-center btn btn-warning"> {{$patient['status']}}</div>
@endif
