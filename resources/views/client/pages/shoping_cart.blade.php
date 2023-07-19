@extends('client.layout.master')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $subtotal = 0;
                                    $total = 0;
                                @endphp
                                @foreach ($cart as $key => $cartItem)
                                    @php
                                        $cartItemTotal = $cartItem['price'] * $cartItem['qty'];
                                        $subtotal += $cartItemTotal;
                                        $total += $cartItemTotal;
                                    @endphp
                                    <tr id="product{{ $key }}">
                                        <td class="shoping__cart__item">
                                            <img src="img/cart/cart-1.jpg" alt="">
                                            <h5>{{ $cartItem['name'] }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            ${{ number_format($cartItem['price']) }}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input data-id="{{ $key }}"
                                                        data-url="{{ route('cart.updateCartItem', ['product' => $key]) }}"
                                                        type="text" value="{{ $cartItem['qty'] }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            ${{ number_format($cartItemTotal) }}
                                        </td>
                                        <td data-url="{{ route('cart.deleteCartItem', ['product' => $key]) }}"
                                            data-id="{{ $key }}" class="shoping__cart__item__close delete">
                                            <span class="icon_close"></span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" data-url="{{ route('cart.deleteCart') }}"
                            class="primary-btn cart-btn cart-btn-right delete-cart"><span class="icon_close"></span>
                            Delete Cart</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span id="subtotal">${{ number_format($subtotal) }}</span></li>
                            <li>Total <span id="total">${{ number_format($total) }}</span></li>
                        </ul>
                        <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection

@section('js-custom')
    <script>
        $(document).ready(function() {
            $('.delete').on('click', function(e) {
                let productId = $(this).data('id')
                let url = $(this).data('url')
                if (confirm("Are you want to remove this product from your cart")) {
                    $.ajax({
                        method: "GET",
                        url: url,
                        success: (res) => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Congratulations',
                                text: res.message,
                            })
                            $('#totalProduct').text(res.totalProduct)
                            $('#totalPrice').text("$" + res.totalPrice)
                            $('#total').text("$" + res.totalPrice)
                            $('#subtotal').text("$" + res.totalPrice)
                            $('#product' + productId).empty()
                        }
                    })

                } else {
                    console.log("no")
                }

            })

            $('span.qtybtn').on('click', function() {
                let oldValue = $(this).siblings('input').val()

                // console.log(productId)
                if ($(this).hasClass('inc')) {
                    oldValue = parseFloat(oldValue) + 1;

                } else {
                    oldValue = parseFloat(oldValue) - 1;
                    oldValue = oldValue >= 0 ? oldValue : 0;
                }

                let url = $(this).siblings('input').data('url') + "/" + oldValue;
                let productId = $(this).siblings('input').data('id')
                $.ajax({
                    method: "GET",
                    url: url,
                    success: (res) => {
                        // Swal.fire({
                        //     icon: 'success',
                        //     title: 'Congratulations',
                        //     text: 'Add product to cart success',
                        // })
                        $('#totalProduct').text(res.totalProduct)
                        $('#totalPrice').text("$" + res.totalPrice)
                        
                        console.log(res.totalProduct)
                        console.log($('#totalProduct').text())
                        if (oldValue == 0) {
                            $('#product' + productId).empty()
                        } else {
                            let newItemPrice = parseFloat($('#product' + productId + " " +
                                    ".shoping__cart__price").text().trim().split("$")[1]) *
                                oldValue
                            $('#product' + productId + " .shoping__cart__total").html("$" +
                                newItemPrice)
                            $('#total').text("$" + res.totalPrice)
                            $('#subtotal').text("$" + res.totalPrice)
                        }
                    }
                })
            })

            $('.delete-cart').on('click', function() {
                let url = $(this).data('url')
                $.ajax({
                    method: "GET",
                    url: url,
                    success: (res) => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Congratulations',
                            text: 'Delete cart success',
                        })
                        $('#totalProduct').text("0")
                        $('#totalPrice').text("$0")
                        $('.shoping__cart__table tbody').empty()
                    }
                })
            })
        })
    </script>
@endsection
