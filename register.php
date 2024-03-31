<?php
spl_autoload_register(function ($class) {
    require_once 'assets/classes/' . $class . '.php';
});

session_start();

$connectionClass = new Connection();
$registerclass = new Register();

$result = 0;

if (isset($_POST['nextStep'])) {
    if ($_POST['password'] == $_POST['repeatPassword']) {
        $result = $registerclass->registerUser(htmlspecialchars($_POST['name']), $_POST['email'], htmlspecialchars($_POST['password']), $connectionClass->setConnection());
    } else {
        $result = 2;
    }
}

$connectionClass->setConnection();

include 'assets/components/header.php'
    ?>

<body class="wv-100 hv-100 bg-white d-flex flex-column">
    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="row">
            <form method="post" action="register.php">
                <div class="p-5 bg-white rounded shadow-sm">
                    <div class="row">
                        <div class="alert alert-danger" role="alert" id="alertDangerRegister" style="display: none;">
                            <div class="d-flex">
                                <div class="alert-link">LET OP! </div>
                                <div id="alertDangerText" style="margin-left: 7.5px"></div>
                            </div>
                        </div>
                        <div class="mb-3 col-lg-12">
                            <label for="name" class="form-label">Naam</label>
                            <input type="text" class="form-control" id="name" aria-describedby="nameHelp" name="name"
                                required>
                        </div>
                        <div class="mb-3 col-lg-12">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                name="email" required>
                        </div>
                        <div class="mb-3 col-lg-12">
                            <label for="password" class="form-label">Wachtwoord</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3 col-lg-12">
                            <label for="repeatPassword" class="form-label">Herhaal wachtwoord</label>
                            <input type="password" class="form-control" id="repeatPassword" name="repeatPassword"
                                required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" name="nextStep"
                        onclick="checkDubbleExpression(password.value,repeatPassword.value)">Volgende</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<?php
if ($result == 1) {
    echo '<script>setMessageAlertBoxLogin("alertDangerRegister","alertDangerText","naam al bezet")</script>';
}
if ($result == 2) {
    echo '<script>setMessageAlertBoxLogin("alertDangerRegister","alertDangerText","wachtwoord en herhaal wachtwoord komen niet overeen")</script>';
}
if ($result == 3) {
    echo '<script>goToPage("login.php")</script>';
}
?>