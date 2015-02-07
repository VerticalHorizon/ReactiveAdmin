@if (count($errors->all()) > 0)
<div class="alert alert-danger alert-block">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <h4>Error</h4>
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
</div>
@endif

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    @if(is_array($message))
        @foreach ($message as $m)
            {{ $m }}
        @endforeach
    @else
        {{ $message }}
    @endif
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <h4>Error</h4>
    @if(is_array($message))
    @foreach ($message as $m)
    {{ $m }}
    @endforeach
    @else
    {{ $message }}
    @endif
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    @if(is_array($message))
    @foreach ($message as $m)
    {{ $m }}
    @endforeach
    @else
    {{ $message }}
    @endif
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    @if(is_array($message))
    @foreach ($message as $m)
    {{ $m }}
    @endforeach
    @else
    {{ $message }}
    @endif
</div>
@endif