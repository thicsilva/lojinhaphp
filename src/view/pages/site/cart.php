<?php $render('site/header'); ?>
<?php if (!empty($cartItems)) : 
  $totalPrice = 0; ?>
  <section class="cart-container">
    <div class="cart-items">
      <?php foreach ($cartItems as $item) :
        $itemPrice = $item['price'] * $item['quantity'];
        $totalPrice += $itemPrice; ?>
        <div class="cart-item">
          <img src="//picsum.photos/50/50" alt="product">
          <h2 class="name"><?= $item['name'] ?></h2>
          <p class="price"> R$ <?= number_format($itemPrice, 2, ',', '.') ?> </p>
          <div class="cart-item-action">
            <form action="<?= $base ?>/cart/update" method="post">
              <input type="hidden" name="product" value="<?= $item['id'] ?>">
              <input type="number" step="1" min="0" name="quantity" id="quantity-<?= $item['id'] ?>" value="<?= $item['quantity'] ?>">
              <button type="submit" class="btn-small update"><i class="fas fa-sync"></i></button>
            </form>
            <form action="<?= $base ?>/cart/remove" method="post">
              <input type="hidden" name="product" value="<?= $item['id'] ?>">
              <button type="submit" class="btn-small delete"><i class="fas fa-trash"></i></button>
            </form>
          </div>
        </div>
      <?php endforeach ?>
      <form action="<?= $base ?>/cart/reset" method="post">
        <div class="form-footer">
          <h2>Total: <?= number_format($totalPrice, 2, ',', '.') ?></h2>
          <button type="submit" class="btn">Limpar carrinho</button>
        </div>
      </form>
    </div>
    <div class="checkout-form">
      <form action="<?= $base ?>/checkout" method="post">
        <label for="name">Nome</label>
        <input type="text" name="name" id="name">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <label for="address">Endereço</label>
        <input type="text" name="address" id="address">
        <div class="form-footer">
          <button type="submit" class="btn">Finalizar compra</button>
          <a href="<?= $base ?>" class="btn">Continuar comprando</a>
        </div>
      </form>
    </div>


  </section>

<?php else : ?>
  <section class="cart-container-empty">
    <p class="no-result"> Seu carrinho está vazio!</p>
    <p class="no-result"><a href="<?= $base ?>">Clique aqui para continuar comprando</a></p>
  </section>
<?php endif ?>
<?php $render('site/footer'); ?>