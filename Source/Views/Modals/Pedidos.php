<div class="modal fade" id="modalPedidos" tabindex="-1" role="dialog" aria-labelledby="modalPedidosLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPedidosLabel">Lista de Pedidos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="table-responsive table-hover table-bordered table-striped mb-0 table table-sm" data-show-columns="true">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Status</th>
                                <th>IdCliente</th>
                                <th>Cliente</th>
                                <th>(R$) Frete</th>
                                <th>Cupom Desconto Nº</th>
                                <th>(%) Desconto</th>
                                <th>(R$) Desconto</th>
                                <th>Valor Total</th>
                                <th>Qtd Itens</th>
                                <th>Itens</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($restaurante->getPedidos()->all() as $x) : ?>
                                <tr class="accordion-toggle collapsed" id="accordion<?= $x->getId() ?>" data-toggle="collapse" data-parent="#accordion<?= $x->getId() ?>" href="#collapse<?= $x->getId() ?>">
                                    <td><?= $x->getId() ?></td>
                                    <td><?= $x->getStatus() ?></td>
                                    <td><?= $x->getClienteId() ?></td>
                                    <td><?= $restaurante->getClientes()->findById($x->getClienteId())->getFirstName() ?></td>
                                    <td><?= $x->getFrete() ?></td>
                                    <td><?= $x->getCupomDesconto() ?></td>
                                    <td><?= $x->getPercentualDesconto() ?></td>
                                    <td><?= $x->getValorDesconto() ?></td>
                                    <td><?= $x->getValorTotal() ?></td>
                                    <td><?= $x->getQtdeTotal() ?></td>
                                    <td class="expand-button"></td>
                                </tr>



                                <!-- Itens Pedidos -->
                                <tr class="hide-table-padding">
                                    <td colspan="3">
                                        <div id="collapse<?= $x->getId() ?>" class="collapse in p-1">
                                            <div class="table-responsive table-hover table-bordered table-striped mb-0 table table-sm" data-show-columns="true">
                                                <table class="table">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>Seq</th>
                                                            <th>Qtde</th>
                                                            <th>PUnit</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($x->getItens()->all() as $y) : ?>
                                                            <tr>
                                                                <td><?= $y->getSeq() ?></td>
                                                                <td><?= $y->getQtde() ?></td>
                                                                <td><?= $y->getPUnit(); ?></td>
                                                                <td><?= $y->getPTotal(); ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>