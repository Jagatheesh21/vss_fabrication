<table class="table table-responsive table-bordered" id="tab_logic">
    <thead class="text-center bg-secondary text-white">
    <tr>
        <th>Type</th>
        <th>Child Part Number</th>
        <th>Quantity (Nos)</th>
        <th>BOM(KG)</th>
        <th>Total Quantity(KG)</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($nestings as $nesting)
    <tr class="nesting_row" id="{{$loop->iteration}}">
        <td class="col-md-2">
            <div class="col-md-12">
                <div class="form-group">
                    <select name="nesting_type_id[]" id="nesting_type_id_{{$loop->iteration}}" class="type_id form-control select2">
                        @foreach ($types as $type)
                            @if ($type->id==$nesting->type_id)
                            <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </td>
        <td class="col-md-4">
            <div class="col-md-12">
                <div class="form-group">
                    <select name="child_part_number_id[]" id="child_part_number_id_{{$loop->iteration}}" class="child_part_number_id form-control select2">
                        @foreach ($child_part_numbers as $child_part_number)
                           @if ($child_part_number->id==$nesting->child_part_number_id)
                           <option value="{{ $child_part_number->id }}" selected>{{ $child_part_number->name }}</option>  
                           @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </td>
        <td class="col-md-2">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="number" class="form-control" name="quantity[]" id="nesting_quantity_{{ $loop->iteration }}" value="{{ $nesting->quantity }}" readonly>
                </div>
            </div>
        </td>
        <td>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="number" class="form-control" name="unit_weight[]" id="unit_weight_{{ $loop->iteration }}" value="{{ $nesting->child_part_number->bom->bom }}" readonly>
                </div>
            </div>
        </td>
        <td>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="number" class="form-control" name="useage_weight[]" id="useage_weight_{{ $loop->iteration }}" value="{{ ($nesting->child_part_number->bom->bom)*($nesting->quantity) }}" readonly>
                </div>
            </div>
        </td>
    </tr>
    <script>
        calculate();
        function calculate()
        {
            var count = {{$loop->count}};
            var loop = count+1;
            var total_useage = 0;
            for(var i=1; i<=count; i++) {
                var useage = $("#useage_weight_"+i).val();
                usegae = $.isNumeric(useage)?useage:0;
                total_useage = parseFloat(total_useage)+parseFloat(useage);
            }
            total_useage = total_useage.toFixed(2);
            var avaialable = $("#issue_unit_quantity").val();
            $("#total_useage_weight").val(total_useage);
            avaialable = parseFloat(avaialable).toFixed(2);
            // if(total_useage>avaialable)
            // {
            //     alert("Exceeding the Available Quantity!");
            //     $("#total_useage_weight").val(0);
            //     return false;
            // }
            var balance = parseFloat(avaialable-total_useage).toFixed(2);
            $("#balance_weight").val(balance);
            var utilization = ((total_useage/avaialable)*100).toFixed(2);
            $("#utilization").val(utilization);

        }
    </script>
    @endforeach
    <tr>
        <td colspan="4" align="right">
            <div class="col-md-3">
                <label for="">Total Useage Weight</label>
            </div>
        </td>
        <td>
            <div class="col-md-9">
                <input type="number" name="total_useage_weight" id="total_useage_weight" class="form-control" min="1" readonly value="0">
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="4" align="right">
            <div class="col-md-3">
                <label for="">Balance Weight</label>
            </div>
        </td>
        <td>
            <div class="col-md-9">
                <input type="number" name="balance_weight" id="balance_weight" class="form-control" min="1" readonly value="0">
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="4" align="right">
            <div class="col-md-3">
                <label for="">% Utilization</label>
            </div>
        </td>
        <td>
            <div class="col-md-9">
                <input type="number" name="utilization" id="utilization" class="form-control" min="1" readonly value="0">
            </div>
        </td>
    </tr>
    </tbody>
</table>