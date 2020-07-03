<?php $render('admin/header', [
    'authUser' => $authUser,
    'datatableCss' => '//cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css',
    'activeMenu' => 'order',
]);?>
        <main class="main">
            <div class="container">
                <table id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Endereço</th>
                            <th>Total</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?=$order->id?></td>
                            <td><?=$order->name?></td>
                            <td><?=$order->address?></td>
                            <td>R$ <?=number_format($order->total, 2, ',', '.')?></td>
                            <td><?=date('d/m/Y \à\s H:i', strtotime($order->created_at))?></td>
                            <td>
                                <a href="#" class="btn green">Visualizar</a>
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