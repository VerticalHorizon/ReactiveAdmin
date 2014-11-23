@foreach($config['edit_fields'] as $field => $attrs)
    @include(
        'reactiveadmin::partials.fields.'.$attrs['type'],
        array(
            'name'          => $field,
            'value'         => Input::old($field) ? Input::old($field) : $row->$field,
            'label'         => $attrs['title'],
        )
    )
@endforeach