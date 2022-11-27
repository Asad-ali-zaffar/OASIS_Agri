@if($patient['status'] == 'Not Saling')
    <div class="text-center btn btn-warning"> {{$patient['status']}}</div>
@elseif($patient['status'] == 'Saling')
    <div class="text-center  btn btn-info"> {{$patient['status']}} </div>
@else
    <div class="text-center  btn btn-danger"> {{$patient['status']}} </div>
@endif
