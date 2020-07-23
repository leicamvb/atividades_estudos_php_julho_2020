<div class="modal fade" id="modalCuponsDesconto" tabindex="-1" role="dialog" aria-labelledby="modalCuponsDescontoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCuponsDescontoLabel">Lista de Cupons</h5>
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
                                <th>Percentual</th>
                                <th>Ativo</th>
                                <th>dtEmissao</th>
                                <th>dtValidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($restaurante->getCuponsDesconto()->all() as $x) : ?>
                                <tr>
                                    <td><?= $x->getId() ?></td>
                                    <td><?= $x->getPercentual() ?></td>
                                    <td><?= $x->getAtivo() ?></td>
                                    <td><?= $x->getDtEmissao()->format('d/m/Y') ?></td>
                                    <td><?= $x->getDtValidade()->format('d/m/Y') ?></td>
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