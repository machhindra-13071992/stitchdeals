<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductStock;
use App\Category;
use App\Size;
use App\Language;
use Auth;
use App\SubSubCategory;
use Session;
use ImageOptimizer;
use DB;
use CoreComponentRepository;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_products(Request $request)
    {
        //CoreComponentRepository::instantiateShopRepository();

        $type = 'In House';
        $col_name = null;
        $query = null;
        $sort_search = null;

        $products = Product::where('added_by', 'admin');

        if ($request->type != null){
            $var = explode(",", $request->type);
            $col_name = $var[0];
            $query = $var[1];
            $products = $products->orderBy($col_name, $query);
            $sort_type = $request->type;
        }
        if ($request->search != null){
            $products = $products
                        ->where('name', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }

        $products = $products->where('digital', 0)->orderBy('created_at', 'desc')->paginate(15);

        return view('products.index', compact('products','type', 'col_name', 'query', 'sort_search'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function seller_products(Request $request)
    {
        $col_name = null;
        $query = null;
        $seller_id = null;
        $sort_search = null;
        $products = Product::where('added_by', 'seller');
        if ($request->has('user_id') && $request->user_id != null) {
            $products = $products->where('user_id', $request->user_id);
            $seller_id = $request->user_id;
        }
        if ($request->search != null){
            $products = $products
                        ->where('name', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }
        if ($request->type != null){
            $var = explode(",", $request->type);
            $col_name = $var[0];
            $query = $var[1];
            $products = $products->orderBy($col_name, $query);
            $sort_type = $request->type;
        }

        $products = $products->orderBy('created_at', 'desc')->paginate(15);
        $type = 'Seller';

        return view('products.index', compact('products','type', 'col_name', 'query', 'seller_id', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();

        $product = new Product;
        $product->name = $request->name;
        $product->added_by = $request->added_by;
        if(Auth::user()->user_type == 'seller'){
            $product->user_id = Auth::user()->id;
        }
        else{
            $product->user_id = \App\User::where('user_type', 'admin')->first()->id;
        }
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->subsubcategory_id = $request->subsubcategory_id;
        $product->brand_id = $request->brand_id;
        $product->current_stock = $request->current_stock;
        $product->barcode = $request->barcode;
        $product->meta_keyword = $request->meta_keyword;
        $size_options = array();
        $size_array = array();
        //$product->sizes = implode('|',$request->size_id);
        if($request->has('size_id') && count($request->size_id) > 0){
            if($request->has('across_shoulder') && count($request->across_shoulder) > 0){
                $size_options[] = $request->across_shoulder;
            }
            if($request->has('back_rise') && count($request->back_rise) > 0){
                $size_options[] = $request->back_rise;
            }
            if($request->has('bottom') && count($request->bottom) > 0){
                $size_options[] = $request->bottom;
            }
            if($request->has('bust') && count($request->bust) > 0){
                $size_options[] = $request->bust;
            }
            if($request->has('chest') && count($request->chest) > 0){
                $size_options[] = $request->chest;
            }
            if($request->has('front_length_bottom') && count($request->front_length_bottom) > 0){
                $size_options[] = $request->front_length_bottom;
            }
            if($request->has('front_length_top') && count($request->front_length_top) > 0){
                $size_options[] = $request->front_length_bottom;
            }
            if($request->has('front_rise') && count($request->front_rise) > 0){
                $size_options[] = $request->front_length_bottom;
            }
            if($request->has('hip') && count($request->hip) > 0){
                $size_options[] = $request->hip;
            }
            if($request->has('inseam') && count($request->inseam) > 0){
                $size_options[] = $request->inseam;
            }
            if($request->has('sleeve_length') && count($request->sleeve_length) > 0){
                $size_options[] = $request->sleeve_length;
            }
            if($request->has('thai') && count($request->thai) > 0){
                $size_options[] = $request->thai;
            }
            if($request->has('waist') && count($request->waist) > 0){
                $size_options[] = $request->waist;
            }
            foreach ($request->size_id as $key => $size) {
                //$str = 'choice_options_'.$size;
                $item['size_id'] = $size;
                $item['values'] = $size_options[$key];
                array_push($size_array, $item);
            }
            //print_r(json_encode($size_array));
             //exit;
            $product->sizes = json_encode($size_array);
           //echo "sasA";
           
        }
        else {
            $sizes = array();
            $product->sizes = json_encode($sizes);
        }
        
        $size_heading = array();
        if(!is_array($request->size_heading)){
            $size_heading = explode(',', $request->size_heading[0]);
            $product->size_heading = json_encode($size_heading);
        }else{
            $product->size_heading = json_encode(array_values($request->size_heading));
        }
        
        $product->designdetails = $request->designdetails;
        $product->sizefits = $request->sizefits;
        $product->fabriccare = $request->fabriccare;
        
        $product->specifproducttype = $request->specifproducttype;
        $product->speciffabrictype = $request->speciffabrictype;
        $product->specifweave = $request->specifweave;
        $product->specifborder = $request->specifborder;
        $product->specifoccasion = $request->specifoccasion;
        $product->specifwash = $request->specifwash;
        $product->speciffabric = $request->speciffabric;
        $product->specifblousefabric = $request->specifblousefabric;
        $product->specifdupattafabric = $request->specifdupattafabric;
        $product->specifbottomfabric = $request->specifbottomfabric;
        $product->specifsleevelength = $request->specifsleevelength;
        $product->specifneck = $request->specifneck;
        $product->specifbottomshape = $request->specifbottomshape;
        $product->specifstylecode = $request->specifstylecode;
        
        
         //echo "sdasd";

        if ($refund_request_addon != null && $refund_request_addon->activated == 1) {
            if ($request->refundable != null) {
                $product->refundable = 1;
            }
            else {
                $product->refundable = 0;
            }
        }

        $photos = array();

        if($request->hasFile('photos')){
            foreach ($request->photos as $key => $photo) {
                $path = $photo->store('uploads/products/photos');
                array_push($photos, $path);
                //ImageOptimizer::optimize(base_path('public/').$path);
            }
            $product->photos = json_encode($photos);
        }

        if($request->hasFile('thumbnail_img')){
            $product->thumbnail_img = $request->thumbnail_img->store('uploads/products/thumbnail');
            //ImageOptimizer::optimize(base_path('public/').$product->thumbnail_img);
        }

        $product->unit = $request->unit;
        $product->min_qty = $request->min_qty;
        $product->tags = implode('|',$request->tags);
        $product->description = $request->description;
        $product->video_provider = $request->video_provider;
        $product->video_link = $request->video_link;
        $product->unit_price = $request->unit_price;
        $product->purchase_price = $request->purchase_price;
        $product->tax = $request->tax;
        $product->tax_type = $request->tax_type;
        $product->discount = $request->discount;
        $product->discount_type = $request->discount_type;
        $product->shipping_type = $request->shipping_type;

        if ($request->has('shipping_type')) {
            if($request->shipping_type == 'free'){
                $product->shipping_cost = 0;
            }
            elseif ($request->shipping_type == 'flat_rate') {
                $product->shipping_cost = $request->flat_shipping_cost;
            }
        }
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;

        if($request->hasFile('meta_img')){
            $product->meta_img = $request->meta_img->store('uploads/products/meta');
            //ImageOptimizer::optimize(base_path('public/').$product->meta_img);
        } else {
            $product->meta_img = $product->thumbnail_img;
        }

        if($product->meta_title == null) {
            $product->meta_title = $product->name;
        }

        if($product->meta_description == null) {
            $product->meta_description = $product->description;
        }

        if($request->hasFile('pdf')){
            $product->pdf = $request->pdf->store('uploads/products/pdf');
        }

        $product->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);

        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $product->colors = json_encode($request->colors);
        }
        else {
            $colors = array();
            $product->colors = json_encode($colors);
        }

        $choice_options = array();

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $str = 'choice_options_'.$no;
                $item['attribute_id'] = $no;
                if(!is_array($request[$str])){
                    $item['values'] = explode(  ',', implode('|', $request[$str]));
                }else{    
                    $item['values'] = $request[$str];
                }
                array_push($choice_options, $item);
            }
        }

        if (!empty($request->choice_no)) {
            $product->attributes = json_encode($request->choice_no);
        }
        else {
            $product->attributes = json_encode(array());
        }

        $product->choice_options = json_encode($choice_options);

        //$variations = array();

        $product->save();
        $home_discounted_base_price = backend_discounted_base_price($product->id);
        \App\Product::where('id','=',$product->id)->update(['discount_price'=>$home_discounted_base_price]);
        //combinations start
        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                if(isset($request[$name])){
                    if(!is_array($request[$name])){
                        $my_str = implode('|', $request[$name]);
                        array_push($options, explode(',', $my_str));
                    }else{    
                        array_push($options,$request[$name]);
                    }
                }
            }
        }

        //Generates the combinations of customer choice options
        $combinations = combinations($options);
        /*dd($combinations);*/
        if(count($combinations[0]) > 0){
            $product->variant_product = 1;
            foreach ($combinations as $key => $combination){
                $str = '';
                foreach ($combination as $key => $item){
                    if($key > 0 ){
                        $str .= '-'.str_replace(' ', '', $item);
                    }
                    else{
                        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
                            $color_name = \App\Color::where('code', $item)->first()->name;
                            $str .= $color_name;
                        }
                        else{
                            $str .= str_replace(' ', '', $item);
                        }
                    }
                }
                // $item = array();
                // $item['price'] = $request['price_'.str_replace('.', '_', $str)];
                // $item['sku'] = $request['sku_'.str_replace('.', '_', $str)];
                // $item['qty'] = $request['qty_'.str_replace('.', '_', $str)];
                // $variations[$str] = $item;

                $product_stock = ProductStock::where('product_id', $product->id)->where('variant', $str)->first();
                if($product_stock == null){
                    $product_stock = new ProductStock;
                    $product_stock->product_id = $product->id;
                }

                $product_stock->variant = $str;
                $product_stock->price = $request['price_'.str_replace('.', '_', $str)];
                $product_stock->sku = $request['sku_'.str_replace('.', '_', $str)];
                $product_stock->qty = $request['qty_'.str_replace('.', '_', $str)];
                $product_stock->save();
            }
        }
        //combinations end

        foreach (Language::all() as $key => $language) {
            $data = openJSONFile($language->code);
            $data[$product->name] = $product->name;
            saveJSONFile($language->code, $data);
        }

	    $product->save();

        flash(translate('Product has been inserted successfully'))->success();
        if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff'){
            return redirect()->route('products.admin');
        }
        else{
            if(\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated){
                $seller = Auth::user()->seller;
                $seller->remaining_uploads -= 1;
                $seller->save();
            }
            return redirect()->route('seller.products');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admin_product_edit($id)
    {
        //print_r($product);
        $product = Product::findOrFail(decrypt($id));
        $tags = json_decode($product->tags);
        $categories = Category::all();
        //$Sizes = \App\Size::all();
        //print_r($Sizes);
        return view('products.edit', compact('product', 'categories', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function seller_product_edit($id)
    {
        $product = Product::findOrFail(decrypt($id));
        $tags = json_decode($product->tags);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->subsubcategory_id = $request->subsubcategory_id;
        $product->brand_id = $request->brand_id;
        $product->current_stock = $request->current_stock;
        $product->barcode = $request->barcode;
        $product->meta_keyword = $request->meta_keyword;
        $size_options = array();
        $size_array = array();
        //$product->sizes = implode('|',$request->size_id);
        if($request->has('size_id') && count($request->size_id) > 0){
            if($request->has('across_shoulder') && count($request->across_shoulder) > 0){
                $size_options[] = $request->across_shoulder;
            }
            if($request->has('back_rise') && count($request->back_rise) > 0){
                $size_options[] = $request->back_rise;
            }
            if($request->has('bottom') && count($request->bottom) > 0){
                $size_options[] = $request->bottom;
            }
            if($request->has('bust') && count($request->bust) > 0){
                $size_options[] = $request->bust;
            }
            if($request->has('chest') && count($request->chest) > 0){
                $size_options[] = $request->chest;
            }
            if($request->has('front_length_bottom') && count($request->front_length_bottom) > 0){
                $size_options[] = $request->front_length_bottom;
            }
            if($request->has('front_length_top') && count($request->front_length_top) > 0){
                $size_options[] = $request->front_length_bottom;
            }
            if($request->has('front_rise') && count($request->front_rise) > 0){
                $size_options[] = $request->front_length_bottom;
            }
            if($request->has('hip') && count($request->hip) > 0){
                $size_options[] = $request->hip;
            }
            if($request->has('inseam') && count($request->inseam) > 0){
                $size_options[] = $request->inseam;
            }
            if($request->has('sleeve_length') && count($request->sleeve_length) > 0){
                $size_options[] = $request->sleeve_length;
            }
            if($request->has('thai') && count($request->thai) > 0){
                $size_options[] = $request->thai;
            }
            if($request->has('waist') && count($request->waist) > 0){
                $size_options[] = $request->waist;
            }
            foreach ($request->size_id as $key => $size) {
                //$str = 'choice_options_'.$size;
                //print_r($size_options);
                //exit;
                if(isset($size_options[$key])){
                    $item['size_id'] = $size;
                    $item['values'] = $size_options[$key];
                    array_push($size_array, $item);
                }
            }
            //print_r(json_encode($size_array));
             //exit;
            $product->sizes = json_encode($size_array);
           
        }
        else {
            $sizes = array();
            $product->sizes = json_encode($sizes);
        }
        
        
        $size_heading = array();
        
        if(!is_array($request->size_heading)){
            $size_heading = explode(',', $request->size_heading[0]);
            $product->size_heading = json_encode($size_heading);
        }else{
            $product->size_heading = json_encode(array_values($request->size_heading));
        }
       
        $product->designdetails = $request->designdetails;
        $product->sizefits = $request->sizefits;
        $product->fabriccare = $request->fabriccare;
        
        $product->specifproducttype = $request->specifproducttype;
        $product->speciffabrictype = $request->speciffabrictype;
        $product->specifweave = $request->specifweave;
        $product->specifborder = $request->specifborder;
        $product->specifoccasion = $request->specifoccasion;
        $product->specifwash = $request->specifwash;
        $product->speciffabric = $request->speciffabric;
        $product->specifblousefabric = $request->specifblousefabric;
        $product->specifdupattafabric = $request->specifdupattafabric;
        $product->specifbottomfabric = $request->specifbottomfabric;
        $product->specifsleevelength = $request->specifsleevelength;
        $product->specifneck = $request->specifneck;
        $product->specifbottomshape = $request->specifbottomshape;
        $product->specifstylecode = $request->specifstylecode;
       

        if ($refund_request_addon != null && $refund_request_addon->activated == 1) {
            if ($request->refundable != null) {
                $product->refundable = 1;
            }
            else {
                $product->refundable = 0;
            }
        }

        if($request->has('previous_photos')){
            $photos = $request->previous_photos;
        }
        else{
            $photos = array();
        }

        if($request->hasFile('photos')){
            foreach ($request->photos as $key => $photo) {
                $path = $photo->store('uploads/products/photos');
                array_push($photos, $path);
                //ImageOptimizer::optimize(base_path('public/').$path);
            }
        }
        $product->photos = json_encode($photos);

        $product->thumbnail_img = $request->previous_thumbnail_img;
        if($request->hasFile('thumbnail_img')){
            $product->thumbnail_img = $request->thumbnail_img->store('uploads/products/thumbnail');
            //ImageOptimizer::optimize(base_path('public/').$product->thumbnail_img);
        }

        $product->unit = $request->unit;
        $product->min_qty = $request->min_qty;
        $product->tags = implode('|',$request->tags);
        $product->description = $request->description;
        $product->video_provider = $request->video_provider;
        $product->video_link = $request->video_link;
        $product->unit_price = $request->unit_price;
        $product->purchase_price = $request->purchase_price;
        $product->tax = $request->tax;
        $product->tax_type = $request->tax_type;
        $product->discount = $request->discount;
        $product->shipping_type = $request->shipping_type;
        if ($request->has('shipping_type')) {
            if($request->shipping_type == 'free'){
                $product->shipping_cost = 0;
            }
            elseif ($request->shipping_type == 'flat_rate') {
                $product->shipping_cost = $request->flat_shipping_cost;
            }
        }
        $product->discount_type = $request->discount_type;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;

        $product->meta_img = $request->previous_meta_img;
        if($request->hasFile('meta_img')){
            $product->meta_img = $request->meta_img->store('uploads/products/meta');
            //ImageOptimizer::optimize(base_path('public/').$product->meta_img);
        }

        if($product->meta_title == null) {
            $product->meta_title = $product->name;
        }

        if($product->meta_description == null) {
            $product->meta_description = $product->description;
        }

        if($request->hasFile('pdf')){
            $product->pdf = $request->pdf->store('uploads/products/pdf');
        }

        $product->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.substr($product->slug, -5);

        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $product->colors = json_encode($request->colors);
        }
        else {
            $colors = array();
            $product->colors = json_encode($colors);
        }

        $choice_options = array();

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $str = 'choice_options_'.$no;
                $item['attribute_id'] = $no;
                if(!is_array($request[$str])){
                    $item['values'] = explode(',', implode('|', $request[$str]));
                }else{    
                    $item['values'] = $request[$str];
                }
                array_push($choice_options, $item);
            }
        }

        if($product->attributes != json_encode($request->choice_attributes)){
            foreach ($product->stocks as $key => $stock) {
                $stock->delete();
            }
        }

        if (!empty($request->choice_no)) {
            $product->attributes = json_encode($request->choice_no);
        }
        else {
            $product->attributes = json_encode(array());
        }

        $product->choice_options = json_encode($choice_options);

        foreach (Language::all() as $key => $language) {
            $data = openJSONFile($language->code);
            unset($data[$product->name]);
            $data[$request->name] = "";
            saveJSONFile($language->code, $data);
        }

        //combinations start
        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                if(!is_array($request[$name])){
                    $my_str = implode('|', $request[$name]);
                    array_push($options, explode(',', $my_str));
                }else{    
                    array_push($options,$request[$name]);
                }
            }
        }

        $combinations = combinations($options);
        if(count($combinations[0]) > 0){
            $product->variant_product = 1;
            ProductStock::where('product_id',$product->id)->delete();
            foreach ($combinations as $key => $combination){
                $str = '';
                foreach ($combination as $key => $item){
                    if($key > 0 ){
                        $str .= '-'.str_replace(' ', '', $item);
                    }
                    else{
                        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
                            $color_name = \App\Color::where('code', $item)->first()->name;
                            $str .= $color_name;
                        }
                        else{
                            $str .= str_replace(' ', '', $item);
                        }
                    }
                }
                
                $product_stock = ProductStock::where('product_id', $product->id)->where('variant', $str)->first();
                if($product_stock == null){
                    $product_stock = new ProductStock;
                    $product_stock->product_id = $product->id;
                }

                $product_stock->variant = $str;
                $product_stock->price = $request['price_'.str_replace('.', '_', $str)];
                $product_stock->sku = $request['sku_'.str_replace('.', '_', $str)];
                $product_stock->qty = $request['qty_'.str_replace('.', '_', $str)];

                $product_stock->save();
            }
        }

        $product->save();
        $home_discounted_base_price = backend_discounted_base_price($product->id);
        \App\Product::where('id','=',$product->id)->update(['discount_price'=>$home_discounted_base_price]);
        flash(translate('Product has been updated successfully'))->success();
        $previousUrl = $request->only('redirects_to');
        if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff'){
            //return redirect()->route('products.admin');
            return redirect()->to($previousUrl['redirects_to'])->with('success', 'Product has been updated successfully');
        }
        else{
            return redirect()->route('seller.products');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if(Product::destroy($id)){
            foreach (Language::all() as $key => $language) {
                $data = openJSONFile($language->code);
                unset($data[$product->name]);
                saveJSONFile($language->code, $data);
            }
            flash(translate('Product has been deleted successfully'))->success();
            if(Auth::user()->user_type == 'admin'){
                return redirect()->route('products.admin');
            }
            else{
                return redirect()->route('seller.products');
            }
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    /**
     * Duplicates the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function duplicate($id)
    {
        $product = Product::find($id);
        $product_new = $product->replicate();
        $product_new->slug = substr($product_new->slug, 0, -5).Str::random(5);

        if($product_new->save()){
            flash(translate('Product has been duplicated successfully'))->success();
            if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff'){
                return redirect()->route('products.admin');
            }
            else{
                return redirect()->route('seller.products');
            }
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    public function get_products_by_subsubcategory(Request $request)
    {
        $products = Product::where('subsubcategory_id', $request->subsubcategory_id)->get();
        return $products;
    }

    public function get_products_by_brand(Request $request)
    {
        $products = Product::where('brand_id', $request->brand_id)->get();
        return view('partials.product_select', compact('products'));
    }

    public function updateTodaysDeal(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->todays_deal = $request->status;
        if($product->save()){
            return 1;
        }
        return 0;
    }

    public function updatePublished(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->published = $request->status;

        if($product->added_by == 'seller' && \App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated){
            $seller = $product->user->seller;
            if($seller->invalid_at != null && Carbon::now()->diffInDays(Carbon::parse($seller->invalid_at), false) <= 0){
                return 0;
            }
        }

        $product->save();
        return 1;
    }

    public function updateFeatured(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->featured = $request->status;
        if($product->save()){
            return 1;
        }
        return 0;
    }

    public function sku_combination(Request $request)
    {
        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }
        else {
            $colors_active = 0;
        }

        $unit_price = $request->unit_price;
        $product_name = $request->name;

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                if(isset($request[$name])){
                    if(!is_array($request[$name])){
                        $my_str = implode('|', $request[$name]);
                        array_push($options, explode(',', $my_str));
                    }else{    
                        array_push($options,$request[$name]);
                    }
                }   
            }
        }

        $combinations = combinations($options);
        return view('partials.sku_combinations', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
    }

    public function sku_combination_edit(Request $request)
    {
        $product = Product::findOrFail($request->id);

        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }
        else {
            $colors_active = 0;
        }

        $product_name = $request->name;
        $unit_price = $request->unit_price;

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                if(isset($request[$name])){
                    if(!is_array($request[$name])){
                        $my_str = implode('|', $request[$name]);
                        array_push($options, explode(',', $my_str));
                    }else{    
                        array_push($options,$request[$name]);
                    }
                }
            }
        }
        $combinations = combinations($options);
        return view('partials.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
    }

}
