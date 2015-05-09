<div class="row">
    <div class="col-md-12 col-md-offset-1">
    <div class="well well-lg col-md-8 questionMarginLeft">
        <div class="row">
            <div class="row">
                <h1 class="col-md-3"><?= htmlspecialchars($this->title) ?></h1>
                <div class="col-md-4 col-md-offset-5">
                    <a href="/questions/ranking" class="btn btn-default">Ranking</a>
                    <a href="/questions/add" class="btn btn-primary">Add Question</a>
                </div>
            </div>

            <?php foreach ($this->questions as $q) : ?>
                <div class="panel panel-primary col-md-10 col-md-offset-1">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-9"><a class="textWhite" href="/questions/view/<?= $q['Id']?>"><h3 class="panel-title"><?= htmlspecialchars($q['Title']) ?></h3></a></div>
                            <div class=" col-md-3 text-right"> <?= htmlspecialchars($q['Date']) ?></div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3"><span>User: </span> <?= htmlspecialchars($q['Username']) ?> &#9733;(<?= htmlspecialchars($q['UserRating']) ?>)</div>
                            <div class="col-md-7"><span>Category: </span> <?= htmlspecialchars($q['Category']) ?></div>
                            <div class="col-md-2 text-right"><span>Visits: </span> <?= htmlspecialchars($q['Counter']) ?></div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <div class="row text-right">
            <label for="perPage">per page: </label>
            <input onchange="changePageSize()" id="perPage" type="text" value="<?= $this->pageSize ?>"/>
        </div>

        <div class="row text-center">
            <?php if($this->page != 1) : ?>
                <a href="/questions/index/<?= $this->page-1?>/<?= $this->pageSize ?>/<?= $this->setCategory ?>" class="btn btn-default">Previous</a>
            <?php endif ?>
            <?php for($i=1; $i<= $this->maxPage; $i++) : ?>
                <a href="/questions/index/<?= $i?>/<?= $this->pageSize ?>/<?= $this->setCategory ?>" class="btn btn-default"><?= $i ?></a>
            <?php endfor ?>
            <?php if($this->page != $this->maxPage && $this->maxPage != 0) : ?>
                <a href="/questions/index/<?= $this->page+1?>/<?= $this->pageSize ?>/<?= $this->setCategory ?>" class="btn btn-default">Next</a>
            <?php endif ?>
        </div>

        <?php if(sizeof($this->questions) == 0) :?>
            <h3>No results.</h3>
        <?php endif ?>
    </div>

    <div class="col-md-1">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Categories</h3>
            </div>
            <a href="/questions/index/1/<?= $this->pageSize ?>"><div class="panel-body list-group-item">All</div></a>
            <?php foreach ($this->categories as $cat) : ?>
                <a href="/questions/index/1/<?= $this->pageSize ?>/<?= $cat['Title'] ?>" ><div class="panel-body list-group-item"><?= $cat['Title'] ?> </div></a>
            <?php endforeach ?>
        </div>
    </div>
    </div>
</div>