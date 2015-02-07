<div class="form-group">
	<label for="{{ $name }}" class="col-sm-2 control-label">{{ $attrs['title'] }}</label>
    <div class="col-sm-10">
		{{ Form::select($name, $values, $row->$name, ['class'=>'form-control', 'id' => 'name']) }}
    </div>
</div>