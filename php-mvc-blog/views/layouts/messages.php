<div class="row">
    <?php
    if (isset($_SESSION['messages'])) :
        foreach ($_SESSION['messages'] as $msg) :?>
        <div class="col-md-4 col-md-offset-4 text-center alert alert-dismissible alert-<?= $msg['type']?>">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong><?= htmlspecialchars($msg['text']) ?>
        </div>
    <?php
        endforeach;
        unset($_SESSION['messages']);
        endif;
    ?>
</div>