<style>
    .menu-bar {
        margin-top: 1rem
    }
</style>

<!--sidebar-menu-->
<nav id="sidebar">
    <div id="newlog">
        <!--<div class="icon2">
            <img src="<?php echo base_url() ?>assets/img/logoprimeiro.png">
        </div>-->
        <div class="title1">
            <?= $configuration['app_theme'] == 'white' || $configuration['app_theme'] == 'whitegreen' ? '<img src="' . base_url() . 'assets/img/logoman2.jpg">' : '<img src="' . base_url() . 'assets/img/logoman2.jpg">'; ?>
        </div>
    </div>
    <a href="#" class="visible-phone">
        <div class="mode">
            <div class="moon-menu">
                <i class='bx bx-chevron-right iconX open-2'></i>
                <i class='bx bx-chevron-left iconX close-2'></i>
            </div>
        </div>
    </a>
    <!-- Start Pesquisar
    <li class="search-box">
        <form style="display: flex" action="<?= site_url('mapos/pesquisar') ?>">
        <button style="background:transparent;border:transparent" type="submit" class="tip-bottom" title="">
                <i class='bx bx-search iconX'></i></button>
                <input style="background:transparent;<?= $configuration['app_theme'] == 'white' ? 'color:#313030;' : 'color:#fff;' ?>border:transparent" type="search" name="termo" placeholder="Pesquise aqui...">
            <span class="title-tooltip">Pesquisar</span>
        </form>
    </li>
    End Pesquisar-->

    <div class="menu-bar">
        <div class="menu">

            <ul class="menu-links" style="position: relative;">
                <li class="<?php if (isset($menuPainel)) {
                    echo 'active';
                }
                ; ?>">
                    <a class="tip-bottom" title="" href="<?= base_url() ?>"><i class='bx bx-home-alt iconX'></i>
                        <span class="title nav-title">Home</span>
                        <span class="title-tooltip">Início</span>
                    </a>
                </li>

                <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')) { ?>
                    <li class="<?php if (isset($menuFornecedores)) {
                        echo 'active';
                    }
                    ; ?>">
                        <a class="tip-bottom" title="" href="<?= site_url('fornecedores') ?>"><i
                                class='bx bx-car iconX'></i>
                            <span class="title">Fornecedores</span>
                            <span class="title-tooltip">Fornecedores</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')) { ?>
                    <li class="<?php if (isset($menuClientes)) {
                        echo 'active';
                    }
                    ; ?>">
                        <a class="tip-bottom" title="" href="<?= site_url('clientes') ?>"><i class='bx bx-home iconX'></i>
                            <span class="title">Clientes</span>
                            <span class="title-tooltip">Clientes</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')) { ?>
                    <li class="<?php if (isset($menuOs)) {
                        echo 'active';
                    }
                    ; ?>">
                        <a class="tip-bottom" title="" href="<?= site_url('os') ?>"><i class='bx bx-file iconX'></i>
                            <span class="title">Ordens</span>
                            <span class="title-tooltip">Ordens</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')) { ?>
                    <li class="<?php if (isset($menuStatusUsuarios)) {
                        echo 'active';
                    }
                    ; ?>">
                        <a class="tip-bottom" title="" href="<?= site_url('statususuarios') ?>"><i
                                class='bx bx-user iconX'></i>
                            <span class="title">Status Usuários</span>
                            <span class="title-tooltip">Status Usuários</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vFornecedor') && $this->session->userdata('nome_admin') == "Admin") { ?>
                    <li class="<?php if (isset($menuFinanceiro)) {
                        echo 'active';
                    }
                    ; ?>">
                        <a class="tip-bottom" title="" href="<?= site_url('financeiro') ?>"><i
                                class='bx bx-receipt iconX'></i>
                            <span class="title">Financeiro</span>
                            <span class="title-tooltip">Financeiro</span>
                        </a>
                    </li>
                <?php } ?>

                
                <!--
                <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vArquivo')) { ?>
                    <li class="<?php if (isset($menuArquivos)) {
                        echo 'active';
                    }
                    ; ?>">
                        <a class="tip-bottom" title="" href="<?= site_url('arquivos') ?>"><i class='bx bx-box iconX'></i>
                            <span class="title">Arquivos</span>
                            <span class="title-tooltip">Arquivos</span>
                        </a>
                    </li>
                <?php } ?>
                -->


                <?php /* if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vLancamento')) { ?>
     <li class="<?php if (isset($menuLancamentos)) {
         echo 'active';
     }; ?>">
         <a class="tip-bottom" title="" href="<?= site_url('financeiro/lancamentos') ?>"><i class="bx bx-bar-chart-alt-2 iconX"></i>
             <span class="title">Lançamentos</span>
             <span class="title-tooltip">Lançamentos</span>
         </a>
     </li>
 <?php } ?>
 <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vCobranca')) { ?>
     <li class="<?php if (isset($menuCobrancas)) {
         echo 'active';
     }; ?>">
         <a class="tip-bottom" title="" href="<?= site_url('cobrancas/cobrancas') ?>"><i class='bx bx-dollar-circle iconX'></i>
             <span class="title">Cobranças</span>
             <span class="title-tooltip">Cobranças</span>
         </a>
     </li>
 <?php } */ ?>
            </ul>
        </div>

        <div class="botton-content">
            <li class="">
                <a class="tip-bottom" title="" href="<?= site_url('login/sair'); ?>">
                    <i class='bx bx-log-out-circle iconX'></i>
                    <span class="title">Sair</span>
                    <span class="title-tooltip">Sair</span>
                </a>
            </li>
        </div>
    </div>
</nav>
<!--End sidebar-menu-->