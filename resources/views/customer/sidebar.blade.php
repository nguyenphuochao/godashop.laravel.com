<aside class="col-md-3">
    <div class="inner-aside">
        @php
            $currentRouteName = Route::currentRouteName();
            $b = 100;
        @endphp
        <div class="category">
            <ul>
                <li class="{{$currentRouteName == "customer.show" ? "active": ""}}">
                    <a href="{{route('customer.show')}}" title="Thông tin tài khoản" target="_self">Thông tin tài khoản
                    </a>
                </li>
                <li class="{{$currentRouteName == "customer.address" ? "active": ""}}">
                    <a href="{{route('customer.address')}}" title="Địa chỉ giao hàng mặc định" target="_self">Địa chỉ giao hàng mặc định
                    </a>
                </li>
                <li class="{{in_array($currentRouteName,['customer.orders', 'orders.show']) ? "active": ""}}">
                    <a href="{{route('customer.orders')}}" target="_self">Đơn hàng của tôi
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>