<?php $this->layout('master', ['title' => 'Home']) ?>

<h1>Home (
    <?= $pagination->getTotal(); ?>)
</h1>

<h3>Items por página:
    <?= $pagination->getItemsPerPage(); ?>
</h3>
<ul>
    <?php foreach ($usersFound as $user): ?>
        <li>
            <?= $user->firstname; ?>
        </li>
    <?php endforeach; ?>
</ul>

<?= $pagination->links(); ?>