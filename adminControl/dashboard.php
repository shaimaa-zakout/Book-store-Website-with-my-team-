<?php session_start(); ?>
<?php
include 'init.php';
if (isset($_POST['add'])) {      //هنا الشغل عند الضغط على زر الاضافة لسلة المشتريات وماذا سوف يحصل
    if (isset($_SESSION['cart'])) {
        $item_array_id = array_column($_SESSION['cart'], "product_id");
        if (in_array($_POST['product_id'], $item_array_id)) {
            echo "<script>alert('Product is already added in the cart..!')</script>";
            echo "<script>window.location = 'dashboard.php'</script>";
        } else {

            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart'][$count] = $item_array;
        }
    } else {

        $item_array = array(
            'product_id' => $_POST['product_id']
        );

        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
        // print_r($_SESSION['cart']);
    }
}
?>
<div id="templatemo_container">
    <div id="templatemo_header">
        <div id="templatemo_special_offers">
            <p>
                <span>25%</span> discounts for
                purchase over $80
            </p>
            <a href="subpage.html" style="margin-left: 50px;">Read more...</a>
        </div>


        <div id="templatemo_new_books">
            <ul>
                <li>Suspen disse</li>
                <li>Maece nas metus</li>
                <li>In sed risus ac feli</li>
            </ul>
            <a href="subpage.html" style="margin-left: 50px;">Read more...</a>
        </div>
    </div> <!-- end of header -->

</div>

<div id="templatemo_container">
    <div id="templatemo_content">
        <div id="templatemo_content_left">
            <div class="templatemo_content_left_section" >
                <h1>Categories</h1>
                <ul>
                    <li><a href="#">cooking</a></li>
                    <li><a href="#">Gardening</a></li>
                    <li><a href="">Art & Photography</a></li>
                    <li><a href="#">Science</a></li>
                    <li><a href="#">view all Categories </a></li>
                </ul>

            </div>
            <div class="templatemo_content_left_section">
                <h1>Bestsellers</h1>
                <ul>
                    <li><a href="#">Vestibulum ullamcorper</a></li>
                    <li><a href="#">Maece nas metus</a></li>
                    <li><a href="#">In sed risus ac feli</a></li>
                    <li><a href="#">Praesent mattis varius</a></li>
                    <li><a href="#">Maece nas metus</a></li>
                    <li><a href="#">In sed risus ac feli</a></li>
                    <li><a href="#">Flash Templates</a></li>
                    <li><a href="#">CSS Templates</a></li>
                    <li><a href="#">Web Design</a></li>
                    <li><a href="http://www.photovaco.com" target="_parent">Free Photos</a></li>
                </ul>
            </div>

        </div> <!-- end of content left -->

        <div id="templatemo_content_right">

            <?PHP
//$query = "SELECT * FROM `product`";
//$query="SELECT* FROM product p , category c WHERE p.categoryId=c.id GROUP BY p.categoryId ";
            $query = "SELECT * FROM product ";
            $result = mysqli_query($conn, $query);


            $groupOB = mysqli_fetch_all($result, MYSQLI_ASSOC);

            foreach ($groupOB as $row) {
                component($row['namep'], $row['price'], $row['image'], $row['id'], $row['type'], $row['discount'], "");
            }
            ?>
            <div class='cleaner_with_width'>&nbsp;</div>

            <div class="cleaner_with_height">&nbsp;</div>
        </div> <!-- end of content -->


        <div id="templatemo_footer">

            <a href="subpage.html">Home</a> | <a href="subpage.html">Search</a> | <a href="subpage.html">Books</a> | <a href="#">New Releases</a> | <a href="#">FAQs</a> | <a href="#">Contact Us</a><br />
            Copyright © 2024 <a href = "#"><strong>Your Company Name</strong></a>
        </div>
    </div>

</div> <!--end of container-->
</div>
<?php
include $tpl . 'footer.inc.php';
?>

</body>