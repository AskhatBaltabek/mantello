@extends('layouts.admin')

@section('scripts')
<!------------------------------ BEGIN ------------------------------->
<!-- Editable -->
<script src="{{asset('plugins/assets/plugins/jsgrid/db.js')}}"></script>
{{-- <script src="{{asset('plugins/materialpro/js/jsgrid-init.js')}}"></script> --}}
<script src="{{asset('plugins/assets/plugins/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('plugins/assets/plugins/bootstrap-select/bootstrap-select.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('plugins/assets/plugins/multiselect/js/jquery.multi-select.js')}}"></script>
<!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->
<script src="{{asset('plugins/assets/plugins/moment/moment.js')}}"></script>
<script src="{{asset('plugins/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
<script src="{{asset('plugins/assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('plugins/assets/plugins/sweetalert/jquery.sweet-alert.custom.js')}}"></script>
@endsection

@section('styles')
<!-- Editable CSS -->
<link type="text/css" rel="stylesheet" href="{{asset('plugins/assets/plugins/jsgrid/jsgrid.min.css')}}" />
<link type="text/css" rel="stylesheet" href="{{asset('plugins/assets/plugins/jsgrid/jsgrid-theme.min.css')}}" />
<link href="{{asset('plugins/assets/plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" />
<link href="{{asset('plugins/assets/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/assets/plugins/multiselect/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">
<link href="{{asset('plugins/assets/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Column -->
        <div class="card">
            <div class="card-body">
                <div style="display:none" id="servicesGrid"></div>
                <h4 class="card-title">Cities</h4>
                <div id="citiesGrid"></div>
                <h4 class="card-title">Stores</h4>
                <div id="storesGrid"></div>
            	<div class="row">
            		<div class="col-md-10"><h4 class="card-title">Employees</h4></div>
            		<div class="col-md-2"><a href='#' style="margin-bottom:10px" class="float-right btn btn-success grid-action-btn" data-toggle="modal" data-target="#mainModal" onclick="window.editItem('new', 'userEditWindow')" ><i class="mdi mdi-plus"></i> add user</a></div>
            	</div>
                <div id="employeesGrid"></div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"></h4>
                <h6 class="card-subtitle"></h6>
            </div>
        </div>
        <!-- Column -->
    </div>
</div>
@endsection