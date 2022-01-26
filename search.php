<?php require __DIR__ . '/navigation.php';


$results = get_results($database); ?>

<div class="content-panel">
    <h2 class="title">Index</h2>
    <fieldset class="fieldset">
        <h3 class="fieldset-title">Search</h3>
        <article class="search-results">
            <h4>Here is your search results: </h4>
            <ul>
                <?php foreach ($results as $task) : ?>
                    <?php if ($_SESSION['user']['id']) : ?>
                        <li>
                            <h5><?= $task['title'] ?></h5>
                            <p>Description: <?= $task['description'] ?> <br>
                                Deadline: <?= $task['due_date']; ?> <br>
                                List: <?= $task['list_title']; ?></p>
                        </li>
                    <?php endif ?>
                <?php endforeach ?>
            </ul>
        </article>

        <?php
