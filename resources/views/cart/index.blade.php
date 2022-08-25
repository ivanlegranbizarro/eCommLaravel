@extends('master')
@section('content')
<div class="container">
  <div class="text-center">
    <a class="btn btn-sm btn-outline-dark" href="{{ route('product.index') }}">Go Back</a>
  </div>
  @if ($totalPrice == 0)
  <div class="text-center my-5">
    <h1>Sorry. Your cart is empty</h1>
  </div>
  @else
  @foreach ($products as $product)
  <div class="card mb-3 mx-auto" style="max-width: 840px; margin-top: 50px">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="{{ $product->gallery }}" class="img-fluid rounded-start" alt="{{ $product->name }}">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title"><a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a></h5>
          <p class="card-text">{{ $product->description }}</p>
          <p class="card-text">{{ $product->price }}€</p>
          <p class="card-text">Quantity: {{ $product->quantity }}</p>
          <p class="card-text">Total per product: {{ $product->price * $product->quantity }}€</p>
        </div>
        <form action="{{ route('cart.destroy', [$product->cart_id]) }}" method="post">
          @csrf
          @method('DELETE')

          <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-warning my-3">Remove
            from Cart</button>
        </form>
      </div>
    </div>
  </div>
  @endforeach
  <div class="text-center mt-5">
    <h2>Total <span class="badge bg-success">{{ $totalPrice }}€</span></h2>
  </div>

  <div class="text-center mt-5">
    <a href="#" class="btn btn-outline-success">Order Now</a>
  </div>
</div>
@endif
@endsection