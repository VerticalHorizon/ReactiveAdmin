@extends('admin.root')

{{-- Content --}}
@section('content')
        <div class="col-sm-3 col-md-2 sidebar">
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          @include('admin.partials.notifications')
          <h1 class="page-header">Dashboard</h1>

        </div>
@stop