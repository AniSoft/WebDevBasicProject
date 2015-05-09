<form class="form-horizontal col-md-8 col-md-offset-2" name="addAnswer" method="POST">
    <fieldset>
        <legend>Add new Answer</legend>
        <div class="form-group">
            <label for="inputText" class="col-lg-3 control-label">Content</label>
            <div class="col-lg-5">
                <textarea class="form-control" rows="3" id="inputText" name="content"  required></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="authorName" class="col-lg-3 control-label">Name</label>
            <div class="col-lg-5">
                <input type="text" class="form-control" id="authorName" name="authorName" placeholder="Author name." required>
            </div>
        </div>
        <div class="form-group">
            <label for="authorEmail" class="col-lg-3 control-label">Email</label>
            <div class="col-lg-5">
                <input type="text" class="form-control" id="authorEmail" name="authorEmail" placeholder="Author email.">
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