<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/style.css">
        <?=$this->section('css')?>
        <title><?=$this->e($title)?></title>
    </head>
    <?php $this->insert('partials/header', ['title' => $this->e($title)]) ?>
    <body>
        <?=$this->section('content')?>
    </body>
</html>
