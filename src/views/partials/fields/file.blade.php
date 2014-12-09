<div class="form-group">
  <label for="{{ $name }}" class="col-sm-2 control-label">{{{ $attrs['title'] }}}</label>
  <div class="col-sm-10">
      <div class="input-group">
          <span class="input-group-addon"><span class="glyphicon glyphicon-file"></span></span>
          <input type="file" name="{{ $name }}" id="{{ $name }}" class="form-control">
      </div>
  </div>
</div>
@if(isset($value) && $value && File::exists(public_path('files/thumbnail/').$value))
  <div class="form-group">
      <div class="col-sm-7 col-sm-offset-1">
          <img src="{{ URL::to('files/thumbnail/'.$value) }}" alt="" class="img-thumbnail">
      </div>
  </div>
@endif