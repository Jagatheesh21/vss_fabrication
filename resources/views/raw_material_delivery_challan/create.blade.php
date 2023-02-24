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
<div class="card ">
    <div class="card-header">
        Create New Raw Material Delivery Challan
    </div>
    <div class="card-body">
        <div class="col-md-12">
                <form id="operation_save" method="POST" action="{{route('raw_material_delivery_challan.store')}}">
                    @csrf
                    @method('POST')
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label for="name" class="col-md-12 col-form-label required">DC Number *</label>
                          <input type="text" name="dc_number" class="form-control bg-light" readonly value="{{ $dc_number }}">
                        @error('dc_number')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="name" class="col-md-12 col-form-label required">Sub Contractor *</label>
                        <select name="sub_contractor_id" id="sub_contractor_id" class="form-control select2">
                          <option value="">Select SubContractor Id</option>
                          <option value="1">VPN</option>
                          <option value="2">Palaniyappa</option>
                        </select>
                      </div>
                      <div class="col-md-3">
                        <label for="name" class="col-md-12 col-form-label required">Raw Material *</label>
                        <select name="raw_material_id" id="raw_material_id" class="form-control select2">
                          <option value="">Select Raw Material</option>
                          @foreach ($raw_materials as $raw_material)
                              <option value="{{ $raw_material->id }}">{{ $raw_material->name }}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                      <label for="name" class="col-md-12 col-form-label required">GRN Number *</label>
                      <select name="grn_number_id" id="grn_number_id" class="form-control select2">
                        <option value="">Select GRN</option>
                      </select>
                  </div>
            </div>
                </div>
          </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('js/select2.min.js')}}"></script>
<script>
  $("#sub_contractor_id").select2({
            placeholder:"Select SubContractor",
            allowedClear:true,
        });
  $("#raw_material_id").select2({
      placeholder:"Select RawMaterial",
      allowedClear:true,
  });
  // Getting GRN Number
  $("#raw_material_id").change(function(e){
    e.preventDefault();
    if($(this).val()=="" || $(this).val()==null || $(this).val()==undefined){
      alert("Raw Material is Required!");
      return false;
    }
    $.ajax({
      url:"{{ route('raw_material_delivery_challan.get_grns') }}",
      type:"POST",
      data:{raw_material_id:$(this).val()},
      success:function(response)
      {
        $("#grn_number_id").html(response);
        $("#grn_number_id").select2({
            placeholder:"Select GRN",
            allowedClear:true,
        });
      }
    });
  });  
  // Getting GRN Details
  $("#grn_number_id").change(function(e){
    if($(this).val()=="" || $(this).val()==null || $(this).val()==undefined){
      alert("GRN Number is Required!");
      return false;
    }
    $.ajax({
      url:"{{ route('raw_material_delivery_challan.grn_details') }}",
      type:"POST",
      data:{grn_number_id:$(this).val()},
      success:function(response)
      {
        console.log(response);
      }
    });
  });
  
</script>  
@endpush
