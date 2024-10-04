<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>js/dist/excanvas.min.js"></script><![endif]-->

<script language="javascript" type="text/javascript"
    src="<?= base_url(); ?>assets/js/dist/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/dist/plugins/jqplot.pieRenderer.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/dist/plugins/jqplot.donutRenderer.min.js"></script>
<script src='<?= base_url(); ?>assets/js/fullcalendar.min.js'></script>
<script src='<?= base_url(); ?>assets/js/fullcalendar/locales/pt-br.js'></script>

<link href='<?= base_url(); ?>assets/css/fullcalendar.min.css' rel='stylesheet' />
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/js/dist/jquery.jqplot.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css" />

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700&display=swap" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>

<div id="content-bemv">
    <div class="bemv">Dashboard</div>
    <div></div>
</div>

<!--Action boxes-->
<ul class="cardBox">

    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')): ?>
        <li class="card">
            <div class="grid-blak">
                <a href="<?= site_url('fornecedores') ?>">
                    <div class="numbers">Fornecedores</div>
                    <div class="cardName">F1</div>
                </a>
            </div>
            <a href="<?= site_url('fornecedores') ?>">
                <div class="lord-icon02">
                    <i class='bx bx-car iconBx02'></i>
                </div>
            </a>
        </li>
    <?php endif ?>

    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')): ?>
        <li class="card">
            <div class="grid-blak">
                <a href="<?= site_url('clientes') ?>">
                    <div class="numbers">Clientes</div>
                    <div class="cardName">F2</div>
                </a>
            </div>
            <a href="<?= site_url('clientes') ?>">
                <div class="lord-icon02">
                    <i class='bx bx-home iconBx02'></i>
                </div>
            </a>
        </li>
    <?php endif ?>

    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')): ?>
        <li class="card">
            <div class="grid-blak">
                <a href="<?= site_url('os') ?>">
                    <div class="numbers N-tittle">Ordens</div>
                    <div class="cardName">F3</div>
                </a>
            </div>
            <a href="<?= site_url('os') ?>">
                <div class="lord-icon04">
                    <i class='bx bx-file iconBx04'></i>
                </div>
            </a>
        </li>
    <?php endif ?>

    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')): ?>
        <li class="card">
            <div class="grid-blak">
                <a href="<?= site_url('statususuarios') ?>">
                    <div class="numbers N-tittle">Status Usuários</div>
                    <div class="cardName">F4</div>
                </a>
            </div>
            <a href="<?= site_url('statususuarios') ?>">
                <div class="lord-icon04">
                    <i class='bx bx-user iconBx04'></i>
                </div>
            </a>
        </li>
    <?php endif ?>
</ul>
<!--End-Action boxes-->

<div class="row-fluid" style="margin-top: 0; display: flex">
    <div class="Sspan12">

        <div class="widget-box2">
            <div>
                <h5 class="cardHeader">Agenda</h5>
            </div>
            <div class="widget-content">
                <table>
                    <div id='source-calendar'>
                        <form method="post">
                            <select style="padding-left: 30px" class="span12" name="statusOsGet" id="statusOsGet"
                                value="">
                                <option value="">Todos os Status</option>
                                <option value="Pendência Cliente">Pendência Cliente</option>
                                <option value="Inviabilidade Técnica">Inviabilidade Técnica</option>
                                <option value="Escola Não Autorizou">Escola Não Autorizou</option>
                                <option value="Instalação">Instalação</option>
                            </select>
                            <button type="button" class="btn-xs" id="btn-calendar"><i
                                    class="bx bx-search iconX2"></i></button>
                        </form>
                    </div>
                </table>
            </div>
        </div>

        <!-- New widget right -->
        <div class="new-statisc">
            <div class="widget-box-new widbox-blak" style="height:100%">
                <div>
                    <h5 class="cardHeader">Estatísticas do Sistema</h5>
                </div>

                <div class="new-bottons">

                    <a href="<?php echo base_url(); ?>index.php/fornecedores/adicionar" class="card tip-top"
                        title="Adicionar Fornecedores">
                        <div><i class='bx bxs-car iconBx'></i></div>
                        <div>
                            <div class="cardName2"><?= $this->db->count_all('fornecedores'); ?></div>
                            <div class="cardName">Adicionar Fornecedor</div>
                        </div>
                    </a>

                    <a href="<?php echo base_url(); ?>index.php/clientes/adicionar" class="card tip-top"
                        title="Adicionar Clientes">
                        <div><i class='bx bxs-group iconBx2'></i></div>
                        <div>
                            <div class="cardName2"><?= $this->db->count_all('clientes'); ?></div>
                            <div class="cardName">Adicionar Cliente</div>
                        </div>
                    </a>

                    <a href="<?php echo base_url(); ?>index.php/os/adicionar" class="card tip-top"
                        title="Adicionar O.S">
                        <div><i class='bx bxs-file iconBx3'></i></div>
                        <div>
                            <div class="cardName2"><?= $this->db->count_all('os'); ?></div>
                            <div class="cardName">Adicionar O.S</div>
                        </div>
                    </a>

                </div>

                <?php if ($this->session->userdata('nome_admin') == 'Admin') { ?>

                </div>
                <h4>teste</h4>
                <div>

                <?php } ?>

            </div>

        </div>
    </div>
</div>

<?php if ($this->db->count_all('clientes') > 0) {
    if (true) { ?>

        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'rFinanceiro')): ?>
            <div class="new-balance">
                <div class="widget-box0">
                    <div class="widget-title2" style="margin-bottom:50px">
                        <h5 class="cardHeader">Clientes por Status</h5>
                    </div>
                    <div class="widget-content" style="padding:10px 25px 5px 25px">
                        <div class="row-fluid" style="margin-top:-35px;">
                            <div class="span12">
                                <!-- Ajuste a altura do canvas aqui -->
                                <canvas id="myChart" width="1532" height="400"
                                    style="overflow-x: scroll;margin-left: -14px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif ?>

        <script type="text/javascript">

            if (window.outerWidth > 2000) {
                Chart.defaults.font.size = 15;
            } else if (window.outerWidth < 2000 && window.outerWidth > 1367) {
                Chart.defaults.font.size = 11;
            } else if (window.outerWidth < 1367 && window.outerWidth > 480) {
                Chart.defaults.font.size = 9.5;
            } else if (window.outerWidth < 480) {
                Chart.defaults.font.size = 8.5;
            }

            var ctx = document.getElementById('myChart').getContext('2d');

            var clientesCount = <?php echo $this->data['clientesCount']; ?>;

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(clientesCount),
                    datasets: [{
                        label: 'Número de Clientes',
                        data: Object.values(clientesCount),
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.5)', // INSTALADO
                            'rgba(255, 99, 132, 0.5)', // NÃO INSTALADO
                            'rgba(255, 206, 86, 0.5)', // FECHADO
                            'rgba(54, 162, 235, 0.5)', // COTADO
                            'rgba(153, 102, 255, 0.5)', // EM ANÁLISE
                            'rgba(255, 159, 64, 0.5)', // AGUARDANDO COTAÇÃO
                            'rgba(75, 192, 192, 0.5)', // SEM RETORNO
                            'rgba(255, 205, 86, 0.5)', // EM NEGOCIAÇÃO
                            'rgba(54, 162, 235, 0.5)', // VIABILIZADO
                            'rgba(153, 102, 255, 0.5)', // AGUARDANDO INSTALAÇÃO
                            'rgba(255, 159, 64, 0.5)', // AGUARDANDO CONTRATAÇÃO
                            'rgba(255, 99, 132, 0.5)', // CANCELADO
                            'rgba(255, 206, 86, 0.5)', // RADIO
                            'rgba(75, 192, 192, 0.5)', // VALOR ALTO
                            'rgba(54, 162, 235, 0.5)'  // COTANDO
                        ],
                        borderRadius: 15,
                    }]
                },
                options: {
                    locale: 'pt-BR',
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Número de Clientes'
                            },
                            ticks: {
                                callback: (value) => {
                                    return value;
                                }
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Status'
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                beforeTitle: function (context) {
                                    return 'Clientes:';
                                }
                            }
                        },
                        legend: {
                            position: "bottom",
                            labels: {
                                usePointStyle: true,
                            }
                        }
                    }
                }
            });

            function responsiveFonts() {
                myChart.update();
            }
        </script>



    <?php }
} ?>

<?php if ($this->db->count_all('clientes') > 0) {
    if (true) { ?>

        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'rFinanceiro')): ?>
            <div class="new-balance">
                <div class="widget-box0">
                    <div class="widget-title2" style="margin-bottom:50px">
                        <h5 class="cardHeader">Status por Usuário</h5>
                    </div>
                    <div class="widget-content" style="padding:10px 25px 5px 25px">
                        <div class="row-fluid" style="margin-top:-35px;">
                            <div class="span12">
                                <!-- Ajuste a altura do canvas aqui -->
                                <canvas id="myChartUsers" width="1532" height="400"
                                    style="overflow-x: scroll;margin-left: -14px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif ?>

        <script type="text/javascript">
            var ctx = document.getElementById('myChartUsers').getContext('2d');

            var usersData = <?php echo $this->data['usersData']; ?>;

            var userNames = Object.keys(usersData);
            var cotacoes = userNames.map(function (name) { return usersData[name]['cotacoes']; });
            var contratos = userNames.map(function (name) { return usersData[name]['contratos']; });

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: userNames,
                    datasets: [{
                        label: 'Cotações',
                        data: cotacoes,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderRadius: 15,
                    },
                    {
                        label: 'Contratos',
                        data: contratos,
                        backgroundColor: 'rgba(153, 102, 255, 0.6)',
                        borderRadius: 15,
                    }]
                },
                options: {
                    locale: 'pt-BR',
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Quantidade'
                            },
                            ticks: {
                                callback: (value) => {
                                    return value;
                                }
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Usuários'
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                beforeTitle: function (context) {
                                    return 'Usuário:';
                                }
                            }
                        },
                        legend: {
                            position: "bottom",
                            labels: {
                                usePointStyle: true,
                            }
                        }
                    }
                }
            });
        </script>




    <?php }
} ?>

<!-- Start Staus OS -->
<div class="span12A" style="margin-left: 0">
    <div class="widget-box0 widbox-blak">
        <div>
            <h5 class="cardHeader">Ordens de Serviços Em Pendência Cliente</h5>
        </div>
        <div class="widget-content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Cliente</th>
                        <th>Data Final</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($ordens_pendencia_cliente != null): ?>
                        <?php foreach ($ordens_pendencia_cliente as $o): ?>
                            <?php
                            $cor = '#00cd00';
                            ?>
                            <tr>
                                <td>
                                    <?= $o->idOs ?>
                                </td>

                                <td class="cli1">
                                    <?= $o->nomeCliente ?>
                                </td>

                                <td><?php if ($o->dataFinal != null) {
                                    echo date('d/m/Y', strtotime($o->dataFinal));
                                } else {
                                    echo "";
                                } ?></td>

                                <td>
                                    <span class="badge"
                                        style="background-color: <?= $cor ?>; border-color: <?= $cor ?>;"><?= $o->status_os ?></span>
                                </td>

                                <td>
                                    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')): ?>
                                        <a href="<?= base_url() ?>index.php/os/visualizar/<?= $o->idOs ?>" class="btn-nwe tip-top"
                                            title="Visualizar">
                                            <i class="bx bx-show"></i> </a>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Nenhuma OS em Pendência Cliente.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="widget-box0 widbox-blak">
        <div>
            <h5 class="cardHeader">Ordens de Serviços Em Pendência Provedor</h5>
        </div>
        <div class="widget-content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Cliente</th>
                        <th>Data Final</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($ordens_pendencia_provedor != null): ?>
                        <?php foreach ($ordens_pendencia_provedor as $o): ?>
                            <?php
                            $cor = '#00cd00';
                            ?>
                            <tr>
                                <td>
                                    <?= $o->idOs ?>
                                </td>

                                <td class="cli1">
                                    <?= $o->nomeCliente ?>
                                </td>

                                <td><?php if ($o->dataFinal != null) {
                                    echo date('d/m/Y', strtotime($o->dataFinal));
                                } else {
                                    echo "";
                                } ?></td>

                                <td>
                                    <span class="badge"
                                        style="background-color: <?= $cor ?>; border-color: <?= $cor ?>;"><?= $o->status_os ?></span>
                                </td>

                                <td>
                                    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')): ?>
                                        <a href="<?= base_url() ?>index.php/os/visualizar/<?= $o->idOs ?>" class="btn-nwe tip-top"
                                            title="Visualizar">
                                            <i class="bx bx-show"></i> </a>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Nenhuma OS em Pendência Cliente.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="widget-box0 widbox-blak">
        <div>
            <h5 class="cardHeader">Ordens de Serviços Em Inviabilidade Técnica</h5>
        </div>
        <div class="widget-content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Cliente</th>
                        <th>Data Final</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($ordens_inviabilidade_tecnica != null): ?>
                        <?php foreach ($ordens_inviabilidade_tecnica as $o): ?>
                            <?php
                            $cor = '#AEB404';
                            ?>
                            <tr>
                                <td>
                                    <?= $o->idOs ?>
                                </td>

                                <td class="cli1">
                                    <?= $o->nomeCliente ?>
                                </td>

                                <td><?php if ($o->dataFinal != null) {
                                    echo date('d/m/Y', strtotime($o->dataFinal));
                                } else {
                                    echo "";
                                } ?></td>

                                <td>
                                    <span class="badge"
                                        style="background-color: <?= $cor ?>; border-color: <?= $cor ?>;"><?= $o->status_os ?></span>
                                </td>

                                <td>
                                    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')): ?>
                                        <a href="<?= base_url() ?>index.php/os/visualizar/<?= $o->idOs ?>" class="btn-nwe tip-top"
                                            title="Visualizar">
                                            <i class="bx bx-show"></i> </a>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Nenhuma OS em inviabilidade técnica.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="widget-box0 widbox-blak">
        <div>
            <h5 class="cardHeader">Ordens de Serviços em que a Escola Não Autorizou</h5>
        </div>
        <div class="widget-content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Cliente</th>
                        <th>Data Final</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($ordens_escola_nao_autorizou != null): ?>
                        <?php foreach ($ordens_escola_nao_autorizou as $o): ?>
                            <?php
                            $cor = '#436eee';
                            ?>
                            <tr>
                                <td>
                                    <?= $o->idOs ?>
                                </td>

                                <td class="cli1">
                                    <?= $o->nomeCliente ?>
                                </td>

                                <td><?php if ($o->dataFinal != null) {
                                    echo date('d/m/Y', strtotime($o->dataFinal));
                                } else {
                                    echo "";
                                } ?></td>

                                <td>
                                    <span class="badge"
                                        style="background-color: <?= $cor ?>; border-color: <?= $cor ?>;"><?= $o->status_os ?></span>
                                </td>

                                <td>
                                    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')): ?>
                                        <a href="<?= base_url() ?>index.php/os/visualizar/<?= $o->idOs ?>" class="btn-nwe tip-top"
                                            title="Visualizar">
                                            <i class="bx bx-show"></i> </a>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Nenhuma OS em que a Escola Não Autorizou.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="widget-box0 widbox-blak">
        <div>
            <h5 class="cardHeader">Ordens de Serviços Em Instalação Em Andamento</h5>
        </div>
        <div class="widget-content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Cliente</th>
                        <th>Data Final</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($ordens_instalacao_em_andamento != null): ?>
                        <?php foreach ($ordens_instalacao_em_andamento as $o): ?>
                            <?php
                            $cor = '#436eee';
                            ?>
                            <tr>
                                <td>
                                    <?= $o->idOs ?>
                                </td>

                                <td class="cli1">
                                    <?= $o->nomeCliente ?>
                                </td>

                                <td><?php if ($o->dataFinal != null) {
                                    echo date('d/m/Y', strtotime($o->dataFinal));
                                } else {
                                    echo "";
                                } ?></td>

                                <td>
                                    <span class="badge"
                                        style="background-color: <?= $cor ?>; border-color: <?= $cor ?>;"><?= $o->status_os ?></span>
                                </td>

                                <td>
                                    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')): ?>
                                        <a href="<?= base_url() ?>index.php/os/visualizar/<?= $o->idOs ?>" class="btn-nwe tip-top"
                                            title="Visualizar">
                                            <i class="bx bx-show"></i> </a>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Nenhuma OS em Instalação Em Andamento.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="widget-box0 widbox-blak">
        <div>
            <h5 class="cardHeader">Ordens de Serviços Em Instalação</h5>
        </div>
        <div class="widget-content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Cliente</th>
                        <th>Data Final</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($ordens_instalacao != null): ?>
                        <?php foreach ($ordens_instalacao as $o): ?>
                            <?php
                            $cor = '#436eee';
                            ?>
                            <tr>
                                <td>
                                    <?= $o->idOs ?>
                                </td>

                                <td class="cli1">
                                    <?= $o->nomeCliente ?>
                                </td>

                                <td><?php if ($o->dataFinal != null) {
                                    echo date('d/m/Y', strtotime($o->dataFinal));
                                } else {
                                    echo "";
                                } ?></td>

                                <td>
                                    <span class="badge"
                                        style="background-color: <?= $cor ?>; border-color: <?= $cor ?>;"><?= $o->status_os ?></span>
                                </td>

                                <td>
                                    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')): ?>
                                        <a href="<?= base_url() ?>index.php/os/visualizar/<?= $o->idOs ?>" class="btn-nwe tip-top"
                                            title="Visualizar">
                                            <i class="bx bx-show"></i> </a>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Nenhuma OS em que a Escola Não Autorizou.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- Fim Staus OS -->

<!-- Modal Status OS Calendar -->
<div id="calendarModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Status OS Detalhada</h3>
    </div>
    <div class="modal-body">
        <div class="span5" id="divFormStatusOS" style="margin-left: 0"></div>
        <h4><b>OS:</b> <span id="modalId" class="modal-id"></span></h4>
        <h5 id="modalCliente" class="modal-cliente"></h5>
        <div id="modalDataInicial" class="modal-DataInicial"></div>
        <div id="modalDataFinal" class="modal-DataFinal"></div>
        <div id="modalStatus" class="modal-Status"></div>
        <div id="modalDescription" class="modal-Description"></div>
    </div>
    <?php
    if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')) {
        echo '<a id="modalIdVisualizar" style="margin-right: 1%" href="" class="btn tip-top" title="Ver mais detalhes"><i class="fas fa-eye"></i></a>';
    }
    if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eOs')) {
        echo '<a id="modalIdEditar" style="margin-right: 1%" href="" class="btn btn-info tip-top" title="Editar OS"><i class="fas fa-edit"></i></a>';
    }
    if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dOs')) {
        echo '<a id="linkExcluir" href="#modal-excluir-os" role="button" data-toggle="modal" os="" class="btn btn-danger tip-top" title="Excluir OS"><i class="fas fa-trash-alt"></i></a>  ';
    }
    ?>
</div>
</div>

<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<!-- Modal Estoque-->
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', 'a', function (event) {
            var produto = $(this).attr('produto');
            var estoque = $(this).attr('estoque');
            $('.idProduto').val(produto);
            $('#estoqueAtual').val(estoque);
        });

        $('#formEstoque').validate({
            rules: {
                estoque: {
                    required: true,
                    number: true
                }
            },
            messages: {
                estoque: {
                    required: 'Campo Requerido.',
                    number: 'Informe um número válido.'
                }
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });

        var srcCalendarEl = document.getElementById('source-calendar');
        var srcCalendar = new FullCalendar.Calendar(srcCalendarEl, {
            locale: 'pt-br',
            height: 700,
            editable: false,
            selectable: false,
            businessHours: true,
            dayMaxEvents: true, // allow "more" link when too many events
            displayEventTime: false,
            events: {
                url: "<?= base_url() . "index.php/mapos/calendario"; ?>",
                method: 'GET',
                extraParams: function () { // a function that returns an object
                    return {
                        status_os: $("#statusOsGet").val(),
                    };
                },
                failure: function () {
                    alert('Falha ao buscar OS de calendário!', $("#statusOsGet").val());
                },
            },
            eventClick: function (info) {
                var eventObj = info.event.extendedProps;
                $('#modalId').html(eventObj.id);
                $('#modalIdVisualizar').attr("href", "<?php echo base_url(); ?>index.php/os/visualizar/" + eventObj.id);
                if (eventObj.editar) {
                    $('#modalIdEditar').show();
                    $('#linkExcluir').show();
                    $('#modalIdEditar').attr("href", "<?php echo base_url(); ?>index.php/os/editar/" + eventObj.id);
                    $('#modalIdExcluir').val(eventObj.id);
                } else {
                    $('#modalIdEditar').hide();
                    $('#linkExcluir').hide();
                }
                $('#modalCliente').html(eventObj.cliente);
                $('#modalDataInicial').html(eventObj.dataInicial);
                $('#modalDataFinal').html(eventObj.dataFinal);
                $('#modalGarantia').html(eventObj.garantia);
                $('#modalStatus').html(eventObj.status);
                $('#modalDescription').html(eventObj.description);
                $('#modalDefeito').html(eventObj.defeito);
                $('#modalObservacoes').html(eventObj.observacoes);
                $('#modalTotal').html(eventObj.total);
                $('#modalDesconto').html(eventObj.desconto);
                $('#modalValorFaturado').html(eventObj.valorFaturado);

                $('#eventUrl').attr('href', event.url);
                $('#calendarModal').modal();
            },
        });

        srcCalendar.render();

        $('#btn-calendar').on('click', function () {
            srcCalendar.refetchEvents();
        });
    });
</script>