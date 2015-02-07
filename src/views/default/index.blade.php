@extends('reactiveadmin::root')

{{-- Content --}}
@section('content')
        @if(!empty($config['sidebar']))
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    @foreach($config['sidebar'] as $href => $title)
                    <li{{ Request::root().Request::server('REQUEST_URI') == $href ? ' class="active"' : '' }}>
                        <a href="{{ $href }}">{{ $title }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="@if(!empty($config['sidebar']))col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 @endif main">
          @include('reactiveadmin::partials.notifications')
          <a href="{{ URL::to('admin/'.$view.'/create') }}" class="pull-right btn btn-success" data-toggle="modalCreate">
            <span class="glyphicon glyphicon-plus-sign"></span> {{ trans('reactiveadmin::reactiveadmin.new') }}
          </a>
          <h1 class="page-header">{{ Lang::choice($config['title'], 2) }} @if(isset($config['description']))<small>{{ $config['description'] }}</small>@endif</h1>
          @if(isset($rows) && count($rows))
          {{--*/ $isSoftDeleting = in_array('Illuminate\Database\Eloquent\SoftDeletingTrait', class_uses($rows->first())) ? true : false; /*--}}
          <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="list-checkbox">
                            <input name="" type="checkbox" id="checkAll">
                        </th>
                        @foreach($config['fields'] as $field => $attrs)
                            {{--*/
                                $dir = 'desc';
                                $active = false;
                                if(Input::has('orderBy') && array_keys(Input::get('orderBy'))[0]==$field) {
                                    $active = true;
                                    $dir = Input::get('orderBy')[$field]=='desc'?'asc':'desc';
                                }
                            /*--}}
                            <th>{{ isset($attrs['title']) ? $attrs['title'] : $field }} <a href="{{Request::url()}}?page={{ Input::get('page',1) }}&orderBy[{{$field}}]={{ $dir }}" class="glyphicon @if($dir=='asc')glyphicon-chevron-down @else glyphicon-chevron-up @endif @if($active) active @endif"></a></th>
                        @endforeach
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $one)
                    <tr data-id="{{ $one->id }}" @if($isSoftDeleting  && $one->trashed()) class="text-muted" @endif>
                        <td class="list-checkbox">
                            <input type="checkbox">
                        </td>
                        @foreach($config['fields'] as $field => $attrs)
                            @if(isset($attrs['field']))
                                @if(is_a($one->$field, 'Illuminate\Database\Eloquent\Collection'))
                                    <td>{{{ implode(', ', array_fetch($one->$field->toArray(), $attrs['field'])) }}}</td>
                                @else
                                    <td>{{{ $one->$field->$attrs['field'] }}}</td>
                                @endif
                            @else
                                <td>{{{$one->$field}}}</td>
                            @endif
                        @endforeach
                        <td class="controls">
                            <div class="btn-group btn-group-sm pull-right">
                                {{--<a href="{{ URL::to(Config::get('reactiveadmin::uri').'/'.$view.'/'.$one->id.'/edit') }}" class="btn btn-default" data-placement="top" title="{{ trans('reactiveadmin::reactiveadmin.index.edit') }}" data-toggle="modalEdit">
                                                                                                    <span class="glyphicon glyphicon-pencil"></span>
                                                                                                </a>--}}
                                @if($isSoftDeleting)
                                @if($one->trashed())
                                <a href="{{ URL::to(Config::get('reactiveadmin::uri').'/'.$view.'/'.$one->id.'/restore') }}" class="btn btn-success" data-placement="top" title="{{ trans('reactiveadmin::reactiveadmin.index.restore') }}">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </a>
                                @else
                                <a href="{{ URL::to(Config::get('reactiveadmin::uri').'/'.$view.'/'.$one->id.'/trash') }}" class="btn btn-warning" data-placement="top" title="{{ trans('reactiveadmin::reactiveadmin.index.trash') }}">
                                    <span class="glyphicon glyphicon-eye-close"></span>
                                </a>
                                @endif
                                @endif
                                <a href="#" data-toggle="modal" data-target="#confirmDelete" data-id="{{ $one->id }}" data-action="{{ URL::to(Config::get('reactiveadmin::uri').'/'.$view.'/'.$one->id.'/destroy') }}" class="btn btn-danger" data-placement="top" title="{{ trans('reactiveadmin::reactiveadmin.index.delete') }}">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ method_exists($rows, 'links') ? $rows->links('reactiveadmin::partials.pagination') : '' }}

            <div id="confirmDelete" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="confirmLabel" aria-hidden="true">
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


            <!--  Modal edit -->
            <div id="modalEdit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        {{ Form::open(array('url' => '', 'method' => 'put', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data')) }}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">{{ trans('reactiveadmin::reactiveadmin.close') }}</span></button>
                            <h3 class="modal-title" id="modalEditLabel">{{ trans('reactiveadmin::reactiveadmin.edit.title') }} <q>{{ Lang::choice($config['title'], 1) }}</q></h3>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">{{ trans('reactiveadmin::reactiveadmin.edit.cancel') }}</button>
                            <button type="submit" class="btn btn-lg btn-primary">{{ trans('reactiveadmin::reactiveadmin.edit.save') }}</button>
                        {{ Form::close() }}
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <!--  Modal create -->
            <div id="modalCreate" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modalCreateLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        {{ Form::open(array('url' => '', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data')) }}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">{{ trans('reactiveadmin::reactiveadmin.close') }}</span></button>
                            <h3 class="modal-title" id="modalEditLabel">{{ trans('reactiveadmin::reactiveadmin.create.title') }} <q>{{ Lang::choice($config['title'], 1) }}</q></h3>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">{{ trans('reactiveadmin::reactiveadmin.create.cancel') }}</button>
                            <button type="submit" class="btn btn-lg btn-primary">{{ trans('reactiveadmin::reactiveadmin.create.title') }}</button>
                        {{ Form::close() }}
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

          @endif
        </div>
@stop