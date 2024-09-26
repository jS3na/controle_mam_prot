<style>
    select {
        width: 70px;
    }
</style>
<div class="new122">
    <div class="widget-title" style="margin: -20px 0 0">
        <span class="icon">
            <i class="fas fa-user"></i>
        </span>
        <h5>Status dos Usuários</h5>
    </div>
    <div class="span12" style="margin-left: 0">
        <form class="span9" method="get" action="<?= base_url() ?>index.php/status_usuarios"
            style="display: flex; justify-content: flex-end;">
            <div class="span3">
                <input type="text" name="pesquisa" id="pesquisa"
                    placeholder="Buscar por Nome, Cpf ou Email..." class="span12"
                    value="<?= $this->input->get('pesquisa') ?>">
            </div>
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
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Contratos</th>
                        <th>Cotações</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!$results) {
                        echo '<tr>
                    <td colspan="9">Nenhum Usuário Cadastrado</td>
                  </tr>';
                    }
                    foreach ($results as $r) {
                        echo '<tr>';
                        echo '<td>' . $r->idUsuarios . '</td>';
                        echo '<td>' . $r->nome . '</td>';
                        echo '<td>' . $r->email . '</td>';
                        echo '<td>' . $r->contratos . '</td>';
                        echo '<td>' . $r->cotacoes . '</td>';

                        echo '<td>';
                        /*
                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vFornecedor')) {
                            echo '<a href="' . base_url() . 'index.php/fornecedores/visualizar/' . $r->idFornecedores . '" style="margin-right: 1%" class="btn-nwe" title="Ver mais detalhes"><i class="bx bx-show bx-xs"></i></a>';
                            //echo '<a href="' . base_url() . 'index.php/mine?e=' . $r->email . '" target="new" style="margin-right: 1%" class="btn-nwe2" title="Área do Fornecedor"><i class="bx bx-key bx-xs"></i></a>';
                        }
                        */
                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eFornecedor')) {
                            echo '<a href="' . base_url() . 'index.php/statususuarios/editar/' . $r->idUsuarios . '" style="margin-right: 1%" class="btn-nwe3" title="Editar Status do Usuário"><i class="bx bx-edit bx-xs"></i></a>';
                        }
                        /*
                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dFornecedor')) {
                            echo '<a href="#modal-excluir" role="button" data-toggle="modal" fornecedor="' . $r->idFornecedores . '" style="margin-right: 1%" class="btn-nwe4" title="Excluir Fornecedor"><i class="bx bx-trash-alt bx-xs"></i></a>';
                        }
                        */
                        echo '</td>';
                        echo '</tr>';
                    } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<?php echo $this->pagination->create_links(); ?>

<script type="text/javascript">
</script>
