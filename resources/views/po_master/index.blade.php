@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
@endpush

@section('content')
<div class="card">
    <div class="card-header">
        Po Master <a href="{{route('po_master.create')}}" class="btn btn-info btn-sm float-end" >Create New</a>
    </div>
    <div class="card-body">
        <form action="" method="POST">
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="">From *</label>
                <input type="date" name="from_date" id="from_date" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="">To *</label>
                <input type="date" name="to_date" id="to_date" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="">Supplier *</label>
                <select name="supplier_id" id="supplier_id" class="form-control select2">
                    <option value="">Select Supplier</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Raw Material *</label>
                <select name="raw_material_id" id="raw_material_id" class="form-control select2">
                    <option value="">Select Raw Material</option>
                </select>
            </div>
        </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="nesting_table">
                <thead class="bg-secondary">
                    <tr>
                        <th>SNo</th>
                        <th>PO#</th>
                        <th>Supplier</th>
                        <th>Quantity</th>
                        <th>UOM</th>
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
        var table = $('#nesting_table').DataTable({
            dom: 'Bfrtip',
        buttons: [
             'excel', 'print'
        ],
        processing: true,
        serverSide: true,
        ajax: "{{ route('po_master.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'rm_po_number', name: 'rm_po_number'},
            {data: 'supplier.company_name', name: 'supplier'},
            {data: 'po_quantity', name: 'quantity'},
            {data: 'uom.name', name: 'uom'},
            {data: 'action', name: 'action', orderable: false, searchable: false,exportable:false},
        ]
    });
    </script>
@endpush