<?php $render('site/header'); ?>



<section class="products-container">
    <?php
    if (isset($products) && !empty($products)) : ?>

        <div class="products">
            <?php foreach ($products as $product) : ?>
                <div class="product">
                    <a href="#">
                        <img src="//picsum.photos/800/600" alt="produto">
                        <h2 class="name"><?= $product->name ?></h2>
                        <p class="price">R$ <?= number_format($product->price, 2, ',', '.') ?></p>
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