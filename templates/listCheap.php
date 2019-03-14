<?php
require_once __DIR__ . '/_header.php';
?>


<!-- start table for displaying DVD details -->
<h2>Cheap movies !!!</h2>

<table>
    <tr>
        <th> ID </th>
        <th> title </th>
        <th> price </th>
        <th> &nbsp; </th>
        <th> &nbsp; </th>
    </tr>

    <?php
        foreach($movies as $movie):
    ?>

            <tr>
                <td><?= $movie->getId() ?></td>
                <td><?= $movie->getTitle() ?></td>
                <td>&euro; <?= $movie->getPrice() ?></td>
                <td>
                    <a href="index.php?action=deleteMovie&id=<?= $movie->getId() ?>">DELETE</a>
                </td>
                <td>
                    <a href="index.php?action=editMovie&id=<?= $movie->getId() ?>">EDIT</a>
                </td>

            </tr>

    <?php
        endforeach;
    ?>

</table>

<hr>
<a href="index.php?action=newMovieForm">new movie form</a>

<?php
require_once __DIR__ . '/_footer.php';
?>