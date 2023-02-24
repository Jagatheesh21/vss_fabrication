<table class="table table-bordered table-responsive text-bold m-3" id="rc_detail">
    <thead>  
      <tr>
          <th class="text-center">Child Part Number</th>
          <th class="text-center">Issued Quantity</th>
          <th class="text-center">Ok Quantity</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($child_part_numbers as $key=>$child_part_number)
    <tr class="transactions">
        <td class="text-bold text-center">
          <div class="form-group"> 
            <select name="child_part_number_id[]" class="form-control select2">
               @foreach ($child_parts as $child_part)
                    @if ($child_part->id==$child_part_number->child_part_number_id)
                        <option value="{{ $child_part->id }}" selected>{{ $child_part->name }}</option>
                   @endif
               @endforeach
            </select>
          </div>
        </td>
        <td>
          <div class="form-group">
              <input type="text" name="issued_quantity[]"  required readonly class="form-control issued_quantity" value="{{ $child_part_number->issued_quantity }}">
          </div>
        </td>
        <td>
          <div class="form-group">
              <input type="text" name="ok_quantity[]"  required  class="form-control ok_quantity" min="1" max="{{ $child_part_number->issued_quantity }}" >
          </div>
        </td>
      </tr>  
    @endforeach
    </tbody>   
    <tfoot>
      <tr>
        <td colspan="2" align="right">Total Utilization %</td>
        <td>
          <div class="form-group">
            <input type="text" class="form-control" id="total_utilization" name="total_utilization" value="" readonly>
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="2" align="right">CLOSE RC</td>
        <td><div class="form-group">
            <div class="form-check form-check-inline close_rc">
              <input class="form-check-input" type="radio" name="close_rc" id="yes" value="YES">
              <label class="form-check-label" for="inlineRadio1">YES</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="close_rc" id="no" value="NO" checked>
              <label class="form-check-label" for="inlineRadio2">NO</label>
            </div>
          </div></td>
        
      </tr>
    </tfoot>
  </table>
  <script>
    $(".close_rc").hide();
    function calculate(main)
    {
      var total_issued = 0.000;
      var total_received = 0.000;
      $(".transactions").each(function( index,value ){
        var issued_quantity = $(this).find(".issued_quantity").val();
        var received_quantity = $(this).find(".ok_quantity").val();
        total_issued = total_issued+parseFloat(issued_quantity);
        total_received = total_received+parseFloat(received_quantity);
      });
      var utilization = ((total_received/total_issued)*100).toFixed(2);
      $("#total_utilization").val(utilization);
      if(utilization>98){
        $('.close_rc').show();
      }else{
        $('.close_rc').hide();
      }
    }
    $(".ok_quantity").change(function(e){
      e.preventDefault();
      if($(this).val()=="" || $(this).val()==null || $(this).val()==undefined || $(this).val()==0){
        alert("ok Quantity Value is InValid");
        $(this).val('');
        return false;
      }
      calculate($(this));
    });
  </script>