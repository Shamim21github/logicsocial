<nav class="sidebar vertical-scroll  ps-container ps-theme-default ps-active-y">
    <div class="logo d-flex justify-content-between">
        {{-- <a href="index-2.html"><img src="img/logo.png" alt></a> --}}
        <a href="{{ url('/dashboard') }}" style="font-size:30px;font-weight:bold">LogicSocial</a>
        {{-- <h4>LogicSocial</h4> --}}
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <li class="mm-active">
            <a href="{{ url('/dashboard') }}" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('img/menu-icon/dashboard.svg') }}" alt>
                </div>
                <span>Dashboard</span>
            </a>
        </li>
        <li class>
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('img/menu-icon/2.svg') }}" alt>
                </div>
                <span>Create</span>
            </a>
            <ul>

                <li>
                    <a href="{{ url('/tweet') }}">Tweet</a>
                </li>
                <li>
                    <a href="{{ url('/fb-post') }}">Fb_Post</a>

                </li>
            </ul>
        </li>

        <li class>
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('img/menu-icon/3.svg') }}" alt>
                </div>
                <span>Plannder</span>
            </a>
            <ul>

                <li>
                    <a href="{{ url('/scheduled_posts/create') }}">Create Schedule</a>
                </li>
                <li>
                    <a href="{{ url('/scheduled_posts') }}">Manage Post</a>
                </li>
                <li>
                    <a href="{{ url('/calendar') }}">Calender View</a>
                </li>
            </ul>
        </li>

        {{-- <li class>
            <a class="has-arrow nav-link {{ Request::is('scheduled_posts') ? 'active' : '' }}"
                href="{{ route('scheduled_posts.index') }}">
                <div class="icon_menu">
                    <img src="{{ asset('img/menu-icon/3.svg') }}" alt>
                </div>
                <span>Plannder</span>
            </a>
        </li> --}}






        <li class>
            <a href="{{ url('/payment') }}" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('img/menu-icon/payment.svg') }}" alt>
                </div>
                <span>Stripe Payment</span>
            </a>
        </li>

        <li class>
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('img/menu-icon/16.svg') }}" alt>
                </div>
                <span>Pages</span>
            </a>
            <ul>
                <li><a href="#">Login</a></li>
                <li><a href="#">Register</a></li>
                <li><a href="#">Forgot Password</a></li>
                <li><a href="#">Gallery</a></li>
            </ul>
        </li>
    </ul>
</nav>
