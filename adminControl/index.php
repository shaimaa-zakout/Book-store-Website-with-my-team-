<?php
session_start();
$nonavbar = ""; //to known this page with no navbar
include 'init.php';
//
//if we found session we will go to dashboard
if (isset($_SESSION['username']) && $_SESSION['id'] == 1) {
    header('Location:dashboard.php');
    exit();
} elseif (isset($_SESSION['username']) && $_SESSION['id'] == 0) {
    header('Location:contralPanel.php');
    exit();
}

include $tpl . 'header.inc.php';
?>

<?php
//$emailError=$passErr="";
$booleanFoundEMail = false;
$booleanFoundEPass = false;
$emailError = $passErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    //to fetch all customer as associative array
    $type = $_POST['pers']; //as member or as admain
    $key = 1;
    //admin
    if ($type == "moderators") {
        $key = 0;
    }
    $sql = "SELECT email,pass FROM cust where keyId=$key ";
    //get result
    $result = mysqli_query($conn, $sql);
    //fetch the resulting row an array
    $groupOB = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ///---------------------------------------------

    $pass = sha1($pass); //ecrypit
    foreach ($groupOB as $obj) {
        if (($obj['email'] == $email)) {
            $booleanFoundEMail = true;
            if (($obj['pass'] == $pass)) {
                $booleanFoundEPass = true;
                //after validation from user 
                //we want to create session for him if he click remember me
                if (isset($_POST['rem'])) {
                    $_SESSION['username'] = $_POST['name'];
                    $_SESSION['id'] = $key;
                }
                //when finish session
                if ($_SESSION['id'] == 0) {
                    header('Location:controlPanel.php');
                    exit();
                } else {
                    header('Location:dashboard.php');
                    exit();
                }
            }


            //header("..........");
        }
    }
}
if ($booleanFoundEMail == false) {
    $emailError = "You don't have email :( ,create new !!";
} elseif ($booleanFoundEPass == false) {
    $passErr = "Error in password !!";
}
?>





<!--===============================================================================================-->

<div class="limiter">
    <div class="container-login100" style="background: url(layout/img/log.jpg)">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="layout/img/img-01.png" alt="IMG">
            </div>

            <form class="login100-form validate-form" method="post">
                <span class="login100-form-title">
                    Member Login
                </span>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email" placeholder="Email">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                    <span class="error">
                        <?php echo $emailError ?>
                    </span>

                </div>

                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    <input class="input100" type="password" name="pass" placeholder="Password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                    <span class="error">
                        <?php echo $passErr ?>
                    </span>

                </div>
                <div class="wrap-input100 validate-input">
                    <label style="color:black">Register as &#128578; :</label><br>
                    <input type="radio"  name="pers" value="customers">
                    <label for="customers" style="color:black">Customers</label>
                    <input type="radio"  name="pers" value="moderators">
                    <label for="moderators" style="color:black">Moderators</label><br>
                </div>
                <input type="checkbox" name="rem" ><label style="color:black"> Remember me &#128522;</label>

                <div class="container-login100-form-btn" >
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>

                <div class="text-center p-t-12">
                    <span class="txt1">
                        Forgot
                    </span>
                    <a class="txt2" href="#">
                        Username / Password?
                    </a>
                </div>

                <div class="text-center p-t-136">
                    <a class="txt2" href="createacount.php">
                        Create your Account
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


<!--===============================================================================================-->	
<script src="layout/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="layout/vendor/bootstrap/js/popper.js"></script>
<script src="layout/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="layout/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="layout/vendor/tilt/tilt.jquery.min.js"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->

<?php
include $tpl . 'footer.inc.php';
?>