<div class="panel panel-info">
    <div class="panel-heading">
        <div class="row">
            <div class="col-xs-8">
                <h3 class="panel-title">
                    <?= htmlspecialchars($post['text']) ?>
                </h3>
            </div>
            <div class="col-xs-2 text-right">
                <span class="badge">
                    <?= htmlspecialchars($post['user_id'])?>
                </span>
            </div>
            <div class="col-xs-2">
                <p class="text-right">
                    Visits: <?= htmlspecialchars($post['visits'])?>
                </p>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <?= htmlspecialchars($post['text']) ?>
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-xs-4 text-left">
                <span >
                    Date: <?= htmlspecialchars($this->makeDateInFormat($post['date']))?>
                </span>
            </div>
            <div class="col-xs-2 text-left">
                <input type="button" value="Add comment" onclick="showCommentForm()" id="showBtn"/>
            </div>
            <div class="col-xs-6 text-right">
                <span >Post#: <?= htmlspecialchars($post['id'])?></span>
            </div>
        </div>
    </div>
</div>
<form class="form-horizontal <?= count($this->fieldsErrors) > 0 ? '' : ' comment-form';?>" method="POST">
    <fieldset>
        <legend>Add comment</legend>
        <div class="form-group">
            <?php if(isset($this->fieldsErrors['author'])) :?>
                <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong><?php echo $this->fieldsErrors['author']; ?></strong>
                </div>
            <?php endif;?>
            <label for="author" class="col-lg-2 control-label">Name</label>
            <div class="col-lg-10">
                <input type="text" name="author" class="form-control" id="name"
                       placeholder="Name..." value="<?php echo isset($_POST['author']) ? htmlspecialchars($_POST['author']) : '' ?>">
            </div>
        </div>
        <div class="form-group">
            <?php if(isset($this->fieldsErrors['email'])) :?>
                <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong><?php echo $this->fieldsErrors['email']; ?></strong>
                </div>
            <?php endif;?>
            <label for="inputEmail" class="col-lg-2 control-label">Email</label>
            <div class="col-lg-10">
                <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email..."
                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
            </div>
        </div>
        <div class="form-group">
            <?php if(isset($this->fieldsErrors['text'])) :?>
                <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong><?php echo $this->fieldsErrors['text']; ?></strong>
                </div>
            <?php endif;?>
            <label for="text" class="col-lg-2 control-label">Textarea</label>
            <div class="col-lg-10">
            <textarea class="form-control" rows="5" name="text" id="text" placeholder="Add post text here..."
                ><?php echo isset($_POST['text']) ? htmlspecialchars($_POST['text']) : '' ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <input type="reset" class="btn btn-default" value="Cancel"
                       onclick="hideForm()"/>
                <input type="hidden" value="1" name="submitted"/>
                <input type="submit" class="btn btn-primary" value="Add comment"/>
            </div>
        </div>
    </fieldset>
</form>
<?php foreach ($comments as $comment): ?>
    <div class="well well-lg">
        <span><?= htmlspecialchars($comment['author'] ) ?>: </span>
        <?= htmlspecialchars($comment['text'])  ?>
        <div class="text-right">
            <?= htmlspecialchars($this->makeDateInFormat($comment['date'])) ?>
        </div>
    </div>
<?php endforeach;?>
<script>
    function showCommentForm(){
        if ($('#showBtn').val() === 'Add comment') {
            $('.comment-form').show();
            $('#showBtn').val('Hide form');
        } else {
            $('.comment-form').hide();
            $('#showBtn').val('Add comment');
        }
    }

    function hideForm(){
        $('.comment-form').hide();
        $('#showBtn').val('Add comment');
    }
</script>