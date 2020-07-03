<?php $render('admin/header', [
    'authUser' => $authUser,
    'activeMenu' => 'user',
]);?>
        <main class="main">
            <div class="container">
                <form action="<?=$base?>/admin/user/store" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" class="input-control">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="input-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" name="password" id="password" class="input-control">
                    </div>
                    <button class="btn yellow">Salvar</button>
                    <a href="<?=$base?>/admin/user" class="btn default">Cancelar</a>
                </form>
            </div>

        </main>

<?php $render('admin/footer');?>