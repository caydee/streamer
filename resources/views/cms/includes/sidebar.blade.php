<nav class="sidebar sidebar-sticky">
    <div class="sidebar-content  js-simplebar">
        <a class="sidebar-brand px-2 text-center" href="{{ url('/cms') }}">
            <img src="{{ asset('assets/img/logo.png') }}"  class="img-fluid" alt="">
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Main
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link font-weight-bold" href="{{ url('/cms') }}">
                   <i class="align-middle" data-feather="home"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link font-weight-bold" href="{{ url('/cms/company') }}">
                   <i class="align-middle" data-feather="layers"></i> <span class="align-middle">Company</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link font-weight-bold" href="{{ url('/cms/livestream') }}">
                   <i class="align-middle" data-feather="film"></i> <span class="align-middle">Livestream</span>
                </a>
            </li>
            <li class="sidebar-header">
                Administration
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link font-weight-bold" href="{{ url('/cms/users') }}">
                   <i class="align-middle" data-feather="user"></i> <span class="align-middle">Users</span>
                </a>
            </li>

            <!--<li class="sidebar-item active">
                <a href="#pages" data-toggle="collapse" class="font-weight-bold sidebar-link">
                    <i class="align-middle" data-feather="monitor"></i> <span class="align-middle">Pages</span>
                </a>
                <ul id="pages" class="sidebar-dropdown list-unstyled collapse show">
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-invoice.html">Invoice</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-pricing.html">Pricing</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-kanban.html">Kanban Board <span class="sidebar-badge badge badge-primary">New</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-404.html">404 Page</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-500.html">500 Page</a></li>
                    <li class="sidebar-item active"><a class="sidebar-link" href="pages-blank.html">Blank Page</a></li>
                </ul>
            </li> -->

        </ul>



    </div>
</nav>
