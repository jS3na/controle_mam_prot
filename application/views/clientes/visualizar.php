<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script src="<?php echo base_url() ?>assets/js/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/dayjs.min.js"></script>

<div class="widget-box">
    <div class="widget-title" style="margin: 0;font-size: 1.1em">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab1">Dados do Cliente</a></li>
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
                                            <?php echo $result->nomeCliente ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Documento</strong></td>
                                        <td>
                                            <?php echo $result->documento ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Descrição</strong></td>
                                        <td>
                                            <?php echo $result->descricao ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Status</strong></td>
                                        <td>
                                            <?php echo $result->status ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Etapa Atual</strong></td>
                                        <td>
                                            <?php echo $etapa_atual[$result->etapa] ?>
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
                                        <td style="text-align: right; width: 30%"><strong>Telefone</strong></td>
                                        <td>
                                            <?php echo $result->telefone ?>
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
                            <a data-parent="#collapse-group" href="#collapseGThree" data-toggle="collapse">
                                <span><i class='bx bx-map-alt icon-cli'></i></span>
                                <h5 style="padding-left: 28px">Endereço</h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGThree">
                        <div class="widget-content">
                            <table class="table table-bordered th"
                                style="border: 1px solid #ddd;border-left: 1px solid #ddd">
                                <tbody>

                                    <tr>
                                        <td style="text-align: right; width: 30%;"><strong>Rua</strong></td>
                                        <td>
                                            <?php echo $result->rua ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Número</strong></td>
                                        <td>
                                            <?php echo $result->numero ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Complemento</strong></td>
                                        <td>
                                            <?php echo $result->complemento ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Bairro</strong></td>
                                        <td>
                                            <?php echo $result->bairro ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Cidade</strong></td>
                                        <td>
                                            <?php echo $result->cidade ?> -
                                            <?php echo $result->estado ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>CEP</strong></td>
                                        <td>
                                            <?php echo $result->cep ?>
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
                                <span><i class='bx bx-note icon-cli'></i></span>
                                <h5 style="padding-left: 28px">Notas</h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGFour">
                        <?php
                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
                            $url = base_url('index.php/clientes/adicionarLog/' . $result->idClientes);
                            echo '<div style="margin: 1.2rem">
                                        <a href="' . $url . '"title="Adicionar Log">
                                            <button type="button" class="button btn btn-mini btn-success">
                                                <span class="button__icon"><i class="bx bx-plus"></i></span>
                                                <span class="button__text2">Adicionar Nota</span>
                                            </button>
                                        </a>
                                    </div>
                                ';
                        }
                        ?>

                        <div class="widget-content">
                            <!-- Aba de Logs -->
                            <div id="tab4" class="tab-pane" style="min-height: 300px">
                                <?php if (!$logs_clientes) { ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Usuário</th>
                                                <th>Log</th>
                                                <th>Status</th>
                                                <th>Data</th>
                                                <th>Hora</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="5">Nenhum log encontrado</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Usuário</th>
                                                <th>Log</th>
                                                <th>Status</th>
                                                <th>Data</th>
                                                <th>Hora</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($logs_clientes as $log) { ?>
                                                <tr>
                                                    <td><?php echo $log->usuario; ?></td>
                                                    <td><?php echo $log->tarefa; ?></td>
                                                    <td><?php echo $log->status; ?></td>
                                                    <td><?php echo date('d/m/Y', strtotime($log->data)); ?></td>
                                                    <td><?php echo $log->hora; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="modal-excluir-fornecedor" class="modal hide fade" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel" aria-hidden="true">
                    <?php $url_excluir_fornecedor = base_url('index.php/clientes/excluirFornecedor/' . $result->idClientes); ?>
                    <form action="<?php echo $url_excluir_fornecedor; ?>" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h5 id="myModalLabel">Remover Fornecedor</h5>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="idParcela" name="idParcela" value="" />
                            <h5 style="text-align: center">Deseja realmente remover esse Fornecedor?</h5>
                            <div class="control-group">
                                <input type="hidden" name="status" value="<?php echo $result->status; ?>" />
                            </div>
                        </div>
                        <div class="modal-footer" style="display:flex;justify-content: center">
                            <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true"><span
                                    class="button__icon"><i class="bx bx-x"></i></span><span
                                    class="button__text2">Cancelar</span></button>
                            <button class="button btn btn-danger"><span class="button__icon"><i
                                        class='bx bx-trash'></i></span> <span
                                    class="button__text2">Remover</span></button>
                        </div>
                    </form>
                </div>

                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGFive" data-toggle="collapse">
                                <span><i class='bx bx-car icon-cli'></i></span>
                                <h5 style="padding-left: 28px">Fornecedor</h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGFive">
                        <?php
                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente') && !$fornecedor_cliente) {
                            $url = base_url('index.php/clientes/vincularFornecedor/' . $result->idClientes);
                            echo '<div style="display: flex; flex-direction: row"> <div style="margin: 1.2rem">
                                            <a href="' . $url . '"title="Vincular Fornecedor">
                                                <button type="button" class="button btn btn-mini btn-success">
                                                    <span class="button__icon"><i class="bx bx-plus"></i></span>
                                                    <span class="button__text2">Vincular Fornecedor</span>
                                                </button>
                                            </a>
                                        </div>
                                    ';

                            echo '<div style="margin: 1.2rem">
                                            <a href="' . base_url() . 'index.php/fornecedores/adicionar" title="Criar Novo Fornecedor">
                                                <button type="button" class="button btn btn-mini btn-primary">
                                                    <span class="button__icon"><i class="bx bx-plus"></i></span>
                                                    <span class="button__text2">Criar Novo Fornecedor</span>
                                                </button>
                                            </a>
                                        </div> </div>
                                    ';
                        }
                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dCliente') && $fornecedor_cliente) {
                            echo '<div class="" style="margin: 0.7rem; gap: 10px; display: flex; flex-direction: row">
                                            <a href="#modal-excluir-fornecedor" data-toggle="modal" role="button" class="button btn btn-mini btn-danger" style="width: 230px">
                                                <span class="button__icon"><i class="bx bx-trash"></i></span><span class="button__text2" title="Remover Financeiro">Remover Fornecedor</span></a>
                                        </div>
                                    ';
                        }
                        ?>
                        <div class="widget-content">
                            <table class="table table-bordered th"
                                style="border: 1px solid #ddd;border-left: 1px solid #ddd">
                                <tbody>

                                    <?php if (!$fornecedor_cliente) { ?>

                                        <tr>
                                            <td>
                                                Nenhum fornecedor foi vinculado
                                            </td>
                                        </tr>

                                    <?php } else { ?>
                                        <?php foreach ($fornecedor_by_id as $fornecedor) { ?>
                                            <tr>
                                                <td style="text-align: right; width: 30%;"><strong>Nome</strong></td>
                                                <td>
                                                    <?php echo $fornecedor->nomeFornecedor ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right"><strong>CNPJ</strong></td>
                                                <td>
                                                    <?php echo $fornecedor->cnpj ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right"><strong>Descrição</strong></td>
                                                <td>
                                                    <?php echo $fornecedor->descricao ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right"><strong>SLA de Manutenção</strong></td>
                                                <td>
                                                    <?php echo $fornecedor->sla_manutencao ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right"><strong>SLA de Instalação</strong></td>
                                                <td>
                                                    <?php echo $fornecedor->sla_instalacao ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right"><strong>Telefone Comercial</strong></td>
                                                <td>
                                                    <?php echo $fornecedor->telefone_comercial ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right"><strong>Email</strong></td>
                                                <td>
                                                    <?php echo $fornecedor->email ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGTen" data-toggle="collapse">
                                <span><i class='bx bx-file icon-cli'></i></span>
                                <h5 style="padding-left: 28px">Ordens</h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGTen">
                        <?php
                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
                            $url = base_url('index.php/os/adicionar/' . $result->nomeCliente);
                            echo '<div style="margin: 1.2rem">
                                        <a href="' . $url . '"title="Adicionar Os">
                                            <button type="button" class="button btn btn-mini btn-success">
                                                <span class="button__icon"><i class="bx bx-plus"></i></span>
                                                <span class="button__text2">Adicionar Ordem</span>
                                            </button>
                                        </a>
                                    </div>
                                ';
                        }
                        ?>

                        <div class="widget-content">
                            <!-- Aba de Logs -->
                            <div id="tab4" class="tab-pane" style="min-height: 300px">
                                <?php if (!$os_cliente) { ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Data Inicial</th>
                                                <th>Data Final</th>
                                                <th>Status</th>
                                                <th>Descrição</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="5">Nenhuma ordem encontrada</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Data Inicial</th>
                                                <th>Data Final</th>
                                                <th>Status</th>
                                                <th>Descrição</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($os_cliente as $osc) { ?>
                                                <tr>
                                                    <td><?php echo date('d/m/Y', strtotime($osc->dataInicial)); ?></td>
                                                    <td><?php echo date('d/m/Y', strtotime($osc->dataFinal)); ?></td>
                                                    <td><?php echo $osc->status_os; ?></td>
                                                    <td><?php echo $osc->descricao_os; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="modal-aprovar-parcela" class="modal hide fade" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel" aria-hidden="true">
                    <?php $url = base_url('index.php/clientes/aprovarParcela/' . $result->idClientes); ?>
                    <form action="<?php echo $url; ?>" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h5 id="myModalLabel">Aprovar Parcela</h5>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="idParcela" name="idParcela" value="" />
                            <h5 style="text-align: center">Deseja realmente registrar essa parcela como paga?</h5>

                            <div class="control-group">
                                <label for="meio_pagamento" class="control-label">Meio de Pagamento</label>
                                <div class="controls">
                                    <select id="meio_pagamento" name="meio_pagamento">
                                        <option value="">Selecione...</option>
                                        <option value="Boleto">Boleto</option>
                                        <option value="Dinheiro">Dinheiro</option>
                                        <option value="Cartão de Crédito">Cartão de Crédito</option>
                                        <option value="Pix">Pix</option>
                                        <option value="DDA">DDA</option>
                                    </select>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="temJuros">
                                        <input type="checkbox" id="temJuros" name="temJuros" onclick="toggleJuros()">
                                        Tem Juros
                                    </label>
                                </div>

                                <div class="control-group" id="campoJuros" style="display: none;">
                                    <label for="valorJuros" class="control-label">Valor do Juros</label>
                                    <div class="controls">
                                        <input type="number" id="valorJuros" name="valorJuros">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer" style="display:flex;justify-content: center">
                            <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true"><span
                                    class="button__icon"><i class="bx bx-x"></i></span><span
                                    class="button__text2">Cancelar</span></button>
                            <button class="button btn btn-success"><span class="button__icon"><i
                                        class='bx bx-check'></i></span> <span
                                    class="button__text2">Aprovar</span></button>
                        </div>
                    </form>
                </div>

                <div id="modal-excluir-financeiro" class="modal hide fade" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel" aria-hidden="true">
                    <?php $url_excluir_financeiro = base_url('index.php/clientes/excluirFinanceiro/' . $result->idClientes); ?>
                    <form action="<?php echo $url_excluir_financeiro; ?>" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h5 id="myModalLabel">Remover Financeiro</h5>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="idParcela" name="idParcela" value="" />
                            <h5 style="text-align: center">Deseja realmente remover esse Financeiro?</h5>
                            <div class="control-group">
                                <input type="hidden" name="status" value="<?php echo $result->status; ?>" />
                            </div>
                        </div>
                        <div class="modal-footer" style="display:flex;justify-content: center">
                            <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true"><span
                                    class="button__icon"><i class="bx bx-x"></i></span><span
                                    class="button__text2">Cancelar</span></button>
                            <button class="button btn btn-danger"><span class="button__icon"><i
                                        class='bx bx-trash'></i></span> <span
                                    class="button__text2">Remover</span></button>
                        </div>
                    </form>
                </div>

                <div id="modal-nova-parcela" class="modal hide fade" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel" aria-hidden="true">
                    <?php $url_parcela_unica = base_url('index.php/clientes/adicionarParcelaUnica/' . $result->idClientes); ?>
                    <form id="formReceita" action="<?php echo $url_parcela_unica ?>" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">Adicionar Nova Parcela</h3>
                        </div>
                        <div class="modal-body">

                            <div class="control-group">
                                <label for="vencimento" class="control-label">Vencimento *</label>
                                <div class="controls">
                                    <input id="vencimento" autocomplete="off" class="datepicker" type="text"
                                        name="vencimento" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="valorParcela" class="control-label">Valor *</label>
                                <div class="controls">
                                    <input id="valorParcela" type="number" name="valorParcela" />
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer" style="display:flex;justify-content: right">
                            <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true"
                                style="min-width: 110px">
                                <span class="button__icon"><i class="bx bx-x"></i></span>
                                <span class="button__text2">Cancelar
                                </span>
                            </button>
                            <button class="button btn btn-success" style="min-width: 110px">
                                <span class="button__icon"><i class='bx bx-check'></i></span><span
                                    class="button__text2">Adicionar</span></button>
                        </div>
                    </form>
                </div>

                <div id="modalParcelas" class="modal hide fade" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">Parcelas</h3>
                    </div>
                    <div class="modal-body">

                        <?php if (!$parcelas_cliente) { ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Valor</th>
                                        <th>Vencimento</th>
                                        <th>Pago</th>
                                        <th>Valor Pago</th>
                                        <th>Meio de pagamento</th>
                                        <th>Data do pagamento</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4">Nenhum financeiro encontrado</td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Valor</th>
                                        <th>Vencimento</th>
                                        <th>Pago</th>
                                        <th>Valor Pago</th>
                                        <th>Meio de pagamento</th>
                                        <th>Data do pagamento</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($parcelas_cliente as $parc) {
                                        // Define a classe CSS para a linha com base no status de pagamento
                                        $rowClass = $parc->pago == 1 ? 'alert-success' : 'alert-danger';
                                        ?>
                                        <tr class="alert <?php echo $rowClass; ?>">
                                            <td><?php echo $parc->valor; ?></td>
                                            <td>
                                                <?php
                                                if (!empty($parc->data_pagamento) && $parc->vencimento != '0000-00-00') {
                                                    echo date('d/m/Y', strtotime($parc->vencimento));
                                                } else {
                                                    echo '';
                                                }
                                                ?>
                                            </td>

                                            <td><?php echo $parc->pago == 1 ? 'Sim' : 'Não'; ?></td>
                                            <td><?php echo $parc->valorPago; ?></td>
                                            <td><?php echo $parc->meio_pagamento; ?></td>
                                            <td>
                                                <?php
                                                if (!empty($parc->data_pagamento) && $parc->data_pagamento != '0000-00-00') {
                                                    echo date('d/m/Y', strtotime($parc->data_pagamento));
                                                } else {
                                                    echo '';
                                                }
                                                ?>
                                            </td>

                                            <td>
                                                <?php if ($parc->pago == 0) { ?>
                                                    <a href="#modal-aprovar-parcela" role="button" data-toggle="modal"
                                                        data-dismiss="modal" parcela="<?php echo $parc->idParcelas; ?>"
                                                        style="margin-right: 1%" class="btn-nwe" title="Aprovar Parcela">
                                                        <i class="bx bx-check bx-xs"></i>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } ?>

                    </div>
                    <div class="modal-footer" style="display:flex;justify-content: right">
                        <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true"
                            style="min-width: 110px">
                            <span class="button__icon"><i class="bx bx-x"></i></span>
                            <span class="button__text2">Cancelar
                            </span>
                        </button>
                        <a data-dismiss="modal" href="#modal-nova-parcela" data-toggle="modal" role="button"
                            class="button btn btn-mini btn-primary" style="width: 230px">
                            <span class="button__icon"><i class="bx bx-plus"></i></span><span class="button__text2"
                                title="Adicionar Parcela">Adicionar Parcela</span></a>
                    </div>
                </div>

                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGSix" data-toggle="collapse">
                                <span><i class='bx bx-money-withdraw icon-cli'></i></span>
                                <h5 style="padding-left: 28px">Financeiro</h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGSix">
                        <?php
                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente') && !$financeiro_cliente) {
                            $url = base_url('index.php/clientes/gerarFinanceiro/' . $result->idClientes);
                            echo '<div style="margin: 0.7rem">
                                            <a href="' . $url . '"title="Gerar Financeiro">
                                                <button type="button" class="button btn btn-mini btn-success">
                                                    <span class="button__icon"><i class="bx bx-plus"></i></span>
                                                    <span class="button__text2">Gerar Financeiro</span>
                                                </button>
                                            </a>
                                        </div>
                                    ';
                        }
                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dCliente') && $financeiro_cliente) {
                            echo '<div class="" style="margin: 0.7rem; gap: 10px; display: flex; flex-direction: row">
                                            <a href="#modalParcelas" data-toggle="modal" role="button" class="button btn btn-mini btn-success" style="width: 230px">
                                                <span class="button__icon"><i class="bx bx-qr-scan"></i></span><span class="button__text2" title="Visualizar Parcelas">Visualizar Parcelas</span></a>
                                            <a href="#modal-excluir-financeiro" data-toggle="modal" role="button" class="button btn btn-mini btn-danger" style="width: 230px">
                                                <span class="button__icon"><i class="bx bx-trash"></i></span><span class="button__text2" title="Remover Financeiro">Remover Financeiro</span></a>
                                        </div>
                                    ';
                        }
                        ?>
                        <div class="widget-content">
                            <table class="table table-bordered th"
                                style="border: 1px solid #ddd;border-left: 1px solid #ddd">
                                <tbody>

                                    <?php if ($financeiro_cliente) {
                                        foreach ($financeiro_cliente as $fns) {

                                            $valorTotal = (float) $fns->valorTotal;
                                            $parcelas = (float) $fns->parcelas;

                                            $valorPorParcela = $parcelas > 0 ? $valorTotal / $parcelas : 0;

                                            $valorTotalFormatado = number_format($valorTotal, 2, ',', '.');
                                            $taxaInstalacaoFormatada = number_format((float) $fns->taxaInstalacao, 2, ',', '.');
                                            $valorPorParcelaFormatado = number_format($valorPorParcela, 2, ',', '.');
                                            ?>
                                            <tr>
                                                <td style="text-align: right; width: 30%;"><strong>Quantidade de
                                                        parcelas</strong></td>
                                                <td><?php echo $fns->parcelas ?></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right"><strong>Taxa de instalação</strong>
                                                </td>
                                                <td>R$ <?php echo $taxaInstalacaoFormatada ?></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right"><strong>Valor Total</strong></td>
                                                <td>R$ <?php echo $valorTotalFormatado ?></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right"><strong>Valor por Parcela</strong>
                                                </td>
                                                <td>R$ <?php echo $valorPorParcelaFormatado ?></td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <td>Nenhum financeiro foi gerado</td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGSeven" data-toggle="collapse">
                                <span><i class='bx bx-note icon-cli'></i></span>
                                <h5 style="padding-left: 28px">Arquivos Financeiro</h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGSeven">
                        <div class="new122">
                            <link rel="stylesheet"
                                href="<?= base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
                            <script type="text/javascript"
                                src="<?= base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>

                            <div class="span12" style="margin-left: 0">
                                <form method="get" action="<?= current_url(); ?>">
                                    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aArquivo')): ?>
                                        <div class="span3">
                                            <a href="<?= base_url(); ?>index.php/clientes/adicionarArquivo/<?php echo $result->idClientes . '/financeiro' ?>"
                                                class="button btn btn-mini btn-success" style="max-width:150px">
                                                <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span
                                                    class="button__text2">Arquivo</span></a>
                                        </div>
                                    <?php endif ?>

                                    <!--

                                        <div class="span5">
                                            <input type="text" name="pesquisa" id="pesquisa"
                                                placeholder="Digite o nome do documento para pesquisar" class="span12"
                                                value="<?= $this->input->get('pesquisa') ?>">
                                        </div>
                                        <div class="span3">
                                            <input type="text" name="data" id="data" placeholder="Data de"
                                                class="span6 datepicker" value="<?= $this->input->get('data') ?>">
                                            <input type="text" name="data2" id="data2" placeholder="Data até"
                                                class="span6 datepicker" value="<?= $this->input->get('data2') ?>">
                                        </div>
                                        <div class="span1">
                                            <button class="button btn btn-mini btn-warning" style="min-width: 30px"><span
                                                    class="button__icon"><i class='bx bx-search-alt'></i></span></button>
                                        </div>
                                        -->
                                </form>
                            </div>

                            <div>
                                <div class="widget-box">
                                    <div class="widget-content nopadding tab-content">
                                        <table id="tabela" width="100%" class="table table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th width="5%">#</th>
                                                    <th width="10%">Miniatura</th>
                                                    <th width="10%">Nome</th>
                                                    <th width="8%">Data</th>
                                                    <th>Descrição</th>
                                                    <th width="8%">Tamanho</th>
                                                    <th width="5%">Extensão</th>
                                                    <th width="14%">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                if (!$results_arquivos_financeiro) {
                                                    echo '<tr>
                                <td colspan="8">Nenhum Arquivo Encontrado</td>
                            </tr>';
                                                }
                                                foreach ($results_arquivos_financeiro as $r): ?>
                                                    <tr>
                                                        <td><?= $r->idDocumentos ?></td>
                                                        <td>
                                                            <?php if (@getimagesize($r->path)): ?>
                                                                <a href="<?= $r->url ?>"> <img src="<?= $r->url ?> "></a>
                                                            <?php else: ?>
                                                                <span>-</span>
                                                            <?php endif ?>
                                                        </td>
                                                        <td><?= $r->documento ?></td>
                                                        <td><?= date('d/m/Y', strtotime($r->cadastro)) ?></td>
                                                        <td><?= $r->descricao ?></td>
                                                        <td><?= $r->tamanho ?> KB</td>
                                                        <td><?= $r->tipo ?></td>
                                                        <td><?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vArquivo')): ?>
                                                                <a href="<?= base_url() ?>index.php/arquivos/download/<?= $r->idDocumentos; ?>"
                                                                    class="btn-nwe" title="Baixar Arquivo"><i
                                                                        class="bx bx-download"></i>
                                                                <?php endif ?>

                                                                <?php /*if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eArquivo')): ?>
                                       <a href="<?= base_url() ?>index.php/arquivos/editar/<?= $r->idDocumentos ?>"
                                           class="btn-nwe3" title="Editar"><i
                                               class="bx bx-edit"></i></a>
                                   <?php endif*/ ?>

                                                                <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dArquivo')): ?>
                                                                    <a href="#modal-excluir" style="margin-right: 1%"
                                                                        role="button" data-toggle="modal"
                                                                        arquivo="<?= $r->idDocumentos ?>" class="btn-nwe4"
                                                                        title="Excluir"><i class="bx bx-trash-alt"></i></a>
                                                                </a>
                                                            <?php endif ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <form
                                    action="<?= base_url() ?>index.php/arquivos/excluir/<?php echo $result->idClientes ?>"
                                    method="post">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×</button>
                                        <h5 id="myModalLabel">Excluir Arquivo</h5>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" id="idDocumento" name="id" value="" />
                                        <h5 style="text-align: center">Deseja realmente excluir este arquivo?</h5>
                                    </div>
                                    <div class="modal-footer" style="display:flex;justify-content: center">
                                        <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true">
                                            <span class="button__icon"><i class="bx bx-x"></i></span><span
                                                class="button__text2">Cancelar</span></button>
                                        <button class="button btn btn-danger"><span class="button__icon"><i
                                                    class='bx bx-trash'></i></span> <span
                                                class="button__text2">Excluir</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <script type="text/javascript">
                            $(document).ready(function () {
                                $(document).on('click', 'a', function (event) {
                                    var arquivo = $(this).attr('arquivo');
                                    $('#idDocumento').val(arquivo);
                                });
                                $(".datepicker").datepicker({
                                    dateFormat: 'dd/mm/yy'
                                });
                            });
                        </script>
                    </div>
                </div>

                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGEight" data-toggle="collapse">
                                <span><i class='bx bx-search icon-cli'></i></span>
                                <h5 style="padding-left: 28px">Arquivos Evidências</h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGEight">
                        <div class="new122">
                            <link rel="stylesheet"
                                href="<?= base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
                            <script type="text/javascript"
                                src="<?= base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>

                            <div class="span12" style="margin-left: 0">
                                <form method="get" action="<?= current_url(); ?>">
                                    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aArquivo')): ?>
                                        <div class="span3">
                                            <a href="<?= base_url(); ?>index.php/clientes/adicionarArquivo/<?php echo $result->idClientes . '/evidencias' ?>"
                                                class="button btn btn-mini btn-success" style="max-width:150px">
                                                <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span
                                                    class="button__text2">Arquivo</span></a>
                                        </div>
                                    <?php endif ?>

                                    <!--

                                        <div class="span5">
                                            <input type="text" name="pesquisa" id="pesquisa"
                                                placeholder="Digite o nome do documento para pesquisar" class="span12"
                                                value="<?= $this->input->get('pesquisa') ?>">
                                        </div>
                                        <div class="span3">
                                            <input type="text" name="data" id="data" placeholder="Data de"
                                                class="span6 datepicker" value="<?= $this->input->get('data') ?>">
                                            <input type="text" name="data2" id="data2" placeholder="Data até"
                                                class="span6 datepicker" value="<?= $this->input->get('data2') ?>">
                                        </div>
                                        <div class="span1">
                                            <button class="button btn btn-mini btn-warning" style="min-width: 30px"><span
                                                    class="button__icon"><i class='bx bx-search-alt'></i></span></button>
                                        </div>
                                        -->
                                </form>
                            </div>

                            <div>
                                <div class="widget-box">
                                    <div class="widget-content nopadding tab-content">
                                        <table id="tabela" width="100%" class="table table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th width="5%">#</th>
                                                    <th width="10%">Miniatura</th>
                                                    <th width="10%">Nome</th>
                                                    <th width="8%">Data</th>
                                                    <th>Descrição</th>
                                                    <th width="8%">Tamanho</th>
                                                    <th width="5%">Extensão</th>
                                                    <th width="14%">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                if (!$results_arquivos_evidencias) {
                                                    echo '<tr>
            <td colspan="8">Nenhum Arquivo Encontrado</td>
        </tr>';
                                                }
                                                foreach ($results_arquivos_evidencias as $r): ?>
                                                    <tr>
                                                        <td><?= $r->idDocumentos ?></td>
                                                        <td>
                                                            <?php if (@getimagesize($r->path)): ?>
                                                                <a href="<?= $r->url ?>"> <img src="<?= $r->url ?> "></a>
                                                            <?php else: ?>
                                                                <span>-</span>
                                                            <?php endif ?>
                                                        </td>
                                                        <td><?= $r->documento ?></td>
                                                        <td><?= date('d/m/Y', strtotime($r->cadastro)) ?></td>
                                                        <td><?= $r->descricao ?></td>
                                                        <td><?= $r->tamanho ?> KB</td>
                                                        <td><?= $r->tipo ?></td>
                                                        <td><?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vArquivo')): ?>
                                                                <a href="<?= base_url() ?>index.php/arquivos/download/<?= $r->idDocumentos; ?>"
                                                                    class="btn-nwe" title="Baixar Arquivo"><i
                                                                        class="bx bx-download"></i>
                                                                <?php endif ?>

                                                                <?php /*if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eArquivo')): ?>
                                       <a href="<?= base_url() ?>index.php/arquivos/editar/<?= $r->idDocumentos ?>"
                                           class="btn-nwe3" title="Editar"><i
                                               class="bx bx-edit"></i></a>
                                   <?php endif*/ ?>

                                                                <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dArquivo')): ?>
                                                                    <a href="#modal-excluir" style="margin-right: 1%"
                                                                        role="button" data-toggle="modal"
                                                                        arquivo="<?= $r->idDocumentos ?>" class="btn-nwe4"
                                                                        title="Excluir"><i class="bx bx-trash-alt"></i></a>
                                                                </a>
                                                            <?php endif ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <form
                                    action="<?= base_url() ?>index.php/arquivos/excluir/<?php echo $result->idClientes ?>"
                                    method="post">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×</button>
                                        <h5 id="myModalLabel">Excluir Arquivo</h5>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" id="idDocumento" name="id" value="" />
                                        <h5 style="text-align: center">Deseja realmente excluir este arquivo?</h5>
                                    </div>
                                    <div class="modal-footer" style="display:flex;justify-content: center">
                                        <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true">
                                            <span class="button__icon"><i class="bx bx-x"></i></span><span
                                                class="button__text2">Cancelar</span></button>
                                        <button class="button btn btn-danger"><span class="button__icon"><i
                                                    class='bx bx-trash'></i></span> <span
                                                class="button__text2">Excluir</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <script type="text/javascript">
                            $(document).ready(function () {
                                $(document).on('click', 'a', function (event) {
                                    var arquivo = $(this).attr('arquivo');
                                    $('#idDocumento').val(arquivo);
                                });
                                $(".datepicker").datepicker({
                                    dateFormat: 'dd/mm/yy'
                                });
                            });
                        </script>
                    </div>
                </div>

                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGNine" data-toggle="collapse">
                                <span><i class='bx bx-news icon-cli'></i></span>
                                <h5 style="padding-left: 28px">Arquivos Contratos</h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGNine">
                        <div class="new122">
                            <link rel="stylesheet"
                                href="<?= base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
                            <script type="text/javascript"
                                src="<?= base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>

                            <div class="span12" style="margin-left: 0">
                                <form method="get" action="<?= current_url(); ?>">
                                    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aArquivo')): ?>
                                        <div class="span3">
                                            <a href="<?= base_url(); ?>index.php/clientes/adicionarArquivo/<?php echo $result->idClientes . '/contratos' ?>"
                                                class="button btn btn-mini btn-success" style="max-width:150px">
                                                <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span
                                                    class="button__text2">Arquivo</span></a>
                                        </div>
                                    <?php endif ?>

                                    <!--

                                        <div class="span5">
                                            <input type="text" name="pesquisa" id="pesquisa"
                                                placeholder="Digite o nome do documento para pesquisar" class="span12"
                                                value="<?= $this->input->get('pesquisa') ?>">
                                        </div>
                                        <div class="span3">
                                            <input type="text" name="data" id="data" placeholder="Data de"
                                                class="span6 datepicker" value="<?= $this->input->get('data') ?>">
                                            <input type="text" name="data2" id="data2" placeholder="Data até"
                                                class="span6 datepicker" value="<?= $this->input->get('data2') ?>">
                                        </div>
                                        <div class="span1">
                                            <button class="button btn btn-mini btn-warning" style="min-width: 30px"><span
                                                    class="button__icon"><i class='bx bx-search-alt'></i></span></button>
                                        </div>
                                        -->
                                </form>
                            </div>

                            <div>
                                <div class="widget-box">
                                    <div class="widget-content nopadding tab-content">
                                        <table id="tabela" width="100%" class="table table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th width="5%">#</th>
                                                    <th width="10%">Miniatura</th>
                                                    <th width="10%">Nome</th>
                                                    <th width="8%">Data</th>
                                                    <th>Descrição</th>
                                                    <th width="8%">Tamanho</th>
                                                    <th width="5%">Extensão</th>
                                                    <th width="14%">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                if (!$results_arquivos_contratos) {
                                                    echo '<tr>
            <td colspan="8">Nenhum Arquivo Encontrado</td>
        </tr>';
                                                }
                                                foreach ($results_arquivos_contratos as $r): ?>
                                                    <tr>
                                                        <td><?= $r->idDocumentos ?></td>
                                                        <td>
                                                            <?php if (@getimagesize($r->path)): ?>
                                                                <a href="<?= $r->url ?>"> <img src="<?= $r->url ?> "></a>
                                                            <?php else: ?>
                                                                <span>-</span>
                                                            <?php endif ?>
                                                        </td>
                                                        <td><?= $r->documento ?></td>
                                                        <td><?= date('d/m/Y', strtotime($r->cadastro)) ?></td>
                                                        <td><?= $r->descricao ?></td>
                                                        <td><?= $r->tamanho ?> KB</td>
                                                        <td><?= $r->tipo ?></td>
                                                        <td><?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vArquivo')): ?>
                                                                <a href="<?= base_url() ?>index.php/arquivos/download/<?= $r->idDocumentos; ?>"
                                                                    class="btn-nwe" title="Baixar Arquivo"><i
                                                                        class="bx bx-download"></i>
                                                                <?php endif ?>

                                                                <?php /*if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eArquivo')): ?>
                                       <a href="<?= base_url() ?>index.php/arquivos/editar/<?= $r->idDocumentos ?>"
                                           class="btn-nwe3" title="Editar"><i
                                               class="bx bx-edit"></i></a>
                                   <?php endif */ ?>

                                                                <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dArquivo')): ?>
                                                                    <a href="#modal-excluir" style="margin-right: 1%"
                                                                        role="button" data-toggle="modal"
                                                                        arquivo="<?= $r->idDocumentos ?>" class="btn-nwe4"
                                                                        title="Excluir"><i class="bx bx-trash-alt"></i></a>
                                                                </a>
                                                            <?php endif ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <form
                                    action="<?= base_url() ?>index.php/arquivos/excluir/<?php echo $result->idClientes ?>"
                                    method="post">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×</button>
                                        <h5 id="myModalLabel">Excluir Arquivo</h5>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" id="idDocumento" name="id" value="" />
                                        <h5 style="text-align: center">Deseja realmente excluir este arquivo?</h5>
                                    </div>
                                    <div class="modal-footer" style="display:flex;justify-content: center">
                                        <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true">
                                            <span class="button__icon"><i class="bx bx-x"></i></span><span
                                                class="button__text2">Cancelar</span></button>
                                        <button class="button btn btn-danger"><span class="button__icon"><i
                                                    class='bx bx-trash'></i></span> <span
                                                class="button__text2">Excluir</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <script type="text/javascript">
                            $(document).ready(function () {
                                $(document).on('click', 'a', function (event) {
                                    var arquivo = $(this).attr('arquivo');
                                    $('#idDocumento').val(arquivo);
                                });
                                $(".datepicker").datepicker({
                                    dateFormat: 'dd/mm/yy'
                                });
                            });
                        </script>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div class="modal-footer" style="display:flex;justify-content: center">
        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            echo '<a title="Icon Title" class="button btn btn-mini btn-info" style="min-width: 140px; top:10px" href="' . base_url() . 'index.php/clientes/editar/' . $result->idClientes . '">
<span class="button__icon"><i class="bx bx-edit"></i></span> <span class="button__text2"> Editar</span></a>';
        } ?>
        <a title="Voltar" class="button btn btn-mini btn-warning" style="min-width: 140px; top:10px"
            href="<?php echo site_url() ?>/clientes">
            <span class="button__icon"><i class="bx bx-undo"></i></span><span class="button__text2">Voltar</span></a>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', 'a', function (event) {
            var parcela = $(this).attr('parcela');
            $('#idParcela').val(parcela);
        });
    });

    function toggleJuros() {
        var checkbox = document.getElementById('temJuros');
        var campoJuros = document.getElementById('campoJuros');
        if (checkbox.checked) {
            campoJuros.style.display = 'block';
        } else {
            campoJuros.style.display = 'none';
        }
    }
</script>