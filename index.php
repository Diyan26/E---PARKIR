<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Boostrap Login </title>
</head>
<body>

    <!----------------------- Main Container -------------------------->

     <div class="container d-flex justify-content-center align-items-center min-vh-100">

    <!----------------------- Login Container -------------------------->

       <div class="row border rounded-5 p-3 bg-white shadow box-area">

    <!--------------------------- Left Box ----------------------------->

       <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #103cbe;">
           <div class="featured-image mb-3">
            <img src="img/6828552_27488.svg" class="img-fluid" style="width: 500px;">
           </div>
           <p class="text-white fs-2 mb-4" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">SISTEM E - PARKIR</p>
          <small class="text-white text-wrap text-center mb-4" style="width: 17rem; font-family: 'Courier New', Courier, monospace;">Selamat datang di E-Parkir, layanan parkir modern untuk kemudahan dan efisiensi</small>
          
        </div> 

    <!-------------------- ------ Right Box ---------------------------->
        
                <div class="col-md-6 right-box">
                <div class="card-body">
                      <!-- Logo -->
                      <div class="text-center mb-3">
                          <img src="img/park_898366.png" class="img-fluid" alt="Logo" style="width: 100px;">
                      </div>
                      <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0">Login</p>
                      </div>
                      <?php
                        // Tampilkan pesan gagal jika ada
                        if (isset($_SESSION['login_error'])) {
                            echo "<p class='text-danger'>{$_SESSION['login_error']}</p>";
                            unset($_SESSION['login_error']); // Hapus pesan dari session setelah ditampilkan
                        }
                        ?>
                     <!-- Form -->
                      <form action="aksilogin.php" method="post">
                          <div class="input-group mb-3">
                              <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Username" name="username">
                          </div>
                          <div class="input-group mb-1">
                              <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" name="password">
                          </div>
                          <div class="input-group mb-3">
                              <button type="submit" class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                          </div>
                      </form>
                  </div>
                </div>
            </div>
       </div> 
      </div>
    </div>

</body>
</html>