@if($patient['status'] == 'In-Active')
    <div class="text-center btn btn-warning"> {{$patient['status']}}</div>
@elseif($patient['status'] == 'Active')
    <div class="text-center  btn btn-info"> {{$patient['status']}} </div>
@elseif($patient['status'] == 'Suspend')
    <div class="text-center  btn btn-danger"> {{$patient['status']}} </div>
@else
    <div class="text-center btn btn-secondary"> {{$patient['status']}}</div>
@endif
