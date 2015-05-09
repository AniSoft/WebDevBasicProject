<div class="col-md-6 col-md-offset-3">
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th class="col-md-1">№</th>
            <th>Username</th>
            <th class="col-md-1">Activity</th>
        </tr>
        </thead>
        <tbody>
        <?php for($i=1; $i<= sizeof($this->ranking); $i++) : ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= htmlspecialchars($this->ranking[$i-1]['Username']) ?></td>
                <td><?= htmlspecialchars($this->ranking[$i-1]['Activity']) ?></td>
            </tr>
        <?php endfor ?>
        </tbody>
    </table>
</div>