<header>
    <a href="#" id="back-to-top" title="Back to top"><span></span>&uarr;</a>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    @if( App\Models\Product::where('holiday_special', true)->exists() && $title != null)
                        <li class="{{ set_active('/') }}">
                            <a href="{{ url('/holidays-special') }}">{{ $title }}</a>
                        </li>
                    @endif
                    <li><a href="/about">About us</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/contact-us">Contact</a></li>
                    @if ( Auth::guest() )
                        <li><a href="/login">Sign in</a></li>
                        <li><a href="/register">Register</a></li>
                    @elseif ( Auth::check() )
                        @if(! auth()->user()->isEmployee())
                            <li><a href="/user/profile">Your profile</a></li>
                        @endif
                        <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Logout</a>
                        </li>

                        @can('see-admin-menu')
                            <li><a href="/restaurantpanel">Admin</a></li>
                        @endcan
                        @can('see-employee-menu')
                            <li><a href="/customer-orders">Today's order</a></li>
                            <li><a href="/calendar">Calendar</a></li>
                            <li><a href="#!"><order-notification></order-notification></a></li>
                        @endcan
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <li>
                                    <a href="/user/profile">Profile</a>
                                </li>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
                    <li>
                        <a type="button" class="btn" data-toggle="modal" data-target=".modal">Preview Cart</a>
                    </li>
                    <cart-counter :numberofitems="{{ Cart::instance()->count() }}"></cart-counter>
            </ul>
        </div>
    </div>
</nav>

</header>
