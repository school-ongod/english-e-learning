<?php

class Register
{
    public function registerUser($name, $email, $password, $connection)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if ($this->isUserNameTaken($name, $connection)) {
            return 1;
        }

        $this->insertUser($name, $email, $hashedPassword, $connection);
        return 3;
    }

    private function isUserNameTaken($name, $connection)
    {
        $sql = "SELECT name FROM users WHERE name = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_array() !== null;
    }

    private function insertUser($name, $email, $password, $connection)
    {
        $sql = "INSERT INTO `users`(`name`, `email`, `password`) VALUES (?,?,?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $password);
        $stmt->execute();
    }
}
