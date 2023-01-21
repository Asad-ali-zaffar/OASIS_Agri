
@if (get_countQuantity($patient['id']) <= 0)
    <div class="text-center  btn btn-danger"> Not Available  </div>
@else
    <div class="text-center  btn btn-info"> Available </div>
@endif


                                         
