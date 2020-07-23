<div class="modal fade" id="modalProdutos" tabindex="-1" role="dialog" aria-labelledby="modalProdutosLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalProdutosLabel">Lista de Produtos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="table table-responsive table-hover table-bordered table-striped mb-0 table-sm" data-show-columns="true">
                    <table class="table" width="100" height="100">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Descrição</th>
                                <th>PUnit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($restaurante->getProdutos()->all() as $x) : ?>
                                <tr>
                                    <td><?= $x->getId() ?></td>
                                    <td><?= $x->getDescricao() ?></td>
                                    <td><?= (float) $x->getPUnit(); ?></td>
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