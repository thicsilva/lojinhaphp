        <aside class="sidenav">
            <div class="sidenav-brand">
                <a href="<?=$base?>/admin/home">
                    <img src="<?=$base?>/assets/img/logo.png" alt="Lojinha">
                </a>
                <div class="sidenav-close-icon">
                    <i class="fas fa-times sidenav-brand-close"></i>
                </div>
            </div>
            <div class="sidenav-profile">
                <div class="sidenav-profile-text"><?=$authUser->name?></div>
            </div>
            <ul class="sidenav-list">
                <a href="<?=$base?>/admin/order">
                    <li class="sidenav-list-item <?=($activeMenu=='order')?'active':''?>">
                        Pedidos
                    </li>
                </a>
                <a href="<?=$base?>/admin/product">
                    <li class="sidenav-list-item <?=($activeMenu=='product')?'active':''?>">
                        Produtos
                    </li>
                </a>
                <a href="<?=$base?>/admin/user">
                    <li class="sidenav-list-item <?=($activeMenu=='user')?'active':''?>">
                        Usuários
                    </li>
                </a>
            </ul>
        </aside>
