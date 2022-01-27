@extends('template.user')

@section('title')
    Cart
@endsection

@section('style')
<link rel="stylesheet" href="{{asset('css/cart.css')}}">
@endsection

@section('content')
<div class="container">
    <!-- success message & Error message -->

    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

        @php
            $total = 0;
        @endphp
    @if ($carts->count() == 0)
    <p style="text-align:center;">Your Cart is Empty</p>
    @endif
<div>
    <h3>{{ $carts->count() }} Item(s) in your cart</h3>
</div>

@foreach ($carts as $cart)
<div class="cart">
    <div class="row">
        <div class="col-lg-3">
        <img class="img-cart" src="{{asset('storage/images/product.jpg')}}" alt="">
        </div>
        <div class="col-lg-9">
            <div class="top">
                <p class="item-name">{{ $cart->product->name }}</p>
                <div class="top-right">
                    <p class="">Rp. {{ number_format($cart->product->price) }}</p>
                    <select name="qty" class="quantity" data-item="{{ $cart->id }}">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{$i}}" {{  $cart->qty == $i ? 'selected': ''  }}>{{$i}}</option>
                    @endfor
                    </select>
                    <!-- Subtotal -->
                    <p class="total-item">Rp. {{ number_format($cart->product->price * $cart->qty) }}</p>
                </div>
            </div>
            <hr class="mt-2 mb-2">
            <div class="bottom">
               <div class="row">
                    <p class="col-lg-6 item-desc">
                        {{ $cart->product->desc }}
                    </p>
                    <div class="offset-lg-4">

                    </div>
                    <div class="col-lg-2">
                    <!-- delete cart -->
                    <form action="" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>

    @php
    $total += ($cart->product->price * $cart->qty);
    @endphp

@endforeach

<div class="totalz">
    <h4 class="total-price">Total Price: Rp. {{ number_format($total) }}</h4>
</div>
</div>

<form action="/checkout" method="POST" style="margin-left: 700px;">
@csrf
<button type="submit" class="btn btn-primary">Checkout</button>
</form>
    {{-- @endif --}}
@endsection

@section('script')
<script type="text/javascript">
    (function(){
    const classname = document.querySelectorAll('.quantity');

    Array.from(classname).forEach(function(element){
     element.addEventListener('change', function(){
        const id = element.getAttribute('data-item');
        axios.patch(`/cart/${id}`, {
            quantity: this.value,
            id: id
          })
          .then(function (response) {
            //console.log(response);
            window.location.href = '/cart'
          })
          .catch(function (error) {
            console.log(error);
          });
   })
 })
    })();
</script>
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
@endsection
