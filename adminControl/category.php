<?php
session_start();
include 'init.php';
$do = isset($_GET['do']) ? $_GET['do'] : 'Manager';
//create new db
//$db=new Db("category");
if ($do == 'Manager') {
    $sql = "SELECT * FROM category";
    //get result
    $result = mysqli_query($conn, $sql);
    //fetch the resulting row an array
    $groupOB = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>
    <h1 class="text-center">Manage Categorie</h1>
    <div class="container">
        <div class="panel panel-defeault">
            <div class="row mt-4 ml-3">

                <?php
                foreach ($groupOB as $cut) {
                    ?>

                    <div class="col-3 mr-3 mb-3 mt-3">
                        <div class="card" style="width: 18rem;">
                            <img src="https://english.alaraby.co.uk/english/file/getimagecustom/15fb6c3f-ed4b-4157-8b01-b7247d468cc2/850/479" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-black"><?php echo $cut['name'] ?></h5>
                                <p class="card-text"><?php echo $cut['description'] ?></p>
                                <a href="?do=product&&id=<?php echo $cut['ID'] ?>" class="btn btn-primary">products</a><!-- we will change href -->
                            </div>
                        </div>
                    </div>




                <?php } ?>
            </div>

        </div>

    </div>

<?php
} elseif ($do == 'product' && isset($_GET['id'])) {
    ?>
    <div class="article-container">
        <div id="templatemo_content_right">


    <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM product p  WHERE p.categoryId=$id";
    $result = mysqli_query($conn, $sql);


    $query = mysqli_num_rows($result);
    echo "There are " . $query . " result.";
    if ($query > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            component($row['namep'], $row['price'], $row['image'], $row['id'], $row['type'], $row['discount'], "");
        }
        ?>

                <div class='cleaner_with_width'>&nbsp;</div>

                <div class="cleaner_with_height">&nbsp;</div>
            </div>
        </div>

    <?php
    }
}
include $tpl . 'footer.inc.php';
?>