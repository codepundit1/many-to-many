<nav class="navbar navbar-expand-lg shadow">
    <div class="container">
        <a class="navbar-brand"
           href="{{ config('app.url') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse"
             id="navbarTogglerDemo02">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.*') ? 'text-primary' : '' }}"
                       aria-current="page"
                       href="{{ route('products.index') }}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('suppliers.*') ? 'text-primary' : '' }}"
                       aria-current="page"
                       href="{{ route('suppliers.index') }}">Suppliers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public-images.*') ? 'text-primary' : '' }}"
                       aria-current="page"
                       href="{{ route('public-images.index') }}">Public Image</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('private-images.*') ? 'text-primary' : '' }}"
                       aria-current="page"
                       href="{{ route('private-images.index') }}">Private Image</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('bucket-images.*') ? 'text-primary' : '' }}"
                       aria-current="page"
                       href="{{ route('bucket-images.index') }}">S3 Bucket</a>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>
