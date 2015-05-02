<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/content/styles.css"/>
    <title>
        <?php if (isset($this->title)) echo htmlspecialchars($this->title) ?>
    </title>
</head>

<body>
<header>
    <a href="/"><img src="/content/images/logo.png"></a>
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/authors">Authors</a></li>
        <li><a href="/books">Books</a></li>
    </ul>
</header>

<?php include('messages.php'); ?>

