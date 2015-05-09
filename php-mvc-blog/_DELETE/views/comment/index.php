<h2>Comments</h2>

<?php foreach ($comments as $comment) : ?>
    <ul>
        <li>
            <?php echo htmlentities($comment["comment"]);?>
        </li>
        <li>
            <?php echo htmlentities($comment["created_on"]);?>
        </li>
        <li>
            <?php echo htmlentities($comment["post_id"]);?>
        </li>
        <li>
            <?php echo htmlentities($comment["user_id"]);?>
        </li>
    </ul>
<?php endforeach ?>