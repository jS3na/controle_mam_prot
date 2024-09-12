<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>

<link rel="stylesheet" href="<?php echo base_url() ?>assets/trumbowyg/ui/trumbowyg.css">
<script type="text/javascript" src="<?php echo base_url() ?>assets/trumbowyg/trumbowyg.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/trumbowyg/langs/pt_br.js"></script>

<script src="<?php echo base_url() ?>assets/js/jquery.mask.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/funcoes.js"></script>
<style>
    #imgSenha {
        width: 18px;
        cursor: pointer;
    }

    /* Hiding the checkbox, but allowing it to be focused */
    .badgebox {
        opacity: 0;
    }

    .badgebox+.badge {
        /* Move the check mark away when unchecked */
        text-indent: -999999px;
        /* Makes the badge's width stay the same checked and unchecked */
        width: 27px;
    }

    .badgebox:focus+.badge {
        /* Set something to make the badge looks focused */
        /* This really depends on the application, in my case it was: */
        /* Adding a light border */
        box-shadow: inset 0px 0px 5px;
        /* Taking the difference out of the padding */
    }

    .badgebox:checked+.badge {
        /* Move the check mark back when checked */
        text-indent: 0;
    }

    .control-group.error .help-inline {
        display: flex;
    }

    .widget-title{
        margin: 0.5rem !important;
    }

    .form-horizontal .control-group {
        border-bottom: 1px solid #ffffff;
    }

    .form-horizontal .controls {
        margin-left: 20px;
        padding-bottom: 8px 0;
    }

    .form-horizontal .control-label {
        text-align: left;
        padding-top: 15px;
    }

    .nopadding {
        padding: 0 20px !important;
        margin-right: 20px;
    }

    .widget-title h5 {
        padding-bottom: 30px;
        text-align-last: left;
        font-size: 2em;
        font-weight: 500;
    }

    @media (max-width: 480px) {
        form {
            display: contents !important;
        }

        .form-horizontal .control-label {
            margin-bottom: -6px;
        }

        .btn-xs {
            position: initial !important;
        }
    }
</style>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title" style="margin: -20px 0 0">
                <span class="icon">
                    <i class="fas fa-user"></i>
                </span>
                <h5>Gerar Financeiro</h5>
            </div>
            <?php if ($custom_error != '') {
                echo '<div class="alert alert-danger">' . $custom_error . '</div>';
            } ?>
            <form action="<?php echo current_url(); ?>" id="formFinanceiro" method="post" class="form-horizontal">
                <div class="widget-content nopadding tab-content">
                    <div class="span6">
                        <div class="control-group">
                            <?php echo form_hidden('idCliente', $result->idClientes) ?>
                        </div>
                        <div class="control-group" class="control-label">
                            <label for="parcelas" class="control-label">Parcelas *</label>
                            <div class="controls">
                                <select id="parcelas" name="parcelas">
                                    <option value="">Selecione...</option>
                                    <option value="12">12</option>
                                    <option value="24">24</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="vencimento" class="control-label">Vencimento *</label>
                            <div class="controls">
                                <input id="vencimento" autocomplete="off" class="datepicker" type="text" name="vencimento" value="<?php echo date('d/m/Y'); ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="taxaInstalacao" class="control-label">Taxa de Instalação</label>
                            <div class="controls">
                                <input id="taxaInstalacao" type="number" name="taxaInstalacao" value="<?php echo set_value('taxaInstalacao'); ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="valorTotal" class="control-label">Valor Total *</label>
                            <div class="controls">
                                <input id="valorTotal" type="number" name="valorTotal" value="<?php echo set_value('valorTotal'); ?>" />
                            </div>
                        </div>
                        <div class="control-group" class="control-label">
                            <label for="responsavel" class="control-label">Responsável</label>
                            <div class="controls">
                                <select id="responsavel" name="responsavel">
                                    <option value="">Selecione...</option>
                                    <option value="Responsável 1">Responsável 1</option>
                                    <option value="Responsável 2">Responsável 2</option>
                                </select>
                            </div>
                        </div>

                    </div>

                <div class="form-actions">
                    <div class="span12">
                        <div class="span6 offset3" style="display:flex;justify-content: center">
                            <button type="submit" class="button btn btn-mini btn-success"><span class="button__icon"><i class='bx bx-save'></i></span> <span class="button__text2">Gerar</span></a></button>
                            <a title="Voltar" class="button btn btn-warning" href="<?php echo site_url() ?>/clientes"><span class="button__icon"><i class="bx bx-undo"></i></span> <span class="button__text2">Voltar</span></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $(".datepicker").datepicker({
            dateFormat: 'dd/mm/yy'
        });

        $('#formFinanceiro').validate({
            rules: {
                parcelas: {
                    required: true
                },
                valorTotal: {
                    required: true
                },
                vencimento: {
                    required: true
                },
                responsavel: {
                    required: true
                },
            },
            messages: {
                nomeCliente: {
                    required: 'Campo Requerido.'
                },
            },

            errorClass: "help-inline",
            errorElement: "span",
            highlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });
    });
</script>