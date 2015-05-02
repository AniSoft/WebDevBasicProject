<h1><?= htmlspecialchars($this->title) ?></h1>

<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
    <?php foreach ($this->authors as $author): ?>
        <tr>
            <td><?= htmlspecialchars($author['id']) ?></td>
            <td><?= htmlspecialchars($author['name']) ?></td>
            <td><a href="/authors/delete/<?=$author['id']?>">[Delete]</a></td>
        </tr>
    <?php endforeach ?>
</table>

<a href="/authors/create">[Create]</a>