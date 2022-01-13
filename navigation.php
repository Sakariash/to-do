<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<!-- https://stackoverflow.com/questions/13336200/add-class-active-to-active-page-using-php -->
<?php
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$first_part = $components[1];
?>

<article>
    <?php if (!isset($_SESSION['user'])) :  ?>
        <div class="container">
            <div class="view-account">
                <section class="module">
                    <div class="module-inner">
                        <div class="side-bar">
                            <div class="user-info">
                                <img class="img-profile img-circle img-responsive center-block" src="/assets/images/Tick-Green-Check.png" alt="">
                                <!-- <img class="img-profile img-circle img-responsive center-block" src="<?php echo $_SESSION['user']['image']; ?>" alt=""> -->
                                <ul class="meta list list-unstyled">
                                    <li class="name">Wunderlist<br>
                                        <label class="label label-info">Just do it!</label>
                                    </li>
                                    <li class="email"><a href="www.simonhelier.com">www.simonhelier.com</a></li>
                                    <li class="activity" style=font-size:12px;>"If you give me 30 days to do a php project, it will take me 30 days. But if I haven't done anything in the first 27 days don't make a fool out of me, I will finish it in 3." - Larry </li>
                                </ul>
                            </div>
                            <nav class="side-menu">
                                <ul class="nav">
                                    <li class="
                                    <?php
                                    if ($first_part == "login.php") : echo "active";
                                    endif; ?>"><a href="/login.php">Log in</a></li>
                                    <li class="
                                    <?php
                                    if ($first_part == "register.php") : echo "active";
                                    endif; ?>"><a href="/register.php">Register</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- END NO USER IS -->
    <?php if (isset($_SESSION['user'])) :
        get_user($database);
        get_all_tasks($database); ?>
        <div class="container">
            <div class="view-account">
                <section class="module">
                    <div class="module-inner">
                        <div class="side-bar">
                            <div class="user-info">
                                <img class="img-profile img-circle img-responsive" src="/assets/images/Tick-Green-Check.png" alt="">
                                <ul class="meta list list-unstyled">
                                    <li class="name"><?php echo $_SESSION['user']['name'] ?><br>
                                        <label class="label-sm label-info">Just do it!</label>
                                    </li>
                                </ul>
                            </div>
                            <nav class="side-menu">
                                <ul class="nav">
                                    <li class="
                                                    <?php
                                                    if ($first_part == "index.php") : echo "active";
                                                    endif; ?>"><a href="/index.php">Home</a></li>
                                    <li class="
                                                    <?php
                                                    if ($first_part == "profile.php") : echo "active";
                                                    endif; ?>"><a href="/profile.php">Profile</a></li>
                                    <li class="
                                                    <?php
                                                    if ($first_part == "tasks.php") : echo "active";
                                                    endif; ?>"><a href="/tasks.php">Tasks</a></li>
                                    <li class="
                                                    <?php
                                                    if ($first_part == "lists.php") : echo "active";
                                                    endif; ?>"><a href="/lists.php">Lists</a></li>
                                    <li class="
                                                    <?php
                                                    if ($first_part == "logout.php") : echo "active";
                                                    endif; ?>"><a href="/app/users/logout.php">Log out</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
            </div>
        </div>
    <?php endif; ?>
