@extends('layouts.app')
@livewireStyles
@push('styles')

@endpush
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> {{session('success')}}.
  <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
</div>
@endif
    <div class="card">
        <div class="card-header">
            Create Part Master
        </div>
        <div class="card-body justify-content-center">
            <div class="col-md-12">
              <form  id="part_master_save" method="POST" action="{{route('part_master.store')}}">
                @csrf
                @method('POST')
                <div class="row">
                    
                    <div class="col-md-3 d-none">
                        <div class="form-group">
                            <label class="control-lable-required">Category*</label>
                            <select class="form-control selecct2" name="category_id" id="category_id">
                                @foreach($categories as $category)
                                @if($category->id==2)
                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-lable-required">Type*</label>
                            <select class="form-control select2" name="type_id" id="type_id" required>
                                <option value="">Select Type</option>
                                @foreach($types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-lable-required">Child Part Number*</label>
                            <select class="form-control select2" name="child_part_id" id="child_part_id" required>
                                <option value="">Select Child Part Number</option>
                                @foreach($child_parts as $child_part_number)
                                <option value="{{$child_part_number->id}}">{{$child_part_number->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-lable-required">UOM*</label>
                            <select class="form-control select2" name="uom_id" id="uom_id" required>
                                <option value="">Select UOM</option>
                                @foreach($uoms as $uom)
                                <option value="{{$uom->id}}">{{$uom->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="status" id="status" value="1" class="form-control">
                </div>
                 
                <button type="submit" id="submit" class="btn btn-primary btn-sm mt-5">Save</button>                              
              </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{asset('js/select2.min.js')}}"></script>
<script>
    $("#type_id").select2();
    $("#child_part_id").select2();
    $("#uom_id").select2();
    $(document).ready(function () {
        window.addEventListener('reApplySelect2', event => {
            $('.select2').select2();
        });
    });
</script>
{{-- <script>
    $("#operation_save").submit(function(e){
      e.preventDefault();
      
      var url = "{{route('operation.store')}}";
      $.ajax({
        url:url,
        type:"POST",
        data:$(this).serialize(),
        dataType: "json",
        success: function(data) {
          Swal.fire({
  title: 'success!',
  text: data.message,
  icon: 'success',
})
        },
        error: function(response) {
            $.each(response.responseJSON.errors, function(index, value) {
              $("#"+index+"_error").html(+value+);
            });
        }
      });
    }); 
</script> --}}
@endpush