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
                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
                            $url = base_url('index.php/clientes/vincularFornecedor/' . $result->idClientes);
                            echo '<div style="margin: 1.2rem">
                                            <a href="' . $url . '"title="Vincular Fornecedor">
                                                <button type="button" class="button btn btn-mini btn-success">
                                                    <span class="button__icon"><i class="bx bx-plus"></i></span>
                                                    <span class="button__text2">Vincular Fornecedor</span>
                                                </button>
                                            </a>
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
                                            <tr>
                                                <td style="text-align: right"><strong>Cidade</strong></td>
                                                <td>
                                                    <?php echo $fornecedor->cidade ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php if ($this->session->userdata('nome_admin') == "Admin") { ?>
                    <div class="accordion-group widget-box">
                        <div class="accordion-heading">
                            <div class="widget-title">
                                <a data-parent="#collapse-group" href="#collapseGSix" data-toggle="collapse">
                                    <span><i class='bx bx-money-withdraw icon-cli'></i></span>
                                    <h5 style="padding-left: 28px">Financeiro (EM MANUTENÇÃO)</h5>
                                </a>
                            </div>
                        </div>
                        <div class="collapse accordion-body" id="collapseGSix">
                            <?php
                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente') && !$financeiro_cliente) {
                                $url = base_url('index.php/clientes/gerarFinanceiro/' . $result->idClientes);
                                echo '<div style="margin: 1.2rem">
                                            <a href="' . $url . '"title="Gerar Financeiro">
                                                <button type="button" class="button btn btn-mini btn-success">
                                                    <span class="button__icon"><i class="bx bx-plus"></i></span>
                                                    <span class="button__text2">Gerar Financeiro</span>
                                                </button>
                                            </a>
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
                                                    <td style="text-align: right"><strong>Taxa de instalação</strong></td>
                                                    <td>R$ <?php echo $taxaInstalacaoFormatada ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>Valor Total</strong></td>
                                                    <td>R$ <?php echo $valorTotalFormatado ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>Valor por Parcela</strong></td>
                                                    <td>R$ <?php echo $valorPorParcelaFormatado ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>Responsável</strong></td>
                                                    <td><?php echo $fns->responsavel ?></td>
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
                <?php } ?>
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