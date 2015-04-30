<h1><?= htmlspecialchars($this->title) ?></h1>
Hello, I am the Authors Index veiw.

<table>
    <tr>
        <th>Id</th>
        <th>name</th>
    </tr>
    <?php foreach ($this->authors as $author): ?>
        <tr>
            <td><?= htmlspecialchars($author['id']) ?></td>
            <td><?= htmlspecialchars($author['name']) ?></td>
        </tr>
    <?php endforeach ?>
</table>

<a href="/authors/create">[Create]</a>