<?php $this->layout('master', ['title' => 'User Profile']) ?>

<h1>User Profile</h1>

<form action="/user/update/12" method="post">

    <input type="text" name="firstName" value="Yuriohh">
    <input type="text" name="lastName" value="Lima">
    <input type="text" name="email" value="yuriohh@teste.com">
    <input type="password" name="password" value="987654321">

    <button type="submit">Atualizar</button>

</form>
