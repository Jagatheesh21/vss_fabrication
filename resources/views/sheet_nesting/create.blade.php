@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />
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
            Create Dynamic Nesting
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="operation_save" method="POST" action="{{route('sheet_nesting.store')}}">
                    @csrf
                    @method('POST')
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="col-sm-12 col-form-label required">Nesting#</label>
                                <input type="text" name="nesting_number" id="nesting_number" readonly class="form-control" value="{{ $next_nesting_number }}">
                                @error('nesting_number')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="col-sm-12 col-form-label required">Raw Material*</label>
                                <select name="raw_material_id" id="raw_material_id" class="form-control">
                                    <option value="">Select Raw Material</option>
                                    @foreach ($raw_materials as $raw_material)
                                        <option value="{{$raw_material->id}}" @if (old('raw_material_id')==$raw_material->id)
                                        selected    
                                            @endif>{{$raw_material->name}}</option>
                                    @endforeach
                                </select>
                                @error('raw_material_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="category_id" value="2">
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <table class="table table-responsive table-bordered" id="tab_logic">
                                <thead class="text-center bg-secondary text-white">
                                <tr>
                                    <th>Type</th>
                                    <th>Child Part Number</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="nesting_row">
                                    <td class="col-md-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select name="type_id[]" class="type_id form-control select2">
                                                    <option value="">Select Type</option>
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="col-md-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select name="child_part_number_id[]" class="child_part_number_id form-control select2">
                                                    <option value="">Select Child Part Number</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="col-md-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="quantity[]" >
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="col-md-4">
                                        <button type="button" class="btn btn-success btn-sm text-white add">+</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                                    
                    <button type="button" id="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script src="{{asset('js/select2.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>

    <script>
        $("#raw_material_id").select2({
            placeholder:"Select Raw Material",
            allowedClear:true,
        });        
        $(".type_id").select2({
            placeholder:"Select Type",
            allowedClear:true,
        });        
        $(".child_part_number_id").select2({
            placeholder:"Select Child Part Number",
            allowedClear:true,
        });
        $("body").on("click",".add",function(e){
            e.preventDefault();
            $.ajax({
                url:"{{ route('sheet_nesting.nesting_master') }}",
                type:"GET",
                success:function(response){
                    $("#tab_logic").append(response.html);
                }
            });
        });
        $("body").on("change",".type_id",function(e){
            e.preventDefault();
            var nesting_row = $(this).closest(".nesting_row").find(".child_part_number_id");
            $.ajax({
                url:"{{ route('sheet_nesting.get_child_parts') }}",
                type:"POST",
                data:{type_id:$(this).val()},
                success:function(response){
                    //$(this).closest(".nesting_row").next("td").next("td").find(".child_part_number_id").html(response.html);
                    nesting_row.html(response.html);
                    //alert($(this).closest(".nesting_row").find(".child_part_number_id"));
                }
            });
        });
        $("body").on("click",".remove",function(e){
            e.preventDefault();
            $(this).closest(".nesting_row").remove();
        });
        // On Submit 
        $("#submit").click(function(e){
        e.preventDefault();
        $.ajax({
            url:"{{route('sheet_nesting.store')}}",
            type:"POST",
            data:$("#operation_save").serialize(),
            success:function(response)
            {
                $.toast({
                  heading: 'Success',
                  text: response,
                  showHideTransition: 'plain',
                  position: 'top-right',
                  icon: 'success'
              });
          
              location.reload(true);
            },
            error:function(result)
            {
                var response = $.parseJSON(result.responseText);
            $.each(response.errors, function(key, val) {
              $.toast({
                  heading: 'Error',
                  text: val,
                  showHideTransition: 'plain',
                  position: 'top-right',
                  icon: 'error'
              })
            })
            }
        });            
        });
    </script>
@endpush