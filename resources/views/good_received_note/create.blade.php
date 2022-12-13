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
  <div class="alert alert-danger" role="alert">
    <strong>Error!</strong>{{session('error')}}
    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  
    <div class="card ">
        <div class="card-header">
            Create New GRN 
            <a href="{{route('good_received_note.index')}}" class="btn btn-primary btn-sm float-end">GRN List</a>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="category_save" method="POST" action="{{route('good_received_note.store')}}">
                  @csrf
                  @method('POST')
                    <div class="row mb-3">
                      <div class="col-md-6">
                        <label for="purchase_order_number" class="col-sm-4 col-form-label required">Purchase Order Number*</label>
                        <input type="text" class="form-control" name="grn_number" readonly value="{{$grn_number}}">
                      </div>
                      <div class="col-md-6">
                        <label for="name" class="col-sm-6 col-form-label required">Purchase Order*</label>
                        <select name="purchase_order_id" id="purchase_order_id" class="form-control select2">
                          <option value="">Select Purchase Order</option>
                          @foreach($purchase_orders as $purchase_order)
                          <option value="{{$purchase_order->id}}">{{$purchase_order->purchase_order_number}}</option>
                          @endforeach
                        </select>
                        @error('purchase_order_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="name" class="col-sm-6 col-form-label required">Part Description*</label>
                        <select name="raw_material_id" id="raw_material_id" class="form-control select2">
                          <option value="">Select Part Description</option>
                        </select>
                        @error('raw_material_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      
                      <div class="col-md-6">
                        <label for="name" class="col-sm-6 col-form-label required">Available Quantity*</label>
                        <input type="number" name="available_quantity" id="available_quantity" class="form-control">
                        @error('quantity')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="name" class="col-sm-6 col-form-label required">UOM*</label>
                        <select name="uom_id"  class="form-control" id="uom_id">
                          <option value="1" selected>KG</option>
                        </select>
                        @error('uom_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="name" class="col-sm-6 col-form-label required">Ok Quantity*</label>
                        <input type="number" name="checked_quantity" id="checked_quantity" class="form-control">
                        @error('checked_quantity')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-12">
                        <label for="name" class="col-sm-6 col-form-label required">Remarks</label>
                        <textarea name="remarks" id="" cols="30" rows="5" class="form-control"></textarea>
                        
                      </div>
                      
                    </div>
                   
                    <button type="submit" id="submit" class="btn btn-primary">Save</button>
                  </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script src="{{asset('js/select2.min.js')}}"></script>
    <script>
        $("#supplier_id").select2({
            placeholder:"Select Supplier",
            allowedClear:true,
        });
        $("#raw_material_id").select2({
            placeholder:"Select Part Description",
            allowedClear:true,
        });
        $("#purchase_order_id").change(function(e){
  e.preventDefault();
  if($(this).val()=="" || $(this).val()==null || $(this).val()==undefined)
  {
    alert("Please Select Purchase Order..");
    return false;
  }else{
    var purchase_order_id = $(this).val();
    $.ajax({
      url:"{{route('store.getPurchaseOrder')}}",
      data:{purchase_order_id:purchase_order_id},
      type:"POST",
      success:function(response)
      {
        $("#supplier_id").html('<option value='+response.test.supplier.id+'>'+response.test.supplier.name+'</option>');
        $("#raw_material_id").html('<option value='+response.test.raw_material.id+'>'+response.test.raw_material.name+'-'+response.test.raw_material.part_description+'</option>');
        $("#type_id").html('<option value='+response.type.id+'>'+response.type.name+'</option>');
        $("#uom_id").html('<option value='+response.test.uom.id+'>'+response.test.uom.name+'</option>');
        $("#available_quantity").val(response.test.quantity);
      }
    });
  }
});
    </script>
@endpush