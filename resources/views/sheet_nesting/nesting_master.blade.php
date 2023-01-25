<tr class="nesting_row">
    <td>
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
    <td>
        <div class="col-md-12">
            <div class="form-group">
                <select name="child_part_number_id[]" class="child_part_number_id form-control select2">
                    <option value="">Select Child Part Number</option>
                </select>
            </div>
        </div>
    </td>
    <td>
        <div class="col-md-12">
            <div class="form-group">
                <input type="number" class="form-control" name="quantity[]" value="0">
            </div>
        </div>
    </td>
    <td>
        <div class="btn-toolbar">
        <div class="btn-group mr-1">
            <button type="button" class="btn btn-success btn-sm text-white add mr-2">+</button>
            <button type="button" class="btn btn-danger btn-sm text-white remove mr-2">-</button>    
        </div>
        </div>
    </td>
</tr>
<script>
        $(".type_id").select2({
            placeholder:"Select Type",
            allowedClear:true,
        });        
        $(".child_part_number_id").select2({
            placeholder:"Select Child Part Number",
            allowedClear:true,
        });

</script>