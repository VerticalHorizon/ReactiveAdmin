<div class="form-group">
    <label for="{{ $name }}" class="col-sm-2 control-label">{{ $attrs['title'] }}</label>
    <div class="col-sm-10">
        <input type="password" name="{{ $name }}" value="" class="form-control" id="{{ $name }}" placeholder="{{ $attrs['title'] }}">
    </div>
</div>
<div class="form-group">
    <label for="{{ $name }}_confirmation" class="col-sm-2 control-label">{{ $attrs['title'] }} Confirmation</label>
    <div class="col-sm-10">
        <input type="password" name="{{ $name }}_confirmation" value="" class="form-control" id="{{ $name }}_confirmation" placeholder="{{ $attrs['title'] }} Confirmation">
    </div>
</div>