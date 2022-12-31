@extends('layouts.app')
@push('styles')

@endpush

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> {{session('success')}}.
  <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> {{session('error')}}.
  <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card">
    <div class="card-header">
        <strong>OutSource Entry </strong>
    </div>
    <div class="card-body">
        <div class="col-md-12">
            <form id="operation_save" method="POST" >
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">DC Number *</label>
                            <input type="text" name="dc_number" id="dc_number" class="form-control" readonly value="U2-2022-00001">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Prev Route Card *</label>
                            <select name="previous_route_card_id" id="previous_route_card_id" class="form-control">
                                <option value="">Select Route Card</option>
                                <option value="1">A2022000001</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Sub Contractor*</label>
                            <select name="sub_contractor_id" id="sub_contractor_id" class="form-control">
                                <option value="">Select SubContractor</option>
                            </select>
                        </div>
                    </div>  
                    <div class="col-md-12 mt-5">
                        <table class="table table-responsive table-bordered">
                            <tr>
                                <td>Child Part Number</td>
                                <td>Available Quantity</td>
                                <td>Rejected Quantity</td>
                                <td>Issue Quantity</td>
                                <td>BOM/Weight</td>
                                <td>Issued Weight</td>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" name="child_part_number"></td>
                                <td><input type="text" class="form-control" name="child_part_number"></td>
                                <td><input type="text" class="form-control" name="child_part_number"></td>
                                <td><input type="text" class="form-control" name="child_part_number"></td>
                                <td><input type="text" class="form-control" name="child_part_number"></td>
                                <td><input type="text" class="form-control" name="child_part_number"></td>
                            </tr>
                        </table>
                    </div>  
                </div>
                <div class="row mb-0">
                    <div class="col-md-8 offset-md-4">
                       <button type="submit" id="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
@push('scripts')
<script src="{{asset('js/select2.min.js')}}"></script>
<script>
    $("#previous_route_card_id").select2();

</script>
@endpush