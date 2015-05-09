<form method="POST">
    <ul>
        <li>
            <span>Content</span>
            <textarea name="content"><?php echo htmlentities($post_for_edit['content']); ?></textarea>
        </li>
        <input type="hidden" name="id" value="<?php echo htmlentities($post_for_edit['id']); ?>"/>
        <li>
            <input type="submit" value="Change"/>
        </li>
    </ul>
</form>