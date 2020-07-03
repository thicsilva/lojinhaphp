<?php $render('admin/header', [
    'authUser' => $authUser,
    'datatableCss' => '//cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css',
    'activeMenu' => 'user',
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
                    <a href="<?=$base?>/admin/user/create" class="btn yellow">Adicionar</a>
                </div>
                <table id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Última Atualização</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?=$user->id?></td>
                            <td><?=$user->name?></td>
                            <td><?=$user->email?></td>
                            <td><?=date('d/m/Y \à\s H:i', strtotime($user->updated_at))?></td>
                            <td>
                                <a href="<?=$base?>/admin/user/edit/<?=$user->id?>" class="btn green">Editar</a>
                                <form action="<?=$base?>/admin/user/delete/<?=$user->id?>" method="post" id="delete-<?=$user->id?>" style="display:none"></form>
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