<?php

function component($productname, $productprice, $productimg, $productid, $productType, $discount, $cname) {

    $img = "../data/uploads/" . $productimg;
    $printPrice = "";
    if ($productType == 'discount') {
        $printPrice = "<p class = 'price'><small style = 'color: grey;'><s>$discount</s></small> $productprice</p> ";
    } else {
        $printPrice = "<p class = 'price'>$productprice</p> ";
    }
    echo " <div class='templatemo_product_box'>
            <h1> $productname </h1>
            <img src=\"$img\" alt='image' />
            <div class='product_info'>

                <p>Aliquam a dui, ac magna quis est eleifend dictum.</p>
                <h3>$printPrice</h3>
                    <form method='POST'>
                 <button type=\"submit\" class = 'addCart  buy_now_button btn ' name='add'>Add to Cart <i class = 'fa fa-shopping-cart' style = 'font-size:24px'></i></button>
                <input type='hidden' name='product_id' value=\"$productid\">
                    </form>
            </div>
            <div class='cleaner'>&nbsp;</div>
        </div>";
}

function cartElement($productimg, $productname, $productprice, $productid) {
 $img = "../data/uploads/" . $productimg;
    $element = "
    
    <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=\"$img\" alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$productname</h5>
                                <small class=\"text-secondary\">Seller: dailytuition</small>
                                <h5 class=\"pt-2\">$$productprice</h5>
                                <button type=\"submit\" class=\"btn btn-warning\">Save for Later</button>
                                <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                            </div>
                            <div class=\"col-md-3 py-5\">
                                <div>
                                    <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-minus\"></i></button>
                                    <input type=\"text\" value=\"1\" class=\"form-control w-25 d-inline\">
                                    <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-plus\"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
    
    ";
    echo $element;
}

?>