@extends('layouts.admin', ['page_title'=> 'Goods'])

@section('scripts')

@endsection

@section('styles')
@endsection

@section('content')
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-10"><h4 class="card-title">Goods</h4></div>
			<div class="col-md-2"><a href='#' style="margin-bottom:10px" class="float-right btn btn-success grid-action-btn" data-toggle="modal" data-target="#mainModal" onclick="window.editItem('new', 'productWindow')" ><i class="mdi mdi-plus"></i> add</a></div>
		</div>
		<div id="goodsGrid"></div>
	</div>
</div>
@endsection
