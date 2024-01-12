<?php $this->layout('master', ['title' => 'User Profile']) ?>

<?= $this->start('css'); ?>
    <link rel="stylesheet" href="/css/user.css">
<?= $this->stop(); ?>

<h1>User Profile</h1>
<p>Hello, <?=$this->e($name)?></p>
