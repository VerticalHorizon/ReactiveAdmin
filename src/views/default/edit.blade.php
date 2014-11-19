@extends('reactiveadmin::root')

{{-- Content --}}
@section('content')
	@if(isset($sidebar))
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
              @if(isset($categories))
                @foreach($categories as $one)
                  <li{{ Request::url() == 'admin/'.$one->alias ? ' class="active"' : '' }}>
                    <a href="{{ URL::to('admin/category/'.$one->alias) }}">{{{ $one->title }}}</a>
                    @if(!empty($one->children))
                      <ul>
                        @foreach($one->children as $two)
                          <li{{ Request::url() == 'admin/'.$one->alias ? ' class="active"' : '' }}>
                            <a href="{{ URL::to('admin/category/'.$two->alias) }}">{{{ $two->title }}}</a>
                          </li>
                        @endforeach
                      </ul>
                    @endif
                  </li>
                @endforeach
              @endif
          </ul>
        </div>
    @endif

        <div class="@if(isset($sidebar))col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 @endif main">
          @include('reactiveadmin::partials.notifications')
          <h1 class="page-header">{{ trans('reactiveadmin::reactiveadmin.edit.title') }} @if($config['singular_title']){{{ '"'.$config['singular_title'].'"' }}}@else{{{ '"'.$row->name.'"' }}}@endif</h1>

          <!-- Tab panes -->
          {{ Form::open(array('url' => array(Config::get('reactiveadmin::uri').'/'.$view.'/'.$row->id), 'method' => 'put', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data')) }}

			      @foreach($config['edit_fields'] as $field => $attrs)
          	  @include('reactiveadmin::partials.fields.'.$attrs['type'], array('name' => $field, 'value' => Input::old($field) ? Input::old($field) : $row->$field, 'label' => $attrs['title']) )
          	@endforeach

            <div class="form-group">
              <div class="col-sm-7">
                <button type="submit" class="btn btn-lg btn-success">Save</button>
              </div>
            </div>
          </div>
          {{ Form::close() }}
        </div>
@stop