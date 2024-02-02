<?php $this->layout('master', ['title' => 'User Profile']) ?>

<h1>User Profile</h1>
<?= flash('created') ?>

<form action="/user/update/12" method="post">

    <?= csrf() ?>

    <?= flash('firstName') ?>
    <input type="text" name="firstName" value="Yuriohh">

    <?= flash('lastName') ?>
    <input type="text" name="lastName" value="Lima">

    <?= flash('email') ?>
    <input type="text" name="email" value="yuriohh@teste.com">

    <?= flash('password') ?>
    <input type="password" name="password" value="987654321">

    <button type="submit">Atualizar</button>

</form>