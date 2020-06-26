<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
</head>
<body>
    <form action="<?=$base?>/admin/logout" method="post" style="display:none" id="logout">
    </form>
    <a href="#" onclick="document.getElementById('logout').submit()">Logout</a>
    <?php $render('admin/sidebar'); ?>
