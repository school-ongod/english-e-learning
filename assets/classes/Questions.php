<?php

class Questions
{
    public function insertQuestionLists($list_id, $question, $answer, $connection)
    {
        $this->executeInsert("INSERT INTO `lists_questions`(`lists_id`, `question`, `good_answer`) VALUES (?,?,?)", "iss", [$list_id, htmlspecialchars($question), htmlspecialchars($answer)], $connection);
    }

    public function insertList($userId, $name, $description, $connection)
    {
        $this->executeInsert("INSERT INTO `lists`(`users_id`, `name`, `description`) VALUES (?,?,?)", "iss", [$userId, htmlspecialchars($name), htmlspecialchars($description)], $connection);
    }

    public function findListId($connection)
    {
        return $this->executeQuery("SELECT * FROM `lists`", $connection)->num_rows;
    }

    public function getAllQuestionsByListId($id, $connection)
    {
        return $this->executeQuery("SELECT * FROM `lists_questions` WHERE lists_id = ?", $connection, "i", [$id]);
    }

    public function updateQuestion($connection, $id, $name, $description)
    {
        $this->executeUpdate("UPDATE `lists` SET `name`= ?, `description`= ? WHERE id = ?", "ssi", [htmlspecialchars($name), htmlspecialchars($description), $id], $connection);
    }

    public function getAllQuestionsDataByListId($id, $connection)
    {
        $stmt = $this->executeQuery("SELECT id, lists_id, question FROM `lists_questions` WHERE lists_id = ?", $connection, "i", [$id]);
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    public function updateQuestionLists($connection, $question, $goodAnswer, $question_id)
    {
        $this->executeUpdate("UPDATE `lists_questions` SET `question`= ?, `good_answer`= ? WHERE id = ?", "ssi", [htmlspecialchars($question), htmlspecialchars($goodAnswer), $question_id], $connection);
    }

    public function deleteQuestionsByListId($connection, $list_id)
    {
        $this->executeDelete("DELETE FROM `lists_questions` WHERE `lists_id` = ?", "i", [$list_id], $connection);
    }

    public function getQuestionAnswerById($questionId, $connection)
    {
        $stmt = $this->executeQuery("SELECT good_answer FROM `lists_questions` WHERE id = ?", $connection, "i", [$questionId]);
        $result = $stmt->fetch_array(MYSQLI_ASSOC);
        return $result['good_answer'];
    }

    private function executeInsert($sql, $types, $values, $connection)
    {
        $stmt = $connection->prepare($sql);
        $stmt->bind_param($types, ...$values);
        $stmt->execute();
    }

    private function executeQuery($sql, $connection, $types = null, $values = null)
    {
        $stmt = $connection->prepare($sql);

        if ($types !== null && $values !== null) {
            $stmt->bind_param($types, ...$values);
        }

        $stmt->execute();
        return $stmt->get_result();
    }

    private function executeUpdate($sql, $types, $values, $connection)
    {
        $stmt = $connection->prepare($sql);
        $stmt->bind_param($types, ...$values);

        if (!$stmt->execute()) {
            die('Error updating: ' . $stmt->error);
        }
    }

    private function executeDelete($sql, $types, $values, $connection)
    {
        $stmt = $connection->prepare($sql);
        $stmt->bind_param($types, ...$values);
        $stmt->execute();
    }
}
