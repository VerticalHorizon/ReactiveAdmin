@extends('reactiveadmin::root')

{{-- Content --}}
@section('content')
        <div class="col-sm-3 col-md-2 sidebar">
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            @include('reactiveadmin::partials.notifications')
            <h1 class="page-header">{{ trans('reactiveadmin::reactiveadmin.dashboard') }}</h1>

            <!-- <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <a href="admin/pages" class="thumbnail" style="position:relative; z-index:1;">

                    </a>
                </div>
            </div> -->
        </div>
@stop

@section('scripts')
@parent
    {{ HTML::script('public/packages/Verticalhorizon/Reactiveadmin/js/vendor/html2canvas.js') }}
@stop