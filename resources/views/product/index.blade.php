@extends('master')
@section('content')
<div class="container">
  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
        aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      @foreach ($products as $product)
      <div class="carousel-item @if ($loop->first) active @endif ">
        <a href="{{ route('product.show',  $product->id ) }}">
          <img class="d-block w-100" style="height: 500px !important" src="{{ $product->gallery }}"
            alt="{{ $product->name }}">
          <div class="carousel-caption d-none d-md-block">
            <h5>{{ $product->name }}</h5>
            <p>{{ $product->price }}€</p>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <div class="my-5 text-center">
    <h3 style="margin: 100px 0 100px">Featured Products</h3>
    <div class="row">
      @foreach ($products as $product)
      @if ($product->featured == 'yes')
      <div class="col-xl-3 col-md-4 col-sm-12">
        <div class="card">
          <a href="{{ route('product.show',  $product->id ) }}">
            <img class="card-img-top" src="{{ $product->gallery }}" alt="{{ $product->name }}">
            <div class="card-body">
              <h5 class="card-title">{{ $product->name }}</h5>
              <p class="card-text">{{ Str::limit($product->description, 40) }}</p>
              <p class="card-text">{{ $product->price }}€</p>
            </div>
          </a>
        </div>
      </div>
      @endif
      @endforeach
    </div>
  </div>
</div>
@endsection