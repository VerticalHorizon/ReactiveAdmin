                  <div class="form-group">
                    <label for="image" class="col-sm-1 control-label">{{{ $label }}}</label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-file"></span></span>
                            <input type="file" name="{{ $fieldName }}" id="image" class="form-control">
                        </div>
                    </div>
                  </div>
                  @if(isset($image) && $image && File::exists(public_path('files/thumbnail/').$image))
                    <div class="form-group">
                        <div class="col-sm-7 col-sm-offset-1">
                            <img src="{{ URL::to('public/files/thumbnail/'.$image) }}" alt="" class="img-thumbnail">
                        </div>
                    </div>
                  @endif