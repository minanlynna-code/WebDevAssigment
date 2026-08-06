<!-- Sub Header Banner -->

<div class="sun-header-banner">
    <div class="sun-banner-container">
        <!-- Logo -->
        <div style="flex:0 0 auto;">
            <img src="{{ asset('images/Logo.png') }}" alt="Sun Cafe Logo"
                style="width:130px; height:auto; border-radius:8px;">
        </div>

        <!-- Tagline -->
        <div style="flex:1 1 auto; text-align:center; padding:10px 15px;">
            <h2 style="font-family:'Times New Roman', serif;
                   font-size:28px;
                   margin:0;
                   line-height:1.4;
                   color:#3c2f2f;
                   font-weight:600;">
                Coffee with a Ray of Sunshine
            </h2>
        </div>

        <!-- Cart Button -->
        <div style="flex:0 0 auto;">
            <a href="{{ route('cart.index') }}" class="sun-cart-btn">
                <i class="fas fa-shopping-cart"></i> Cart
            </a>
        </div>

    </div>

</div>

<!-- Navigation -->

<nav class="sun-nav">
    <ul>

        <li><a href="{{ url('/') }}">Home</a></li>

        <li><a href="{{ url('/menu') }}">Menu</a></li>

        <li><a href="{{ url('/about') }}">About</a></li>

        <li><a href="{{ url('/contact') }}">Contact</a></li>

        <li><a href="{{ url('/orders') }}">My Orders</a></li>

        <li><a href="{{ url('/login') }}">Login</a></li>

        <!-- Search -->
        <li style="margin-left:auto;">
            <form action="{{ url('/menu') }}" method="GET" style="display:flex; align-items:center;">

                <input type="text"
                    name="search"
                    placeholder="Search coffee..."
                    style="padding:6px 12px;
                          border:1px solid #ccc;
                          border-radius:20px;
                          outline:none;">

                <button type="submit"
                    style="background:#3c2f2f;
                           color:white;
                           border:none;
                           padding:6px 12px;
                           margin-left:5px;
                           border-radius:20px;
                           cursor:pointer;">
                    🔍
                </button>

            </form>
        </li>

    </ul>
    @auth
    <span class="me-3">Hi, {{ Auth::user()->name }}</span>

    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="nav-btn logout-btn">
            Logout
        </button>
    </form>
    @endauth

    @guest
    <a href="{{ route('login') }}" class="nav-btn">Login</a>
    <a href="{{ route('register') }}" class="nav-btn register-btn">Register</a>
    @endguest
</nav>