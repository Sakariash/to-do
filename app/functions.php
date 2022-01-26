<?php

declare(strict_types=1);

// require __DIR__ . '/autoload.php';

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

function get_all_tasks($database)
{
    $user_id = $_SESSION['user']['id'];

    $query = 'SELECT * FROM tasks WHERE user_id = :user_id';
    $statement = $database->prepare($query);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->execute();

    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $tasks;
}

function get_all_lists($database)
{

    $user_id = $_SESSION['user']['id'];

    $query = 'SELECT * FROM lists WHERE user_id = :user_id';
    $statement = $database->prepare($query);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->execute();

    $lists = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $lists;
}

function get_user($database)
{
    $id = $_SESSION['user']['id'];
    $statement = $database->prepare('SELECT * FROM users WHERE id = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $users = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $users;
}

function due_date($database)
{
    $due_date = date('Y-m-d');
    $user_id = $_SESSION['user']['id'];

    $query = 'SELECT * FROM tasks WHERE user_id = :user_id AND due_date = :due_date';
    $statement = $database->prepare($query);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->bindParam(':due_date', $due_date, PDO::PARAM_STR);
    $statement->execute();

    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $tasks;
}

function tasksToComplete($database, $user_id)
{

    $query = 'SELECT * FROM tasks WHERE user_id = :user_id AND completed = NULL';

    $statement = $database->prepare($query);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->execute();

    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $tasks;
}
// function back() {
//     redirect($_SERVER['HTTP_REFERER']);
// }

// function for search

function get_results(PDO $database)
{
    $user_id = $_SESSION['user']['id'];
    if (isset($_POST['search'])) {
        $trim_search = trim($_POST['search']);
        $sanitize_search = filter_var($trim_search, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $search = "%" . ($sanitize_search) . "%";
        $statement = $database->prepare(
            'SELECT tasks.id, tasks.due_date, tasks.list_id, tasks.title, tasks.user_id, tasks.completed, tasks.description, lists.title
            AS list_title
            FROM tasks
            INNER JOIN  lists
            ON tasks.list_id = list_id
            WHERE tasks.user_id = :user_id
            AND (tasks.title
            LIKE :search
            OR tasks.description
            LIKE :search
            OR list_title
            LIKE :search)'
        );
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindParam(':search', $search, PDO::PARAM_STR);
        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}
