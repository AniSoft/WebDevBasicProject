<div class="row">
    <div class="col-md-6 col-md-offset-3 well">
        <div class="row">
            <h1 class="col-md-3"><?= htmlspecialchars($this->title) ?></h1>
            <div class="col-md-3 col-md-offset-6">
                <a href="/tags/add" class="btn btn-primary">Add Tags</a>
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th class="col-md-1">Id</th>
                <th>Title</th>
                <?php if(isset($_SESSION['isAdmin'])) : ?>
                    <th class="col-md-3">Modifiers</th>
                <?php endif ?>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($this->tags as $t) : ?>
                    <tr>
                        <td><?= htmlspecialchars($t['Id']) ?></td>
                        <td><?= htmlspecialchars($t['Title']) ?></td>
                        <?php if(isset($_SESSION['isAdmin'])) : ?>
                            <td>
                                <a class="btn btn-warning btn-sm" href="/tags/edit/<?= $t['Id'] ?>">EDIT</a>
                                <a class="btn btn-danger btn-sm" href="/tags/delete/<?= $t['Id'] ?>">DELETE</a>
                            </td>
                        <?php endif ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <div class="row text-center">
            <?php if($this->page != 1) : ?>
                <a href="/tags/index/<?= $this->page-1?>/<?= $this->pageSize ?>" class="btn btn-default">Previous</a>
            <?php endif ?>
            <?php for($i=1; $i<= $this->maxPage; $i++) : ?>
                <a href="/tags/index/<?= $i?>/<?= $this->pageSize ?>" class="btn btn-default"><?= $i ?></a>
            <?php endfor ?>
            <?php if($this->page != $this->maxPage && $this->maxPage != 0) : ?>
                <a href="/tags/index/<?= $this->page+1?>/<?= $this->pageSize ?>" class="btn btn-default">Next</a>
            <?php endif ?>
        </div>
    </div>
</div>