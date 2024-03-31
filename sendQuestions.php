<?php
spl_autoload_register(function ($class) {
    require_once 'assets/classes/' . $class . '.php';
});

session_start();

$connectionClass = new Connection();
$questionClass = new Questions();

$data = null;
$dataFrom = null;

if (isset($_POST["data"]) && isset($_POST['formData'])) {
    $data = $_POST["data"];
    $dataFrom = $_POST["formData"];

    $questionClass->insertList($_SESSION["users_id"], $dataFrom[0], $dataFrom[1], $connectionClass->setConnection());

    foreach ($data as $record) {
        $questionClass->insertQuestionLists($questionClass->findListId($connectionClass->setConnection()), $record[0], $record[1], $connectionClass->setConnection());
    }
}
?>