<div class="form-group">
	<label for="{{ $name }}" class="col-sm-1 control-label">{{ $attrs['title'] }}</label>
    <div class="col-sm-7">
		{{ Form::select($name, $values, $row->$name, ['class'=>'form-control', 'id' => 'name']) }}
    </div>
</div>