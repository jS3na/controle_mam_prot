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
                                <h5 style="padding-left: 28px">Dados Pessoais</h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse in accordion-body" id="collapseGOne">
                        <div class="widget-content">
                            <table class="table table-bordered" style="border: 1px solid #ddd">
                                <tbody>
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong>Nome</strong></td>
                                        <td>
                                            <?php echo $result->nomeFornecedor ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>CNPJ</strong></td>
                                        <td>
                                            <?php echo $result->cnpj ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Descrição</strong></td>
                                        <td>
                                            <?php echo $result->descricao ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>SLA de Manutenção</strong></td>
                                        <td>
                                            <?php echo $result->sla_manutencao ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>SLA de Instalação</strong></td>
                                        <td>
                                            <?php echo $result->sla_instalacao ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Data de Cadastro</strong></td>
                                        <td>
                                            <?php echo date('d/m/Y', strtotime($result->dataCadastro)) ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGTwo" data-toggle="collapse">
                                <span><i class='bx bx-phone icon-cli'></i></span>
                                <h5 style="padding-left: 28px">Contatos</h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGTwo">
                        <div class="widget-content">
                            <table class="table table-bordered" style="border: 1px solid #ddd">
                                <tbody>
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong>Telefone Comercial</strong>
                                        </td>
                                        <td>
                                            <?php echo $result->telefone_comercial ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong> Financeiro</strong></td>
                                        <td>
                                            <?php echo $result->telefone_financeiro ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong>Telefone Suporte</strong></td>
                                        <td>
                                            <?php echo $result->telefone_suporte ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Email</strong></td>
                                        <td>
                                            <?php echo $result->email ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGFour" data-toggle="collapse">
                                <span><i class='bx bx-barcode icon-cli'></i></span>
                                <h5 style="padding-left: 28px">Clientes</h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGFour">

                        <div class="widget-content">
                            <!-- Aba de Logs -->
                            <div id="tab4" class="tab-pane" style="min-height: 300px">
                                <?php if (!$clientes_by_id) { ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Documento</th>
                                                <th>Telefone</th>
                                                <th>Email</th>
                                                <th>Cidade</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="5">Nenhum cliente encontrado</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Documento</th>
                                                <th>Telefone</th>
                                                <th>Email</th>
                                                <th>Cidade</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($clientes_by_id as $cl) { ?>
                                                <tr>
                                                    <td><?php echo $cl->nomeCliente; ?></td>
                                                    <td><?php echo $cl->documento; ?></td>
                                                    <td><?php echo $cl->telefone; ?></td>
                                                    <td><?php echo $cl->email; ?></td>
                                                    <td><?php echo $cl->cidade; ?></td>
                                                    <td><?php echo $cl->status; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGFive" data-toggle="collapse">
                                <span><i class='bx bx-map-alt icon-cli'></i></span>
                                <h5 style="padding-left: 28px">Endereços</h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGFive">

                        <?php
                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eFornecedor')) {
                            $url = base_url('index.php/fornecedores/adicionarEndereco/' . $result->idFornecedores);
                            echo '<div style="margin: 1.2rem">
                                        <a href="' . $url . '"title="Adicionar Log">
                                            <button type="button" class="button btn btn-mini btn-success">
                                                <span class="button__icon"><i class="bx bx-plus"></i></span>
                                                <span class="button__text2">Adicionar Endereço</span>
                                            </button>
                                        </a>
                                    </div>
                                ';
                        }
                        ?>

                        <div class="widget-content">
                            <!-- Aba de Logs -->
                            <div id="tab4" class="tab-pane" style="min-height: 300px">
                                <?php if (!$fornecedor_enderecos) { ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Rua</th>
                                                <th>Número</th>
                                                <th>Bairro</th>
                                                <th>Cidade</th>
                                                <th>Estado</th>
                                                <th>CEP</th>
                                                <th>Complemento</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="5">Nenhum cliente encontrado</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Rua</th>
                                                <th>Número</th>
                                                <th>Bairro</th>
                                                <th>Cidade</th>
                                                <th>Estado</th>
                                                <th>CEP</th>
                                                <th>Complemento</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($fornecedor_enderecos as $fe) { ?>
                                                <tr>
                                                    <td><?php echo $fe->rua; ?></td>
                                                    <td><?php echo $fe->numero; ?></td>
                                                    <td><?php echo $fe->bairro; ?></td>
                                                    <td><?php echo $fe->cidade; ?></td>
                                                    <td><?php echo $fe->estado; ?></td>
                                                    <td><?php echo $fe->cep; ?></td>
                                                    <td><?php echo $fe->complemento; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer" style="display:flex;justify-content: center">
    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
        echo '<a title="Icon Title" class="button btn btn-mini btn-info" style="min-width: 140px; top:10px" href="' . base_url() . 'index.php/fornecedores/editar/' . $result->idFornecedores . '">
<span class="button__icon"><i class="bx bx-edit"></i></span> <span class="button__text2"> Editar</span></a>';
    } ?>
    <a title="Voltar" class="button btn btn-mini btn-warning" style="min-width: 140px; top:10px"
        href="<?php echo site_url() ?>/fornecedores">
        <span class="button__icon"><i class="bx bx-undo"></i></span><span class="button__text2">Voltar</span></a>
</div>
</div>