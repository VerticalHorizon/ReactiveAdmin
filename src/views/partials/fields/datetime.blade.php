<div class="form-group">
    <label for="{{ $name }}" class="col-sm-2 control-label">{{ $label }}</label>
    <div class="col-sm-10">
		<div class="input-group date">
			<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        	<input type="text" name="{{ $name }}" value="{{ $value }}" class="form-control" data-date-format="YYYY-MM-DD HH:mm" id="{{ $name }}" placeholder="{{ $label }}">
		</div>
    </div>
</div>