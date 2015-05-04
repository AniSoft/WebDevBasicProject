<h1>Books</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
    </tr>
    <?php foreach($this->books as $book):?>
        <tr>
            <td><?php echo $book[0]?></td>
            <td><?php echo $book[1]?></td>
        </tr>
    <?php endforeach ?>
</table>