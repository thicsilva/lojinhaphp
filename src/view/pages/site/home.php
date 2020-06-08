<?php $render('site/header');?>

<section class="search">
    <form method ="post" action="<?=$base?>">
        <input type="text" name="search" id="search" placeholder="Buscar produto...">
        <button type="submit" id="find"></button>
    </form>
</section>

<section class="product-container">
    <?php
if (isset($products) && !empty($products)) {?>

    <div class="products">
        <?php
foreach ($products as $product) {
    ?>
        <div class="product">
            <a href="#">
                <img src="//picsum.photos/800/600" alt="produto">
                <p class="price">R$ <?=number_format($product->price, 2, ',', '.')?></p>
                <h2 class="name"><?=$product->name?></h2>
                <p><?=$product->description?></p>
            </a>
        </div>
        <?php
}
    ?>
    </div>
<?php
} else {
    ?>
    <p class="no-result">Não encontramos nada para listar aqui :(</p>
    <?php }?>
</section>


<?php $render('site/footer');?>
