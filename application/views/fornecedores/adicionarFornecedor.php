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
                <h5>Cadastro de Fornecedores</h5>
            </div>
            <?php if ($custom_error != '') {
                echo '<div class="alert alert-danger">' . $custom_error . '</div>';
            }
            ?>

            <form action="<?php echo current_url(); ?>" id="formFornecedor" method="post" class="form-horizontal">
                <div class="widget-content nopadding tab-content">
                    <div class="span6">
                        <div class="control-group">
                            <label for="documento" class="control-label">CNPJ</label>
                            <div class="controls">
                                <input id="documento" class="cpfcnpj" type="text" name="documento"
                                    value="<?php echo set_value('documento'); ?>" />
                                <button id="buscar_info_cnpj" class="btn btn-xs" type="button">Buscar(CNPJ)</button>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="nomeFornecedor" class="control-label">Nome/Razão Social<span
                                    class="required">*</span></label>
                            <div class="controls">
                                <input id="nomeCliente" type="text" name="nomeFornecedor"
                                    value="<?php echo set_value('nomeFornecedor'); ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="telefone_comercial" class="control-label">Telefone Comercial</label>
                            <div class="controls">
                                <input id="telefone" type="text" name="telefone_comercial"
                                    value="<?php echo set_value('telefone_comercial'); ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="telefone_financeiro" class="control-label">Telefone Financeiro</label>
                            <div class="controls">
                                <input id="telefone_financeiro" type="text" name="telefone_financeiro"
                                    value="<?php echo set_value('telefone_financeiro'); ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="telefone_suporte" class="control-label">Telefone Suporte</label>
                            <div class="controls">
                                <input id="telefone_suporte" type="text" name="telefone_suporte"
                                    value="<?php echo set_value('telefone_suporte'); ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="email" class="control-label">Email</label>
                            <div class="controls">
                                <input id="email" type="text" name="email" value="<?php echo set_value('email'); ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="sla_manutencao" class="control-label">SLA de Manutenção</label>
                            <div class="controls">
                                <input placeholder="Quantidade de Horas. Ex.: 2" id="sla_manutencao" type="number" name="sla_manutencao"
                                    value="<?php echo set_value('sla_manutencao'); ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="sla_instalacao" class="control-label">SLA de Instalação</label>
                            <div class="controls">
                                <input placeholder="Quantidade de Horas. Ex.: 2" id="sla_instalacao" type="number" name="sla_instalacao"
                                    value="<?php echo set_value('sla_instalacao'); ?>" />
                            </div>
                        </div>

                    </div>

                    <div class="span6">
                        <div class="control-group" class="control-label">
                            <label for="cep" class="control-label">CEP</label>
                            <div class="controls">
                                <input id="cep" type="text" name="cep" value="<?php echo set_value('cep'); ?>" />
                            </div>
                        </div>
                        <div class="control-group" class="control-label">
                            <label for="rua" class="control-label">Rua</label>
                            <div class="controls">
                                <input id="rua" type="text" name="rua" value="<?php echo set_value('rua'); ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="numero" class="control-label">Número</label>
                            <div class="controls">
                                <input id="numero" type="number" name="numero"
                                    value="<?php echo set_value('numero'); ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="complemento" class="control-label">Complemento</label>
                            <div class="controls">
                                <input id="complemento" type="text" name="complemento"
                                    value="<?php echo set_value('complemento'); ?>" />
                            </div>
                        </div>
                        <div class="control-group" class="control-label">
                            <label for="bairro" class="control-label">Bairro</label>
                            <div class="controls">
                                <input id="bairro" type="text" name="bairro"
                                    value="<?php echo set_value('bairro'); ?>" />
                            </div>
                        </div>
                        <div class="control-group" class="control-label">
                            <label for="cidade" class="control-label">Cidade</label>
                            <div class="controls">
                                <input id="cidade" type="text" name="cidade"
                                    value="<?php echo set_value('cidade'); ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="estado" class="control-label">Estado</label>
                            <div class="controls">
                                <select id="estado" name="estado">
                                    <option value="">Selecione...</option>
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espírito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select>
                            </div>
                        </div>

                        <div class="span6" style="padding: 1%; margin-left: 0">
                            <label for="descricao">
                                <h4>Descrição (opcional)</h4>
                            </label>
                            <textarea class="span12 editor" name="descricao" id="descricao" cols="30"
                                rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="span12">
                        <div class="span6 offset3" style="display:flex;justify-content: center">
                            <button type="submit" class="button btn btn-mini btn-success"><span class="button__icon"><i
                                        class='bx bx-save'></i></span> <span
                                    class="button__text2">Salvar</span></button>
                            <a title="Voltar" class="button btn btn-warning"
                                href="<?php echo site_url() ?>/fornecedores"><span class="button__icon"><i
                                        class="bx bx-undo"></i></span> <span class="button__text2">Voltar</span></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        let container = document.querySelector('div');

        $("#nomeFornecedor").focus();
        $('#formFornecedor').validate({
            rules: {
                nomeFornecedor: {
                    required: true
                },
            },
            messages: {
                nomeFornecedor: {
                    required: 'Campo Requerido.'
                },
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
    });
</script>