<div class="widget-box">
    <div class="widget-title" style="margin: 0;font-size: 1.1em">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab1">Dados do Fornecedor</a></li>
            <!--<li><a data-toggle="tab" href="#tab2"> Serviço Contratado</a></li>
            <li><a data-toggle="tab" href="#tab3">Vendas</a></li>-->
        </ul>
    </div>
    <div class="widget-content tab-content">
        <div id="tab1" class="tab-pane active" style="min-height: 300px">
            <div class="accordion" id="collapse-group">
                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                                <span><i class='bx bx-user icon-cli'></i></span>
                                <h5 style="padding-left: 28px">Informações da O.S</h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse in accordion-body" id="collapseGOne">
                        <div class="widget-content">
                            <table class="table table-bordered" style="border: 1px solid #ddd">
                                <tbody>
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong>Cliente</strong></td>
                                        <td>
                                            <?php echo $result->nomeCliente ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Status</strong></td>
                                        <td>
                                            <?php echo $result->status_os ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Descrição</strong></td>
                                        <td>
                                            <?php echo $result->descricao ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer" style="display:flex;justify-content: center">
    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
        echo '<a title="Icon Title" class="button btn btn-mini btn-info" style="min-width: 140px; top:10px" href="' . base_url() . 'index.php/os/editar/' . $result->idOs . '">
<span class="button__icon"><i class="bx bx-edit"></i></span> <span class="button__text2"> Editar</span></a>';
    } ?>
    <a title="Voltar" class="button btn btn-mini btn-warning" style="min-width: 140px; top:10px"
        href="<?php echo site_url() ?>/os">
        <span class="button__icon"><i class="bx bx-undo"></i></span><span class="button__text2">Voltar</span></a>
</div>
</div>