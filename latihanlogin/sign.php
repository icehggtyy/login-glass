<?php
require "koneksi.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
</head>
<style>
    body {
    background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url(img/signin.avif);
    background-size: cover;
    }
    .container1 {
    backdrop-filter: blur(15px);
    background-color: transparent;
    border: solid rgba(255,255,255,.3);
  }
  .userex{
    font-size: 15px;
  }
</style>
<body>
<section class="vh-100 gradient-custom">
  <div class="container py-3 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card container1 text-white mb-3" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <div class="mb-md-3 mt-md-4 pb-2">
              <h2 class="fw-bold mb-2 text-uppercase">Sign Up</h2>
              <p class="text-white-50 mb-5">Create Account</p>
              <div class="alert alert-danger d-none filal" role="alert">
                  Please Fill Username, Password, Re-enter Password and Email
              </div>
              <div class="alert alert-danger d-none uae" role="alert">
                  Username Or Email Already Exist
              </div>
              <div class="alert alert-danger d-none pm8c" role="alert">
                 Password Must 8 Character
              </div>
              <div class="alert alert-danger d-none cpp" role="alert">
                Confirmation Password Must Be same
              </div>
              <div class="alert alert-primary d-none success" role="alert">
                Successfull Registered
              </div>
              <form action="" method="post">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="" autocomplete="off">
                        <label for="floatingInput" class="text-dark"><i class="fa-solid fa-envelope"></i> Email</label>
                    </div>
                    <div class="form-floating mb-3 users">
                        <input type="text" class="form-control" name="username" id="floatingInput" placeholder="" autocomplete="off">
                        <label for="floatingInput" class="text-dark"><i class="fa-solid fa-user"></i> Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="" autocomplete="off">
                        <label for="floatingPassword" class="text-dark"><i class="fa-solid fa-lock"></i> Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="" autocomplete="off">
                        <label for="floatingPassword" class="text-dark"><i class="fa-solid fa-lock"></i> Re-enter Password</label>
                    </div>
                    <div class="mb-3 d-flex">
                      <input class="form-check-input me-1" type="checkbox" onclick="myFunction()">Show Password
                    </div>
                <button class="btn btn-outline-light btn-lg px-5" type="submit" name="signbtn">Sign Up</button>
              </form>
            </div>
            <div>
              <p class="mb-0">Already Have Account? <a href="login.php" class="text-white-50 fw-bold">Login</a>
              </p>
            </div>
          </div>
        </div>
        <?php
            if(isset($_POST['signbtn'])){
                  $email = htmlspecialchars($_POST['email']);
                  $username = htmlspecialchars($_POST['username']);
                  $password = htmlspecialchars($_POST['password']);
                  $cpassword = htmlspecialchars($_POST['cpassword']);
                  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                  if($username=='' || $password=='' || $email==''){
                    ?>
                    <script>
                      var isila = document.querySelector('.filal');
                      if (isila){
                      isila.classList.remove('d-none');
                      }
                      else {
                        console.log('class not found');
                      }
                      </script>
                    <?php
                  }
                else{
                  if (strlen($_POST["password"]) <= '7') {
                    ?>
                      <script>
                      var passui = document.querySelector('.pm8c');
                      if (passui){
                        passui.classList.remove('d-none');
                      }
                      else {
                        console.log('class not found');
                      }
                      </script>
                    <?php
                  }
                  else{
                    if ($password!= $cpassword){
                      ?>
                      <script>
                        var cpas = document.querySelector('.cpp');
                        if (cpas){
                          cpas.classList.remove('d-none');
                        }
                        else {
                          console.log('class not found');
                        }
                      </script>
                      <?php
                    }
                    else{
                      $check_query = mysqli_query($con, "SELECT * FROM users WHERE username = '$username' OR email = '$email'");
                      if (mysqli_num_rows($check_query) > 0) {
                        ?>
                        <script>
                          var uaes = document.querySelector('.uae');
                          if (uaes){
                            uaes.classList.remove('d-none');
                          }
                          else {
                            console.log('class not found');
                          }
                        </script>
                      <?php
                      }
                      else{
                        $input = mysqli_query($con, "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$hashed_password')");
                        if($input){
                          ?>
                          <script>
                          var pass = document.querySelector('.success');
                          if (pass){
                            pass.classList.remove('d-none');
                          }
                          else {
                            console.log('class not found');
                          }
                          </script>
                          <meta http-equiv="refresh" content="2; url=login.php">
                        <?php
                        }
                        else{
                          echo mysqli_error($con);
                        }
                      }
                    }
                  }
                }
            }
            ?>
      </div>
    </div>
  </div>
</section>
<script>
function myFunction() {
  var x = document.getElementById("floatingPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
  var y = document.getElementById("cpassword");
  if (y.type === "password") {
    y.type = "text";
  } else {
    y.type = "password";
  }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>