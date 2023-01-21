{{-- @can('edit_patient')
    <a class="btn btn-primary btn-sm" href="{{route('admin.product_method_entry.edit',$patient->id)}}">
        <i class="fa fa-edit" aria-hidden="true"></i>
    </a>
@endcan

@can('delete_patient')
    <form method="POST" action="{{route('admin.product_method_entry.destroy',$patient->id)}}" class="d-inline">
        <input type="hidden" name="_method" value="delete">
        <button type="submit" class="btn btn-danger btn-sm delete_patient">
            <i class="fa fa-trash"></i>
        </button>
    </form>
@endcan --}}
<div class="dropdown open">
    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-list" aria-hidden="true"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="triggerId">
        <a href="javascript:void(0)" data-toggle="tooltip" onClick="editFunc({{ $patient->pay_id }})"
            data-original-title="Edit" class="edit btn btn-outline-primary ml-4 mt-2">
            <i class="fa fa-edit" aria-hidden="true"></i> Edit
        </a>
        <a href="javascript:void(0);" id="delete-compnay" onClick="deleteFunc({{ $patient->pay_id }})"
            data-toggle="tooltip" data-original-title="Delete" class=" delete btn btn-outline-danger ml-4 mt-2">
           <i class="fa fa-trash" aria-hidden="true"></i> Delete
        </a>
        <a href="{{route('admin.salary_pays.print',$patient->pay_id)}}" id="print_invoice"
            data-toggle="tooltip" data-original-title="Print Invoice"
            class="ptint btn btn-outline-warning ml-4 mt-2">
            <i class="fa fa-print" aria-hidden="true"></i> Print
        </a>
    </div>
</div>

&nbsp;&nbsp;
