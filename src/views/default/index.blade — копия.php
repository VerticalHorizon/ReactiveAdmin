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
          <a href="{{ URL::to('admin/'.$view.'/create') }}" class="pull-right btn btn-success">
            <span class="glyphicon glyphicon-plus-sign"></span> New
          </a>
          <h1 class="page-header">{{ $config['plural_title'] }}</h1>
          @if(isset($rows) && count($rows))
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    @foreach($config['fields'] as $field => $attrs)
                    <th>{{ isset($attrs['title']) ? $attrs['title'] : $field }}</th>
                    @endforeach
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($rows as $one)
                    <tr>
                      @foreach($config['fields'] as $field => $attrs)
                        @if($field==='id')
                          <td>{{{$one->$field}}}</td>
                        @else
                          @if(isset($attrs['field']))
                          <td>{{{ $one->$field->$attrs['field'] }}}</td>
                          @else
                          <td>{{{$one->$field}}}</td>
                          @endif
                        @endif
                      @endforeach
                      <td>
                          <div class="btn-group btn-group-sm">
                            <a href="{{ URL::to('admin/'.$view.'/'.$one->id.'/edit') }}" class="btn btn-default" data-placement="top" title="{{ trans('reactiveadmin::reactiveadmin.index.edit') }}">
                              <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                        @if(method_exists($one, 'forceDelete'))
                          @if($one->trashed())
                            <a href="{{ URL::to('admin/'.$view.'/'.$one->id.'/restore') }}" class="btn btn-success" data-placement="top" title="{{ trans('reactiveadmin::reactiveadmin.index.restore') }}">
                              <span class="glyphicon glyphicon-refresh"></span>
                            </a>
                          @else
                            <a href="{{ URL::to('admin/'.$view.'/'.$one->id.'/trash') }}" class="btn btn-warning" data-placement="top" title="{{ trans('reactiveadmin::reactiveadmin.index.trash') }}">
                              <span class="glyphicon glyphicon-trash"></span>
                            </a>
                          @endif
                        @endif
                            <a href="#" data-toggle="modal" data-target="#confirm_delete" data-id="{{ $one->id }}" data-action="{{ URL::to('admin/'.$view.'/'.$one->id.'/destroy') }}" class="btn btn-danger" data-placement="top" title="{{ trans('reactiveadmin::reactiveadmin.index.delete') }}">
                              <span class="glyphicon glyphicon-remove"></span>
                            </a>
                          </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              {{ method_exists($rows, 'links') ? $rows->links('reactiveadmin::partials.pagination') : '' }}
            </div>

            <div id="confirm_delete" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="confirmLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="confirmLabel">Уверены?</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-xs-1 col-sm-2 text-center"><span class="glyphicon glyphicon-question-sign" style="font-size: 24px;"></span></div>
                      <div class="col-xs-11 col-sm-10"><p>Вы действительно хотите удалить запись #<strong></strong>?</p></div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    {{ Form::open(array('url' => '', 'method' => 'delete')) }}
                      <button type="button" class="btn btn-default" tabindex="0" data-dismiss="modal">Отмена</button>
                      <button type="submit" class="btn btn-danger" tabindex="1">Удалить</button>
                    {{ Form::close() }}
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>
          @endif
        </div>
@stop