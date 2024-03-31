<?php
echo '
<!doctype html>
    <html lang="nl">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>English E-learning</title>
    
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <link rel="stylesheet" href="assets/css/styles.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
      <script rel="script" src="assets/js/index.js"></script>
      <script rel="script" src="assets/js/editLists.js"></script>
    </head>
    
    <header class="header-shadow">
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
        <a class="navbar-brand m-2" href="./index.php"><i class="fa fa-home" aria-hidden="true"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    ';

if (isset($_SESSION['session_id']) && $_SESSION['session_id'] == session_id()) {
    echo '
                <div class="collapse navbar-collapse" id="navbarText" style="justify-content: end !important;">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link m-2" href="./lists.php">Lijsten</a>
                        </li>
                    </ul>
                    <a class="btn btn-primary m-2" href="./logout.php">Uitloggen</a>
                </div>
            </div>
        </nav>
    </header>';
} else {
    echo '
             <div class="collapse navbar-collapse" id="navbarText">
                 <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                     <li class="nav-item">
                         <p class="m-0 text-white">hallo</p>
                     </li>
                 </ul>
                 <a class="btn btn-success w-auto m-2" href="./login.php">Inloggen</a>
                 <a class="btn btn-primary w-auto m-2" href="./register.php">Registreren</a>
            </div>
        </div>
    </nav>
    </header>';
}
?>