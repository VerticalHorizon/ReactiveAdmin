<div class="form-group">
    <label for="{{ $name }}" class="col-sm-1 control-label">{{ $attrs['title'] }}</label>
    <div class="col-sm-7">
        <input type="text" name="{{ $name }}" value="{{{ $value }}}" class="form-control" id="{{ $name }}" placeholder="{{ $attrs['title'] }}">
    </div>
</div>