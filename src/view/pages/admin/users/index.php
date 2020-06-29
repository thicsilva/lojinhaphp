<?php $render('admin/header', [
    'authUser' => $authUser,
    'datatableCss' => '//cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css',
]);?>
        <main class="main">
            <div class="table-container">
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
                        <?php foreach ($products as $user): ?>
                        <tr>
                            <td><?=$user->id?></td>
                            <td><?=$user->name?></td>
                            <td><?=$user->email?></td>
                            <td>
                                <a href="#" class="btn green">Editar</a>
                                <form action="<?=$base?>/user/delete/<?=$user->id?>" method="post" id="delete-<?=$user->id?>" style="display:none"></form>
                                <a href="#" class="btn red" onclick="document.getElementById('delete-<?=$user->id?>').submit()">Excluir</a>
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