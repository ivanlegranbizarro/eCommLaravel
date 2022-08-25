@extends('master')
@section('content')
<div class="container">
  <div class="text-center">
    <a class="btn btn-sm btn-outline-dark" href="{{ route('product.index') }}">Go Back</a>
  </div>
  <div class="card mb-3 mx-auto" style="max-width: 840px; margin-top: 50px">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="{{ $product->gallery }}" class="img-fluid rounded-start" alt="{{ $product->name }}">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">{{ $product->name }}</h5>
          <p class="card-text">{{ $product->description }}</p>
          <p class="card-text"><small class="text-muted">{{ $product->category->name }}</small></p>
          <p class="card-text">{{ $product->price }}€</p>
          <br />
          <form action="{{ route('product.add.cart') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="quantity">Quantity</label>
              <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1"
                max="{{ $product->stock }}">
              <input type="hidden" name="product_id" value="{{ $product->id }}" />
            </div>
            <button type="submit" class="btn btn-primary my-3">Add to cart</button>
          </form>
          <button class="btn btn-success" type="submit">Buy Now</button>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection