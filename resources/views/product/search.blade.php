@extends('master')
@section('content')
<div class="container">
  <div class="text-center">
    <a class="btn btn-sm btn-outline-dark" href="{{ route('product.index') }}">Go Back</a>
  </div>
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
          <p class="card-text"><small class="text-muted">{{ $product->category->name }}</small></p>
          <p class="card-text">{{ $product->price }}€</p>
          <br />
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection