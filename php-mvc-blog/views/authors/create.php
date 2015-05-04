<h1>Create New Author</h1>
<form method="post" action="/authors/create">
    Name:<input type="text" name="author_name" value="<?php echo $this->getFieldValue('author_name');?>">
    <?php echo $this->getValidationError('author_name');?>
    <br/>
    <input type="submit" value="Create">
</form>
