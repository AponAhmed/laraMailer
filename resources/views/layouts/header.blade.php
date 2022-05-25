<div class="module-header">
    <h2 class="currentModule">
        {{ $module['title'] ?? "" }}
        @if (isset($module['addRoute']))
            <a href="{{ $module['addRoute'] }}" class="{{ $module['ajaxAdd']?"popup":""}} btn btn_a">Add New</a>
        @endif
    </h2>
    <div class="header-right">
        <!-- Right -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect" id="navbarDropdownMenuLink3" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="true">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                        <title>User</title>
                        <path d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z"
                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="32" />
                        <path
                            d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z"
                            fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                    </svg>
                </a>
                <div class="dropdown-menu drop_manu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>

                </div>
            </li>
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
