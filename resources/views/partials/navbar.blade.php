<!-- Sun Cafe Header -->

<header class="sun-header">

    <div class="sun-header-container">

        <!-- Logo -->
        <div class="sun-logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/Logo.png') }}" alt="Sun Cafe Logo">
            </a>
        </div>

        <!-- Tagline -->
        <div class="sun-tagline">
            <h1>Coffee with a Ray of Sunshine</h1>
        </div>

        <!-- Cart -->
        <div class="sun-cart-area">

            @auth
            <a href="{{ route('cart.index') }}" class="sun-cart-btn">
                <i class="fas fa-shopping-cart"></i>
                <span>Cart</span>
            </a>
            @else
            <a href="{{ route('login') }}" class="sun-cart-btn">
                <i class="fas fa-shopping-cart"></i>
                <span>Cart</span>
            </a>
            @endauth

        </div>

    </div>

</header>


<!-- Main Navigation -->

<nav class="sun-nav">

    <div class="sun-nav-container">

        <div class="sun-nav-links">

            <a href="{{ route('home') }}">
                Home
            </a>

            <a href="{{ route('menu.index') }}">
                Menu
            </a>

            <a href="#">
                About
            </a>

            <a href="#">
                Contact
            </a>

            @auth
            <a href="{{ route('orders.index') }}">
                My Orders
            </a>
            @endauth

        </div>


        <!-- Search -->

        <form
            action="{{ route('menu.index') }}"
            method="GET"
            class="sun-search">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search coffee...">

            <button type="submit">
                🔍
            </button>

        </form>


        <!-- User Area -->

        <div class="sun-user">

            @auth

            <!-- <span class="welcome-user">
                Hi, {{ Auth::user()->name }}
            </span> -->

            <form
                action="{{ route('logout') }}"
                method="POST">
                @csrf

                <button
                    type="submit"
                    class="logout-btn">
                    Logout
                </button>
            </form>

            @else

            <a href="{{ route('login') }}" class="login-btn">
                Login
            </a>

            <a href="{{ route('register') }}" class="register-btn">
                Register
            </a>
            <a href="{{ route('admin.orders.index') }}">
                Admin
            </a>

            @endauth

        </div>

    </div>

</nav>