
@extends('admin_layout')

@section('admin_content')

    <div id="content" class="span10">


        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="index.html">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="#">Orders</a></li>
        </ul>
        <p class="alert-success">
            <?php
            $message=Session::get('message');

            if($message){
                echo $message;
                Session::put('message',null);
            }

            ?>
        </p>

        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon user"></i><span class="break"></span>Orders</h2>

                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Phone Number</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Quantity</th>
                            <th>Product Receiver</th>

                            <th>Delivery Address</th>

                            <th>Order Total</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        @foreach(  $all_order_info as $order  )
                            <tbody>
                            <tr>
                                <td>{{$order->order_id}}</td>
                                <td class="center">{{$order->customer_name}}</td>
                                <td class="center">{{$order->shipping_mobile_number}}</td>
                                <td class="center">{{$order->product_name}}</td>
                                <td class="center">{{$order->product_price}}</td>
                                <td class="center">{{$order->product_sales_quantity}}</td>

                                <td class="center"> {{$order->shipping_first_name}} {{$order->shipping_last_name}}</td>
                                <td class="center">{{$order->shipping_address}}</td>
                                <td class="center">{{$order->order_total}}</td>
                                <td class="center">{{$order->order_status}}</td>
                               <!-- <td class="center">

                                </td>-->
                                <td class="center">
                                    @if($order->order_status == 'pending')
                                        <a class="btn btn-danger" href="{{URL::to('/inactive-order/'.$order->order_id)}}">
                                            <i class="halflings-icon white thumbs-down"></i>
                                        </a>
                                    @else

                                        <a class="btn btn-success" href="{{URL::to('/active-order/'.$order->order_id)}}">
                                            <i class="halflings-icon white thumbs-up"></i>
                                        </a>

                                    @endif


                                    <a class="btn btn-danger" href="{{URL::to('/delete-order/'.$order->order_id)}}" id="delete">
                                        <i class="halflings-icon white trash"></i>
                                    </a>
                                </td>
                            </tr>

                            </tbody>
                        @endforeach


                    </table>
                </div>
            </div><!--/span-->
        </div>
    </div><!--/row-->
@endsection
