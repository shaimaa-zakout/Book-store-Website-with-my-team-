

<div id="templatemo_container">
    <div id="templatemo_menu">
        <ul>
            <li><a href="dashboard.php" class="current">Home</a></li>
            <li><a href="#">Search</a></li>
            <li><a href="#">New Releases</a></li>  
            <li><a href="#">Company</a></li> 
            <li><a href="category.php">Categories</a></li>
            <li><a href="#">Contact</a></li>
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle ml-5" data-toggle="dropdown"
                   href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['username'] ?? "Uknown"; ?></a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#!">Another action</a>
                    <a class="dropdown-item" href="logOut.php">Log Out</a>
                </div>
            </li>
        </ul>
        <div class="cart my-2 my-lg-0" >
            <a href="cart.php">
                <span>
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <?php
                    if (isset($_SESSION['cart'])) {
                        $count = count($_SESSION['cart']);
                        echo "<span id=\"cart_count\" style='right: 21.9rem;color:#000'>$count</span>";
                    } else {
                        echo "<span id=\"cart_count\" style='right:21.9rem;color:#000'>0</span>";
                    }
                    ?>

                </span>
            </a>

        </div>
        <form class="form-inline my-2 my-lg-0" action="search.php" method="POST">
            <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search here..." aria-label="Search">
            <button class="fa fa-search" type="submit" name="submit-search"></button>
        </form>


    </div> <!-- end of menu -->
</div>

