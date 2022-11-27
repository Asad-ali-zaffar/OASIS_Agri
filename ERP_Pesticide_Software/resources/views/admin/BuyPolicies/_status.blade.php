@if($status == 0)
    <div class="text-center btn btn-info"> {{__('Active')}}</div>
@else
    <div class="text-center btn btn-danger"> {{__('In-Active')}}</div>
@endif
