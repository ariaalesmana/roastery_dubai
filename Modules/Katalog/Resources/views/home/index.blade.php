@extends('katalog::layouts.app')
@section('content')
<div class="main-content home-page main-content-home2">
	<div class="container">
		{{-- @include('katalog::home.slide_show') --}}
		<div class="row">
			<div class="right-content-offset col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="group-product layout1">
					<div class="kt-tab nav-tab-style1">
						@include('katalog::home.filter')
						@include('katalog::home.products')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	$(document).ready(function () {
		$('.select2').select2({
            allowClear: false,
            theme: "bootstrap",
            width: "100%",
			placeholder: 'Filter berdasarkan vendor'
        });
    });
	function quickview_popup(product_id, code_url, name, description, image, qty, price, unit, sku, vendor_sku, vendor_id, vendor_name, vendor_email, key) {
		
		var html = `<div class="row">
						<div class="details-thumb col-md-6">`;
		if(image == null) {
			html += 		`<div style="height:250px;">
								<img src="{{ asset('/techone/images/product_placeholder.jpg') }}" style="height:200px; position: absolute; margin: auto; top: 0; left: 0; right: 0; bottom: 0;">
							</div>`;
		} else {
			html += 		`<div style="width:250px;height:250px;">
								<img src="` + image + `" style="width:250px;height:250px; position: absolute; margin: auto; top: 0; left: 0; right: 0; bottom: 0;">
							</div>`;
		}
		html += 		`</div>
						<div class="details-info col-md-6">
							<a class="product-name">
								`+name+`
							</a>
							<p class="description">
							`+description+`
							</p>
							<div class="price">
								<span >Rp.`+price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+`</span>
							</div>`;
		@can('customer')
		html += 			`<div class="group-button">
								<div class="inner">
									<a class="btn btn-default" onclick="addtocart('`+product_id+`', '`+code_url+`', '`+name+`', '`+image+`', '`+qty+`', '`+price+`', '`+unit+`', '`+sku+`', '`+vendor_sku+`', '`+vendor_id+`', '`+vendor_name+`', '`+vendor_email+`')">
										<i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
									</a>
									<a class="btn btn-default" onclick="addtocompare('`+product_id+`', '`+code_url+`', '`+name+`', '`+image+`', `+qty+`, '`+price+`', '`+unit+`', '`+sku+`', '`+vendor_sku+`', '`+vendor_id+`', '`+vendor_name+`', '`+vendor_email+`')">
										<i class="fa fa-exchange" aria-hidden="true"></i>
									</a>
								</div>
							</div>`;
		@endcan
		html += 		`</div>
					</div>`;

		$("#assign-modal .modal-content .modal-body").html(html);
		$("#assign-modal").modal('show');
		
	}

</script>
@endpush
