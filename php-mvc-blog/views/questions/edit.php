<div class="row">
    <form class="form-horizontal col-md-8 col-md-offset-2" name="EditQuestion" method="POST">
        <fieldset>
            <legend>Edit Question</legend>
            <div class="form-group">
                <label for="inputTitle" class="col-lg-3 control-label">Title</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" id="inputTitle" name="title" placeholder="Title" value="<?= $this->questionInfo['Title'] ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputText" class="col-lg-3 control-label">Content</label>
                <div class="col-lg-5">
                    <textarea class="form-control" rows="3" id="inputText" name="content"  required><?= $this->questionInfo['Content'] ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="selectCat" class="col-lg-3 control-label">Category</label>
                <div class="col-lg-5">
                    <select class="form-control" id="selectCat" name="selectCategory" onselect="<?= $this->questionInfo['Category'] ?>" required>
                        <?php foreach($this->TagsAndCategories["categories"] as $cat) : ?>
                            <?php if($cat['Title'] == $this->questionInfo['Category']) : ?>
                            <option value="<?= $cat['Id'] ?>" selected><?= htmlspecialchars($cat['Title']) ?></option>
                            <?php else : ?>
                                <option value="<?= $cat['Id'] ?>"><?= htmlspecialchars($cat['Title']) ?></option>
                            <?php endif ?>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Tags</label>
                <div class="col-lg-5">
                    <?php foreach($this->TagsAndCategories["tags"] as $tag) : ?>
                        <div class="checkbox">
                            <label >
                                <?php if(in_array($tag['Title'], $this->questionInfo['Tags'])) : ?>
                                    <input type="checkbox" name="check_tags[]" value="<?= $tag['Id'] ?>" checked/><?=$tag['Title']?>
                                <?php else : ?>
                                    <input type="checkbox" name="check_tags[]" value="<?= $tag['Id'] ?>" /><?=$tag['Title']?>
                                <?php endif ?>
                            </label>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>

            <div class="form-group">
                <div class="text-center">
                    <a class="btn btn-default" href="/questions">Cancel</a>
                    <input class="btn btn-primary" type="submit" value="Edit"/>
                </div>
            </div>
        </fieldset>
    </form>
</div>