<?php $render('admin/header', [
    'authUser' => $authUser,
    'datatableCss' => '//cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css',
    'activeMenu' => 'product',
]);?>
        <main class="main">
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
            <div class="container">
                <div class="btn-container">
                    <a href="<?=$base?>/admin/product/create" class="btn yellow">Adicionar</a>
                </div>
                <table id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th>Última Atualização</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?=$product->id?></td>
                            <td><?=$product->name?></td>
                            <td>R$ <?=number_format($product->price, 2, ',', '.')?></td>
                            <td><?=date('d/m/Y \à\s H:i', strtotime($product->updated_at))?></td>
                            <td>
                                <a href="<?=$base?>/admin/product/edit/<?=$product->id?>" class="btn green">Editar</a>
                                <form action="<?=$base?>/admin/product/delete/<?=$product->id?>" method="post" id="delete-<?=$product->id?>" style="display:none"></form>
                                <a href="#" class="btn red" onclick="document.getElementById('delete-<?=$product->id?>').submit()">Excluir</a>
                            </td>
                        </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>

        </main>

<?php $render('admin/footer', [
    'datatableJs' => '//cdn.datatables.net/v/dt/dt-1.10.21/r-2.2.5/datatables.min.js',
]);?>