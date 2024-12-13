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
                <h5>Editar Cliente</h5>
            </div>
            <?php if ($custom_error != '') {
                echo '<div class="alert alert-danger">' . $custom_error . '</div>';
            } ?>
            <form action="<?php echo current_url(); ?>" id="formCliente" method="post" class="form-horizontal">
                <div class="widget-content nopadding tab-content">
                    <div class="span6">
                        <div class="control-group">
                            <label for="documento" class="control-label">CNPJ</label>
                            <div class="controls">
                                <input id="documento" class="cpfcnpj" type="text" name="documento"
                                    value="<?php echo $result->documento; ?>" />
                                <button id="buscar_info_cnpj" class="btn btn-xs" type="button">Buscar(CNPJ)</button>
                            </div>
                        </div>
                        <div class="control-group">
                            <?php echo form_hidden('idClientes', $result->idClientes) ?>
                            <label for="nomeCliente" class="control-label">Circuito + Nome <span
                                    class="required">*</span></label>
                            <div class="controls">
                                <input id="nomeCliente" type="text" name="nomeCliente"
                                    value="<?php echo $result->nomeCliente; ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="telefone" class="control-label">Telefone</label>
                            <div class="controls">
                                <input id="telefone" type="text" name="telefone"
                                    value="<?php echo $result->telefone; ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="email" class="control-label">Email</label>
                            <div class="controls">
                                <input id="email" type="text" name="email" value="<?php echo $result->email; ?>" />
                            </div>
                        </div>

                        <div class="control-group" class="control-label">
                            <label for="responsavel" class="control-label">Responsável</label>
                            <div class="controls">
                                <select id="responsavel" name="responsavel">
                                    <option value="">Selecione...</option>

                                    <?php foreach ($usuarios as $usuario) { ?>
                                        <option value="<?php echo $usuario->nome ?>" <?php echo ($result->responsavel == $usuario->nome) ? 'selected' : ''; ?>>
                                            <?php echo $usuario->nome ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>



                    <!-- <div class="span6">
                        <div class="control-group" class="control-label">
                            <label for="cep" class="control-label">CEP</label>
                            <div class="controls">
                                <input id="cep" type="text" name="cep" value="<?php echo $result->cep; ?>" />
                            </div>
                        </div>
                        <div class="control-group" class="control-label">
                            <label for="rua" class="control-label">Rua</label>
                            <div class="controls">
                                <input id="rua" type="text" name="rua" value="<?php echo $result->rua; ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="numero" class="control-label">Número</label>
                            <div class="controls">
                                <input id="numero" type="text" name="numero" value="<?php echo $result->numero; ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="complemento" class="control-label">Complemento</label>
                            <div class="controls">
                                <input id="complemento" type="text" name="complemento"
                                    value="<?php echo $result->complemento; ?>" />
                            </div>
                        </div>
                        <div class="control-group" class="control-label">
                            <label for="bairro" class="control-label">Bairro</label>
                            <div class="controls">
                                <input id="bairro" type="text" name="bairro" value="<?php echo $result->bairro; ?>" />
                            </div>
                        </div>
                        <div class="control-group" class="control-label">
                            <label for="cidade" class="control-label">Cidade</label>
                            <div class="controls">
                                <input id="cidade" type="text" name="cidade" value="<?php echo $result->cidade; ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="estado" class="control-label">Estado</label>
                            <div class="controls">
                                <select id="estado" name="estado">
                                    <option value="">Selecione...</option>
                                    <option value="AC" <?php echo ($result->estado == 'AC') ? 'selected' : ''; ?>>Acre
                                    </option>
                                    <option value="AL" <?php echo ($result->estado == 'AL') ? 'selected' : ''; ?>>Alagoas
                                    </option>
                                    <option value="AP" <?php echo ($result->estado == 'AP') ? 'selected' : ''; ?>>Amapá
                                    </option>
                                    <option value="AM" <?php echo ($result->estado == 'AM') ? 'selected' : ''; ?>>Amazonas
                                    </option>
                                    <option value="BA" <?php echo ($result->estado == 'BA') ? 'selected' : ''; ?>>Bahia
                                    </option>
                                    <option value="CE" <?php echo ($result->estado == 'CE') ? 'selected' : ''; ?>>Ceará
                                    </option>
                                    <option value="DF" <?php echo ($result->estado == 'DF') ? 'selected' : ''; ?>>Distrito
                                        Federal</option>
                                    <option value="ES" <?php echo ($result->estado == 'ES') ? 'selected' : ''; ?>>Espírito
                                        Santo</option>
                                    <option value="GO" <?php echo ($result->estado == 'GO') ? 'selected' : ''; ?>>Goiás
                                    </option>
                                    <option value="MA" <?php echo ($result->estado == 'MA') ? 'selected' : ''; ?>>Maranhão
                                    </option>
                                    <option value="MT" <?php echo ($result->estado == 'MT') ? 'selected' : ''; ?>>Mato
                                        Grosso</option>
                                    <option value="MS" <?php echo ($result->estado == 'MS') ? 'selected' : ''; ?>>Mato
                                        Grosso do Sul</option>
                                    <option value="MG" <?php echo ($result->estado == 'MG') ? 'selected' : ''; ?>>Minas
                                        Gerais</option>
                                    <option value="PA" <?php echo ($result->estado == 'PA') ? 'selected' : ''; ?>>Pará
                                    </option>
                                    <option value="PB" <?php echo ($result->estado == 'PB') ? 'selected' : ''; ?>>Paraíba
                                    </option>
                                    <option value="PR" <?php echo ($result->estado == 'PR') ? 'selected' : ''; ?>>Paraná
                                    </option>
                                    <option value="PE" <?php echo ($result->estado == 'PE') ? 'selected' : ''; ?>>
                                        Pernambuco</option>
                                    <option value="PI" <?php echo ($result->estado == 'PI') ? 'selected' : ''; ?>>Piauí
                                    </option>
                                    <option value="RJ" <?php echo ($result->estado == 'RJ') ? 'selected' : ''; ?>>Rio de
                                        Janeiro</option>
                                    <option value="RN" <?php echo ($result->estado == 'RN') ? 'selected' : ''; ?>>Rio
                                        Grande do Norte</option>
                                    <option value="RS" <?php echo ($result->estado == 'RS') ? 'selected' : ''; ?>>Rio
                                        Grande do Sul</option>
                                    <option value="RO" <?php echo ($result->estado == 'RO') ? 'selected' : ''; ?>>Rondônia
                                    </option>
                                    <option value="RR" <?php echo ($result->estado == 'RR') ? 'selected' : ''; ?>>Roraima
                                    </option>
                                    <option value="SC" <?php echo ($result->estado == 'SC') ? 'selected' : ''; ?>>Santa
                                        Catarina</option>
                                    <option value="SP" <?php echo ($result->estado == 'SP') ? 'selected' : ''; ?>>São
                                        Paulo</option>
                                    <option value="SE" <?php echo ($result->estado == 'SE') ? 'selected' : ''; ?>>Sergipe
                                    </option>
                                    <option value="TO" <?php echo ($result->estado == 'TO') ? 'selected' : ''; ?>>
                                        Tocantins</option>
                                </select>
                            </div>
                        </div> -->

                    <!-- 
                        <div class="control-group" class="control-label">
                            <label for="etapa" class="control-label">Etapa</label>
                            <div class="controls">
                                <h6><?php echo $etapa_atual[$result->etapa]; ?></h6>
                                <a href="#modal-proxima-etapa" data-toggle="modal" role="button"
                                    class="button btn btn-mini btn-success" style="width: 230px">
                                    <span class="button__icon"><i class="bx bx-right-arrow-alt"></i></span><span
                                        class="button__text2" title="Próxima Etapa">Próxima Etapa</span></a>
                                <a href="#modal-relatar-pendencia" data-toggle="modal" role="button"
                                    class="button btn btn-mini btn-danger" style="width: 230px">
                                    <span class="button__icon"><i class="bx bx-message-alt-error"></i></span><span
                                        class="button__text2" title="Relatar Pendência">Relatar Pendência</span></a>
                            </div>
                        </div> -->

                    <div class="span6" style="padding: 1%; margin-left: 0">
                        <label for="descricao">
                            <h4>Descrição</h4>
                        </label>
                        <textarea class="span12 editor" name="descricao" id="descricao" cols="30"
                            rows="5"><?php echo $result->descricao ?></textarea>
                    </div>

                </div>
        </div>
        <div class="form-actions">
            <div class="span12">
                <div class="span6 offset3" style="display:flex;justify-content: center">
                    <button type="submit" class="button btn btn-primary" style="max-width: 160px">
                        <span class="button__icon"><i class="bx bx-sync"></i></span><span
                            class="button__text2">Atualizar</span></button>
                    <a title="Voltar" class="button btn btn-warning" href="<?php echo site_url() ?>/clientes"><span
                            class="button__icon"><i class="bx bx-undo"></i></span> <span
                            class="button__text2">Voltar</span></a>
                </div>
            </div>
        </div>
        </form>

        <!-- <div id="modal-proxima-etapa" class="modal hide fade" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true">
                <?php $url_proxima_etapa = base_url('index.php/clientes/proximaEtapa/' . $result->idClientes . '/' . $result->etapa); ?>
                <form action="<?php echo $url_proxima_etapa; ?>" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 id="myModalLabel">Promover para a próxima etapa</h5>
                    </div>
                    <div class="modal-body">
                        <div class="control-group">
                            <input type="hidden" name="etapa_atual"
                                value="<?php echo $etapa_atual[$result->etapa]; ?>" />
                            <input type="hidden" name="etapa_promovida"
                                value="<?php echo $etapa_atual[$result->etapa + 1]; ?>" />
                            <input type="hidden" name="usuario"
                                value="<?php echo $this->session->userdata['nome_admin'] ?>" />
                        </div>
                        <p style="text-align: center">Deseja realmente promover esse Cliente de
                            <strong><?php echo $etapa_atual[$result->etapa]; ?></strong> a
                            <strong><?php echo $etapa_atual[$result->etapa + 1]; ?></strong>?
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

            <div id="modal-relatar-pendencia" class="modal hide fade" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true">
                <?php $url_proxima_etapa = base_url('index.php/clientes/relatarPendencia/' . $result->idClientes . '/' . $result->etapa); ?>
                <form action="<?php echo $url_proxima_etapa; ?>" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 id="myModalLabel">Relatar Pendência</h5>
                    </div>
                    <div class="modal-body">
                        <div class="control-group">
                            <input type="hidden" name="etapa_atual"
                                value="<?php echo $etapa_atual[$result->etapa]; ?>" />
                            <input type="hidden" name="usuario"
                                value="<?php echo $this->session->userdata['nome_admin'] ?>" />
                        </div>
                        <p style="text-align: center">Digite abaixo a justificativa dessa pendência:</p>

                        <div class="span6" style="padding: 1%; margin-left: 0">
                            <label for="justificativa">
                                <h4>Justificativa</h4>
                            </label>
                            <textarea required class="span12 editor" name="justificativa" id="justificativa" cols="30"
                                rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer" style="display:flex;justify-content: center">
                        <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true"><span
                                class="button__icon"><i class="bx bx-x"></i></span> <span
                                class="button__text2">Cancelar</span></button>
                        <button class="button btn btn-success"><span class="button__icon"><i
                                    class='bx bx-check'></i></span> <span class="button__text2">Relatar</span></button>
                    </div>
                </form>
            </div> -->
    </div>
</div>
</div>
<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        let container = document.querySelector('div');
        let input = document.querySelector('#senha');
        let icon = document.querySelector('#imgSenha');

        icon.addEventListener('click', function () {
            container.classList.toggle('visible');
            if (container.classList.contains('visible')) {
                icon.src = '<?php echo base_url() ?>assets/img/eye-off.svg';
                input.type = 'text';
            } else {
                icon.src = '<?php echo base_url() ?>assets/img/eye.svg'
                input.type = 'password';
            }
        });

        $.getJSON('<?php echo base_url() ?>assets/json/estados.json', function (data) {
            for (i in data.estados) {
                $('#estado').append(new Option(data.estados[i].nome, data.estados[i].sigla));
            }
            var curState = '<?php echo $result->estado; ?>';
            if (curState) {
                $("#estado option[value=" + curState + "]").prop("selected", true);
            }

        });
        $('#formCliente').validate({
            rules: {
                nomeCliente: {
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