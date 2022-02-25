<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <ul class="navbar-nav theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="dashboard">
                    <img src="assets/img/favicon.png" class="navbar-logo" alt="logo">
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
                    <li class='shops'>
                        <a href="shops"> Shops</a>
                    </li>
                    <li class='categories'>
                        <a href="categories"> Categories</a>
                    </li>
                    <li class='products'>
                        <a href="products"> Products</a>
                    </li>
                    <li class='sponsored'>
                        <a href="sponsored"> Sponsored</a>
                    </li>
                </ul>
            </li>

            <li class="menu sponsored">
                <a href="#sponsored" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="dollar-sign"></i>
                        <span>Sponsored</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="sponsored" data-parent="#accordionExample">
                    <?php $query = mysqli_query($connection, "SELECT * FROM countries");
                    while ($country = mysqli_fetch_assoc($query)) { ?>
                        <li class='sponsored'>
                            <a href="country?sponsored=<?php print $country["country_id"]; ?>"> <?php print $country["country_name"]; ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </li>

            <li class="menu forum">
                <a href="#forum" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="layout"></i>
                        <span>Forum</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="forum" data-parent="#accordionExample">

                    <li class='forum'>
                        <a href="posts"> Posts</a>
                    </li>
                </ul>
            </li>


            <!-- <li class="menu ShopKeepers">
                <a href="#sales" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="box"></i>
                        <span>Sales</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="sales" data-parent="#accordionExample">


                    <li class='orders'>
                        <a href="orders"> Orders</a>
                    </li>
                </ul>
            </li> -->


            <!-- <li class="menu customers">
                <a href="#customers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="users"></i>
                        <span>Customers</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="customers" data-parent="#accordionExample">

                    <li class='addCustomer'>
                        <a href="addCustomer"> Add New</a>
                    </li>
                    <li class='customers'>
                        <a href="customers"> Report</a>
                    </li>
                </ul>
            </li> -->

        </ul>

    </nav>

</div>