<?php
spl_autoload_register(function ($class) {
    require_once 'assets/classes/' . $class . '.php';
});

$questionClass = new Questions();
$connectionClass = new Connection();

try {
    $formData = json_decode($_POST['formData'], true);

    $questionClass->updateQuestion(
        $connectionClass->setConnection(),
        $formData['listId'],
        $formData['name'],
        $formData['description']
    );

    $questionsData = json_decode($_POST['data'], true);

    $questionClass->deleteQuestionsByListId(
        $connectionClass->setConnection(),
        $formData['listId']
    );

    foreach ($questionsData as $row) {
        $questionClass->insertQuestionLists(
            $formData['listId'],
            $row['question'],
            $row['answer'],
            $connectionClass->setConnection()
        );
    }

    echo 'Success';
} catch (Exception $e) {
    error_log('Error: ' . $e->getMessage());
    echo 'Error updating lists. Please try again.';
}
?>