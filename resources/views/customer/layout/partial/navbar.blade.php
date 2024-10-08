<!-- Spinner Start -->
<div id="spinner"
    class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" role="status"></div>
</div>
<!-- Spinner End -->


<!-- Navbar start -->
<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#"
                        class="text-white">123 Street, New York</a></small>
                <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#"
                        class="text-white">Email@Example.com</a></small>
            </div>
            <div class="top-link pe-2">
                <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                <!-- Logout Form -->
                <form id="logout-form" action="{{ route('customer.auth.logout') }}" method="POST"
                    style="display: none;">
                    @csrf
                </form>
                <a href="{{ route('customer.auth.logout') }}" class="text-white"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><small
                        class="text-white ms-2">Logout</small></a>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="{{ route('public.dashboard') }}" class="navbar-brand">
                <h1 class="text-primary display-6">Fruitables</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ route('public.dashboard') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('public.shop.index') }}" class="nav-item nav-link {{ request()->is('shop') ? 'active' : '' }}">Shop</a>
                    <a href="{{ route('public.detail.index') }}"
                        class="nav-item nav-link {{ request()->is('shop-detail') ? 'active' : '' }}">Shop Detail</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <a href="{{ route('customer.cart.index') }}" class="dropdown-item {{ request()->is('cart') ? 'active' : '' }}">Cart</a>
                            <a href="customer/checkout"
                                class="dropdown-item {{ request()->is('customer/checkout') ? 'active' : '' }}">Checkout</a>
                            <a href="{{ route('public.testimonial.index') }}"
                                class="dropdown-item {{ request()->is('testimonial') ? 'active' : '' }}">Testimonial</a>
                            <a href="/404" class="dropdown-item {{ request()->is('404') ? 'active' : '' }}">404
                                Page</a>
                        </div>
                    </div>
                    <a href="{{ route('public.contact.index') }}"
                        class="nav-item nav-link {{ request()->is('contact') ? 'active' : '' }}">Contact</a>
                </div>
                <div class="d-flex m-3 me-0">
                    <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4"
                        data-bs-toggle="modal" data-bs-target="#searchModal"><i
                            class="fas fa-search text-primary"></i></button>
                    <a href="{{ route('customer.checkout.index') }}" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-bag fa-2x"></i>
                        <span
                            class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                            style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                    </a>
                    <a href="{{ route('customer.profile.show', ['profile' => Auth::id()]) }}" class="my-auto" id="userMenuButton">
                        <i class="fas fa-user fa-2x"></i>
                    </a>

                    <!-- Menu Popup -->
                    <div id="userMenuPopup" class="popup-menu" style="display: none;">
                        <ul>
                            <li><a href="{{ route('customer.profile.show', ['profile' => Auth::id()]) }}">Lihat Profil</a></li>
                            <li><a href="{{ route('customer.auth.logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->
