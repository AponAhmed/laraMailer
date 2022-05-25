<div id="wrapper">
    <!-- Sidebar -->

    <div id="sidebar-wrapper">
        <div class="brand_logo_div fixed-brand">

            <a class="navbar-brand" href="{{ Route('homeIndex') }}">
                <h5 class="brand_logo">Dex<span>Mailler</span></h5>
            </a>
        </div>
        <ul class="sidebar-nav nav-pills nav-stacked" id="menu">

            <li class="active">
                <a href="{{ Route('ContactGroup') }}">
                    <span class="menu_ic">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                            <title>List</title>
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="32" d="M160 144h288M160 256h288M160 368h288" />
                            <circle cx="80" cy="144" r="16" fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="32" />
                            <circle cx="80" cy="256" r="16" fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="32" />
                            <circle cx="80" cy="368" r="16" fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="32" />
                        </svg>
                    </span>
                    <span class="menu_a">Contact Group</span> </a>
            </li>
            <li>
                <a href="{{ Route('contact') }}">
                    <span class="menu_ic">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                            <title>People</title>
                            <path
                                d="M402 168c-2.93 40.67-33.1 72-66 72s-63.12-31.32-66-72c-3-42.31 26.37-72 66-72s69 30.46 66 72z"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="32" />
                            <path
                                d="M336 304c-65.17 0-127.84 32.37-143.54 95.41-2.08 8.34 3.15 16.59 11.72 16.59h263.65c8.57 0 13.77-8.25 11.72-16.59C463.85 335.36 401.18 304 336 304z"
                                fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                            <path
                                d="M200 185.94c-2.34 32.48-26.72 58.06-53 58.06s-50.7-25.57-53-58.06C91.61 152.15 115.34 128 147 128s55.39 24.77 53 57.94z"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="32" />
                            <path
                                d="M206 306c-18.05-8.27-37.93-11.45-59-11.45-52 0-102.1 25.85-114.65 76.2-1.65 6.66 2.53 13.25 9.37 13.25H154"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                stroke-width="32" />
                        </svg>
                    </span>
                    <span class="menu_a">Contact </span>
                </a>
            </li>
            <li>
                <a href="{{ Route('newsletter') }}">
                    <span class="menu_ic ioicon" data-name="newspaper_outline"></span>
                    <span class="menu_a">Newsletter</span>
                </a>
            </li>
            <li>
                <a href="{{ Route('campain') }}">
                    <span class="menu_ic">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                            <title>Send</title>
                            <path
                                d="M470.3 271.15L43.16 447.31a7.83 7.83 0 01-11.16-7V327a8 8 0 016.51-7.86l247.62-47c17.36-3.29 17.36-28.15 0-31.44l-247.63-47a8 8 0 01-6.5-7.85V72.59c0-5.74 5.88-10.26 11.16-8L470.3 241.76a16 16 0 010 29.39z"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="32" />
                        </svg>
                    </span>
                    <span class="menu_a">Campain</span>
                </a>
            </li>
            <hr style="border-bottom: 1px solid #000;margin: 5px 0;">
            <li>
                <a href="{{ Route('googleAccount') }}">
                    <span class="menu_ic">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                            <title>Google Account</title>
                            <path
                                d="M473.16 221.48l-2.26-9.59H262.46v88.22H387c-12.93 61.4-72.93 93.72-121.94 93.72-35.66 0-73.25-15-98.13-39.11a140.08 140.08 0 01-41.8-98.88c0-37.16 16.7-74.33 41-98.78s61-38.13 97.49-38.13c41.79 0 71.74 22.19 82.94 32.31l62.69-62.36C390.86 72.72 340.34 32 261.6 32c-60.75 0-119 23.27-161.58 65.71C58 139.5 36.25 199.93 36.25 256s20.58 113.48 61.3 155.6c43.51 44.92 105.13 68.4 168.58 68.4 57.73 0 112.45-22.62 151.45-63.66 38.34-40.4 58.17-96.3 58.17-154.9 0-24.67-2.48-39.32-2.59-39.96z" />
                        </svg>
                    </span>
                    <span class="menu_a">Google Account</span>
                </a>
            </li>
            <li>
                <a href="{{ Route('template') }}">
                    <span class="menu_ic ioicon" data-name="newspaper_outline"></span>
                    <span class="menu_a">Template</span>
                </a>
            </li>
            <li>
                <a href="{{ Route('settings') }}">
                    <span class="menu_ic ioicon" data-name="construct"></span>
                    <span class="menu_a">Settings</span>
                </a>
            </li>

        </ul>
    </div>
    <!-- /#sidebar-wrapper -->
