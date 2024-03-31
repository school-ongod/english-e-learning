<?php
spl_autoload_register(function ($class) {
    require_once 'assets/classes/' . $class . '.php';
});

$connectionClass = new Connection();
$questionsClass = new Questions();
$listsClass = new Lists();

$array = [];

try {
    $listId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    if ($listId === false || $listId === null) {
        throw new Exception('Invalid id parameter.');
    }

    $dataArrayQuestions = $questionsClass->getAllQuestionsByListId($listId, $connectionClass->setConnection());

    while ($row = $dataArrayQuestions->fetch_assoc()) {
        $array[] = $row;
    }

    echo json_encode($array);
} catch (Exception $e) {
    error_log('Error: ' . $e->getMessage());
    echo json_encode(['error' => 'Error fetching questions.']);
}
?>