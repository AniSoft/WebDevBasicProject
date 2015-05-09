<div class="row">
    <div class="well well-lg col-md-8 col-md-offset-2">
        <div class="row">
            <div class="row">
                <h1 class="col-md-10">Search by Question title or content</h1>
            </div>

            <?php foreach ($this->searchByQuestion as $q) : ?>
                <a href="/questions/view/<?= $q['Id'] ?>" class="btn btn-lg btn-info searchBtnMargin"><?= $q['Title'] ?></a>
            <?php endforeach ?>
            <?php if (sizeof($this->searchByQuestion) == 0) : ?>
                <h3>No results.</h3>
            <?php endif ?>
        </div>
    </div>

    <div class="well well-lg col-md-8 col-md-offset-2">
        <div class="row">
            <div class="row">
                <h1 class="col-md-10">Search by Answer content</h1>
            </div>

            <?php foreach ($this->searchByAnswer as $q) : ?>
                <a href="/questions/view/<?= $q['Id'] ?>" class="btn btn-lg btn-info searchBtnMargin"><?= $q['Title'] ?></a>
            <?php endforeach ?>
            <?php if (sizeof($this->searchByAnswer) == 0) : ?>
                <h3>No results.</h3>
            <?php endif ?>
        </div>
    </div>
    <div class="well well-lg col-md-8 col-md-offset-2">
        <div class="row">
            <div class="row">
                <h1 class="col-md-10">Search by Tag</h1>
            </div>

            <?php foreach ($this->searchByTag as $q) : ?>
                <a href="/questions/view/<?= $q['Id'] ?>" class="btn btn-lg btn-info searchBtnMargin"><?= $q['Title'] ?></a>
            <?php endforeach ?>
            <?php if (sizeof($this->searchByTag) == 0) : ?>
                <h3>No results.</h3>
            <?php endif ?>
        </div>
    </div>
</div>