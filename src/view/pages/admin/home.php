<?php $render('admin/header', ['authUser' => $authUser]);?>
        <main class="main">

            <div class="main-overview">
                <div class="overviewcard red">
                    <div class="overviewcard-icon">
                        <i class="fas fa-shopping-basket"></i>
                    </div>
                    <div class="overviewcard-info">
                        <h3 class="overviewcard-info-title">Pedidos Registrados</h3>
                        <p class="overviewcard-info-subtitle"><?=$totalOrders?></p>

                    </div>
                </div>
                <div class="overviewcard blue">
                    <div class="overviewcard-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="overviewcard-info">
                        <h3 class="overviewcard-info-title">Produtos cadastrados</h3>
                        <p class="overviewcard-info-subtitle"><?=$totalProducts?></p>

                    </div>
                </div>
                <div class="overviewcard green">
                    <div class="overviewcard-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="overviewcard-info">
                        <h3 class="overviewcard-info-title">Vendas do Mês</h3>
                        <p class="overviewcard-info-subtitle">R$ <?=number_format($monthSales, 2, ',', '.')?></p>
                    </div>
                </div>
            </div>
        </main>

<?php $render('admin/footer');?>