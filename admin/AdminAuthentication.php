<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign in - Thriftify</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body>

  <?php
  session_start();
  if (isset($_POST['login'])) {

    session_start();
    require('db_con.php');

    $username = $_POST['email'];
    $password = $_POST['password'];

    $remember = isset($_POST['remember']) ? $_POST['remember'] : 0;

    if ($remember == 1) {
      setcookie('uname', $username, time() + 60 * 60, "/");
      setcookie('upass', $password, time() + 60 * 60, "/");
    } else {
      setcookie('0', $remember, time() + 60 * 60, "/");
    }

    $sql = "select * from admins where Admin_Email='$username' && Admin_Password='$password'";

    $query = mysqli_query($connection, $sql) or die("Failed with loging in.");
    $count = mysqli_num_rows($query);

    if ($count == 1) {
      $_SESSION['user'] = $username; // Fix the typo '$_SESSOIN' to $_SESSION
      header("Location: index.html");
    } else {
      echo "<script type='text/javascript'>alert('Email or/and password is incorrect, please try again!');</script>";
    }
  }

  ?>

  <!-- NAV BAR  -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
      <!-- Brand centered -->
      <a href="index.html" class="navbar-brand">THRIFTIFY</a>
      <!-- Navbar toggler -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <!-- Left side of navbar -->
          <li class="nav-item">
            <a href="index.html" class="nav-link">
              <i class="bi bi-house" style="margin-right: 20px">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                  <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                </svg>
              </i>
              Home
            </a>
          </li>
          <!-- right side of navbar -->
          <li class="nav-item">
            <a href="./sign_in.html" class="nav-link">
              <i class="bi bi-person" style="margin-right: 20px">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                </svg>
              </i>
              Account
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container" style="margin-top: 149px; margin-bottom: 400px">
    <main class="form-signin">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <form id="auth" action="AdminAuthentication.php" method="POST">
            <h1 class="h3 mb-3 fw-normal text-center">Sign In As an Admin</h1>
            <div class="form-floating mb-3">
              <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required />
              <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required />
              <label for="floatingPassword">Password</label>
            </div>
            <div class="form-check mb-3">
              <input class="form-check-input" name="remember" type="checkbox" id="flexCheckDefault" />
              <label class="form-check-label" for="flexCheckDefault">
                Remember me
              </label>
            </div>
            <button class="btn btn-secondary w-100" type="submit" name="login">
              Sign in
            </button>
          </form>
        </div>
      </div>
    </main>
  </div>
  <!-- footer  -->
  <footer class="bg-dark text-light py-3 text-center" style="margin-top: 150px">
    <div class="container">
      <div class="col">
        <a class="nav-link text-light" href="#">Country/Region: Saudi Arabia</a>
      </div>
    </div>
    <div class="row mt-2">
      <!-- Added margin top to create space -->
      <div class="col">
        <p>
          THRIFTIFY and the THRIFTIFY logo are trademarks of Thriftify and are
          registered or pending registration in numerous jurisdictions around
          the world. &copy; Copyright 2024 Thriftify. All rights reserved.
        </p>
      </div>
    </div>
  </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</html>