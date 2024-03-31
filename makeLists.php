<?php
spl_autoload_register(function ($class) {
    require_once 'assets/classes/' . $class . '.php';
});

session_start();

$connectionClass = new Connection();
$accessClasses = new Access();
$listsClass = new Lists();

$accessClasses->checkAccessEnglish();

include 'assets/components/header.php';
?>

<body class="wv-100 vh-100 bg-white d-flex flex-column">
    <div class="container mb-auto">
        <div class="row">
            <div class="alert alert-danger mt-3" role="alert" id="alertDangerList" style="display: none;">
                <div class="d-flex justify-content-center">
                    <div class="alert-link">LET OP! </div>
                    <div id="alertDangerListText" style="margin-left: 7.5px"></div>
                </div>
            </div>
            <div class="col-lg-12 h-100 mt-3">
                <div class="m-lg-3 p-lg-3 bg-white mt-lg-3 pt-3 pb-3 mt-3 p-3">
                    <div class="mt-5 mb-5">
                        <div class="mt-3 mb-3">
                            <label for="name" class="form-label">Naam van de lijst:</label>
                            <input type="text" class="form-control" id="nameList" aria-describedby="nameList"
                                name="nameList"" required>
                    </div>
                    <div class=" mt-3 mb-3">
                            <label for="name" class="form-label">Beschrijving van de lijst:</label>
                            <input type="text" class="form-control" id="descriptionList"
                                aria-describedby="descriptionList" name="descriptionList"" required>
                    </div>
                </div>
                <div class=" row" id="makeQuestionsField">
                        </div>
                        <button class="btn btn-primary" id="makeQuestions">Vraag toevoegen</button>
                        <button type="submit" class="btn btn-success" name="nextStep" onclick="registerQuestion()">Maak
                            lijst</button>
                    </div>
                </div>
            </div>
        </div>
</body>
<script>
    setDocumentBegin();
</script>

</html>