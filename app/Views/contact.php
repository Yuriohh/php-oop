<?php

 $this->layout('master', ['title' => $title]) ?>

<h1>Contact</h1>
<?= flash('sent_success', 'color:green') ?>
<?= flash('sent_error', 'color:red') ?>

<form action="/contact" method="post">
    <?= csrf()  ?>

    <?= flash('email', 'color:red;') ?>
    <input type="text" name="email" placeholder="email">

    <?= flash('subject', 'color:red') ?>
    <input type="text" name="subject" placeholder="subject">

    <?= flash('message', 'color:red') ?>
    <textarea name="message" cols="30" rows="10"></textarea>

    <button type="submit">Send</button>
</form>
