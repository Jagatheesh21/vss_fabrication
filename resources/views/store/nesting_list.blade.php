<table>
<tr>
	<th>Child Part Type</th>
	<th>Child Part Number</th>
	<th>Quantity</th>
</tr>
@foreach($nesting_sequences as $nesting_sequence)
<tr>
	<td><div class="col-md-4">
		<div class="form-group">
			<select name="nesting_sequence_id" id="nesting_sequence_id" class="form-control select2">
				<option value="">Select Child Part</option>
			</select>
		</div>
	</div></td>
	<td></td>
	<td></td>
</tr>
@endforeach
</table>