<div>
    <h1>Books</h1>

    <?php if ($this->books): ?>
        <ul>
            <?php foreach ($this->books as $book): ?>
                <li><?php echo $book['title'] ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

