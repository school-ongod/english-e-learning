<?php

class Lists
{
    public function getPrivateLists($conn, $users_id)
    {
        $sql = "SELECT *, lists.name AS lists_name, lists.id AS lists_id
                FROM lists
                LEFT JOIN users ON lists.users_id = users.id
                WHERE users.id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $users_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function getPublicLists($conn)
    {
        $sql = "SELECT *, lists.name AS lists_name, lists.id AS lists_id
                FROM lists";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function getListByListId($conn, $id)
    {
        $sql = "SELECT * FROM lists WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }
}
