<header class="header bg-light">

    <!--------------------------------------TOPMENU---------------------------------------------->
    <nav class="topmenu navbar navbar-black bg-dark d-flex justify-content-between">
        <div class="align-content-center">
            <ul class="list-unstyled d-flex">
                <li class="ms-3"><a class="link-body-emphasis" href="#"><i class="fab fa-twitter text-white"></i></a></li>
                <li class="ms-3"><a class="link-body-emphasis" href="#"><i class="fab fa-instagram text-white"></i></a></li>
                <li class="ms-3"><a class="link-body-emphasis" href="#"><i class="fab fa-facebook text-white"></i></a></li>
            </ul>
        </div>

        <div class="vertical-align-middle  lg-6 md-6 sm-12">

            <?php
            // if user click on logout
            if (isset($_GET['logout'])) {
                if ($_GET['logout'] == true) {
                    $user->logout();
                }
            }
            // if user is logged in as admin
            if ($user->isAdmin()) { ?>

                <ul class="navbar-nav flex-row px-3">
                    <li class="nav-item px-1 currentUser">
                        <a class="nav-link" href="profile.php" id="currentUser"><img src="inc/img/icons/user.png" />&nbsp;<?= $user->getLogin() ?></a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="admin.php"><img src="inc/img/icons/admin.png"> Admin</a>
                    </li>
                    <li class="nav-item px-1" id="deconnexion">
                        <a class="nav-link" href="index.php?logout=true"><img src="inc/img/icons/logout.png"> LogOut</a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="shop.php"><img src="inc/img/icons/shop.png"> Shop</a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="cart.php"><img src="inc/img/icons/bag.png"> Cart</a>
                    </li>
                </ul>
            <?php
                // if user is logged as member
            } else if ($user->isLogged()) { ?>
                <ul class="navbar-nav flex-row px-3">
                    <li class="currentUser">
                        <a class="nav-link" href="profile.php" id="currentUser"><img src="inc/img/icons/user.png">&nbsp;<?= $user->getLogin() ?></a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="index.php?logout=true"><img src="inc/img/icons/logout.png"> LogOut</a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="shop.php"><img src="inc/img/icons/shop.png"> Shop</a> 
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="cart.php"><img src="inc/img/icons/bag.png"> Cart</a>
                    </li>
                </ul>
            <?php
            } else { ?>
                <ul class="navbar-nav flex-row px-3">
                    <li class="nav-item px-1">
                        <a class="nav-link" href="authentification.php?choice=login"><img src="inc/img/icons/login.png"> Login</a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="authentification.php?choice=register"><img src="inc/img/icons/join.png"> JoinUs</a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="shop.php"><img src="inc/img/icons/shop.png"> Shop</a>
                    </li>
                </ul>
            <?php
            } ?>
        </div>
    </nav> <!-- /menu-top -->

    <!--------------------------------------MAINMENU---------------------------------------------->
    <nav id="mainmenu" class="mainmenu navbar navbar-expand-md navbar-light bg-light justify-content-end px-3">
        <!-- logo -->
        <a class="navbar-brand" href="index.php"><img src="inc/img/design/logo_bk.png" alt="logo" height="40px"></a>
        <!-- search bar -->
        <div class="d-flex vertical-align-bottom col mx-2">
            <form class="d-flex w-100" method="get" action="search.php">
                <input id="search" class="form-control me-sm-1" type="text" name="search" placeholder="Search..." autocomplete="off">
                <button class="btn btn-transparent text-white my-sm-0" type="submit"><i class="fas fa-search"></i></button>
            </form>
            <ul id="matchList" class="position-absolute z-3 mt-5"></ul>
            <ul id="matchList2" class="position-absolute z-3 mt-5"></ul>
        </div> <!-- end search bar -->

        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item px-1">
                    <a class="nav-link" href="shop.php?category_id=7" data-id="7">New Collection</a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="shop.php?category_id=2" data-id="2">Best Sellers</a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="shop.php">Shop</a>
                </li>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="shop.php?category_id=8" data-id="8">Promotion</a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
        </div> <!-- /collapse -->


    </nav>

</header>

