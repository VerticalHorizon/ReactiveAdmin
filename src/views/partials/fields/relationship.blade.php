<div class="form-group">
    <label for="{{ $name }}" class="col-sm-2 control-label">{{ $attrs['title'] }}</label>
    <div class="col-sm-10">
{{--*/
    list($table, $field) = explode('.', $attrs['field']);

    if(is_a($value, 'Illuminate\Database\Eloquent\Collection')) {
        $multiple = array('multiple' => 'true');
        $values = array_fetch($value->toArray(), 'id');
    } else {
        $multiple = array();
        $values = is_object($value) ? $value->toArray()['id'] : array($value);
    }
/*--}}

        {{ Form::select(
            $name,
            DB::table($table)->lists($field, 'id'),
            $values,
            array_merge(
                array('data-placeholder' => $attrs['title'], 'class' => 'form-control chosen-select', 'id' => $name),
                $multiple
            )
        ) }}
    </div>
</div>