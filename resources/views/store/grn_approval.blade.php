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
            <strong>Store - Raw Material Receive - Confirmation </strong>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="operation_save" method="POST" action="{{route('store_receive.update',$store->id)}}">
                  @csrf
                  @method('PUT')
                  <div class="row mb-3">
                    <div class="col-sm-4">
                      <label for="grn_number" class="col-sm-4 col-form-label control-label-required">GRN Number*</label>
                      <div class="form-group">
                        <input type="text" name="grn_number" id="grn_number" class="form-control" readonly value="{{$store->grn_number}}" >
                      </div>
                    </div>
                    <input type="hidden" name="category_id" id="category_id" value="{{$store->category_id}}">

                    <div class="col-sm-4">
                      <label for="name" class="col-sm-6 col-form-label required">Raw Material Type*</label>
                      <div class="form-group">
                        <select name="type_id" id="type_id" class="form-control select2">
                            <option value="">Select Raw Material Type</option>
                            @foreach ($types as $type)
                                <option value="{{$type->id}}" @if ($store->type_id==$type->id)
                                    selected
                                @endif>{{$type->name}}</option>
                            @endforeach
                        </select>
                        @error('type_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-4 col-form-label required">Raw Material*</label>
                      <div class="form-group">
                        <select name="raw_material_id" id="raw_material_id" class="form-control select2">
                        @foreach ($raw_materials as $raw_material)
                            <option value="{{$raw_material->id}}">{{$raw_material->name}}</option>
                        @endforeach
                        </select>
                        @error('raw_material_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-4 col-form-label required">Purchase Order*</label>
                      <div class="form-group">
                        <select name="purchase_order_id" id="purchase_order_id" class="form-control select2">
                          <option value="">Select Purchase Order</option>
                        </select>
                        @error('purchase_order_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4 supplier_div">
                      <label for="name" class="col-sm-4 col-form-label required">Supplier*</label>
                      <div class="form-group">
                        <select name="supplier_id" id="supplier_id" class="form-control select2">
                          <option value="">Select Supplier</option>
                        </select>
                        @error('supplier_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-4 col-form-label required">Invoice Number*</label>
                      <div class="form-group">
                       <input type="text" name="invoice_number" id="invoice_number" class="form-control">
                        @error('invoice_number')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-2 col-form-label required">UOM*</label>
                      <div class="form-group">
                        <select name="uom_id" id="uom_id" class="form-control select2">
                          <option value="">Select UOM</option>
                        </select>
                        @error('uom_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-6 col-form-label required">Available Quantity*</label>
                      <div class="form-group">
                      <input type="text" name="available_quantity" id="available_quantity" readonly class="form-control">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-4 col-form-label required">Quantity*</label>
                      <div class="form-group">
                      <input type="text" name="inward_quantity" id="inward_quantity" value="{{old('quantity')}}" class="form-control">
                      @error('inward_quantity')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
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

@endsection
@push('scripts')
<script src="{{asset('js/select2.min.js')}}"></script>
<script>
  $("#type_id").select2();
</script>
@endpush