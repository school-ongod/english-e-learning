<?php
session_start();

include 'assets/components/header.php';
?>

<body class="wv-100 hv-100 bg-white d-flex flex-column">
    <div class="container mb-auto">
        <div class="row justify-content-center align-items-center bg-transparent"
            style="position: relative; height: 90vh;">
            <div class="col-lg-12">
                <div class="m-lg-3 p-lg-3 mt-lg-3 pt-3 pb-3 mt-3 mb-3 d-flex justify-content-center align-items-center">
                    <h1>English E-Learning</h1>
                </div>
                <div class="m-lg-3 p-lg-3 mt-lg-3 pt-3 pb-3 mt-3 mb-3 d-flex justify-content-center align-items-center">
                    <iframe width="900" height="500" src="https://www.youtube.com/embed/VIDEO_ID" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_SESSION['session_id'])) {
    if ($_SESSION['logged_in'] == 1) {
        echo '<script>setMessageAlertBoxLogin("alertSuccessIndex","alertSuccessIndexText","Succes vol ingelogd")</script>';

        $_SESSION['logged_in'] = 2;
    }
} else {
    echo '<script>setMessageAlertBoxLogin("alertDangerIndex","alertDangerIndexText","nog niet ingelogd, log in om lijsten aan te maken en te spelen")</script>';
}
?>