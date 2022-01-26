<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

$tasks = get_all_tasks($database);

if (isset($_POST['title'], $_POST['description'])) :
    $userId = $_SESSION['user']['id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $taskId = $_POST['edit-task'];

    if (isset($_POST['date'])) :
        if ($_POST['date'] >= date('Y-m-d')) :
            $dueDate = $_POST['date'];
        else :
            $_SESSION['errors'][] = 'The date has already past, choose a later date.';
            redirect('/tasks.php');
        endif;
        if (isset($_POST['list'])) :
            $listId = trim($_POST['list']);
        else :
            $listId = 0;
        endif;
    endif;

    $query = 'UPDATE tasks SET title = :title, description = :description, list_id = :list_id, due_date = :due_date WHERE id = :id AND user_id = :user_id';

    $statement = $database->prepare($query);
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    $statement->bindParam(':list_id', $listId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->bindParam(':due_date', $dueDate, PDO::PARAM_STR);

    $statement->execute();

    $_SESSION['task-updated'] = 'Your task was successfully updated.';
    redirect('/tasks.php');
endif;

if (isset($_POST['completed-switch'])) :
    $taskId = $_POST['completed-switch'];
    $completed = true;

    foreach ($tasks as $task) :
        if ($task['id'] === $taskId) :
            if ($task['completed'] == $completed) :
                $completed = false;

                $query = 'UPDATE tasks SET completed = :completed WHERE id = :id';
                $statement = $database->prepare($query);
                $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
                $statement->bindParam(':completed', $completed, PDO::PARAM_BOOL);
                $statement->execute();

                $_SESSION['task-uncompleted'] = 'Ye it be like that sometimes.. You\'ll get there!';

                redirect('/tasks.php');
            endif;
        endif;
    endforeach;

    $query = 'UPDATE tasks SET completed = :completed WHERE id = :id';
    $statement = $database->prepare($query);
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
    $statement->bindParam(':completed', $completed, PDO::PARAM_BOOL);
    $statement->execute();

    $_SESSION['task-done'] = 'You got it done, great job!';

    redirect('/tasks.php');
endif;

$_SESSION['errors'][] = 'Something went wrong.';

redirect('/tasks.php');
