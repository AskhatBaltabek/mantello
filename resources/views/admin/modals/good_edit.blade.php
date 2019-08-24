<!-- icheck -->
<script src="{{asset('plugins/assets/plugins/jquery-asColor/dist/jquery-asColor.js')}}"></script>
<script src="{{asset('plugins/assets/plugins/jquery-asGradient/dist/jquery-asGradient.js')}}"></script>
<script src="{{asset('plugins/assets/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js')}}"></script>
<script src="{{asset('plugins/assets/plugins/gijgo-combined/js/gijgo.js')}}"></script>
<script>
  $(function () {
    $("#cp1").asColorPicker({
      mode: 'complex',
      hideInput: true,
    });

    window.getCategories();
    window.getSizes();
  });
</script>

<link href="{{asset('plugins/assets/plugins/gijgo-combined/css/gijgo.css')}}" rel="stylesheet">
<link href="{{asset('plugins/assets/plugins/jquery-asColorPicker-master/dist/css/asColorPicker.css')}}" rel="stylesheet">
<link href="{{asset('plugins/assets/plugins/colorpicker/colorpicker.css')}}" rel="stylesheet">

<div class="modal-content">
  <div class="modal-header">
    <h4 class="modal-title" id="mainModalLabel">{{!$new ? $product->title : 'New product'}}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>
  <div class="modal-body">
    <div class="row">
      <div class="col-lg-9 col-xlg-9 col-md-9">
        <div class="card">
          <div class="card-body">
            
          </div>
        </div>
      </div>
      <div class="col-lg-3col-xlg-3 col-md-3">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">
              Product categories
              <div class="card-actions">
                <a class="" data-action="collapse"><i class="ti-plus"></i></a>
              </div>
            </h4>
          </div>
          <div class="card-body collapse show">
            <div id="categoriesTree" class=""></div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">
              Size & Quantity
              <div class="card-actions">
                <a class="" data-action="collapse"><i class="ti-plus"></i></a>
              </div>
            </h4>
          </div>
          <div id="productSizes" class="card-body collapse show">
            <label class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input">
              <span class="custom-control-label">Check this custom checkbox</span>
            </label>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">
              Color & Quantity
              <div class="card-actions">
                <a class="" data-action="collapse"><i class="ti-plus"></i></a>
              </div>
            </h4>
          </div>
          <div class="card-body collapse show">
            <div class="color-area-wrap">
              <input id="cp1" type="text" class="" value=""/>
              <button type="button" class="btn btn-sm waves-effect waves-light btn-info">add</button>
            </div>
            <hr>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" onclick="storeEmployee()" class="btn btn-primary">Save</button>
  </div>
</div>
