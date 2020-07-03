
<?php $render('site/header');?>

<section class="cart-container-empty">
    <p class="no-result"> O pedido <?=($order) ? $order->id : ''?> foi concluído! Em breve você deve receber no endereço informado.</p>
    <p class="no-result"><a href="<?=$base?>">Clique aqui para voltar</a></p>
</section>

<?php $render('site/footer');?>