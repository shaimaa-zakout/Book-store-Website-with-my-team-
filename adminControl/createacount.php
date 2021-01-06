<?php
session_start();
$nonavbar = ""; //to known this page with no navbar
include 'init.php';
?>


<?php
if (isset($_POST['email']) && isset($_POST["pass"]) && isset($_POST["name"]) && isset($_POST['pers'])) {
    $name = $_POST["name"];
    $email = $_POST['email'];
    $pass = $_POST["pass"];
    $passHas = sha1($pass);
    $type = $_POST['pers'];


    $key = 1;
    //to change key we should chek type 1=>custmer 0=>admain
    if ($type == "moderators") {
        $key = 0;
    }


    //to store in database
    $sql = "INSERT INTO  cust (name,email,pass,keyId) VALUES ('$name' ,'$email','$passHas','$key')";
    if (mysqli_query($conn, $sql)) {
        //when click remmember me
        if (isset($_POST['rem'])) {
            $_SESSION['username'] = $_POST['name'];
            $_SESSION['id'] = $key;
        }

        if ($key == 1) {
            header('Location:dashboard.php');
            exit();
        } elseif ($key == 0) {


            header('Location:contralPanel.php?action=viewC&product=viewP');
            exit();
        }
    } else {
        echo "erro in conect!!!!";
    }
}


// end validate form------------------------------------------------------------------------------------------------------
?>

<!--===============================================================================================-->

<body>

    <div class="limiter">
        <div class="container-login100" style="background: url(layout/img/log.jpg)">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="layout/img/img-01.png" alt="IMG">
                </div>

                <form class="login100-form validate-form" method="POST">
                    <span class="login100-form-title">
                        Member Login
                    </span>
                    <div class="wrap-input100 validate-input" data-validate = "<?php echo $nameErro; ?>">
                        <input class="input100" type="text" name="name" placeholder="Name">

                        <span class="focus-input100"></span>

                        <span class="symbol-input100">
                            <i class="fas fa-user-alt" aria-hidden="true"></i>
                        </span>

                    </div>


                    <div class="wrap-input100 validate-input" data-validate = "<?php echo $emailErro; ?>">
                        <input class="input100" type="text" name="email" placeholder="Email">

                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>

                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "<?php echo $passError; ?>">

                        <input class="input100" type="password" name="pass"  placeholder="password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>

                    </div>
                    <div class="wrap-input100 validate-input">
                        <input type="radio"  name="pers" value="customers">
                        <label for="customers" style="color: #000;">Customers</label>
                        <input type="radio"  name="pers" value="moderators">
                        <label for="moderators" style="color: #000;">Moderators</label><br>
                    </div>
                    <br>
                    <input type="checkbox" name="rem" ><label  style="color: #000;"> Remember me &#128522;</label>


                    <div class="container-login100-form-btn">
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
                        <a class="txt2" href="index.php">
                            sign up
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
    <script src="js/main.js"></script>

</body>
</html>