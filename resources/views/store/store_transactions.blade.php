@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
@endpush

@section('content')
<div class="card">
    <div class="card-header">
                 <strong>Store Transactions</strong><a href="{{route('raw_material.create')}}" class="btn btn-primary float-end">Add New</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="raw_material_table">
                <thead class="bg-secondary">
                    <tr>
                        <th>SNo</th>
                        <th>GRN Number</th>
                        <th>Part Description</th>
                        <th>Quantity</th>
                        <th>Uom</th>
                        <th>Material Quantity</th>
                        <th>Material Uom</th>
                        <th>Status</th>
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
<script src="{{asset('js/datatables.min.js')}}"></script>
<script>
        var table = $('#raw_material_table').DataTable({
            buttons: [
        'copy', 'excel', 'pdf'
    ],
        processing: true,
        serverSide: true,
        ajax: "{{ route('store_receive.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'grn_number', name: 'grn_number'},
            {data: 'raw_material.name', name: 'part_description'},
            {data: 'inward_quantity', name: 'quantity'},
            {data: 'uom.name', name: 'uom'},
            {data: 'inward_material_quantity', name: 'material_quantity'},
            {data: 'material_uom.name', name: 'material_uom'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

</script>
@endpush
