<form role="form" method="POST" name="addPost">
    <div class="form-group">
        <?php if(isset($this->fieldsErrors['title'])) :?>
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong><?php echo $this->fieldsErrors['title']; ?></strong>
            </div>
        <?php endif;?>
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="title" name="title"
               placeholder="Enter title..."
               value="<?= isset($_POST['title']) ? htmlspecialchars($_POST['title'] ): ''  ?>">
    </div>
    <div class="form-group">
        <?php if(isset($this->fieldsErrors['text'])) :?>
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong><?php echo $this->fieldsErrors['text']; ?></strong>
            </div>
        <?php endif;?>
        <label for="text">Text:</label>
        <textarea class="col-xs-12" rows="5" name="text"
                  placeholder="Add post text here..."><?= isset($_POST['text'])
                ? htmlspecialchars($_POST['text'])
                :  ''  ?></textarea>
        <br/>
    </div>
    <div class="form-group">
        <label>Tags:</label>
        <div class="row">
            <div class="col-xs-2">
                <input type="text" class="form-control" name="tag1"
                       placeholder="Enter a tag"
                       value="<?= isset($_POST['tag1']) ? htmlspecialchars($_POST['tag1'] ): ''  ?>">
                <?php if(isset($this->fieldsErrors['tag1'])) :?>
                    <div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong><?php echo $this->fieldsErrors['tag1']; ?></strong>
                    </div>
                <?php endif;?>
            </div>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="tag2"
                       placeholder="Enter a tag"
                       value="<?= isset($_POST['tag2']) ? htmlspecialchars($_POST['tag2'] ): ''  ?>">
                <?php if(isset($this->fieldsErrors['tag2'])) :?>
                    <div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong><?php echo $this->fieldsErrors['tag2']; ?></strong>
                    </div>
                <?php endif;?>
            </div>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="tag3"
                       placeholder="Enter a tag"
                       value="<?= isset($_POST['tag3']) ? htmlspecialchars($_POST['tag3'] ): ''  ?>">
                <?php if(isset($this->fieldsErrors['tag3'])) :?>
                    <div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong><?php echo $this->fieldsErrors['tag3']; ?></strong>
                    </div>
                <?php endif;?>
            </div>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="tag4"
                       placeholder="Enter a tag"
                       value="<?= isset($_POST['tag4']) ? htmlspecialchars($_POST['tag4'] ): ''  ?>">
                <?php if(isset($this->fieldsErrors['tag4'])) :?>
                    <div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong><?php echo $this->fieldsErrors['tag4']; ?></strong>
                    </div>
                <?php endif;?>
            </div>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="tag5"
                       placeholder="Enter a tag"
                       value="<?= isset($_POST['tag5']) ? htmlspecialchars($_POST['tag5'] ): ''  ?>">
                <?php if(isset($this->fieldsErrors['tag5'])) :?>
                    <div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong><?php echo $this->fieldsErrors['tag5']; ?></strong>
                    </div>
                <?php endif;?>
            </div>
            <div class="col-xs-2">
                <input type="hidden" value="1" name="submitted"/>
                <button type="submit" class="btn btn-default add-post">
                    Add post
                </button>
            </div>
        </div>
    </div>
</form>
