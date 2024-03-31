<?php
spl_autoload_register(function ($class) {
    require_once 'assets/classes/' . $class . '.php';
});

session_start();

$connectionClass = new Connection();
$accessClasses = new Access();
$listsClass = new Lists();

$accessClasses->checkAccessEnglish();

include 'assets/components/header.php';
?>

<body class="wv-100 vh-100 bg-white d-flex flex-column">
    <div class="container mb-auto">
        <div class="row">
            <div class="col-lg-6 h-100 mb-3">
                <div class="bg-white p-lg-3 m-lg-3 rounded pt-3 pb-3 mb-3">
                    <div class="m-lg-3 m-lg-2 rounded m-3 d-flex justify-content-between">
                        <h5>Mijn lijsten:</h5>
                        <a class="btn btn-primary" href="makeLists.php">+</a>
                    </div>
                    <?php
                    $myListsResult = $listsClass->getPrivateLists($connectionClass->setConnection(), $_SESSION['users_id']);

                    if ($myListsResult->num_rows > 0) {
                        while ($myListRow = $myListsResult->fetch_assoc()) {
                            echo '<div class="m-lg-2 bg-light p-lg-3 hover-background-gray mt-3 mb-3 pt-3 pb-3 rounded m-3 p-3">
                                <h6>' . $myListRow['lists_name'] . '</h6>
                                <p>' . $myListRow['description'] . '</p>
                                <div class="d-flex">
                                    <form action="playList.php" method="post">
                                        <input type="hidden" name="listId" id="listId" value="' . $myListRow['lists_id'] . '">
                                        <input type="hidden" name="listUserId" id="listUserId" value="' . $myListRow['users_id'] . '">
                                        <input type="submit" class="btn btn-primary" value="Maken">
                                    </form>
                                    <form action="editLists.php" method="post" style="margin-left: 5px !important;">
                                        <input type="hidden" id="listId" name="listId" value="' . $myListRow['lists_id'] . '">
                                        <input type="hidden" name="listUserId" id="listUserId" value="' . $myListRow['users_id'] . '">
                                        <input type="submit" name="submit" class="btn btn-secondary" value="Wijzigen">
                                    </form>
                                </div>
                            </div>';
                        }
                    } else {
                        echo '<div class="m-3">Geen lijsten gevonden</div>';
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-6 h-100 mb-3">
                <div class="bg-white p-lg-3 m-lg-3 rounded pt-3 pb-3 mb-3">
                    <div class="m-lg-3 col-lg-12 m-lg-2 rounded m-3">
                        <h5>Alle lijsten:</h5>
                    </div>
                    <?php
                    $publicListsResult = $listsClass->getPublicLists($connectionClass->setConnection());

                    if ($publicListsResult->num_rows > 0) {
                        while ($publicListRow = $publicListsResult->fetch_assoc()) {
                            echo '<div class="m-lg-2 bg-light p-lg-3 hover-background-gray mt-3 mb-3 pt-3 pb-3 rounded m-3 p-3">
                                <h6>' . $publicListRow['lists_name'] . '</h6>
                                <p>' . $publicListRow['description'] . '</p>
                                <div class="d-flex justify-content-between">
                                    <form class="m-0" method="post" action="playList.php">
                                        <input type="hidden" name="listId" id="listId" value="' . $publicListRow['lists_id'] . '">
                                        <input type="hidden" name="listUserId" id="listUserId" value="' . $publicListRow['users_id'] . '">
                                        <input type="submit" class="btn btn-primary" value="Maken">
                                    </form>
                                </div>
                            </div>';
                        }
                    } else {
                        echo '<div class="m-3">Geen lijsten gevonden</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>