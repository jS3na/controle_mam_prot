<style>
    select {
        width: 70px;
    }

    .topActions {
        display: flex !important;
        flex-direction: row !important;
        justify-content: space-between;
    }

    .button {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .button.alinhar_texto {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    #pesquisa {
        width: 50vh !important
    }
</style>
<div class="new122">
    <div class="widget-title" style="margin: -20px 0 0">
        <span class="icon">
            <i class="fas fa-user"></i>
        </span>
        <h5>Clientes</h5>
    </div>
    <div class="span12" style="margin-left: 0">
        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aCliente') && $this->session->userdata('nome_admin') == 'Admin') { ?>
            <div class="topActions">
                <a href="<?= base_url() ?>index.php/clientes/adicionar" class="button btn btn-mini btn-success">
                    <span class="button__icon"><i class='bx bx-plus-circle'></i></span>
                    <span class="button__text2 alinhar_texto">Adicionar Cliente</span>
                </a>

                <?php /* if($this->session->userdata('nome_admin') == 'Admin') { ?>
               
                   <a href="./../../../assets/file_templates/importar_cliente.csv" download="importar_cliente.csv" class="button btn btn-primary alinhar_texto">
                       Baixar Template CSV
                   </a>
                   <div class="container">
                       <form action="<?= base_url('index.php/clientes/importar') ?>" method="post" enctype="multipart/form-data">
                           <div class="form-group">
                               <label for="arquivo">Importar Arquivo CSV:</label>
                               <input type="file" class="form-control" name="arquivo" id="arquivo" accept=".csv" required>
                           </div>
                           <button type="submit" class="btn btn-primary">Importar</button>
                       </form>
                   </div>

               <?php } */ ?>

            <?php } ?>
            <form method="get" action="<?= base_url() ?>index.php/clientes"
                style="display: flex; justify-content: flex-end; gap: 10px;">
                <input type="text" name="pesquisa" id="pesquisa" placeholder="Buscar por Nome, Doc ou Cidade..."
                    class="form-control" value="<?= $this->input->get('pesquisa') ?>">
                <select name="status" id="status" style="width: 100%;">
                    <option value="">Todos os Status</option>
                    <option value="INSTALADO" <?= $this->input->get('status') == 'INSTALADO' ? 'selected' : '' ?>>INSTALADO
                    </option>
                    <option value="NÃO INSTALADO" <?= $this->input->get('status') == 'NÃO INSTALADO' ? 'selected' : '' ?>>
                        NÃO INSTALADO</option>
                    <option value="FECHADO" <?= $this->input->get('status') == 'FECHADO' ? 'selected' : '' ?>>FECHADO
                    </option>
                    <option value="COTADO" <?= $this->input->get('status') == 'COTADO' ? 'selected' : '' ?>>COTADO</option>
                    <option value="EM ANÁLISE" <?= $this->input->get('status') == 'EM ANÁLISE' ? 'selected' : '' ?>>EM
                        ANÁLISE</option>
                    <option value="AGUARDANDO COTAÇÃO" <?= $this->input->get('status') == 'AGUARDANDO COTAÇÃO' ? 'selected' : '' ?>>AGUARDANDO COTAÇÃO</option>
                    <option value="SEM RETORNO" <?= $this->input->get('status') == 'SEM RETORNO' ? 'selected' : '' ?>>SEM
                        RETORNO</option>
                    <option value="EM NEGOCIAÇÃO" <?= $this->input->get('status') == 'EM NEGOCIAÇÃO' ? 'selected' : '' ?>>
                        EM NEGOCIAÇÃO</option>
                    <option value="VIABILIZADO" <?= $this->input->get('status') == 'VIABILIZADO' ? 'selected' : '' ?>>
                        VIABILIZADO</option>
                    <option value="SEM VIABILIDADE" <?= $this->input->get('status') == 'SEM VIABILIDADE' ? 'selected' : '' ?>>SEM VIABILIDADE</option>
                    <option value="AGUARDANDO INSTALAÇÃO" <?= $this->input->get('status') == 'AGUARDANDO INSTALAÇÃO' ? 'selected' : '' ?>>AGUARDANDO INSTALAÇÃO</option>
                    <option value="AGUARDANDO CONTRATAÇÃO" <?= $this->input->get('status') == 'AGUARDANDO CONTRATAÇÃO' ? 'selected' : '' ?>>AGUARDANDO CONTRATAÇÃO</option>
                    <option value="AGUARDANDO ASSINATURA" <?= $this->input->get('status') == 'AGUARDANDO ASSINATURA' ? 'selected' : '' ?>>AGUARDANDO ASSINATURA</option>
                    <option value="PENDENCIA CLIENTE" <?= $this->input->get('status') == 'PENDENCIA CLIENTE' ? 'selected' : '' ?>>PENDENCIA CLIENTE</option>
                    <option value="PENDENCIA PROVEDOR" <?= $this->input->get('status') == 'PENDENCIA PROVEDOR' ? 'selected' : '' ?>>PENDENCIA PROVEDOR</option>
                    <option value="CANCELADO" <?= $this->input->get('status') == 'CANCELADO' ? 'selected' : '' ?>>CANCELADO
                    </option>
                    <option value="RADIO" <?= $this->input->get('status') == 'RADIO' ? 'selected' : '' ?>>RADIO</option>
                    <option value="VALOR ALTO" <?= $this->input->get('status') == 'VALOR ALTO' ? 'selected' : '' ?>>VALOR
                        ALTO</option>
                    <option value="COTANDO" <?= $this->input->get('status') == 'COTANDO' ? 'selected' : '' ?>>COTANDO
                    </option>
                </select>
                <div class="span1">
                    <button class="button btn btn-mini btn-warning" style="min-width: 30px">
                        <span class="button__icon"><i class='bx bx-search-alt'></i></span></button>
                </div>
            </form>
        </div>

        <div class="widget-box">
            <h5 style="padding: 3px 0"></h5>
            <div class="widget-content nopadding tab-content">
                <table id="tabela" class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>Cod.</th>
                            <th>Cliente</th>
                            <th>CNPJ</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Cidade</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!$results) {
                            echo '<tr>
                    <td colspan="9">Nenhum Cliente Cadastrado</td>
                  </tr>';
                        }
                        foreach ($results as $r) {
                            echo '<tr>';
                            echo '<td>' . $r->idClientes . '</td>';
                            echo '<td><a href="' . base_url() . 'index.php/clientes/visualizar/' . $r->idClientes . '" style="margin-right: 1%">' . $r->nomeCliente . '</a></td>';
                            echo '<td>' . $r->documento . '</td>';
                            echo '<td>' . $r->telefone . '</td>';
                            echo '<td>' . $r->email . '</td>';
                            echo '<td>' . $r->cidade . '</td>';
                            echo '<td>' . $r->status . '</td>';

                            echo '<td>';

                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')) {
                                echo '<a href="' . base_url() . 'index.php/clientes/visualizar/' . $r->idClientes . '" style="margin-right: 1%" class="btn-nwe" title="Ver mais detalhes"><i class="bx bx-show bx-xs"></i></a>';
                                //echo '<a href="' . base_url() . 'index.php/mine?e=' . $r->email . '" target="new" style="margin-right: 1%" class="btn-nwe2" title="Área do cliente"><i class="bx bx-key bx-xs"></i></a>';
                            }
                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
                                echo '<a href="' . base_url() . 'index.php/clientes/editar/' . $r->idClientes . '" style="margin-right: 1%" class="btn-nwe3" title="Editar Cliente"><i class="bx bx-edit bx-xs"></i></a>';
                            }
                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dCliente')) {
                                echo '<a href="#modal-excluir" role="button" data-toggle="modal" cliente="' . $r->idClientes . '" style="margin-right: 1%" class="btn-nwe4" title="Excluir Cliente"><i class="bx bx-trash-alt bx-xs"></i></a>';
                            }
                            echo '</td>';
                            echo '</tr>';
                        } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <?php echo $this->pagination->create_links(); ?>

    <!-- Modal -->
    <div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <form action="<?php echo base_url() ?>index.php/clientes/excluir" method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 id="myModalLabel">Excluir Cliente</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idCliente" name="id" value="" />
                <h5 style="text-align: center">Deseja realmente excluir este cliente e os dados associados a ele (OS,
                    Fornecedores)?</h5>
            </div>
            <div class="modal-footer" style="display:flex;justify-content: center">
                <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true"><span
                        class="button__icon"><i class="bx bx-x"></i></span><span
                        class="button__text2">Cancelar</span></button>
                <button class="button btn btn-danger"><span class="button__icon"><i class='bx bx-trash'></i></span>
                    <span class="button__text2">Excluir</span></button>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', 'a', function (event) {
                var cliente = $(this).attr('cliente');
                $('#idCliente').val(cliente);
            });
        });
    </script>