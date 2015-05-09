<div class="col-md-12">
    <div class="col-md-4">
    </div>
    <div class="well well-lg col-md-4">
        <form class="form-horizontal " name="addAnswer" method="POST">
            <fieldset>
                <legend>Edit Answer</legend>
                <div class="form-group">
                    <label for="inputText" class="col-lg-3 control-label">Content :</label>
                    <div class="col-lg-6">
                        <textarea class="form-control" rows="3" id="inputText" name="content"
                                  required><?= $this->answer['Content'] ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="authorName" class="col-lg-3 control-label">Name :</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="authorName" name="authorName"
                               value="<?= $this->answer['AuthorName'] ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="authorEmail" class="col-lg-3 control-label">Email :</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="authorEmail" name="authorEmail"
                               value="<?= $this->answer['AuthorEmail'] ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <a class="btn btn-default" href="/questions/view/<?= $this->questionId ?>">Cancel</a>
                        <input class="btn btn-primary" type="submit" value="Submit"/>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>