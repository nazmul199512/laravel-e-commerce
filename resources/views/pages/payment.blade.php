@extends('layout')

@section('content')


    <section id="cart_items">
        <div class="container col-sm-12">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <?php
                $contents=Cart::content();

                ?>
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Image</td>
                        <td class="description">Name</td>


                        <td class="total">Total</td>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($contents as $v_contents) {?>
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{URL::to($v_contents->options->image)}}" height="80px" width="80px" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$v_contents->name}}</a></h4>

                        </td>




                        <td class="cart_total">
                            <p class="cart_total_price">{{$v_contents->total}} BDT</p>
                        </td>

                    </tr>
                    <?php }?>

                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->
    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
            </div>
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Payment method</li>
                </ol>
            </div>
            <div class="paymentCont col-sm-8">
                <div class="headingWrap">
                    <h3 class="headingTop text-center">Select Your Payment Method</h3>
                    <p class="text-center"></p>
                </div>




                        <form action="{{url('/order-place')}}" method="post">
                            {{ csrf_field() }}
                           <h4><input type="radio" name="payment_method" value="handcash"><strong> Hand Cash </strong><br></h4>
                           <h4><input type="radio" name="payment_method" value="cart"><strong> Debit Card</strong>  <br></h4>
                          <h4><input type="radio" name="payment_method" value="paypal"><strong> PayPal</strong>  <br></h4>
                            <input type="submit" class="btn btn-success"  name="" value="Done" style="width: 80px">

                        </form>


                    </div>
                </div>






    </section><!--/#do_action-->
    @endsection
