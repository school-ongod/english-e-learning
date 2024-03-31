<?php
spl_autoload_register(function ($class) {
    require_once 'assets/classes/' . $class . '.php';
});

session_start();

$accessClasses = new Access();
$listsClass = new Lists();
$accessClasses->checkAccessEnglish();

include 'assets/components/header.php';
?>

<body class="wv-100 hv-100 bg-white d-flex flex-column">
    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="row w-100">
            <div class="p-5 bg-white rounded shadow-sm">
                <div id="displayOne" style="display: block;">
                    <div class="row">
                        <div class="mb-3 col-lg-12">
                            <div id="questionBlockPlay"></div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" name="nextStep"
                        onclick="checkAnswer($('#answer').val())" value="Controleren">
                </div>
                <div id="displayTwo" style="display: none;">
                    <h5>Resultaten van <span>
                            <?php echo $_SESSION['gebruikersnaam']; ?>
                        </span>:</h5>
                    <p>- Je hebt <span id="good"></span> vragen goed<br>- Je hebt <span id="wrong"></span> vragen fout
                    </p>
                    <button type="submit" name="submit" class="btn btn-primary"
                        onclick="window.location.href = './lists.php'">Terug</button>
                </div>
            </div>
        </div>
        <div class="progress" style="position: absolute; width: 75%; bottom: 50px;">
            <div class="progress-bar progress-bar" id="progressBar" role="progressbar" style="width: 0%;"
                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
</body>
<script>loadQuestions(<?php echo $_POST['listId']; ?>);</script>