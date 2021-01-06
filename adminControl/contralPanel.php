<?php session_start(); ?>
<?php
$nonavbar = "";

// include_once 'conect.php';
include_once'init.php';
$Cid = $Cname = $Cdes = $Pid = $pname = $Pprice = $Ptype = $Pimage = $Pdiscount = " ";
///////////////////////add catgory /////////////////////////
if (isset($_GET["action"]) && $_GET["action"] == "addC") {
    echo'  <div id="right-panel" class="right-panel"><div class="content pb-0" style="color: black;">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="color: black;font-size: 30px"><strong>Category</strong><small> Form</small></div>
                    <div class="card-body card-block">
                        <form method="POST">
                            <div class="form-group"><label for="company" class=" form-control-label">name</label><input type="text" id="company" placeholder="Enter your Category name" class="form-control" name="Cname"></div>
                            <div class="form-group"><label for="street" class=" form-control-label">description</label><input type="text" id="street" placeholder="Enter description" class="form-control" name="Cdes"></div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="addCa">
                                <span id="payment-button-amount">Submit</span>
                            </button></form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div></div>
';
}
if (isset($_POST['addCa'])) {
    $Cdes = $_POST['Cdes'];
    $Cname = $_POST['Cname'];
    $sqlQ3 = "INSERT INTO `category`(`name`, `description`) VALUES ('$Cname','$Cdes')";

    if (mysqli_query($conn, $sqlQ3)) {
        echo "<script>alert('category is  added')</script>";
        echo "<script>window.location = 'contralPanel.php'</script>";
    }
}
//************************************************************************************************
//add product
if (isset($_GET["product"]) && $_GET["product"] == "addP") {
    echo '<div id="right-panel" class="right-panel">
    <div class="content pb-0" style="color: black;">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header"style="color: black;font-size: 30px"><strong>Product </strong><small> Form</small></div>
                        <div class="card-body card-block">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group"><label for="company" class=" form-control-label">name</label><input type="text" id="company" placeholder="Enter your Product name" class="form-control" name="Pname"></div>
                                <div class="form-group"><label for="vat" class=" form-control-label">type</label><input type="text" id="vat" placeholder="Enter type (normal ,discount) of product" class="form-control" name="Ptype"></div>
                                <div class="form-group"><label for="street" class=" form-control-label">price</label><input type="number" id="street" placeholder="Enter Product price" class="form-control" name="Pprice"></div>
                                <div class="form-group"><label for="street" class=" form-control-label">category id</label><input type="number" id="street" placeholder="Enter category id" class="form-control" name="Cid"></div>
                                <div class="form-group"><label for="street" class=" form-control-label">discount</label><input type="number" id="street" placeholder="Enter discount" class="form-control" name="Pdiscount"></div>
                                <div class="form-group"><label for="country" class=" form-control-label">image </label><input type="file" name="fileToUpload" id="fileToUpload"></div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="addProduct">
                                    <span id="payment-button-amount">Submit</span>
                                </button></form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div></div>';
}
?>



<?php
if (isset($_POST['addProduct'])) {
    $Pname = $_POST['Pname'];
    $Ptype = $_POST['Ptype'];
    $Pprice = $_POST['Pprice'];
    $Pdiscount = $_POST['Pdiscount'];
    $Cid = $_POST['Cid'];
    $upload = $_FILES['fileToUpload'];
    // print_r($upload);
    $name = $_FILES['fileToUpload']['name'];
    $target_dir = "../data/uploads/";
    $target_file = $target_dir . basename($_FILES['fileToUpload']["name"]);

// Select file type
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // // Valid file extensions
    $extensions_arr = array("jpg", "jpeg", "png", "gif");




    if (in_array($imageFileType, $extensions_arr)) {

        // Insert record
        $sqlQ4 = "INSERT INTO `product`( `namep`, `image`, `price`, `type`, `discount`, `categoryId`) VALUES ('$Pname','" . $name . "',
     $Pprice,'$Ptype',$Pdiscount,$Cid)";
        if (mysqli_query($conn, $sqlQ4)) {
            echo "<script>alert('Product is  added')</script>";
            echo "<script>window.location = 'contralPanel.php'</script>";
        }

//      mysqli_query($con,$query);
//      // Upload file
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_dir . $name);

//   }
    }
}
//************************************************************************************************
//Update Category 
if (isset($_GET["action"]) && $_GET["action"] == "updateC") {
    echo'  <div id="right-panel" class="right-panel"><div class="content pb-0" style="color: black;">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="color: black;font-size: 30px"><strong>Update Category</strong><small> Form</small></div>
                    <div class="card-body card-block">
                        <form method="POST">
                           <div class="form-group"><label for="company" class=" form-control-label">ID for Category </label><input type="number" id="company" placeholder="Enter your Category id" class="form-control" name="Cid"></div>
                             <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="SendId">
                                <span id="payment-button-amount">Send</span>
                            </button> </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div></div>
';
}

if (isset($_POST['SendId'])) {
    $Cid = $_POST['Cid'];
    $sqlQ3 = "SELECT `name`, `description` FROM `category` WHERE ID=$Cid";
    $result5 = mysqli_query($conn, $sqlQ3);
    while ($row5 = mysqli_fetch_assoc($result5)) {
        $Cname = $row5["name"];
        $Cdes = $row5["description"];
        echo"    <div id='right-panel' class='right-panel'><div class='content pb-0' style='color: black;'>
        <div class='animated fadeIn'>
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='card'>
                        <div class='card-header' style='color: black;font-size: 30px'><strong>Category</strong><small> Form</small></div>
                        <div class='card-body card-block'>
                            <form method='POST'>
                              <div class='form-group'><label for='company' class=' form-control-label'>id</label><input type='text' id='company' value=\"$Cid \" class='form-control' name='Cid'></div>
                                  <div class='form-group'><label for='company' class=' form-control-label'>name</label><input type='text' id='company' value=\"$Cname\" class='form-control' name='Cname2'></div>
                                <div class='form-group'><label for='street' class='form-control-label'>description</label><input type='text' id='street' value=\"$Cdes\" class='form-control' name='Cdes2'></div>
                                <button id='payment-button' type='submit' class='btn btn-lg btn-info btn-block' name='updatepCat'>
                                    <span id='payment-button-amount'>Save</span>
                                </button> </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div></div>";
    }
}

if (isset($_POST['updatepCat'])) {
    $Cdes = $_POST['Cdes2'];
    $Cname = $_POST['Cname2'];
    $Cid = $_POST['Cid'];
    $sqlQ11 = " UPDATE `category` SET `name` = '$Cname', `description` = '$Cdes'   WHERE ID=$Cid";
    if (mysqli_query($conn, $sqlQ11)) {
        echo "<script>alert('category is  updeat')</script>";
        echo "<script>window.location = 'contralPanel.php'</script>";
    }
}





//************************************************************************************************
//update product
if (isset($_GET["product"]) && $_GET["product"] == "updateP") {
    echo'  <div id="right-panel" class="right-panel"><div class="content pb-0" style="color: black;">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="color: black;font-size: 30px"><strong>Update product</strong><small> Form</small></div>
                    <div class="card-body card-block">
                        <form method="POST">
                           <div class="form-group"><label for="company" class=" form-control-label">ID for product </label><input type="number" id="company" placeholder="Enter your product id" class="form-control" name="pid"></div>
                             <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="SendPId">
                                <span id="payment-button-amount">Send</span>
                            </button> </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div></div>
';
}

if (isset($_POST['SendPId'])) {
    $Pid = $_POST['pid'];

    $sqlQ4 = "SELECT * FROM `product` WHERE id=$Pid";
    $result6 = mysqli_query($conn, $sqlQ4);
    while ($row5 = mysqli_fetch_assoc($result6)) {
        $Pname = $row5['namep'];
        $Ptype = $row5['type'];
        $Pprice = $row5['price'];
        $Pdiscount = $row5['discount'];
        $PCid = $row5['categoryId'];
        $Pid = $row5['id'];
        echo" <div id='right-panel' class='right-panel'><div class='content pb-0' style='color: black;'>
        <div class='animated fadeIn'>
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='card'>
                        <div class='card-header' style='color: black;font-size: 30px'><strong>Category</strong><small> Form</small></div>
                        <div class='card-body card-block'>
                            <form method='POST'>
                             <div class='form-group'><label for='company' class=' form-control-label'>id</label><input type='text' id='company' value=\"$Pid \" class='form-control' name='Pid'></div>
                                  <div class='form-group'><label for='company' class=' form-control-label'>name</label><input type='text' id='company' value=\"$Pname\" class='form-control' name='pname'></div>
                                   <div class='form-group'><label for='company' class=' form-control-label'>type</label><input type='text' id='company' value=\"$Ptype\" class='form-control' name='ptype'></div>
                                 <div class='form-group'><label for='company' class=' form-control-label'>price</label><input type='number' id='company' value=\"$Pprice\" class='form-control' name='pprice'></div>
                                 <div class='form-group'><label for='company' class=' form-control-label'>catgory id</label><input type='text' id='company' value=\"$PCid \" class='form-control' name='pCid'></div>
                                 <div class='form-group'><label for='street' class='form-control-label'>description</label><input type='number' id='street' value=\"$Pdiscount\" class='form-control' name='pdiscount'></div>
                                <button id='payment-button' type='submit' class='btn btn-lg btn-info btn-block' name='updatepPro'>
                                    <span id='payment-button-amount'>Save</span>
                                </button> </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div></div>";
    }
}

if (isset($_POST['updatepPro'])) {
    $Pname = $_POST['pname'];
    $Ptype = $_POST['ptype'];
    $Pprice = $_POST['pprice'];
    $Pdiscount = $_POST['pdiscount'];
    $PCid = $_POST['pCid'];
    $Pid = $_POST['Pid'];

    $sqlQ12 = "UPDATE `product` SET `nameP`='$Pname' ,`price`=$Pprice,`type`= '$Ptype' ,`discount`= $Pdiscount ,`categoryId`=$PCid WHERE id=$Pid";
    if (mysqli_query($conn, $sqlQ12)) {
        echo "<script>alert('product is  updeat')</script>";
        echo "<script>window.location = 'contralPanel.php'</script>";
    }
}




//************************************************************************************************
//delete catgory
if (isset($_GET["action"]) && $_GET["action"] == "deleteC") {
    echo'  <div id="right-panel" class="right-panel"><div class="content pb-0" style="color: black;">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="color: black;font-size: 30px"><strong>Delete Category</strong><small> Form</small></div>
                    <div class="card-body card-block">
                        <form method="POST">
                           <div class="form-group"><label for="company" class=" form-control-label">ID for Category </label><input type="number" id="company" placeholder="Enter your Category id" class="form-control" name="Cid"></div>
                             <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="SendId2">
                                <span id="payment-button-amount">Delete</span>
                            </button> </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div></div>
';
}

if (isset($_POST['SendId2'])) {
    $Cid = $_POST['Cid'];
    $query3 = "DELETE FROM `category` WHERE ID=$Cid";
    $result5 = mysqli_query($conn, $query3);
    if ($result5) {
        echo "<script>alert('category is  deleteed')</script>";
        echo "<script>window.location = 'contralPanel.php'</script>";
    }
}

//************************************************************************************************
//delete product
if (isset($_GET["product"]) && $_GET["product"] == "deleteP") {
    echo'  <div id="right-panel" class="right-panel"><div class="content pb-0" style="color: black;">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="color: black;font-size: 30px"><strong>Delete Product</strong><small> Form</small></div>
                    <div class="card-body card-block">
                        <form method="POST">
                           <div class="form-group"><label for="company" class=" form-control-label">ID for product </label><input type="number" id="company" placeholder="Enter your product id" class="form-control" name="Cid"></div>
                             <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="SendId3">
                                <span id="payment-button-amount">Delete</span>
                            </button> </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div></div>
';
}

if (isset($_POST['SendId3'])) {
    $Cid = $_POST['Cid'];
    $query3 = "DELETE FROM `product` WHERE id=$Cid";
    $result5 = mysqli_query($conn, $query3);
    if ($result5) {
        echo "<script>alert('product is  deleted')</script>";
        echo "<script>window.location = 'contralPanel.php'</script>";
    }
}

//.****************************************************************************************************
//view all catgory
$sqlQ = "SELECT * FROM `category`";
$result2 = mysqli_query($conn, $sqlQ);
if (isset($_GET["action"]) && $_GET["action"] == "viewC") {
    echo ' <div id="right-panel" ><div class="card">
                                <div class="card-body">
                                    <h4 class="box-title">Orders </h4>
                                </div><div class="card-body--"><div class="table-stats order-table ov-h"><table class="table ">
        <thead>
            <tr>
                <th class="serial">#</th>
                 <th>ID</th>
                <th>Name</th>
                <th>description</th>
                 <th>chose</th>
             </tr>
        </thead>
 ';
    while ($row = mysqli_fetch_assoc($result2)) {
        static $i = 1;
        $Cid = $row['ID'];
        $Cname = $row['name'];
        $Cdes = $row['description'];
        echo"
        
      <tbody>
        <tr>
            <td class='serial'>#$i</td>
             <td> $Cid</td>
            <td> <span class='name'>$Cname</span> </td>
            <td> <span class='product'>$Cdes</span></td>
             <td>

             <a href=\"contralPanel.php?action=delete&id= $Cid\"><span class='badge badge-pending'>delete</span></a>
             <a href=\"contralPanel.php?action=update&id= $Cid\"><span class='badge badge-complete'>Update</span></a>
 
             </td>
        </tr>
        <tr></tbody>";
        $i++;
    }
}
if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["id"])) {
    // if ($row = mysqli_fetch_assoc($result2)) {
    // $Cid = $row['ID'];
    $id = $_GET["id"];
    $query3 = "DELETE FROM `category` WHERE ID=$id";
    if (mysqli_query($conn, $query3)) {
        echo "<script>alert('product is  deleted')</script>";
        echo "<script>window.location = 'contralPanel.php'</script>";
    }
    // }
}
if (isset($_GET["action"]) && $_GET["action"] == "update" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "SELECT * FROM `category` WHERE ID=$id";
    $result2 = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result2)) {
        $CN = $row["name"];
        $CD = $row["description"];
        $Cid = $row["ID"];
        echo"    <div id='right-panel' class='right-panel'><div class='content pb-0' style='color: black;'>
        <div class='animated fadeIn'>
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='card'>
                        <div class='card-header' style='color: black;font-size: 30px'><strong>Category</strong><small> Form</small></div>
                        <div class='card-body card-block'>
                            <form method='POST'>
                                <div class='form-group'><label for='company' class=' form-control-label'>id</label><input type='text' id='company' value=\"$Cid \" class='form-control' name='Cid'></div>
                                  <div class='form-group'><label for='company' class=' form-control-label'>name</label><input type='text' id='company' value=\"$CN\" class='form-control' name='Cname2'></div>
                                <div class='form-group'><label for='street' class='form-control-label'>description</label><input type='text' id='street' value=\"$CD\" class='form-control' name='Cdes2'></div>
                                <button id='payment-button' type='submit' class='btn btn-lg btn-info btn-block' name='updateC2'>
                                    <span id='payment-button-amount'>Save</span>
                                </button> </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div></div>";
    }
}


if (isset($_POST['updateC2'])) {
    $Cdesc = $_POST['Cdes2'];
    $Cname = $_POST['Cname2'];
    $cid = $_POST["Cid"];
    $sqlQ11 = "  UPDATE `category` SET `name` = '$Cname', `description` = '$Cdesc'  WHERE ID=$cid";
    if (mysqli_query($conn, $sqlQ11)) {
        echo "<script>alert('product is  updeted')</script>";
        echo "<script>window.location = 'contralPanel.php'</script>";
    }
}


echo '</div></div></div></div></table>';


//*******************vew product**********************************************

$sqlQ = "SELECT * FROM `product`";
$result2 = mysqli_query($conn, $sqlQ);
if (isset($_GET["product"]) && $_GET["product"] == "viewP") {
    echo ' <div id="right-panel" ><div class="card">
                                <div class="card-body">
                                    <h4 class="box-title">Orders </h4>
                                </div><div class="card-body--"><div class="table-stats order-table ov-h"><table class="table ">
        <thead>
            <tr>
                <th class="serial">#</th>
                 <th>ID</th>
                <th>Name</th>
                <th>price</th>
                <th>Type</th>
                <th>Discount</th>
                 <th>category ID</th>
                 <th> choose</th>
             </tr>
        </thead>
 ';
    while ($row = mysqli_fetch_assoc($result2)) {
        static $i = 1;
        $Cid = $row['id'];
        $Cname = $row['namep'];
        $Cdes = $row['price'];
        $type = $row['type'];
        $disc = $row['discount'];
        $cat = $row['categoryId'];
        echo"
        
      <tbody>
        <tr>
            <td class='serial'>#$i</td>
             <td> $Cid</td>
            <td> <span class='name'>$Cname</span> </td>
            <td> <span class='product'> $Cdes</span></td>
            <td>$type </td>
            <td> $disc</td>
            <td> $cat</td>
            

             <td>


             <a href=\"contralPanel.php?product=delete&id= $Cid\"><span class='badge badge-pending'>delete</span></a>
             <a href=\"contralPanel.php?product=update&id= $Cid\"><span class='badge badge-complete'>Update</span></a>
 
             </td>
        </tr>
        <tr></tbody>";
        $i++;
    }
}
if (isset($_GET["product"]) && $_GET["product"] == "delete" && isset($_GET["id"])) {
    // if ($row = mysqli_fetch_assoc($result2)) {
    // $Cid = $row['ID'];
    $id = $_GET["id"];
    $query3 = "DELETE FROM `product` WHERE id=$id";
    if (mysqli_query($conn, $query3)) {
        echo "<script>alert('product is  deleted')</script>";
        echo "<script>window.location = 'contralPanel.php'</script>";
    }
    // }
}
if (isset($_GET["product"]) && $_GET["product"] == "update" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "SELECT * FROM `product` WHERE id=$id";
    $result2 = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result2)) {
        $Pname = $row['namep'];
        $Ptype = $row['type'];
        $Pprice = $row['price'];
        $Pdiscount = $row['discount'];
        $PCid = $row['categoryId'];
        $Pid = $row['id'];
        echo" <div id='right-panel' class='right-panel'><div class='content pb-0' style='color: black;'>
        <div class='animated fadeIn'>
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='card'>
                        <div class='card-header' style='color: black;font-size: 30px'><strong>Product</strong><small> Form</small></div>
                        <div class='card-body card-block'>
                            <form method='POST'>
                             <div class='form-group'><label for='company' class=' form-control-label'>id</label><input type='text' id='company' value=\"$Pid \" class='form-control' name='Pid'></div>
                                  <div class='form-group'><label for='company' class=' form-control-label'>name</label><input type='text' id='company' value=\"$Pname\" class='form-control' name='pname'></div>
                                   <div class='form-group'><label for='company' class=' form-control-label'>type</label><input type='text' id='company' value=\"$Ptype\" class='form-control' name='ptype'></div>
                                 <div class='form-group'><label for='company' class=' form-control-label'>price</label><input type='number' id='company' value=\"$Pprice\" class='form-control' name='pprice'></div>
                                 <div class='form-group'><label for='company' class=' form-control-label'>catgory id</label><input type='text' id='company' value=\"$PCid \" class='form-control' name='pCid'></div>
                                 <div class='form-group'><label for='street' class='form-control-label'>description</label><input type='number' id='street' value=\"$Pdiscount\" class='form-control' name='pdiscount'></div>
                                <button id='payment-button' type='submit' class='btn btn-lg btn-info btn-block' name='updatepPro'>
                                    <span id='payment-button-amount'>Save</span>
                                </button> </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div></div>";
    }
}


if (isset($_POST['updatepPro'])) {
    $Pname = $_POST['pname'];
    $Ptype = $_POST['ptype'];
    $Pprice = $_POST['pprice'];
    $Pdiscount = $_POST['pdiscount'];
    $PCid = $_POST['pCid'];
    $Pid = $_POST['Pid'];

    $sqlQ12 = "UPDATE `product` SET `nameP`='$Pname' ,`price`=$Pprice,`type`= '$Ptype' ,`discount`= $Pdiscount ,`categoryId`=$PCid WHERE id=$Pid";
    if (mysqli_query($conn, $sqlQ12)) {
        echo "<script>alert('product is  updeat')</script>";
        echo "<script>window.location = 'contralPanel.php'</script>";
    }
}


echo '</div></div></div></div></table>';















//************************************************************************************************
?>






<!doctype html>
<html class="no-js" lang="" >
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dashboard Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="layout/css/normalize.css">
        <link rel="stylesheet" href="layout/css/bootstrap.min.css">
        <link rel="stylesheet" href="layout/css/font-awesome.min.css">
        <link rel="stylesheet" href="layout/css/themify-icons.css">
        <link rel="stylesheet" href="layout/css/pe-icon-7-filled.css">
        <link rel="stylesheet" href="layout/css/flag-icon.min.css">
        <link rel="stylesheet" href="layout/css/cs-skin-elastic.css">
        <link rel="stylesheet" href="layout/css/style.css">
        <link rel="stylesheet" href="layout/css/style2.css">

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    </head>
    <body style='color: black;'>
        <aside id="left-panel" class="left-panel">
            <nav class="navbar navbar-expand-sm navbar-default">
                <div id="main-menu" class="main-menu collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="menu-title">Menu</li>
                        <li class="menu-item-has-children dropdown">
                            <a href="#" >Category</a>
                            <div class="dropdown-content">
                                <a href="contralPanel.php?action=addC">Add Category </a>
                                <a href="contralPanel.php?action=updateC">Update Category </a>
                                <a href="contralPanel.php?action=deleteC">Delete Category </a>
                                <a href="contralPanel.php?action=viewC">View Categories</a>
                            </div>
                        </li>
                        <li class="menu-item-has-children dropdown">
                            <a href="#" > product </a>
                            <div class="dropdown-content">
                                <a href="contralPanel.php?product=addP">Add product  </a>
                                <a href="contralPanel.php?product=updateP">Update product  </a>
                                <a href="contralPanel.php?product=deleteP">Delete product  </a>
                                <a href="contralPanel.php?product=viewP">View product </a>
                            </div>
                        </li>
                        <li class="menu-item-has-children dropdown">
                            <a href="logOut.php" > logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </aside>
        <div id="right-panel" class="right-panel">
            <header id="header" class="header">
                <div class="top-left">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#"><img src="layout/img/logo.png" alt="Logo"></a>
                        <a class="navbar-brand hidden" href="#"><img src="layout/img/logo2.png" alt="Logo"></a>
                        <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
                <div class="top-right">
                    <div class="header-menu">
                        <div class="user-area dropdown float-right">
                            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome Admin</a>
                            <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="#"><i class="fa fa-power-off"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="content pb-0">
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="box-title">Orders </h4>
                                </div>
                                <!--                                <div class="card-body--">
                                                                    ,;l******************************************************************************************4545
                                                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <footer class="site-footer">
                <div class="footer-inner bg-white">
                    <div class="row">
                        <div class="col-sm-6">
                            Copyright &copy; 2018 Ela Admin
                        </div>
                        <div class="col-sm-6 text-right">
                            Designed by <a href="https://colorlib.com/">Colorlib</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <script src="layout/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src="layout/js/popper.min.js" type="text/javascript"></script>
        <script src="layout/js/plugins.js" type="text/javascript"></script>
        <script src="layout/js/main.js" type="text/javascript"></script>
    </body>
</html>