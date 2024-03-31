<?php
spl_autoload_register(function ($class) {
    require_once 'assets/classes/' . $class . '.php';
});

session_start();

$connectionClass = new Connection();
$accessClasses = new Access();
$questionsClass = new Questions();
$listsClass = new Lists();

$accessClasses->checkFormIsPressed();
$accessClasses->checkAccessEnglish();
$dataArrayQuestions = $questionsClass->getAllQuestionsByListId($_POST['listId'], $connectionClass->setConnection());

$dataArrayList = $listsClass->getListByListId($connectionClass->setConnection(), $_POST['listId']);
$recordsList = $dataArrayList->fetch_assoc();

$listId = $_POST['listId'];

include 'assets/components/header.php';
?>

<body class="wv-100 vh-100 bg-white d-flex flex-column">
    <div class="container mb-auto">
        <div class="row">
            <div class="col-lg-12 h-100 mt-3">
                <div class="m-lg-3 p-lg-3 bg-white mt-lg-3 pt-3 pb-3 mt-3 p-3">
                    <div class="mt-5 mb-5">
                        <div class="mt-3 mb-3">
                            <input type="hidden" id="listId" name="listId" value="<?php echo $listId; ?>">
                            <label for="name" class="form-label">Naam van de lijst:</label>
                            <input type="text" class="form-control" id="nameList" aria-describedby="nameList"
                                name="nameList" value="<?php echo htmlspecialchars($recordsList['name']); ?>" required>
                        </div>
                        <div class="mt-3 mb-3">
                            <label for="name" class="form-label">Beschrijving van de lijst:</label>
                            <input type="text" class="form-control" id="descriptionList"
                                aria-describedby="descriptionList"
                                value="<?php echo htmlspecialchars($recordsList['description']); ?>"
                                name="descriptionList" required>
                        </div>
                    </div>
                    <div class=" row" id="makeQuestionsField">
                    </div>
                    <button class="btn btn-primary" onclick="addQuestionBlock()">Vraag toevoegen</button>
                    <button type="submit" class="btn btn-success" name="nextStep"
                        onclick="registerUpdate()">Opslaan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        setFieldsEdit(<?php echo $listId; ?>);
        loadQuestionsEditLength(<?php echo $listId; ?>);
    </script>
</body>