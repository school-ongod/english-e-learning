<?php
spl_autoload_register(function ($class) {
    require_once 'assets/classes/' . $class . '.php';
});

$connectionClass = new Connection();
$questionsClass = new Questions();

try {
    $questionId = filter_input(INPUT_GET, 'questionId', FILTER_VALIDATE_INT);
    $userAnswer = filter_input(INPUT_GET, 'answer', FILTER_SANITIZE_STRING);

    if ($questionId === false || $questionId === null || $userAnswer === false || $userAnswer === null) {
        throw new Exception('Invalid parameters.');
    }

    $goodAnswer = $questionsClass->getQuestionAnswerById($questionId, $connectionClass->setConnection());

    if ($goodAnswer === false) {
        throw new Exception('Question not found.');
    }

    if ($userAnswer === $goodAnswer) {
        echo json_encode(['result' => 'correct']);
    } else {
        echo json_encode(['result' => 'incorrect', 'correct_answer' => $goodAnswer]);
    }
} catch (Exception $e) {
    error_log('Error: ' . $e->getMessage());
    echo json_encode(['error' => 'Error checking answer: ' . $e->getMessage()]);
}
?>