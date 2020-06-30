<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lojinha PHP</title>
  <link rel="stylesheet" href="<?=$base;?>/assets/css/site.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
</head>

<body>
  <div id="site">
    <header>
      <nav>
        <a href="<?=$base?>" class="logo">
          <img src="<?=$base?>/assets/img/logo.png" alt="Logo">
        </a>
        <section class="search">
          <form method="get" action="<?=$base?>">
            <input type="text" name="q" id="search" placeholder="Buscar produto...">
            <button type="submit" id="find"></button>
          </form>
        </section>
        <section class="menu">
          <a href="<?=$base?>/wish" class="wish">
            <i class="fas fa-heart"></i>
          </a>
          <a href="<?=$base?>/cart" class="cart">
            <i class="fas fa-shopping-basket"></i>
            <?php if (!empty($_SESSION['cart'])): ?>
            <span class="badge"><?=count($_SESSION['cart'])?></span>
            <?php endif?>
          </a>
        </section>
      </nav>
    </header>
      <?php if (isset($_SESSION['flash'])): ?>
      <div class="notification">
        <div class="message <?=$_SESSION['flash']['type'];?>">
          <?=$_SESSION['flash']['message'];?>
        </div>
      </div>
      <?php
unset($_SESSION['flash']);
endif
?>
    <main>

