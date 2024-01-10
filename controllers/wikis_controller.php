<?php
// redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header('location: index.php?page=login');
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['type']) && !empty($data['type'] && $data['type'] === 'getCat')) {
        $result = Category::getAll();
        if ($result) {
            exit(json_encode($result));
        }
        exit();
    }

    if (isset($data['type']) && $data['type'] === 'addWiki') {
        $result = Wiki::add($data['title'], $data['content'], $_SESSION['user_id'], $data['id_category']);
        if ($result !== false) {
            exit(true);
        }
        exit();
    }
}