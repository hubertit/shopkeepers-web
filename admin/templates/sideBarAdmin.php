<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <ul class="navbar-nav theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="dashboard">
                    <img src="assets/img/logo.svg" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="dashboard" class="nav-link"> ShopKeepers </a>
            </li>
            <li class="nav-item toggle-sidebar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left sidebarCollapse">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </li>
        </ul>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu dashboard">
                <a href="dashboard" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="trello"></i>
                        <span>Dashboard</span>
                    </div>

                </a>
            </li>

            <li class="menu catalog">
                <a href="#catalog" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="layers"></i>
                        <span>Catalog</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="catalog" data-parent="#accordionExample">

                    <li class='categories'>
                        <a href="categories"> Categories</a>
                    </li>
                    <li class='products'>
                        <a href="products"> Products</a>
                    </li>
                </ul>
            </li>

            <li class="menu fuel">
                <a href="#fuel" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="database"></i>
                        <span>Fuel Consumption</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="fuel" data-parent="#accordionExample">

                    <li class='addFuel'>
                        <a href="addRefillingInfo"> Add New</a>
                    </li>
                    <li class='fuelRefills'>
                        <a href="fuelRefills"> Report</a>
                    </li>
                </ul>
            </li>


            <li class="menu ShopKeepers">
                <a href="#ShopKeepers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="box"></i>
                        <span>ShopKeepers</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="ShopKeepers" data-parent="#accordionExample">

                    <li class='addCar'>
                        <a href="addCar"> Add New</a>
                    </li>
                    <li class='ShopKeepers'>
                        <a href="ShopKeepers"> Report</a>
                    </li>
                </ul>
            </li>


            <li class="menu users">
                <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="users"></i>
                        <span>Users</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="users" data-parent="#accordionExample">

                    <li class='addUser'>
                        <a href="addUser"> Add New</a>
                    </li>
                    <li class='users'>
                        <a href="users"> Report</a>
                    </li>
                </ul>
            </li>

        </ul>

    </nav>

</div>