@extends('layouts.admin', ['page_title'=> !$new ? $product->title : 'New product'])

@section('scripts')
<!-- icheck -->
<script src="{{asset('plugins/assets/plugins/icheck/icheck.min.js')}}"></script>
<script src="{{asset('plugins/assets/plugins/icheck/icheck.init.js')}}"></script>
<script src="{{asset('plugins/assets/plugins/colorpicker/bootstrap-colorpicker.js')}}"></script>
<script src="{{asset('plugins/assets/plugins/jquery-asColor/dist/jquery-asColor.js')}}"></script>
<script src="{{asset('plugins/assets/plugins/jquery-asGradient/dist/jquery-asGradient.js')}}"></script>
<script src="{{asset('plugins/assets/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js')}}"></script>
<script src="{{asset('plugins/assets/plugins/gijgo-combined/js/gijgo.js')}}"></script>
{{-- <script src="{{asset('plugins/assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}"></script> --}}
{{-- <script src="{{asset('plugins/assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup-init.js')}}"></script> --}}
<script src="{{asset('plugins/assets/plugins/horizontal-timeline/js/horizontal-timeline.js')}}"></script>
<script src="{{asset('plugins/assets/plugins/lightGallery/dist/js/lightgallery-all.min.js')}}"></script>
<script src="{{asset('plugins/assets/plugins/dropzone-master/dist/dropzone.js')}}"></script>
<script>
  $(function () {
    $("#cp1").asColorPicker({
      mode: 'complex',
      hideInput: true,
    });


    window.getProductGallery();
    window.getCategories();
    window.getSizes();
  });
</script>
@endsection

@section('styles')
<link href="{{asset('plugins/assets/plugins/gijgo-combined/css/gijgo.css')}}" rel="stylesheet">
<link href="{{asset('plugins/assets/plugins/jquery-asColorPicker-master/dist/css/asColorPicker.css')}}" rel="stylesheet">
<link href="{{asset('plugins/assets/plugins/icheck/skins/all.css')}}" rel="stylesheet">
<link href="{{asset('plugins/assets/plugins/colorpicker/colorpicker.css')}}" rel="stylesheet">
{{-- <link href="{{asset('plugins/assets/plugins/Magnific-Popup-master/dist/magnific-popup.css')}}" rel="stylesheet"> --}}
<link href="{{asset('plugins/assets/plugins/horizontal-timeline/css/horizontal-timeline.css')}}" rel="stylesheet">
<link href="{{asset('plugins/assets/plugins/lightGallery/dist/css/lightgallery.min.css')}}" rel="stylesheet">
<link href="{{asset('plugins/assets/plugins/dropzone-master/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
  <div class="col-lg-9 col-xlg-9 col-md-9">
    <div class="card">
      <div class="card-body">
        <h3>Gallery</h3>
        <div class="row">
          <div id="lightgallery" class="col-md-12">
            <a href="{{asset('plugins/assets/images/big/img6.jpg')}}">
                <img width="120" src="{{asset('plugins/assets/images/big/img6.jpg')}}" />
            </a>
            <a href="{{asset('plugins/assets/images/big/img2.jpg')}}">
                <img width="120" src="{{asset('plugins/assets/images/big/img2.jpg')}}" />
            </a>
            <a href="{{asset('plugins/assets/images/big/img5.jpg')}}">
                <img width="120" src="{{asset('plugins/assets/images/big/img5.jpg')}}" />
            </a>
            <a href="{{asset('plugins/assets/images/big/img4.jpg')}}">
                <img width="120" src="{{asset('plugins/assets/images/big/img4.jpg')}}" />
            </a>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <form id="dropzoneProduct" action="/admin/uploadGalleryImages" class="dropzone">
              <input type="text" name="_token" value="{{csrf_token()}}" hidden="hidden">
              <input type="text" name="id" value="{{!$new ? $product->id : 'new'}}" hidden="hidden">
              <div class="fallback">
                <input name="file" type="file" multiple />
              </div>
            </form>
          </div>
        </div>
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
@endsection
