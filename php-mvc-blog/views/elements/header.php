<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/library/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/content/bootstrap-theme.css">
    <link rel="stylesheet" href="/library/phpLib/Paging/public/css/zebra_pagination.css" type="text/css">
    <link rel="stylesheet" href="/content/styles.css">
    <script type="text/javascript" src="/library/jquery-2.1.3.js"></script>
    <title>
        <?php if (isset($this->title)) echo htmlspecialchars($this->title) ?>
    </title>
</head>

<body>
<header>
    <nav class="navbar navbar-default">
        <div><a href="/"><img src="/content/images/logo.png"></a></div>
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Creative Blog</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="/posts/index">Posts</a></li>
                    <?php if ($this->auth->isLogged()): ?>
                        <li><a href="/posts/add">Add post</a></li>
                    <?php endif; ?>
                    <form class="navbar-form navbar-left" role="search" action="/posts/index" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search" name="tagName">
                        </div>
                        <input type="hidden" name="searched" value="1"/>
                        <button type="submit" class="btn btn-default">Search</button>
                    </form>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <?php if (!$this->auth->isLogged()): ?>
                        <li><a href="/register/index">Register</a></li>
                        <li><a href="/login/index">Log in</a></li>
                    <?php endif; ?>
                    <?php if ($this->auth->isLogged()): ?>
                        <li><a href="/logout/index">Log out</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <?php if (isset($_SESSION['message'])): ?>
        <?php if ($_SESSION['message']['type'] == 'error'): ?>
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong><?php echo $_SESSION['message']['text']; ?></strong>
            </div>
        <?php endif; ?>
        <?php if ($_SESSION['message']['type'] == 'info'): ?>
            <div class="alert alert-dismissible alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong><?php echo $_SESSION['message']['text']; ?></strong>
            </div>
        <?php endif; ?>
        <?php unset($_SESSION['message']) ?>
    <?php endif; ?>

</header>

<!--<ul>-->
<!--    <li><a href="/">Home</a></li>-->
<!--    <li><a href="/authors">Authors</a></li>-->
<!--    --><?php //if ($this->isLoggedIn()) : ?>
<!--            <li><a href="/books">Books</a></li></li>-->
<!--        --><?php //endif; ?>
<!--</ul>-->
<?php //if ($this->isLoggedIn()): ?>
<!--    <div id="logged-in-username">-->
<!--        <span>Hello, --><?php //echo $this->getUsername(); ?><!--</span>-->
<!---->
<!--        <form action="/account/logout" method="POST"><input type="submit" value="Logout"/></form>-->
<!--    </div>-->
<?php //endif; ?>

<div class="row">
    <div class="btn-group-vertical col-xs-2">
        <a href="/posts/byPeriod/1" class="btn btn-default">Last Day</a>
        <a href="/posts/byPeriod/7" class="btn btn-default">Last Week</a>
        <a href="/posts/byPeriod/30" class="btn btn-default">Last Month</a>
        <a href="/posts/byPeriod/365" class="btn btn-default">Last Year</a>
    </div>

    <div class="btn-group-vertical col-xs-<?php echo isset($mostPopularTags) ? 8 : 10 ?>">

