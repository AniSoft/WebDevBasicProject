<div class="row">
    <div class="col-md-6 col-md-offset-3 well">
        <div class="row">
            <h1 class="col-md-3">Users</h1>
        </div>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th class="col-md-1">Id</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Email</th>
                <th class="col-md-3">Modifiers</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($this->users as $u) : ?>
                <tr>
                    <td><?= htmlspecialchars($u['Id']) ?></td>
                    <td><?= htmlspecialchars($u['Username']) ?></td>
                    <td><?= htmlspecialchars($u['FullName']) ?></td>
                    <td><?= htmlspecialchars($u['Email']) ?></td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="/accounts/adminEdit/<?= $u['Id'] ?>">EDIT</a>
                            <a class="btn btn-danger btn-sm" href="/accounts/delete/<?= $u['Id'] ?>">DELETE</a>
                        </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
        <div class="row text-center">
            <?php if($this->page != 1) : ?>
                <a href="/accounts/all/<?= $this->page-1?>/<?= $this->pageSize ?>" class="btn btn-default">Previous</a>
            <?php endif ?>
            <?php for($i=1; $i<= $this->maxPage; $i++) : ?>
                <a href="/accounts/all/<?= $i?>/<?= $this->pageSize ?>" class="btn btn-default"><?= $i ?></a>
            <?php endfor ?>
            <?php if($this->page != $this->maxPage && $this->maxPage != 0) : ?>
                <a href="/accounts/all/<?= $this->page+1?>/<?= $this->pageSize ?>" class="btn btn-default">Next</a>
            <?php endif ?>
        </div>
    </div>
</div>