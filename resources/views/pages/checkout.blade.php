@extends('layout')
@section('content')
    <section id="cart_items">
        <div class="container">

<!--/checkout-options-->

            <div class="register-req">
                <p>Please fill up this form</p>
            </div><!--/register-req-->

            <div class="shopper-informations">
                <div class="row">

                    <div class="col-sm-12 clearfix">
                        <div class="bill-to">
                            <p>Shipping details</p>
                            <div class="form-one">
                                <form method="post" action="{{url('/save-shipping')}}">
                                    {{ csrf_field() }}

                                    <input type="text" name="shipping_email" placeholder="Email*" required="">

                                    <input type="text" name="shipping_first_name" placeholder="First Name *" required="">

                                    <input type="text" name="shipping_last_name" placeholder="Last Name *" required="" >
                                    <input type="text" name="shipping_address"  placeholder="Address  *" required="">
                                    <input type="text"  name="shipping_mobile_number" placeholder="Mobile Number  *" required="">
                                    <input type="text" name="shipping_city"  placeholder="City  *" required="">

                                    <input type="submit" class="btn btn-default" value="Done" >

                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>



        </div>
    </section> <!--/#cart_items-->
    @endsection
