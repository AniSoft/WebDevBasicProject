<div class="row">
    <form class="form-horizontal col-md-8 col-md-offset-2" name="addQuestion" method="POST" action="/questions/add">
        <fieldset>
            <legend>Add new Question</legend>
            <div class="form-group">
                <label for="inputTitle" class="col-lg-3 control-label">Title</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" id="inputTitle" name="title" placeholder="Title" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputText" class="col-lg-3 control-label">Content</label>
                <div class="col-lg-5">
                    <textarea class="form-control" rows="3" id="inputText" name="content"  required></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="selectCat" class="col-lg-3 control-label">Category</label>
                <div class="col-lg-5">
                    <select class="form-control" id="selectCat" name="selectCategory" required>
                        <?php foreach($this->TagsAndCategories["categories"] as $cat) : ?>
                            <option value="<?= $cat['Id'] ?>"><?= htmlspecialchars($cat['Title']) ?></option>
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
                                <input type="checkbox" name="check_tags[]" value="<?= $tag['Id'] ?>" /><?=$tag['Title']?>
                            </label>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>

            <div class="form-group">
                <div class="text-center">
                    <a class="btn btn-default" href="/questions">Cancel</a>
                    <input class="btn btn-primary" type="submit" value="Submit"/>
                </div>
            </div>
        </fieldset>
    </form>
</div>