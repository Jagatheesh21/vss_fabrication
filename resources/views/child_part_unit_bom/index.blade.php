@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
@endpush

@section('content')
<div class="card">
    
    <div class="card-header">
                 <strong>Child Part BOM - List</strong>
                 <a href="{{route('child_part_unit_bom.export')}}" class="btn btn-primary btn-sm">Export</a>
                 <a href="{{route('child_part_unit_bom.create')}}" class="btn btn-primary btn-sm float-end">Add New</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="operation_table">
                <thead class="bg-secondary">
                    <tr>
                        <th>SNo</th>
                        <th>ChildPartNumber</th>
                        <th>Quantity</th>
                        <th>UOM</th>
                        {{-- <th>Action</th> --}}
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
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>

<script>
        var table = $('#operation_table').DataTable({  
        processing: true,
        serverSide: true,
        ajax: "{{ route('child_part_unit_bom.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'child_part_number.name', name: 'ChildPartNumber'},
            {data: 'bom', name: 'bom'},
            {data: 'uom.name', name: 'uom'},
            // {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
</script>
@endpush
