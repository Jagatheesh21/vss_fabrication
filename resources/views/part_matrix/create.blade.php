@extends('layouts.app')
@push('styles')

@endpush

@section('content')
<div class="row">
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
            Part Matrix
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="category_save" method="POST" action="{{route('part_matrix.store')}}">
                  @csrf
                  @method('POST')
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="name" class="col-sm-12 col-form-label required">Assemble Part Number*</label>
                            <div class="col-sm-10">
                                <select name="assemble_part_number_id" id="assemble_part_number_id" class="form-control select2">
                                    <option value="">Select Assemble Part Number</option>
                                    @foreach ($assemble_part_numbers as $assemble_part_number)
                                        <option value="{{$assemble_part_number->id}}">{{$assemble_part_number->name}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                            @error('assemble_part_number_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="name" class="col-sm-12 col-form-label required">Child Part Number*</label>
                            <div class="col-sm-10">
                                <select name="child_part_number_id[]" id="child_part_number_id" class="form-control select2" multiple>
                                    <option value="">Select Child Part Number</option>
                                    @foreach ($child_part_numbers as $child_part_number)
                                        <option value="{{$child_part_number->id}}">{{$child_part_number->name}}</option>
                                    @endforeach
                                </select>
                                @error('child_part_number_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            
                        </div>
                    </div>
                    
                    <button type="submit" id="submit" class="btn btn-primary">Save</button>
                  </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('js/select2.min.js')}}"></script>
<script>
    $("#assemble_part_number_id").select2();
    $("#child_part_number_id").select2();
</script>
@endpush