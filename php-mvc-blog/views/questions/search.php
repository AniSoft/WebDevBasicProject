<div class="well well-lg col-md-8 col-md-offset-2">
    <legend>Search By</legend>

    <div class="well well-lg col-md-12">
        <div class="row">
            <legend>  Search by Question title or content</legend>
            <?php foreach ($this->searchByQuestion as $q) : ?>
                <a href="/questions/view/<?= $q['Id'] ?>" class="btn btn-lg btn-info searchBtnMargin"><?= $q['Title'] ?></a>
            <?php endforeach ?>
            <?php if (sizeof($this->searchByQuestion) == 0) : ?>
                <h3>No results.</h3>
            <?php endif ?>
        </div>
    </div>

    <div class="well well-lg col-md-12">
        <div class="row">
            <legend>Search by Answer content</legend>
            <?php foreach ($this->searchByAnswer as $q) : ?>
                <a href="/questions/view/<?= $q['Id'] ?>" class="btn btn-lg btn-info searchBtnMargin"><?= $q['Title'] ?></a>
            <?php endforeach ?>
            <?php if (sizeof($this->searchByAnswer) == 0) : ?>
                <h3>No results.</h3>
            <?php endif ?>
        </div>
    </div>

    <div class="well well-lg col-md-12">
        <div class="row">
            <legend>Search by Tag</legend>
            <?php foreach ($this->searchByTag as $q) : ?>
                <a href="/questions/view/<?= $q['Id'] ?>" class="btn btn-lg btn-info searchBtnMargin"><?= $q['Title'] ?></a>
            <?php endforeach ?>
            <?php if (sizeof($this->searchByTag) == 0) : ?>
                <h3>No results.</h3>
            <?php endif ?>
        </div>
    </div>
</div>