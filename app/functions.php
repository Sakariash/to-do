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
