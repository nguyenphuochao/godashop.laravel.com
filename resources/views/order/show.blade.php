@extends('layout.app')
@section('content')
<main id="maincontent" class="page-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-9">
                <ol class="breadcrumb">
                    <li><a href="/" target="_self">Trang chủ</a></li>
                    <li><span>/</span></li>
                    <li class="active"><span>Tài khoản</span></li>
                </ol>
            </div>
            <div class="clearfix"></div>
            @include('customer.sidebar')
            <div class="col-md-9 order-info">
                <div class="row">
                    <div class="col-xs-6">
                        <h4 class="home-title">Đơn hàng #{{$order->id}}</h4>
                    </div>
                    <div class="clearfix"></div>
                    <aside class="col-md-7 cart-checkout">
                        @foreach ($order->orderItems as $orderItem)
                        @php
                            $product = $orderItem->product;
                        @endphp
                        <div class="row">
                            <div class="col-xs-2">
                                <img class="img-responsive" src="../images/{{$product->featured_image}}" alt="{{$product->name}}"> 
                            </div>
                            <div class="col-xs-7">
                                @php
                                $prefixSlug =  \Str::slug($product->name);
                                $slug = "{$prefixSlug}-{$product->id}";
                                @endphp
                                <a class="product-name" href="{{route("product.show", ["slug" => $slug])}}" title="{{$product->name}}">{{$product->name}}</a>
                                <br>
                                <span>{{$orderItem->qty}}</span> x <span>{{number_format($orderItem->unit_price)}}₫</span>
                            </div>
                            <div class="col-xs-3 text-right">
                                <span>{{number_format($orderItem->total_price)}}₫</span>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                        
                        
                        <div class="row">
                            <div class="col-xs-6">
                                Tạm tính
                            </div>
                            <div class="col-xs-6 text-right">
                                {{number_format($order->price_total)}}₫
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                Giảm giá
                            </div>
                            <div class="col-xs-6 text-right">
                                -{{number_format($order->discount_amount)}}₫
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                Tổng tiền
                            </div>
                            <div class="col-xs-6 text-right">
                                {{number_format($order->sub_total)}}₫
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                VAT:
                            </div>
                            <div class="col-xs-6 text-right">
                                {{number_format($order->tax)}}₫
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                Tổng tiền bao gồm VAT:
                            </div>
                            <div class="col-xs-6 text-right">
                                {{number_format($order->price_inc_tax_total)}}₫
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                Voucher:
                            </div>
                            <div class="col-xs-6 text-right">
                                -{{number_format($order->voucher_amount)}}₫
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                Phí vận chuyển
                            </div>
                            <div class="col-xs-6 text-right">
                                {{number_format($order->shipping_fee)}}₫
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-6">
                                Tổng cộng
                            </div>
                            <div class="col-xs-6 text-right">
                                {{number_format($order->payment_total)}}₫
                            </div>
                        </div>
                    </aside>
                    <div class="ship-checkout col-md-5">
                        <h4>Thông tin giao hàng</h4>
                        <div>
                            Họ và tên: {{$order->shipping_fullname}}                           
                        </div>
                        <div>
                            Số điện thoại: {{$order->shipping_mobile}}                            
                        </div>
                        <div>
                            {{$order->ward->district->province->name}}                            
                        </div>
                        <div>
                            {{$order->ward->district->name}}                          
                        </div>
                        <div>
                            {{$order->ward->name}}                           
                        </div>
                        <div>
                            {{$order->shipping_housenumber_street}}                            
                        </div>
                        <div>
                            Phương thức thanh toán: {{$order->payment_method == 0 ? "COD": "Bank"}}                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
