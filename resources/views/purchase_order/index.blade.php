@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">

@endpush

@section('content')
<div class="card">
    <div class="card-header">
         
        <strong>Purchase Order</strong>  <a href="{{route('purchase_order.create')}}" class="btn btn-primary float-end">Add New</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="category_table">
                <thead class="bg-secondary">
                    <tr>
                        <th>SNo</th>
                        <th>Purchase Order Number</th>
                        <th>Purchase Order Date</th>
                        <th>Supplier</th>
                        <th>Price</th>
                        <th>Tax Price</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>    
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script>
        var table = $('#category_table').DataTable({
            dom: 'Bfrtip',
        buttons: [
             'excel', 'print'
        ],
        processing: true,
        serverSide: true,
        ajax: "{{ route('purchase_order.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'purchase_order_number', name: 'purchase_order_number'},
            {data: 'purchase_order_date', name: 'purchase_order_date'},
            {data: 'supplier.company_name', name: 'supplier'},
            {data: 'sub_total', name: 'sub_total'},
            {data: 'tax_price', name: 'tax_price'},
            {data: 'total_price', name: 'total_price'},
            {data: 'action', name: 'action', orderable: false, searchable: false,exportable:false},
        ]
    });
</script>
@endpush
