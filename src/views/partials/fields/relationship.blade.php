<div class="form-group">
    <label for="{{ $name }}" class="col-sm-1 control-label">{{ $attrs['title'] }}</label>
    <div class="col-sm-7">
    	{{--*/ list($table, $field) = explode('.', $attrs['field']); /*--}}

    	{{ Form::select($name, DB::table($table)->lists($field, 'id'), $value, array('class' => 'form-control', 'id' => $name)) }}
    </div>
</div>