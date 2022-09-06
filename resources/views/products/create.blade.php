@extends('layouts.app')

@section('content')
<style>
ul.specification-list {
    list-style: none;
    padding-left: 0;
    display: flex;
    flex-wrap: wrap;
    margin: 0;
}

ul.specification-list>li {
    width: 23%;
    flex-basis: 23%;
    margin: 5px;
}
</style>
<div>
    <h1 class="page-header text-overflow">{{ translate('Add New Product') }}</h1>
</div>
<div class="row">
	<div class="col-lg-8 col-lg-offset-2">
		<form class="form form-horizontal mar-top" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" id="choice_form">
			@csrf
			<input type="hidden" name="added_by" value="admin">
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Product Information')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Product Name')}}</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="name" placeholder="{{ translate('Product Name') }}" onchange="update_sku()" required>
						</div>
					</div>
					<div class="form-group" id="category">
						<label class="col-lg-2 control-label">{{translate('Category')}}</label>
						<div class="col-lg-7">
							<select class="form-control demo-select2-placeholder" name="category_id" id="category_id" required>
								@foreach($categories as $category)
									<option value="{{$category->id}}">{{__($category->name)}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group" id="subcategory">
						<label class="col-lg-2 control-label">{{translate('Subcategory')}}</label>
						<div class="col-lg-7">
							<select class="form-control demo-select2-placeholder" name="subcategory_id" id="subcategory_id" required>

							</select>
						</div>
					</div>
					<div class="form-group" id="subsubcategory">
						<label class="col-lg-2 control-label">{{translate('Sub Subcategory')}}</label>
						<div class="col-lg-7">
							<select class="form-control demo-select2-placeholder" name="subsubcategory_id" id="subsubcategory_id">

							</select>
						</div>
					</div>
					<div class="form-group" id="brand">
						<label class="col-lg-2 control-label">{{translate('Brand')}}</label>
						<div class="col-lg-7">
							<select class="form-control demo-select2-placeholder" name="brand_id" id="brand_id">
								<option value="">{{ ('Select Brand') }}</option>
								@foreach (\App\Brand::all() as $brand)
									<option value="{{ $brand->id }}">{{ $brand->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Unit')}}</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="unit" placeholder="{{ translate('Unit (e.g. KG, Pc etc)') }}" required>
						</div>
					</div>
                    <div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Minimum Qty')}}</label>
						<div class="col-lg-7">
							<input type="number" class="form-control" name="min_qty" value="1" min="1" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Tags')}}</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="tags[]" placeholder="{{ translate('Type to add a tag') }}" data-role="tagsinput">
						</div>
					</div>
					<div class="form-group">
                        <label class="col-lg-2 control-label">{{translate('Size Heading')}}</label>
                        <div class="col-lg-7">
                            <!-- <input type="text" class="form-control" name="size_heading[]" id="size_heading" value="" placeholder="{{ translate('Type to add size heading') }}" data-role="tagsinput"> -->
                        	<select class="form-control demo-select2-size" name="size_heading[]" id="size_heading_id" multiple>
								@foreach (\App\Psize::orderBy('name', 'asc')->get() as $key => $psize)
									<option value='{{ $psize->name }}'>{{ $psize->name }}</option>
								@endforeach
							</select>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Select Sizes')}}</label>
						<div class="col-lg-7">
							<select class="form-control demo-select2-size" name="size_id[]" id="size_id" multiple>
                                @foreach (\App\Size::orderBy('name', 'asc')->get() as $key => $size)
									<option value="{{ $size->id }}" >{{ $size->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="size-group-conatiner" id="size-options">
					    
					</div>
					@php
					    $pos_addon = \App\Addon::where('unique_identifier', 'pos_system')->first();
					@endphp
					@if ($pos_addon != null && $pos_addon->activated == 1)
						<div class="form-group">
							<label class="col-lg-2 control-label">{{translate('Barcode')}}</label>
							<div class="col-lg-7">
								<input type="text" class="form-control" name="barcode" placeholder="{{ translate('Barcode') }}">
							</div>
						</div>
					@endif

					@php
					    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
					@endphp
					@if ($refund_request_addon != null && $refund_request_addon->activated == 1)
						<div class="form-group">
							<label class="col-lg-2 control-label">{{translate('Refundable')}}</label>
							<div class="col-lg-7">
								<label class="switch" style="margin-top:5px;">
									<input type="checkbox" name="refundable" checked>
		                            <span class="slider round"></span></label>
								</label>
							</div>
						</div>
					@endif
				</div>
			</div>
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Product Images')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Gallery Images')}} </label>
						<div class="col-lg-7">
							<div id="photos">

							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Thumbnail Image')}} <small>(290x300)</small></label>
						<div class="col-lg-7">
							<div id="thumbnail_img">

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Product Videos')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Video Provider')}}</label>
						<div class="col-lg-7">
							<select class="form-control demo-select2-placeholder" name="video_provider" id="video_provider">
								<option value="youtube">{{translate('Youtube')}}</option>
								<option value="dailymotion">{{translate('Dailymotion')}}</option>
								<option value="vimeo">{{translate('Vimeo')}}</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Video Link')}}</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="video_link" placeholder="{{ translate('Video Link') }}">
						</div>
					</div>
				</div>
			</div>
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Product Variation')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<div class="col-lg-2">
							<input type="text" class="form-control" value="{{translate('Colors')}}" disabled>
						</div>
						<div class="col-lg-7">
							<select class="form-control color-var-select" name="colors[]" id="colors" multiple disabled>
								@foreach (\App\Color::orderBy('name', 'asc')->get() as $key => $color)
									<option value="{{ $color->code }}">{{ $color->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-lg-2">
							<label class="switch" style="margin-top:5px;">
								<input value="1" type="checkbox" name="colors_active">
								<span class="slider round"></span>
							</label>
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-2">
							<input type="text" class="form-control" value="{{translate('Attributes')}}" disabled>
						</div>
	                    <div class="col-lg-7">
	                        <select name="choice_attributes[]" id="choice_attributes" class="form-control demo-select2" multiple data-placeholder="{{ translate('Choose Attributes') }}">
								@foreach (\App\Attribute::all() as $key => $attribute)
									<option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
								@endforeach
	                        </select>
	                    </div>
	                </div>

					<div>
						<p>{{ translate('Choose the attributes of this product and then input values of each attribute') }}</p>
						<br>
					</div>

					<div class="customer_choice_options" id="customer_choice_options">

					</div>

					{{-- <div class="customer_choice_options" id="customer_choice_options">

					</div>
					<div class="form-group">
						<div class="col-lg-2">
							<button type="button" class="btn btn-info" onclick="add_more_customer_choice_option()">{{ translate('Add more customer choice option') }}</button>
						</div>
					</div> --}}
				</div>
			</div>
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Product price + stock')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Unit price')}}</label>
						<div class="col-lg-7">
							<input type="number" min="0" value="0" step="0.01" placeholder="{{ translate('Unit price') }}" name="unit_price" class="form-control" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Purchase price')}}</label>
						<div class="col-lg-7">
							<input type="number" min="0" value="0" step="0.01" placeholder="{{ translate('Purchase price') }}" name="purchase_price" class="form-control" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Tax')}}</label>
						<div class="col-lg-7">
							<input type="number" min="0" value="0" step="0.01" placeholder="{{ translate('Tax') }}" name="tax" class="form-control" required>
						</div>
						<div class="col-lg-1">
							<select class="demo-select2" name="tax_type">
								<option value="amount">{{translate('Flat')}}</option>
								<option value="percent">{{translate('Percent')}}</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Discount')}}</label>
						<div class="col-lg-7">
							<input type="number" min="0" value="0" step="0.01" placeholder="{{ translate('Discount') }}" name="discount" class="form-control" required>
						</div>
						<div class="col-lg-1">
							<select class="demo-select2" name="discount_type">
								<option value="amount">{{translate('Flat')}}</option>
								<option value="percent">{{translate('Percent')}}</option>
							</select>
						</div>
					</div>
					<div class="form-group" id="quantity">
						<label class="col-lg-2 control-label">{{translate('Quantity')}}</label>
						<div class="col-lg-7">
							<input type="number" min="0" value="0" step="1" placeholder="{{ translate('Quantity') }}" name="current_stock" class="form-control" required>
						</div>
					</div>
					<br>
					<div class="sku_combination" id="sku_combination">

					</div>
				</div>
			</div>
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Product Description')}}</h3>
				</div>
				<div class="panel-body">
					<!--<div class="form-group">
                        <label class="col-lg-2 control-label">{{translate('Description')}}</label>
                        <div class="col-lg-9">
                            <textarea class="editor" name="description"></textarea>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="col-lg-2 control-label">{{translate('Design Details')}}</label>
                        <div class="col-lg-9">
                            <textarea name="designdetails" rows="3" class="form-control editor" placelholder="Design Details"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">{{translate('Size & Fit')}}</label>
                        <div class="col-lg-9">
                            <textarea name="sizefits" rows="3" class="form-control editor" placelholder="Size & Fit"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">{{translate('Fabric & Care')}}</label>
                        <div class="col-lg-9">
                            <textarea name="fabriccare" rows="3" class="form-control editor" placelholder="Fabric & Care"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">{{translate('Product Specification')}}</label>
                        <div class="col-lg-9">
                            <ul class="specification-list">
                                <li><input type="text" class="form-control" name="specifproducttype" placeholder="Product type" /></li>
                                <li><input type="text" class="form-control" name="speciffabrictype" placeholder="Fabric type" /></li>
                                <li><input type="text" class="form-control" name="specifweave" placeholder="Weave" /></li>
                                <li><input type="text" class="form-control" name="specifborder" placeholder="Border" /></li>
                                <li><input type="text" class="form-control" name="specifoccasion" placeholder="Occasion" /></li>
                                <li><input type="text" class="form-control" name="specifwash" placeholder="Wash" /></li> 
                                <li><input type="text" class="form-control" name="speciffabric" placeholder="Fabric" /></li>
                                <li><input type="text" class="form-control" name="specifblousefabric" placeholder="Blouse Fabric" /></li>
                                <li><input type="text" class="form-control" name="specifdupattafabric" placeholder="Dupatta fabric" /></li>
                                <li><input type="text" class="form-control" name="specifbottomfabric" placeholder="Bottom fabric" /></li>
                                <li><input type="text" class="form-control" name="specifsleevelength" placeholder="Sleeve length" /></li>
                                <li><input type="text" class="form-control" name="specifneck" placeholder="Neck" /></li>
                                <li><input type="text" class="form-control" name="specifbottomshape" placeholder="Bottom Shape" /></li>
                                <li><input type="text" class="form-control" name="specifstylecode" placeholder="Style Code" /></li>
                                <!--<li><input type="text" class="form-control" name="specifblouse" placeholder="Blouse" /></li>
                                
                                <li><input type="text" class="form-control" name="specifproductwash" placeholder="Wash" /></li>
                                <li><input type="text" class="form-control" name="specifsareefabric" placeholder="Saree Fabric" /></li>
                                <li><input type="text" class="form-control" name="specifproductblouse" placeholder="Blouse" /></li>
                                <li><input type="text" class="form-control" name="specifproductblousefabric" placeholder="Blouse Fabric" /></li>-->
                                
                            </ul>
                            
                        </div>
                    </div>
				</div>
			</div>
            @if (\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'product_wise_shipping')
                <div class="panel">
    				<div class="panel-heading bord-btm">
    					<h3 class="panel-title">{{translate('Product Shipping Cost')}}</h3>
    				</div>
    				<div class="panel-body">
    					<div class="row bord-btm">
    						<div class="col-md-2">
    							<div class="panel-heading">
    								<h3 class="panel-title">{{translate('Free Shipping')}}</h3>
    							</div>
    						</div>
    						<div class="col-md-10">
    							<div class="form-group">
    								<label class="col-lg-2 control-label">{{translate('Status')}}</label>
    								<div class="col-lg-7">
    									<label class="switch" style="margin-top:5px;">
    										<input type="radio" name="shipping_type" value="free" checked>
    										<span class="slider round"></span>
    									</label>
    								</div>
    							</div>
    						</div>
    					</div>
    					<div class="row">
    						<div class="col-md-2">
    							<div class="panel-heading">
    								<h3 class="panel-title">{{translate('Flat Rate')}}</h3>
    							</div>
    						</div>
    						<div class="col-md-10">
    							<div class="form-group">
    								<label class="col-lg-2 control-label">{{translate('Status')}}</label>
    								<div class="col-lg-7">
    									<label class="switch" style="margin-top:5px;">
    										<input type="radio" name="shipping_type" value="flat_rate" checked>
    										<span class="slider round"></span>
    									</label>
    								</div>
    							</div>
    							<div class="form-group">
    								<label class="col-lg-2 control-label">{{translate('Shipping cost')}}</label>
    								<div class="col-lg-7">
    									<input type="number" min="0" value="0" step="0.01" placeholder="{{ translate('Shipping cost') }}" name="flat_shipping_cost" class="form-control" required>
    								</div>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
            @endif
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('PDF Specification')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('PDF Specification')}}</label>
						<div class="col-lg-7">
							<input type="file" class="form-control" placeholder="{{ translate('PDF') }}" name="pdf" accept="application/pdf">
						</div>
					</div>
				</div>
			</div>
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('SEO Meta Tags')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Meta Title')}}</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="meta_title" placeholder="{{ translate('Meta Title') }}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Description')}}</label>
						<div class="col-lg-7">
							<textarea name="meta_description" rows="8" class="form-control"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Keyword')}}</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="meta_keyword" placeholder="{{translate('Meta Keyword')}}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{ translate('Meta Image') }}</label>
						<div class="col-lg-7">
							<div id="meta_photo">

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="mar-all text-right">
				<button type="submit" name="button" class="btn btn-info">{{ translate('Add New Product') }}</button>
			</div>
		</form>
	</div>
</div>


@endsection

@section('script')

<script type="text/javascript">
	function add_more_customer_choice_option(i, name){
		/*$('#customer_choice_options').append('<div class="form-group"><div class="col-lg-2"><input type="hidden" name="choice_no[]" value="'+i+'"><input type="text" class="form-control" name="choice[]" value="'+name+'" readonly></div><div class="col-lg-7"><input type="text" class="form-control" name="choice_options_'+i+'[]" placeholder="{{ translate('Enter choice values') }}" data-role="tagsinput" onchange="update_sku()"></div><div class="col-lg-2"><button onclick="delete_row(this)" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button></div></div>');*/
		var size_options = "";
		@foreach (\App\Psize::orderBy('name', 'asc')->get() as $key => $psize)
		size_options += '<option value={{ $psize->name }}>{{ $psize->name }}</option>'
		@endforeach
		$('#customer_choice_options').append('<div class="form-group"><div class="col-lg-2"><input type="hidden" name="choice_no[]" value="'+i+'"><input type="text" class="form-control" name="choice[]" value="'+name+'" readonly></div><div class="col-lg-7"><select name="choice_options_'+i+'[]" id="choice_attributes" onchange="update_sku()" class="form-control demo-select2" multiple="">'+size_options+'</select></div></div>');
		$("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
		$('.demo-select2').select2();
	}

	$('input[name="colors_active"]').on('change', function() {
	    if(!$('input[name="colors_active"]').is(':checked')){
			$('#colors').prop('disabled', true);
		}
		else{
			$('#colors').prop('disabled', false);
		}
		update_sku();
	});

	$('#colors').on('change', function() {
	    update_sku();
	});

	$('input[name="unit_price"]').on('keyup', function() {
	    update_sku();
	});

	$('input[name="name"]').on('keyup', function() {
	    update_sku();
	});

	function delete_row(em){
		$(em).closest('.form-group').remove();
		update_sku();
	}

	function update_sku(){
		$.ajax({
		   type:"POST",
		   url:'{{ route('products.sku_combination') }}',
		   data:$('#choice_form').serialize(),
		   success: function(data){
			   $('#sku_combination').html(data);
			   if (data.length > 1) {
				   $('#quantity').hide();
			   }
			   else {
					$('#quantity').show();
			   }
		   }
	   });
	}

	function get_subcategories_by_category(){
		var category_id = $('#category_id').val();
		$.post('{{ route('subcategories.get_subcategories_by_category') }}',{_token:'{{ csrf_token() }}', category_id:category_id}, function(data){
		    $('#subcategory_id').html(null);
		    for (var i = 0; i < data.length; i++) {
		        $('#subcategory_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		        $('.demo-select2').select2();
		    }
		    get_subsubcategories_by_subcategory();
		});
	}

	function get_subsubcategories_by_subcategory(){
		var subcategory_id = $('#subcategory_id').val();
		$.post('{{ route('subsubcategories.get_subsubcategories_by_subcategory') }}',{_token:'{{ csrf_token() }}', subcategory_id:subcategory_id}, function(data){
		    $('#subsubcategory_id').html(null);
			$('#subsubcategory_id').append($('<option>', {
				value: null,
				text: null
			}));
		    for (var i = 0; i < data.length; i++) {
		        $('#subsubcategory_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		        $('.demo-select2').select2();
		    }
		    //get_brands_by_subsubcategory();
			//get_attributes_by_subsubcategory();
		});
	}

	function get_brands_by_subsubcategory(){
		var subsubcategory_id = $('#subsubcategory_id').val();
		$.post('{{ route('subsubcategories.get_brands_by_subsubcategory') }}',{_token:'{{ csrf_token() }}', subsubcategory_id:subsubcategory_id}, function(data){
		    $('#brand_id').html(null);
		    for (var i = 0; i < data.length; i++) {
		        $('#brand_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		        $('.demo-select2').select2();
		    }
		});
	}

	function get_attributes_by_subsubcategory(){
		var subsubcategory_id = $('#subsubcategory_id').val();
		$.post('{{ route('subsubcategories.get_attributes_by_subsubcategory') }}',{_token:'{{ csrf_token() }}', subsubcategory_id:subsubcategory_id}, function(data){
		    $('#choice_attributes').html(null);
		    for (var i = 0; i < data.length; i++) {
		        $('#choice_attributes').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		    }
			$('.demo-select2').select2();
		});
	}
	

	$(document).ready(function(){
	    get_subcategories_by_category();
		$("#photos").spartanMultiImagePicker({
			fieldName:        'photos[]',
			maxCount:         10,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
		$("#thumbnail_img").spartanMultiImagePicker({
			fieldName:        'thumbnail_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
		$("#meta_photo").spartanMultiImagePicker({
			fieldName:        'meta_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
	});

	$('#category_id').on('change', function() {
	    get_subcategories_by_category();
	});

	$('#subcategory_id').on('change', function() {
	    
	    get_subsubcategories_by_subcategory();
	});

	$('#subsubcategory_id').on('change', function() {
	    // get_brands_by_subsubcategory();
		//get_attributes_by_subsubcategory();
	});

	$('.demo-select2-size').select2({
        maximumSelectionLength: 6
    });
	

	$('#choice_attributes').on('change', function() {
		$('#customer_choice_options').html(null);
		$.each($("#choice_attributes option:selected"), function(){
			//console.log($(this).val());
            add_more_customer_choice_option($(this).val(), $(this).text());
        });
		update_sku();
	});
	
    var sizeSelect = $("#size_id");
    sizeSelect.on("select2:select", function(event) {
        //debugger;
        var optionText = event.params.data.text;
        
        var x = optionText.replaceAll(' ', '_');
        var name = x.replace(/[{()}]/g, '').trim().toLowerCase();
        
        var options = '<div class="form-group" data="'+name+'"><label class="col-lg-2 control-label">'+optionText+' (Inches)</label><div class="col-lg-1"><input type="number" class="form-control" name="'+name+'[]" id="" value="" placeholder="XS" data-role="tagsinput"></div><div class="col-lg-1"><input type="number" class="form-control" name="'+name+'[]" id="" value="" placeholder="S" data-role="tagsinput"></div><div class="col-lg-1"><input type="number" class="form-control" name="'+name+'[]" id="" value="" placeholder="M" data-role="tagsinput"></div><div class="col-lg-1"><input type="number" class="form-control" name="'+name+'[]" id="" value="" placeholder="L" data-role="tagsinput"></div><div class="col-lg-1"><input type="number" class="form-control" name="'+name+'[]" id="" value="" placeholder="XL" data-role="tagsinput"></div><div class="col-lg-1"><input type="number" class="form-control" name="'+name+'[]" id="" value="" placeholder="XXL" data-role="tagsinput"></div><div class="col-lg-1"><input type="number" class="form-control" name="'+name+'[]" id="" value="" placeholder="XXXL" data-role="tagsinput"></div></div>';
        $('#size-options').append(options);
    });
    
    sizeSelect.on('select2:unselecting', function (event) {
        var item = event.params.args.data.text;
        var x = item.replaceAll(' ', '_');
        var name = x.replace(/[{()}]/g, '').trim().toLowerCase();
        $('#size-options').find('div[data="'+name+'"]').remove();
    });


</script>

@endsection
