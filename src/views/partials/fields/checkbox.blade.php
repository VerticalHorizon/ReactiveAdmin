<div class="form-group">
    <div class="col-sm-offset-1 col-sm-7">
        <div class="checkbox-inline">
            <input type="hidden" name="{{ $name }}" value="0" >
            <label>
                <input name="{{ $name }}" type="checkbox" value="1"@if($value) checked="checked"@endif> {{ $attrs['title'] }}
            </label>
        </div>
    </div>
</div>