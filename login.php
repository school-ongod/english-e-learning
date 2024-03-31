<?php
spl_autoload_register(function ($class) {
    require_once 'assets/classes/' . $class . '.php';
});

session_start();

$conntionClass = new Connection();

$loginClass = new Login();

$result = 0;

if (isset($_POST['nextStep'])) {
    $result = $loginClass->loginFunction(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['password']), $conntionClass->setConnection());
}
function alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

include 'assets/components/header.php';
?>

<body class="wv-100 hv-100 bg-white d-flex flex-column">
    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="row">
            <form method="post" action="login.php">
                <div class="p-5 bg-white rounded shadow-sm">
                    <div class="row">
                        <div class="alert alert-danger" role="alert" id="alertDangerLogin" style="display: none;">
                            <div class="d-flex">
                                <div class="alert-link">LET OP! </div>
                                <div id="alertDangerLoginText" style="margin-left: 7.5px"></div>
                            </div>
                        </div>
                        <div class="mb-3 col-lg-12">
                            <label for="name" class="form-label">Naam</label>
                            <input type="text" class="form-control" id="name" aria-describedby="nameHelp" name="name"
                                required>
                        </div>
                        <div class="mb-3 col-lg-12">
                            <label for="password" class="form-label">Wachtwoord</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" name="nextStep"
                        onclick="checkPasswordLogin(name.value, password.value)">Inloggen</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<?php
if ($result == 1) {
    echo '<script>setMessageAlertBoxLogin("alertDangerLogin","alertDangerLoginText","Verkeerde naam")</script>';
}
if ($result == 2) {
    echo '<script>setMessageAlertBoxLogin("alertDangerLogin","alertDangerLoginText","Naam en wachtwoord komen niet overeen")</script>';
}
if ($result == 3) {
    echo '<script>goToPage("lists.php")</script>';
}
?>