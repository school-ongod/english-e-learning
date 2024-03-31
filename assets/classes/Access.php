<?php

class Access
{
    public function checkAccessEnglish()
    {
        if (isset($_SESSION['session_id']) && $_SESSION['session_id'] == session_id()) {
            $startDateSeconds = $_SESSION['date_logged_in_seconds'];

            $nowDate = date('d-m-y h:i:s');
            $startDateSecondsEnds = $startDateSeconds + (2.5 * (60 * 60));
            $nowDateSeconds = strtotime($nowDate);

            if ($startDateSecondsEnds < $nowDateSeconds) {
                $this->redirect('logout.php');
            }
        } else {
            $this->redirect('login.php');
        }
    }

    public function checkFormIsPressed()
    {
        if (!isset($_POST['submit'])) {
            $this->redirect('lists.php');
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
        exit();
    }
}