<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet" href="<?=$base?>/assets/css/admin.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <?php if (isset($datatableCss)): ?>
    <link rel="stylesheet" href="<?=$datatableCss?>">
    <?php endif?>


</head>
<body>
    <div class="panel-container">
        <div class="menu-icon">
            <i class="fas fa-bars header-menu"></i>
        </div>
        <header class="header">
            <div class="header-search">

            </div>
            <div class="header-avatar">
                <form action="<?=$base?>/admin/logout" method="post" id="logout"></form>
                <a href="#" onclick="document.getElementById('logout').submit()">Logout</a>
            </div>
        </header>
        <?php $render('admin/sidenav', ['authUser' => $authUser]);?>





