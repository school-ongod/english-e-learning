<?php

class Login
{
    public function loginFunction($name, $password, $conn)
    {
        $sql = "SELECT * FROM `users` WHERE name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            try {
                while ($row = $result->fetch_array()) {
                    $passwordreturn = password_verify($password, $row['password']);

                    if ($passwordreturn) {
                        $_SESSION['session_id'] = session_id();
                        $_SESSION['users_id'] = $row['id'];
                        $_SESSION['gebruikersnaam'] = $name;
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['date_created'] = $row['date_created'];
                        $startDate = date('d-m-y h:i:s');
                        $_SESSION['date_logged_in_format'] = $startDate;
                        $_SESSION['date_logged_in_seconds'] = strtotime($startDate);
                        $_SESSION['logged_in'] = 1;
                        return 3;
                    } else {
                        return 2;
                    }
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            return 1;
        }
    }
}