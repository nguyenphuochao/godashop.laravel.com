@extends('admin.layout.app')
@section('content')
<div id="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
       <ol class="breadcrumb">
          <li class="breadcrumb-item active">Tổng quan</li>
       </ol>
       <div class="mb-3 my-3">
          <a href="#" class="active btn btn-primary">Hôm nay</a>
          <a href="#" class="btn btn-primary">Hôm qua</a>
          <a href="#" class="btn btn-primary">Tuần này</a>
          <a href="#" class="btn btn-primary">Tháng này</a>
          <a href="#" class="btn btn-primary">3 tháng</a>
          <a href="#" class="btn btn-primary">Năm này</a>
          <div class="dropdown" style="display:inline-block">
             <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
             <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <div style="margin:20px">
                   Từ ngày <input type="date" class="form-control" id="usr">
                   Đến ngày <input type="date" class="form-control" id="usr">
                   <br>
                   <input type="submit" value="Tìm" class="btn btn-primary form-control">
                </div>
             </div>
          </div>
       </div>
       <!-- Icon Cards-->
       <div class="row">
          <div class="col-xl-4 col-sm-6 mb-3">
             <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                   <div class="card-body-icon">
                      <i class="fas fa-fw fa-list"></i>
                   </div>
                   <div class="mr-5">{{$orders->count()}} Đơn hàng</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">Chi tiết</span>
                <span class="float-right">
                <i class="fas fa-angle-right"></i>
                </span>
                </a>
             </div>
          </div>
          <div class="col-xl-4 col-sm-6 mb-3">
             <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                   <div class="card-body-icon">
                      <i class="fas fa-fw fa-shopping-cart"></i>
                   </div>
                   @php
                       $revenue = 0;
                       $cancel_order = 0;
                       foreach($orders as $order){
                          if($order->order_status_id == 6) {
                           $cancel_order++;
                          }
                          else {
                           $revenue += $order->payment_total;
                          }
                           
                       }
                   @endphp
                   <div class="mr-5">Doanh thu {{number_format($revenue)}} đ</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">Chi tiết</span>
                <span class="float-right">
                <i class="fas fa-angle-right"></i>
                </span>
                </a>
             </div>
          </div>
          <div class="col-xl-4 col-sm-6 mb-3">
             <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                   <div class="card-body-icon">
                      <i class="fas fa-fw fa-life-ring"></i>
                   </div>
                   <div class="mr-5">{{$cancel_order}} đơn hàng bị hủy</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">Chi tiết</span>
                <span class="float-right">
                <i class="fas fa-angle-right"></i>
                </span>
                </a>
             </div>
          </div>
       </div>
       <!-- DataTables Example -->
       <div class="card mb-3">
          <div class="card-header">
             <i class="fas fa-table"></i>
             Đơn hàng
          </div>
          <div class="card-body">
             <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                      <tr>
                         <th>Mã</th>
                         <th>Tên khách hàng</th>
                         <th>Điện thoai</th>
                         <th>Email</th>
                         <th>Trạng Thái</th>
                         <th>Ngày đặt hàng</th>
                         <th>Phương thức thanh toán</th>
                         <th>Người nhận</th>
                         <th>Số điện thoại nhận</th>
                         <th>Ngày giao hàng</th>
                         <th>Phí giao hàng</th>
                         <th>Tạm tính</th>
                         <th>Tổng cộng</th>
                         <th>Địa chỉ giao hàng</th>
                         <th>Nhân viên phụ trách</th>
                         <th></th>
                         <th></th>
                         <th></th>
                      </tr>
                   </thead>
                   <tbody>
                      @foreach ($orders as $order)
                      <tr>
                        <td >#{{$order->id}}</td>
                        <td>{{$order->customer->name}}</td>
                        <td>{{$order->customer->mobile}}</td>
                        <td>{{$order->customer->email}}</td>
                        <td>{{$order->status->description}}</td>
                        <td>{{$order->created_date}} </td>
                        <td>{{$order->payment_method == 0 ? 'COD': 'Bank'}}</td>
                        <td>{{$order->shipping_fullname}}</td>
                        <td>{{$order->shipping_mobile}}</td>
                        <td>{{$order->delivered_date}}</td>

                        <td>{{number_format($order->shipping_fee)}}đ</td>
                        <td>{{number_format($order->sub_total)}}đ</td>
                        <td>{{number_format($order->payment_total)}}đ</td>
                        <td>{{$order->shipping_housenumber_street}}, {{$order->ward->name}}, {{$order->ward->district->name}}, {{$order->ward->district->province->name}}</td>
                        <td >{{!empty($order->staff) ? $order->staff->name: ''}}</td>
                        <td > <input type="button" onclick="Confirm('1');" value="Xác nhận" class="btn btn-primary btn-sm"></td>
                        <td > <input type="button" onclick="Edit('1');" value="Sửa" class="btn btn-warning btn-sm"></td>
                        <td > <input type="button" onclick="Delete('1');" value="Xóa" class="btn btn-danger btn-sm"></td>
                     </tr>
                      @endforeach
                      
                      
                   </tbody>
                </table>
             </div>
          </div>
       </div>
    </div>
</div>
 @endsection
