<?php $render('admin/header', [
    'authUser' => $authUser,
    'datatableCss' => '//cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css',
    'activeMenu' => 'product',
]);?>
        <main class="main">
            <div class="container">
                <form action="<?=$base?>/admin/product/store" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" class="input-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <textarea name="description" id="description" class="input-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Preço</label>
                        <input type="number" step="0.01" min="0" name="price" id="price" class="input-control">
                    </div>
                    <div class="form-group">
                        <label for="image">Imagem</label>
                        <input type="file" name="image[]" id="image" class="input-control">
                    </div>
                    <button class="btn yellow">Salvar</button>
                    <a href="<?=$base?>/admin/product" class="btn default">Cancelar</a>
                </form>
            </div>

        </main>

<?php $render('admin/footer', [
    'datatableJs' => '//cdn.datatables.net/v/dt/dt-1.10.21/r-2.2.5/datatables.min.js',
]);?>