<div class="form-group">
    <label for="{{ $name }}" class="col-sm-2 control-label">{{ $attrs['title'] }}</label>
    <div class="col-sm-10">
    	{{--*/ list($table, $field) = explode('.', $attrs['field']); /*--}}

    	{{ Form::select($name, DB::table($table)->lists($field, 'id'), $value, array('class' => 'form-control', 'id' => $name)) }}
    </div>
</div>