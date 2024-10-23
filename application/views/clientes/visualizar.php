<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script src="<?php echo base_url() ?>assets/js/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/dayjs.min.js"></script>

<div class="widget-box">
    <div class="widget-title" style="margin: 0;font-size: 1.1em">
        <ul class="nav nav-tabs">

            <?php $indexContrato = 1;
            foreach ($contratos as $contrato) { ?>
                <li <?php echo $indexContrato == 1 ? 'class="active"' : null ?>><a data-toggle="tab"
                        href="#tab<?php echo $indexContrato; ?>">Dados do Contrato
                        <?php echo $indexContrato; ?></a></li>
                <?php $indexContrato++;
            } ?>

            <li><a href="#modal-adicionar-contrato" data-toggle="modal" role="button"><i class='bx bx-plus'></i></a>
            </li>

        </ul>

        <div id="modal-adicionar-contrato" class="modal hide fade" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel" aria-hidden="true">
            <?php $url_adicionar_contrato = base_url('index.php/clientes/addContrato/' . $result->idClientes); ?>
            <form action="<?php echo $url_adicionar_contrato; ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 id="myModalLabel">Adicionar Novo Contrato</h5>
                </div>
                <div class="modal-body">
                    <h6 style="text-align: center">Deseja realmente adicionar um novo contrato ao cliente
                        <?php echo $result->nomeCliente; ?>?
                    </h6>
                </div>
                <div class="modal-footer" style="display:flex;justify-content: center">
                    <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true"><span
                            class="button__icon"><i class="bx bx-x"></i></span><span
                            class="button__text2">Cancelar</span></button>
                    <button class="button btn btn-success"><span class="button__icon"><i class='bx bx-check'></i></span>
                        <span class="button__text2">Confirmar</span></button>
                </div>
            </form>
        </div>
    </div>
    <div class="widget-content tab-content">
        <?php $indexContrato = 1;
        foreach ($contratos as $contrato) { ?>
            <div id="tab<?php echo $indexContrato; ?>" class="tab-pane <?php echo $indexContrato == 1 ? 'active' : null ?>"
                style="min-height: 300px">
                <div class="accordion" id="collapse-group">
                    <div class="accordion-group widget-box">
                        <div class="accordion-heading">
                            <div class="widget-title">
                                <a data-parent="#collapse-group" href="#collapseGOne<?php echo $indexContrato; ?>"
                                    data-toggle="collapse">
                                    <span><i class='bx bx-user icon-cli'></i></span>
                                    <h5 style="padding-left: 28px">Dados do Cliente/Contrato</h5>
                                </a>
                            </div>
                        </div>
                        <?php $motivo_pendencia_loop = "motivo_pendencia_" . $indexContrato; ?>
                        <div class="collapse in accordion-body" id="collapseGOne<?php echo $indexContrato; ?>">
                            <div class="widget-content">
                                <table class="table table-bordered" style="border: 1px solid #ddd">
                                    <tbody>
                                        <tr>
                                            <td style="text-align: right; width: 30%"><strong>Nome</strong></td>
                                            <td>
                                                <?php echo $result->nomeCliente ?>
                                            </td>
                                        </tr>
                                        <?php if ($contrato->idPendencia) { ?>
                                            <tr>
                                                <td style="text-align: right; width: 30%"><strong>Motivo da Pendência</strong>
                                                </td>
                                                <td>
                                                    <?php echo $$motivo_pendencia_loop->justificativa ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
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
                                            <td style="text-align: right; vertical-align: middle;"><strong>Etapa
                                                    Atual</strong></td>
                                            <td>
                                                <div style="display: flex; align-items: center;">
                                                    <span><?php echo $etapa_atual[$contrato->idEtapa]; ?></span>
                                                    <div style="margin-left: 20px;">
                                                        <a href="#modal-proxima-etapa<?php echo $indexContrato; ?>"
                                                            data-toggle="modal" role="button" class="btn btn-success"
                                                            style="min-width: 150px; margin-right: 10px;">
                                                            <i class="bx bx-right-arrow-alt"
                                                                style="margin-right: 5px;"></i>Próxima Etapa
                                                        </a>
                                                        <a href="#modal-relatar-pendencia<?php echo $indexContrato; ?>"
                                                            data-toggle="modal" role="button" class="btn btn-danger"
                                                            style="min-width: 150px;">
                                                            <i class="bx bx-message-alt-error"
                                                                style="margin-right: 5px;"></i>Relatar Pendência
                                                        </a>
                                                    </div>
                                                </div>
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

                    <div id="modal-proxima-etapa<?php echo $indexContrato; ?>" class="modal hide fade" tabindex="-1"
                        role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <?php $url_proxima_etapa = base_url('index.php/clientes/proximaEtapa/' . $contrato->idContratos . '/' . $contrato->idEtapa . '/' . $result->idClientes . '/' . $etapa_atual[$contrato->idEtapa]); ?>
                        <form action="<?php echo $url_proxima_etapa; ?>" method="post">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h5 id="myModalLabel">Promover para a próxima etapa</h5>
                            </div>
                            <div class="modal-body">
                                <div class="control-group">
                                    <input type="hidden" name="etapa_atual"
                                        value="<?php echo $etapa_atual[$contrato->idEtapa]; ?>" />
                                    <input type="hidden" name="etapa_promovida"
                                        value="<?php echo $etapa_atual[$contrato->idEtapa + 1]; ?>" />
                                    <input type="hidden" name="usuario"
                                        value="<?php echo $this->session->userdata['nome_admin'] ?>" />
                                </div>
                                <p style="text-align: center">Deseja realmente promover esse Cliente de
                                    <strong><?php echo $etapa_atual[$contrato->idEtapa]; ?></strong> a
                                    <strong><?php echo $etapa_atual[$contrato->idEtapa + 1]; ?></strong>?
                                </p>
                            </div>
                            <div class="modal-footer" style="display:flex;justify-content: center">
                                <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true"><span
                                        class="button__icon"><i class="bx bx-x"></i></span><span
                                        class="button__text2">Cancelar</span></button>
                                <button class="button btn btn-success"><span class="button__icon"><i
                                            class='bx bx-check'></i></span> <span
                                        class="button__text2">Confirmar</span></button>
                            </div>
                        </form>
                    </div>

                    <div id="modal-relatar-pendencia<?php echo $indexContrato; ?>" class="modal hide fade" tabindex="-1"
                        role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <?php $url_proxima_etapa = base_url('index.php/clientes/relatarPendencia/' . $contrato->idContratos . '/' . $result->idClientes . '/' . $etapa_atual[$contrato->idEtapa]); ?>
                        <form action="<?php echo $url_proxima_etapa; ?>" method="post">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h5 id="myModalLabel">Relatar Pendência</h5>
                            </div>
                            <div class="modal-body">
                                <div class="control-group">
                                    <input type="hidden" name="etapa_atual"
                                        value="<?php echo $etapa_atual[$contrato->idEtapa]; ?>" />
                                    <input type="hidden" name="usuario"
                                        value="<?php echo $this->session->userdata['nome_admin'] ?>" />
                                </div>
                                <p style="text-align: center">Digite abaixo a justificativa dessa pendência:</p>

                                <div class="span6" style="padding: 1%; margin-left: 0">
                                    <label for="justificativa">
                                        <h4>Justificativa</h4>
                                    </label>
                                    <textarea required class="span12 editor" name="justificativa" id="justificativa"
                                        cols="30" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer" style="display:flex;justify-content: center">
                                <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true"><span
                                        class="button__icon"><i class="bx bx-x"></i></span> <span
                                        class="button__text2">Cancelar</span></button>
                                <button class="button btn btn-success"><span class="button__icon"><i
                                            class='bx bx-check'></i></span> <span
                                        class="button__text2">Relatar</span></button>
                            </div>
                        </form>
                    </div>

                    <div class="accordion-group widget-box">
                        <div class="accordion-heading">
                            <div class="widget-title">
                                <a data-parent="#collapse-group" href="#collapseGTwo<?php echo $indexContrato; ?>"
                                    data-toggle="collapse">
                                    <span><i class='bx bx-phone icon-cli'></i></span>
                                    <h5 style="padding-left: 28px">Contatos</h5>
                                </a>
                            </div>
                        </div>
                        <div class="collapse accordion-body" id="collapseGTwo<?php echo $indexContrato; ?>">
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
                    <div class="accordion-group widget-box" <?php echo !$contrato->idClienteEndereco ? 'style="background-color: #faa6a0;"' : null ?>>
                        <div class="accordion-heading">
                            <div class="widget-title">
                                <a data-parent="#collapse-group" href="#collapseGThree<?php echo $indexContrato; ?>"
                                    data-toggle="collapse">
                                    <span><i class='bx bx-map-alt icon-cli'></i></span>
                                    <h5 style="padding-left: 28px">Endereço</h5>
                                </a>
                            </div>
                        </div>
                        <div class="collapse accordion-body" id="collapseGThree<?php echo $indexContrato; ?>">
                            <div class="widget-content">
                                <table class="table table-bordered th"
                                    style="border: 1px solid #ddd;border-left: 1px solid #ddd">
                                    <tbody>

                                        <?php
                                        $idEndereco = null;
                                        if (isset($contrato->idClienteEndereco) && $contrato->idClienteEndereco >= 1) {
                                            $idEndereco = $contrato->idClienteEndereco - 1;
                                        }
                                        ?>

                                        <?php if ($idEndereco !== null && !empty($enderecos) && isset($enderecos[$idEndereco]['rua'])) { ?>

                                            <?php
                                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aCliente') && $contrato->idContratoCliente != 1) {
                                                $url_excluir_endereco = base_url('index.php/clientes/excluirEndereco/' . $contrato->idContratos . '/' . $enderecos[$idEndereco]['id'] . '/' . $contrato->idCliente . '/' . $etapa_atual[$contrato->idEtapa]);
                                                echo '<div style="margin: 1.2rem">
                                        <a href="' . $url_excluir_endereco . '"title="Excluir Endereço">
                                            <button type="button" class="button btn btn-mini btn-danger">
                                                <span class="button__icon"><i class="bx bx-trash"></i></span>
                                                <span class="button__text2">Excluir Endereço</span>
                                            </button>
                                        </a>
                                    </div>
                                ';
                                            }

                                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aCliente')) {
                                                $url_editar_endereco = base_url('index.php/clientes/editarEndereco/' . $contrato->idContratos . '/' . $enderecos[$idEndereco]['id'] . '/' . $contrato->idCliente . '/' . $etapa_atual[$contrato->idEtapa]);
                                                echo '<div style="margin: 1.2rem">
                                        <a href="' . $url_editar_endereco . '"title="Editar Endereço">
                                            <button type="button" class="button btn btn-mini btn-primary">
                                                <span class="button__icon"><i class="bx bx-pencil"></i></span>
                                                <span class="button__text2">Editar Endereço</span>
                                            </button>
                                        </a>
                                    </div>
                                ';
                                            }
                                            ?>

                                            <tr>
                                                <td style="text-align: right; width: 30%;"><strong>Rua</strong></td>
                                                <td>
                                                    <?php echo $enderecos[$idEndereco]['rua']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right"><strong>Número</strong></td>
                                                <td>
                                                    <?php echo $enderecos[$idEndereco]['numero']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right"><strong>Complemento</strong></td>
                                                <td>
                                                    <?php echo $enderecos[$idEndereco]['complemento']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right"><strong>Bairro</strong></td>
                                                <td>
                                                    <?php echo $enderecos[$idEndereco]['bairro']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right"><strong>Cidade</strong></td>
                                                <td>
                                                    <?php echo $enderecos[$idEndereco]['cidade']; ?> -
                                                    <?php echo $enderecos[$idEndereco]['estado']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right"><strong>CEP</strong></td>
                                                <td>
                                                    <?php echo $enderecos[$idEndereco]['cep']; ?>
                                                </td>
                                            </tr>

                                        <?php } else { ?>
                                            <?php
                                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
                                                $url_adicionar_endereco = base_url('index.php/clientes/adicionarEndereco/' . $contrato->idContratos . '/' . $result->idClientes . '/' . $etapa_atual[$contrato->idEtapa]);
                                                $url_vincular_endereco = base_url('index.php/clientes/vincularEndereco/' . $contrato->idContratos . '/' . $result->idClientes . '/' . $etapa_atual[$contrato->idEtapa]);
                                                echo '<div style="margin: 1.2rem">
                                        <a href="' . $url_adicionar_endereco . '"title="Adicionar Endereço">
                                            <button type="button" class="button btn btn-mini btn-success">
                                                <span class="button__icon"><i class="bx bx-plus"></i></span>
                                                <span class="button__text2">Adicionar Endereço</span>
                                            </button>
                                        </a>
                                        <a href="' . $url_vincular_endereco . '"title="Vincular Endereço">
                                            <button type="button" class="button btn btn-mini btn-primary">
                                                <span class="button__icon"><i class="bx bx-sort"></i></span>
                                                <span class="button__text2">Vincular Endereço Principal</span>
                                            </button>
                                        </a>
                                    </div>
                                ';
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="5">Nenhum endereço encontrado</td>
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
                                <a data-parent="#collapse-group" href="#collapseGFour<?php echo $indexContrato; ?>"
                                    data-toggle="collapse">
                                    <span><i class='bx bx-note icon-cli'></i></span>
                                    <h5 style="padding-left: 28px">Notas</h5>
                                </a>
                            </div>
                        </div>
                        <div class="collapse accordion-body" id="collapseGFour<?php echo $indexContrato; ?>">
                            <?php
                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
                                $url = base_url('index.php/clientes/adicionarLog/' . $result->idClientes . '/' . $contrato->idContratos);
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
                                    <?php if (!$notas_clientes) { ?>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Usuário</th>
                                                    <th>Nota</th>
                                                    <th>Etapa</th>
                                                    <th>Data</th>
                                                    <th>Hora</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="5">Nenhuma Nota encontrado</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <?php } else { ?>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Usuário</th>
                                                    <th>Nota</th>
                                                    <th>Etapa</th>
                                                    <th>Data</th>
                                                    <th>Hora</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($notas_clientes as $nota) { ?>
                                                    <?php if ($contrato->idNotas != null && in_array($nota['id'], json_decode($contrato->idNotas, true))) { ?>
                                                        <tr>
                                                            <td><?php echo $nota['usuario']; ?></td>
                                                            <td><?php echo $nota['nota']; ?></td>
                                                            <td><?php echo $nota['etapa']; ?></td>
                                                            <td><?php echo $nota['data']; ?></td>
                                                            <td><?php echo $nota['hora']; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="modal-excluir-fornecedor<?php echo $indexContrato; ?>" class="modal hide fade" tabindex="-1"
                        role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <?php $url_excluir_fornecedor = base_url('index.php/clientes/excluirFornecedor/' . $result->idClientes . '/' . $contrato->idContratos . '/' . $etapa_atual[$contrato->idEtapa]); ?>
                        <form action="<?php echo $url_excluir_fornecedor; ?>" method="post">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h5 id="myModalLabel">Remover Fornecedor</h5>
                            </div>
                            <div class="modal-body">
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

                    <div class="accordion-group widget-box" <?php echo !$contrato->idFornecedor ? 'style="background-color: #faa6a0;"' : null ?>>
                        <div class="accordion-heading">
                            <div class="widget-title">
                                <a data-parent="#collapse-group" href="#collapseGFive<?php echo $indexContrato; ?>"
                                    data-toggle="collapse">
                                    <span><i class='bx bx-car icon-cli'></i></span>
                                    <h5 style="padding-left: 28px">Fornecedor</h5>
                                </a>
                            </div>
                        </div>
                        <div class="collapse accordion-body" id="collapseGFive<?php echo $indexContrato; ?>">
                            <?php
                            $fornecedor_cliente_loop = "fornecedor_cliente_" . $indexContrato;
                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente') && !$$fornecedor_cliente_loop) {
                                $url = base_url('index.php/clientes/vincularFornecedor/' . $result->idClientes . '/' . $contrato->idContratos);
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
                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dCliente') && $$fornecedor_cliente_loop) {
                                echo '<div class="" style="margin: 0.7rem; gap: 10px; display: flex; flex-direction: row">
                                            <a href="#modal-excluir-fornecedor' . $indexContrato . '" data-toggle="modal" role="button" class="button btn btn-mini btn-danger" style="width: 230px">
                                                <span class="button__icon"><i class="bx bx-trash"></i></span><span class="button__text2" title="Remover Financeiro">Remover Fornecedor</span></a>
                                        </div>
                                    ';
                            }
                            ?>
                            <div class="widget-content">
                                <table class="table table-bordered th"
                                    style="border: 1px solid #ddd;border-left: 1px solid #ddd">
                                    <tbody>

                                        <?php if (!$$fornecedor_cliente_loop) { ?>

                                            <tr>
                                                <td>
                                                    Nenhum fornecedor foi vinculado
                                                </td>
                                            </tr>

                                        <?php } else { ?>
                                            <?php foreach ($$fornecedor_cliente_loop as $fornecedor) { ?>
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
                                <a data-parent="#collapse-group" href="#collapseGTen<?php echo $indexContrato; ?>"
                                    data-toggle="collapse">
                                    <span><i class='bx bx-file icon-cli'></i></span>
                                    <h5 style="padding-left: 28px">Ordens</h5>
                                </a>
                            </div>
                        </div>
                        <div class="collapse accordion-body" id="collapseGTen<?php echo $indexContrato; ?>">
                            <?php
                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
                                $url = base_url('index.php/os/adicionar/' . $result->nomeCliente . '/' . $contrato->idContratos);
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
                                                    <?php if ($contrato->idOrdens != null && in_array($osc->idOs, json_decode($contrato->idOrdens, true))) { ?>
                                                        <tr>
                                                            <td><?php echo date('d/m/Y', strtotime($osc->dataInicial)); ?></td>
                                                            <td><?php echo date('d/m/Y', strtotime($osc->dataFinal)); ?></td>
                                                            <td><?php echo $osc->status_os; ?></td>
                                                            <td><?php echo $osc->descricao_os; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="modal-aprovar-parcela<?php echo $indexContrato; ?>" class="modal hide fade" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true">
                        <?php $url = base_url('index.php/clientes/aprovarParcela/' . $result->idClientes . '/' . $contrato->idContratos . '/' . $etapa_atual[$contrato->idEtapa]); ?>
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
                        <?php $url_excluir_financeiro = base_url('index.php/clientes/excluirFinanceiro/' . $result->idClientes . '/' . $contrato->idContratos . '/' . $etapa_atual[$contrato->idEtapa]); ?>
                        <form action="<?php echo $url_excluir_financeiro; ?>" method="post">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h5 id="myModalLabel">Remover Financeiro</h5>
                            </div>
                            <div class="modal-body">
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

                    <div class="accordion-group widget-box" <?php echo !$contrato->idFinanceiro ? 'style="background-color: #faa6a0;"' : null ?>>
                        <div class="accordion-heading">
                            <div class="widget-title">
                                <a data-parent="#collapse-group" href="#collapseGSix<?php echo $indexContrato; ?>"
                                    data-toggle="collapse">
                                    <span><i class='bx bx-money-withdraw icon-cli'></i></span>
                                    <h5 style="padding-left: 28px">Financeiro</h5>
                                </a>
                            </div>
                        </div>
                        <div class="collapse accordion-body" id="collapseGSix<?php echo $indexContrato; ?>">
                            <?php
                            $financeiro_cliente_loop = "financeiro_cliente_" . $indexContrato;
                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente') && !$$financeiro_cliente_loop) {
                                $parcelas_cliente_loop = null;
                                $url = base_url('index.php/clientes/gerarFinanceiro/' . $result->idClientes . '/' . $contrato->idContratos . '/' . $etapa_atual[$contrato->idEtapa]);
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
                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dCliente') && $$financeiro_cliente_loop) {
                                $parcelas_cliente_loop = "parcelas_cliente_" . $indexContrato;
                                echo '<div class="" style="margin: 0.7rem; gap: 10px; display: flex; flex-direction: row">
                                            <a href="#modalParcelas' . $indexContrato . '" data-toggle="modal" role="button" class="button btn btn-mini btn-success" style="width: 230px">
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

                                        <?php if ($$financeiro_cliente_loop) {
                                            foreach ($$financeiro_cliente_loop as $fns) {

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

                    <div id="modalParcelas<?php echo $indexContrato; ?>" class="modal hide fade" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">Parcelas</h3>
                        </div>
                        <div class="modal-body">

                            <?php if (!$parcelas_cliente_loop) { ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
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
                                            <th>Código</th>
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
                                        <?php foreach ($$parcelas_cliente_loop as $parc) {

                                            $rowClass = $parc->pago == 1 ? 'alert-success' : 'alert-danger';
                                            ?>
                                            <tr class="alert <?php echo $rowClass; ?>">
                                                <td><?php echo $parc->codigo; ?></td>
                                                <td><?php echo $parc->valor; ?></td>
                                                <td>
                                                    <?php
                                                    if (empty($parc->data_pagamento) && $parc->vencimento != '0000-00-00') {
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
                                                        <a class='aprovar-parcela'
                                                            href="#modal-aprovar-parcela<?php echo $indexContrato; ?>" role="button"
                                                            data-toggle="modal" data-dismiss="modal"
                                                            parcela="<?php echo $parc->idParcelas; ?>" style="margin-right: 1%"
                                                            class="btn-nwe" title="Aprovar Parcela">
                                                            <i class="bx bx-check bx-xs"></i>
                                                        </a>
                                                    <?php } ?>
                                                    <?php $url_editar_parcela = (base_url() . 'index.php/clientes/editarParcela/' . $parc->idParcelas . '/' . $result->idClientes); ?>
                                                    <a href="<?php echo $url_editar_parcela ?>" role="button"
                                                        style="margin-right: 1%" class="btn-nwe" title="Editar Parcela">
                                                        <i class="bx bx-edit bx-xs"></i>
                                                    </a>
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
                                <a data-parent="#collapse-group" href="#collapseGSeven<?php echo $indexContrato; ?>"
                                    data-toggle="collapse">
                                    <span><i class='bx bx-note icon-cli'></i></span>
                                    <h5 style="padding-left: 28px">Arquivos Financeiro</h5>
                                </a>
                            </div>
                        </div>
                        <div class="collapse accordion-body" id="collapseGSeven<?php echo $indexContrato; ?>">
                            <div class="new122">
                                <link rel="stylesheet"
                                    href="<?= base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
                                <script type="text/javascript"
                                    src="<?= base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>

                                <div class="span12" style="margin-left: 0">
                                    <form method="get" action="<?= current_url(); ?>">
                                        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aArquivo')): ?>
                                            <div class="span3">
                                                <a href="<?= base_url(); ?>index.php/clientes/adicionarArquivo/<?php echo $result->idClientes . '/financeiro/' . $contrato->idContratos ?>"
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
                                                        <?php if ($contrato->idArquivos != null && in_array($r->idDocumentos, json_decode($contrato->idArquivos, true))) { ?>
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
                                                        <?php } ?>
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
                                <a data-parent="#collapse-group" href="#collapseGEight<?php echo $indexContrato; ?>"
                                    data-toggle="collapse">
                                    <span><i class='bx bx-search icon-cli'></i></span>
                                    <h5 style="padding-left: 28px">Arquivos Evidências</h5>
                                </a>
                            </div>
                        </div>
                        <div class="collapse accordion-body" id="collapseGEight<?php echo $indexContrato; ?>">
                            <div class="new122">
                                <link rel="stylesheet"
                                    href="<?= base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
                                <script type="text/javascript"
                                    src="<?= base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>

                                <div class="span12" style="margin-left: 0">
                                    <form method="get" action="<?= current_url(); ?>">
                                        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aArquivo')): ?>
                                            <div class="span3">
                                                <a href="<?= base_url(); ?>index.php/clientes/adicionarArquivo/<?php echo $result->idClientes . '/evidencias/' . $contrato->idContratos ?>"
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
                                                        <?php if ($contrato->idArquivos != null && in_array($r->idDocumentos, json_decode($contrato->idArquivos, true))) { ?>
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
                                                        <?php } ?>
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
                                <a data-parent="#collapse-group" href="#collapseGNine<?php echo $indexContrato; ?>"
                                    data-toggle="collapse">
                                    <span><i class='bx bx-news icon-cli'></i></span>
                                    <h5 style="padding-left: 28px">Arquivos Contratos</h5>
                                </a>
                            </div>
                        </div>
                        <div class="collapse accordion-body" id="collapseGNine<?php echo $indexContrato; ?>">
                            <div class="new122">
                                <link rel="stylesheet"
                                    href="<?= base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
                                <script type="text/javascript"
                                    src="<?= base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>

                                <div class="span12" style="margin-left: 0">
                                    <form method="get" action="<?= current_url(); ?>">
                                        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aArquivo')): ?>
                                            <div class="span3">
                                                <a href="<?= base_url(); ?>index.php/clientes/adicionarArquivo/<?php echo $result->idClientes . '/contratos/' . $contrato->idContratos ?>"
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
                                                        <?php if ($contrato->idArquivos != null && in_array($r->idDocumentos, json_decode($contrato->idArquivos, true))) { ?>
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
                                                        <?php } ?>
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
            <?php $indexContrato++;
        } ?>


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