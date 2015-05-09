<form method="POST">
    <h2>Do you want to delete it ?</h2>
    <input type="hidden" name="id" value="<?php echo addslashes($post_for_delete['id']); ?>"/>
    <input type="submit" value="Delete"/>
</form>