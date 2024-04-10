<?php
spl_autoload_register(function ($class) {
    require_once 'assets/classes/' . $class . '.php';
});

$connectionClass = new Connection();
$questionsClass = new Questions();
$listsClass = new Lists();

$array = [];

try {
    $listId = filter_input(INPUT_GET, 'listId', FILTER_VALIDATE_INT);
    if ($listId === false || $listId === null) {
        throw new Exception('Invalid listId parameter.');
    }

    $dataArrayQuestions = $questionsClass->getAllQuestionsDataByListId($listId, $connectionClass->setConnection());

    if ($dataArrayQuestions) {
        foreach ($dataArrayQuestions as $question) {
            $array[] = [
                'id' => $question['id'],
                'lists_id' => $question['lists_id'],
                'question' => $question['question']
            ];
        }
    }

    echo json_encode($array);
} catch (Exception $e) {
    error_log('Error: ' . $e->getMessage());
    echo json_encode(['error' => 'Error fetching questions.']);
}
?>