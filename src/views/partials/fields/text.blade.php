<div class="form-group">
    <label for="{{ $name }}" class="col-sm-1 control-label">{{ $attrs['title'] }}</label>
    <div class="col-sm-7">
        <textarea name="{{ $name }}" class="form-control" id="{{ $name }}" placeholder="{{ $attrs['title'] }}" data-type="wysihtml5" rows="6">{{ $value }}</textarea>
    </div>
</div>