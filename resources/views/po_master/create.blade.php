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
            Create New Po Master 
            <a href="{{route('po_master.index')}}" class="btn btn-primary float-end">PO Master List</a>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="category_save" method="POST" action="{{route('po_master.store')}}">
                  @csrf
                  @method('POST')
                    <div class="row mb-3">
                      <div class="col-md-4">
                        <label for="purchase_order_number" class="col-sm-12 col-form-label required">Purchase Order Number*</label>
                        <input type="text" class="form-control" name="rm_po_number" readonly value="{{$po_number}}">
                      </div>
                      <div class="col-md-4">
                        <label for="name" class="col-sm-12 col-form-label required">Supplier*</label>
                        <select name="supplier_id" id="supplier_id" class="form-control select2">
                          <option value=""></option>
                          @foreach($suppliers as $supplier)
                          <option value="{{$supplier->id}}">{{$supplier->code}}</option>
                          @endforeach
                        </select>
                        @error('supplier_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-4">
                        <label for="name" class="col-sm-12 col-form-label required">Material Type*</label>
                        <select name="type_id" id="type_id" class="form-control select2">
                          <option value="">Select Type</option>
                          @foreach ($types as $type)
                              <option value="{{$type->id}}">{{$type->name}}</option>
                          @endforeach
                        </select>
                        @error('type_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-4">
                        <label for="name" class="col-sm-12 col-form-label required">Part Description*</label>
                        <select name="raw_material_id" id="raw_material_id" class="form-control select2">
                          <option value="">Select Part Description</option>
                          @error('raw_material_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        </select>
                        @error('raw_material_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="name" class="col-sm-6 col-form-label required">Date Of Purchase*</label>
                        <input type="date" name="po_date" id="po_date" class="form-control">
                        @error('po_date')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="name" class="col-sm-6 col-form-label required">Invoice Number*</label>
                        <input type="text" name="invoice_number" id="invoice_number" class="form-control">
                        @error('invoice_number')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label for="name" class="col-sm-6 col-form-label required">Quantity*</label>
                        <input type="number" name="po_quantity" id="quantity" class="form-control" min="1" value="0">
                        @error('po_quantity')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <input type="hidden" nme="remarks" value="PO">
                      <div class="col-md-3">
                        <label for="name" class="col-sm-6 col-form-label required">UOM*</label>
                        <select name="uom_id"  class="form-control" id="uom_id">
                          <option value="">Select UOM</option>
                          
                        </select>
                        @error('uom_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="name" class="col-sm-6 col-form-label required">Material Quantity*</label>
                        <input type="number" name="material_quantity" id="material_quantity" class="form-control" value="0" min="1">
                        @error('material_quantity')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="name" class="col-sm-6 col-form-label required">Material UOM*</label>
                        <select name="material_uom_id"  class="form-control" id="material_uom_id">
                          <option value="">Select Material Uom</option>
                        </select>
                        @error('material_uom_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="name" class="col-sm-12 col-form-label required">Unit Material Quantity*</label>
                        <input type="text" name="unit_material_quantity" id="unit_material_quantity" class="form-control" value="0" min="1" readonly>
                        @error('material_uom_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                   <input type="hidden" name="remarks" value="PO">
                    <button type="submit" id="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to Save?')">Save</button>
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
        $("#type_id").select2({
            placeholder:"Select Type",
            allowedClear:true,
        });
        $("#raw_material_id").select2({
            placeholder:"Select Type First",
            allowedClear:true,
        });
        $("#type_id").change(function(e){
            e.preventDefault();
            var type_id = $(this).val();
            if(type_id=="" || type_id==null || type_id==undefined)
            {
                return false;
            }
            if(type_id==2)
            {
              $("#uom_id").append("<option value='2' selected>Meters</option>");
              $("#material_uom_id").append("<option value='3' selected>Nos</option>");
            }
            if(type_id==1)
            {
              $("#uom_id").append("<option value='1' selected>KG</option>");
              $("#material_uom_id").append("<option value='3' selected>Nos</option>");
            }
            if(type_id>2)
            {
              $("#uom_id").append("<option value='3' selected>Nos</option>");
              $("#material_uom_id").append("<option value='3' selected>Nos</option>");
            }

            $.ajax({
              url:"{{route('store.materials')}}",
              type:"POST",
              data:{type_id:$(this).val()},
              success:function(response)
              {
                var data = JSON.parse(response);
                $("#raw_material_id").append("<option value=''>Select Raw Material</option>");
                $.each(data, function (i, item) {
                  $("#raw_material_id").append("<option value='"+item.id+"'>" + item.name + "-"+item.part_description+"</option>");
                });
                $("#raw_material_id").select2({
                allowedClear:true,
                placeholder:'Select Raw Material'
              });
            }
        });
        });
        $("#quantity").change(function(){
          unit_quantity();
        });
        $("#material_quantity").change(function(){
          unit_quantity();
        });
        function unit_quantity()
        {
          var quantity = $("#quantity").val();
          var material_quantity = $("#material_quantity").val();
          if(material_quantity>0 && quantity>0)
          {
            var unit_quantity = parseFloat(quantity)/parseFloat(material_quantity);
            $("#unit_material_quantity").val(unit_quantity.toFixed(3));
          }
        }
    </script>
@endpush