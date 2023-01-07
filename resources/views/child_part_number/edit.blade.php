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
    {{session('error')}}.
    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
    <div class="card mb-4">
        <div class="card-header">
            <strong>Edit Child Part Number</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <form id="stocking_point_update" method="POST" action="{{route('child_part_number.update',$childPartNumber->id)}}">
                  @csrf
                  @method('PUT')
                    <div class="row mb-3">
                      <div class="col-md-4">
                        <label for="name" class="col-sm-12 col-form-label required">Part Type*</label>
                        <div class="form-group">
                          <select name="part_type_id" id="part_type_id" class="form-control select2">
                            <option value="">Select Part Type</option>
                            @foreach ($part_types as $part_type)
                                <option value="{{ $part_type->id }}" @if ($part_type->id==$childPartNumber->part_type_id)
                                    selected
                                @endif>{{ $part_type->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <label for="name" class="col-sm-12 col-form-label required">Name*</label>
                        <div class="form-group">
                          <input type="text" class="form-control" id="name" name="name" autocomplete="off" value="{{$childPartNumber->name}}">
                          @error('name')
                          <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <button type="submit" id="submit" class="btn btn-primary">Update</button>
                  </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script src="{{asset("js/select2.min.js")}}"></script>

<script>
$("#part_type_id").select2();
</script>
@endpush