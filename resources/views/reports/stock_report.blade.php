@extends('layouts.app')

@section('content')

    <div class="pad-all text-center">
        <form class="" action="{{ route('stock_report.index') }}" method="GET">
            <div class="box-inline mar-btm pad-rgt">
                 {{ translate('Sort by Category') }}:
                 <div class="select">
                     <select id="demo-ease" class="demo-select2" name="category_id" required>
                         @foreach (\App\Category::all() as $key => $category)
                             <option value="{{ $category->id }}">{{ __($category->name) }}</option>
                         @endforeach
                     </select>
                 </div>
            </div>
            <button class="btn btn-default" type="submit">{{ translate('Filter') }}</button>
        </form>
    </div>


    <div class="col-md-offset-2 col-md-8">
        <div class="panel">
            <!--Panel heading-->
            <div class="panel-heading">
                <h3 class="panel-title">{{ translate('Product wise stock report') }}</h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>{{ translate('Product Name') }}</th>
                                <th>{{ translate('Stock') }}</th>
                                <th>{{ translate('Amount') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                                @php
                                    $qty = 0;
                                    if ($product->variant_product) {
                                        foreach ($product->stocks as $key => $stock) {
                                            $qty += $stock->qty;
                                        }
                                    }
                                    else {
                                        $qty = $product->current_stock;
                                    }
                                @endphp
                                <tr>
                                    <td>{{ __($product->name) }}</td>
                                    <td>{{ $qty }}</td>
                                    <td>{{ __($product->purchase_price) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
