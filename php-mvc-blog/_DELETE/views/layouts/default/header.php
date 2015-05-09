<!DOCTYPE html>
<html>
<head>
    <title>Forum<?php if(isset($this->title)) echo ' - ' . htmlspecialchars($this->title) ?></title>
    <link rel="stylesheet" type="text/css" href="/library/bootstrap/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="/content/style.css"/>
    <meta charset="utf-8"/>
</head>
<body>
<div class="wrapper">
    <header>
        <div class="navbar navbar-default ">
            <div class="container">
                <div class="col-md-4">
                    <div class="navbar-header">

                        <a href="/"><img src="/content/images/logo.png" alt="Logo"/></a>
                        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="navbar-collapse collapse">
                            <form method="POST" class="nav navbar-nav navbar-right" action="/questions/search">
                                <input type="text" name="searchWord" placeholder="Search"/>
                                <input class="btn btn-default btn-sm" type="submit" value="&#128269;"/>
                            </form>
                        </div>
                    </div>

                    <div class="row">

                        <div class="navbar-collapse collapse">
                            <ul id="menu" class="nav navbar-nav navbar-right">
                                <li><a href="/">Home</a></li>
                                <li><a href="/questions">Questions</a></li>
                                <li><a href="/categories">Category</a></li>
                                <?php if(isset($_SESSION['username'])) : ?>
                                    <li><a href="/accounts/edit" class="btn btn-primary"><?= htmlspecialchars($_SESSION['username']) ?></a></li>
                                    <li><a href="/accounts/logout">Logout</a></li>
                                <?php else : ?>
                                    <li><a class="btn-danger" href="/accounts/login">Login</a></li>
                                    <li><a class="btn-primary" href="/accounts/register">Register</a></li>
                                <?php endif ?>
                            </ul>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <?php include('/views/layouts/messages.php'); ?>

    <main>



