<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/table-custom.css" />
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script src="<?php echo base_url() ?>assets/js/sweetalert2.all.min.js"></script>
<style>

  select {
    width: 70px;
  }

  .topActions {
        display: flex !important;
        flex-direction: row !important;
        justify-content: space-between;
    }

</style>
<div class="new122">
    <div class="widget-title" style="margin: -20px 0 0">
            <span class="icon">
                <i class="fas fa-diagnoses"></i>
            </span>
            <h5>O.S</h5>
        </div>
    <div class="span12" style="margin-left: 0">
        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aOs')) { ?>
        <div class="topActions">
            <div class="span3">
                <a href="<?php echo base_url(); ?>index.php/os/adicionar" class="button btn btn-mini btn-success" style="max-width: 160px">
                    <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">Adicinar O.S</span></a>
            </div>
        <?php
        } ?>

            <form method="get" action="<?= base_url() ?>index.php/os" style="display: flex; justify-content: flex-end; gap: 10px;">
                <!--<input type="text" name="pesquisa" id="pesquisa" placeholder="Buscar por Nome, Doc, Email ou Telefone..." class="form-control" value="<?= $this->input->get('pesquisa') ?>">-->
                <select name="status" id="status" style="width: 100%;">
                    <option value="">Todos os Status</option>
                    <option value="Pendência Cliente" <?= $this->input->get('status_os') == 'Pendência Cliente' ? 'selected' : '' ?>>Pendência Cliente</option>
                    <option value="Pendência Provedor" <?= $this->input->get('status_os') == 'Pendência Provedor' ? 'selected' : '' ?>>Pendência Provedor</option>
                    <option value="Inviabilidade Técnica" <?= $this->input->get('status_os') == 'Inviabilidade Técnica' ? 'selected' : '' ?>>Inviabilidade Técnica</option>
                    <option value="Escola Não Autorizou" <?= $this->input->get('status_os') == 'Escola Não Autorizou' ? 'selected' : '' ?>>Escola Não Autorizou</option>
                    <option value="Instalação Em Andamento" <?= $this->input->get('status_os') == 'Instalação Em Andamento' ? 'selected' : '' ?>>Instalação Em Andamento</option>
                    <option value="Instalação" <?= $this->input->get('status_os') == 'Instalação' ? 'selected' : '' ?>>Instalação</option>
                    <option value="Instalado" <?= $this->input->get('status_os') == 'Instalado' ? 'selected' : '' ?>>Instalado</option>
                </select>
                <input type="text" name="dataInicial" id="dataInicial" placeholder="Data Inicial (YYYY-MM-DD)" class="form-control" value="<?= $this->input->get('dataInicial') ?>">
                <input type="text" name="dataFinal" id="dataFinal" placeholder="Data Final (YYYY-MM-DD)" class="form-control" value="<?= $this->input->get('dataFinal') ?>">
                <div class="span1">
                    <button class="button btn btn-mini btn-warning" style="min-width: 30px">
                        <span class="button__icon"><i class='bx bx-search-alt'></i></span></button>
                </div>
            </form>

        </div>
    </div>

    <div class="widget-box" style="margin-top: 8px">
        <div class="widget-content nopadding">
            <div class="table-responsive">
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Cliente</th>
                            <th class="ph1">Responsável</th>
                            <th>Data Inicial</th>
                            <th class="ph2">Data Final</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$results) {
                            echo '<tr>
                            <td colspan="10">Sem O.S</td>
                            </tr>';
                        }

                        foreach ($results as $r) {

                            $dataInicial = new DateTime($r->dataInicial);
                            $dataFinal = new DateTime($r->dataFinal);

                            $dataInicialFormatada = $dataInicial->format('d/m/Y');
                            $dataFinalFormatada = $dataFinal->format('d/m/Y');

                            echo '<tr>';
                            echo '<td>' . $r->idOs . '</td>';
                            echo '<td><a href="' . base_url() . 'index.php/os/visualizar/' . $r->idOs . '" style="margin-right: 1%">' . $r->nomeCliente . '</a></td>';
                            echo '<td>' . $r->nome . '</td>';
                            echo '<td>' . $dataInicialFormatada  . '</td>';
                            echo '<td>' . $dataFinalFormatada  . '</td>';
                            echo '<td>' . $r->status_os  . '</td>';

                            echo '<td>';
                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')) {
                                echo '<a href="' . base_url() . 'index.php/os/visualizar/' . $r->idOs . '" style="margin-right: 1%" class="btn-nwe" title="Ver mais detalhes"><i class="bx bx-show bx-xs"></i></a>';
                            }
                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eOs')) {
                                echo '<a href="' . base_url() . 'index.php/os/editar/' . $r->idOs . '" style="margin-right: 1%" class="btn-nwe3" title="Editar O.S"><i class="bx bx-edit bx-xs"></i></a>';
                            }
                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dOs')) {
                                echo '<a href="#modal-excluir" role="button" data-toggle="modal" os="' . $r->idOs . '" style="margin-right: 1%" class="btn-nwe4" title="Excluir O.S"><i class="bx bx-trash-alt bx-xs"></i></a>';
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
    <div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action="<?php echo base_url() ?>index.php/os/excluir" method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 id="myModalLabel">Excluir OS</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idOs" name="id" value="" />
                <h5 style="text-align: center">Deseja realmente excluir esta O.S?</h5>
            </div>
            <div class="modal-footer" style="display:flex;justify-content: center">
                <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true">
                    <span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
                <button class="button btn btn-danger"><span class="button__icon"><i class='bx bx-trash'></i></span> <span class="button__text2">Excluir</span></button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
    $("#dataInicial, #dataFinal").datepicker({
        dateFormat: 'yy-mm-dd'
    });
});

    $(document).ready(function() {
        $(document).on('click', 'a', function(event) {
            var os = $(this).attr('os');
            $('#idOs').val(os);
        });
        $(document).on('click', '#excluir-notificacao', function(event) {
            event.preventDefault();
            $.ajax({
                    url: '<?php echo site_url() ?>/os/excluir_notificacao',
                    type: 'GET',
                    dataType: 'json',
                })
                .done(function(data) {
                    if (data.result == true) {
                        Swal.fire({
                            type: "success",
                            title: "Sucesso",
                            text: "Notificação excluída com sucesso."
                        });
                        location.reload();
                    } else {
                        Swal.fire({
                            type: "success",
                            title: "Sucesso",
                            text: "Ocorreu um problema ao tentar exlcuir notificação."
                        });
                    }
                });
        });
        $(".datepicker").datepicker({
            dateFormat: 'dd/mm/yy'
        });
    });
    
</script>
