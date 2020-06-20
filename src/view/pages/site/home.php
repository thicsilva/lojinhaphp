<?php $render('site/header'); ?>



<section class="products-container">
    <?php
    if (isset($products) && !empty($products)) : ?>

        <div class="products">
            <?php foreach ($products as $product) : ?>
                <div class="product">
                    <a href="#">
                        <div class="product-image">
                            <img src="//picsum.photos/800/600" alt="produto">
                            <p class="price">R$ <?= number_format($product->price, 2, ',', '.') ?></p>
                        </div>
                        <div class="product-action">
                            <h2 class="name"><?= $product->name ?></h2>
                            <form action="#" method="post">
                                <input type="hidden" name="product" value="<?= $product->id ?>">
                                <button type="submit" title="Adicionar aos favoritos" class="btn-small love"><i class="fas fa-heart"></i></button>
                            </form>
                            <form action="<?=$base?>/cart/add" method="post">
                                <input type="hidden" name="product" value="<?= $product->id ?>">
                                <button type="submit" title="Adicionar ao carrinho" class="btn-small cart"><i class="fas fa-shopping-basket"></i></button>
                            </form>
                        </div>
                        <p class="description">
                            <?php
                            $pos = strpos($product->description, ' ', 50);
                            $str = substr($product->description, 0, $pos) . '...';
                            echo $str;
                            ?>
                        </p>
                    </a>
                </div>

            <?php endforeach ?>
        </div>
    <?php else : ?>
        <p class="no-result">Não encontramos nada para listar aqui 😥</p>
        <p class="no-result"><a href="<?= $base ?>">Clique aqui para voltar</a></p>
    <?php endif ?>
    <?php if ($pages['total'] > 1) : ?>
        <div class="pagination">
            <ul>
                <?php for ($p = 1; $p <= $pages['total']; $p++) : ?>
                    <li><a href="<?= $base ?>?page=<?= $p ?><?php if ($pages['searchTerm']) : ?>&q=<?= $pages['searchTerm'] ?><?php endif ?>" <?php if ($p == $pages['current']) : ?>class="active" <?php endif ?>><?= $p ?></a></li>
                <?php endfor ?>
            </ul>
        </div>
    <?php endif ?>
</section>





<?php $render('site/footer'); ?>