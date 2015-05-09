<div class="row">
    <div class="col-md-4 col-md-offset-4 well">
        <div class="row">
            <legend><?= htmlspecialchars($this->title) ?></legend>

            <?php if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) :  ?>
            <div class="col-md-3 col-md-offset-6">
                <a href="/categories/add" class="btn btn-primary">Add Category</a>
            </div>
            <?php endif ?>
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
                <?php foreach ($this->categories as $c) : ?>
                    <tr>
                        <td><?= htmlspecialchars($c['Id']) ?></td>
                        <td><?= htmlspecialchars($c['Title']) ?></td>
                        <?php if(isset($_SESSION['isAdmin'])) : ?>
                            <td>
                                <a class="btn btn-warning btn-sm" href="/categories/edit/<?= $c['Id'] ?>">EDIT</a>
                                <a class="btn btn-danger btn-sm" href="/categories/delete/<?= $c['Id'] ?>">DELETE</a>
                            </td>
                        <?php endif ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <div class="row text-center">
            <?php if($this->page != 1) : ?>
                <a href="/categories/index/<?= $this->page-1?>/<?= $this->pageSize ?>" class="btn btn-default">Previous</a>
            <?php endif ?>
            <?php for($i=1; $i<= $this->maxPage; $i++) : ?>
                <a href="/categories/index/<?= $i?>/<?= $this->pageSize ?>" class="btn btn-default"><?= $i ?></a>
            <?php endfor ?>
            <?php if($this->page != $this->maxPage && $this->maxPage != 0) : ?>
                <a href="/categories/index/<?= $this->page+1?>/<?= $this->pageSize ?>" class="btn btn-default">Next</a>
            <?php endif ?>
        </div>
    </div>
</div>