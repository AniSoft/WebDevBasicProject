<table border="1">
    <tr>
        <th>Id</th>
        <th>Title</th>
    </tr>
    <?php foreach ($this->books as $book): ?>
        <tr>
            <td><?php echo $book['id']; ?></td>
            <td><?php echo $book['title']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="/books/all?page=<?php echo $this->page - 1; ?>">Back</a>
<a href="/books/all?page=<?php echo $this->page + 1; ?>">Next</a>