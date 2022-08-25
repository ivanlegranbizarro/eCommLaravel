@php
use App\Http\Controllers\ProductController;
$total = ProductController::getCartItems();
@endphp
<nav class="navbar navbar-expand-lg bg-light mb-5">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link 
          @if(request()->routeIs('product.index'))
          active
          @endif

          " href="{{ route('product.index') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link
          @if(request()->routeIs('cart.index'))
          active
          @endif
          " href="{{ route('cart.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
              fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
              <path
                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>({{ $total }})</a>
        </li>
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}" class="nav-link">
            @csrf

            <button type="submit" class="btn btn-sm btn-outline-secondary">
              {{ __('Log Out') }}
            </button>
          </form>
        </li>
      </ul>
      <form class="d-flex" role="search" method="post" action="{{ route('product.search') }}">
        @csrf
        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show text-center mb-4 py-4" role="alert">
  <strong>{{ session('success')}} </strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif