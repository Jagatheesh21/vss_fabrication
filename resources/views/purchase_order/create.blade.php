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
            Create New Purchase Order 
            <a href="{{route('purchase_order.index')}}" class="btn btn-primary float-end">Purchase Order List</a>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="category_save" method="POST" action="{{route('purchase_order.store')}}">
                  @csrf
                  @method('POST')
                    <div class="row mb-3">
                      <div class="col-md-6">
                        <label for="purchase_order_number" class="col-sm-4 col-form-label required">Purchase Order Number*</label>
                        <input type="text" class="form-control" name="purchase_order_number" readonly value="{{$po_number}}">
                      </div>
                      <div class="col-md-6">
                        <label for="name" class="col-sm-2 col-form-label required">Supplier*</label>
                        <select name="supplier_id" id="supplier_id" class="form-control select2">
                          <option value=""></option>
                          @foreach($suppliers as $supplier)
                          <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                          @endforeach
                        </select>
                        @error('supplier_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="name" class="col-sm-6 col-form-label required">Part Description*</label>
                        <select name="raw_material_id" id="raw_material_id" class="form-control select2">
                          <option value="">Select Part Description</option>
                          @foreach ($raw_materials as $raw_material)
                              <option value="{{$raw_material->id}}">{{$raw_material->name}}-{{$raw_material->part_description}}</option>
                          @endforeach
                        </select>
                        @error('raw_material_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="name" class="col-sm-6 col-form-label required">Date Of Purchase*</label>
                        <input type="date" name="purchase_order_date" id="purchase_order_date" class="form-control">
                        @error('purchase_order_date')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="name" class="col-sm-6 col-form-label required">Unit Quantity*</label>
                        <input type="text" name="unit_quantity" id="unit_quantity" class="form-control">
                        @error('unit_quantity')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="name" class="col-sm-6 col-form-label required">Quantity*</label>
                        <input type="number" name="quantity" id="quantity" class="form-control">
                        @error('quantity')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="name" class="col-sm-6 col-form-label required">Total Quantity*</label>
                        <input type="number" readonly name="total_quantity" id="total_quantity" class="form-control">
                        @error('total_quantity')
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
        $("#quantity").change(function(){
          var unit = $("#unit_quantity").val();
          var quantity = $("#quantity").val();
          var total_quantity = unit*quantity;
          $("#total_quantity").val(total_quantity);
        });
    </script>
@endpush