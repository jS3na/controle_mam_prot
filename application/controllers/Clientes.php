<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Clientes extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('clientes_model');
        $this->data['menuClientes'] = 'clientes';
    }

    public function index()
    {
        $this->gerenciar();
    }

    public function gerenciar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar clientes.');
            redirect(base_url());
        }

        $pesquisa = $this->input->get('pesquisa');
        $etapa = $this->input->get('etapa');

        $this->load->library('pagination');

        $this->data['configuration']['base_url'] = site_url('clientes/gerenciar/');
        $this->data['configuration']['total_rows'] = $this->clientes_model->count('clientes');

        if ($pesquisa) {
            $this->data['configuration']['suffix'] = "?pesquisa={$pesquisa}&etapa={$etapa}";
            $this->data['configuration']['first_url'] = base_url("index.php/clientes") . "?pesquisa={$pesquisa}&etapa={$etapa}";
        } else if ($etapa) {
            $this->data['configuration']['suffix'] = "?etapa={$etapa}";
            $this->data['configuration']['first_url'] = base_url("index.php/clientes") . "?etapa={$etapa}";
        }

        $this->pagination->initialize($this->data['configuration']);

        $this->data['results'] = $this->clientes_model->get('clientes', '*', $pesquisa, $etapa, $this->data['configuration']['per_page'], $this->uri->segment(3));
        $this->data['etapa_atual'] = $this->clientes_model->getEtapas();

        $this->data['view'] = 'clientes/clientes';

        return $this->layout();
    }

    public function adicionarArquivo()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aArquivo')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar arquivos.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('nome', '', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $arquivo = $this->do_upload();

            $file = $arquivo['file_name'];
            $path = $arquivo['full_path'];
            $url = base_url() . 'assets/arquivos/' . date('d-m-Y') . '/' . $file;
            $tamanho = $arquivo['file_size'];
            $tipo = $arquivo['file_ext'];

            $idReferencia = $this->uri->segment(3);
            $secao = $this->uri->segment(4);
            $idContrato = $this->uri->segment(5);
            $etapa = $this->uri->segment(6);
            
            $data = $this->input->post('data');

            if ($data == null) {
                $data = date('Y-m-d');
            } else {
                $data = explode('/', $data);
                $data = $data[2] . '-' . $data[1] . '-' . $data[0];
            }

            $data = [
                'documento' => $this->input->post('nome'),
                'descricao' => $this->input->post('descricao'),
                'file' => $file,
                'path' => $path,
                'url' => $url,
                'cadastro' => $data,
                'tamanho' => $tamanho,
                'tipo' => $tipo,
                'categoria' => 'clientes',
                'idReferencia' => $idReferencia,
                'secao' => $secao,
            ];

            if ($this->clientes_model->addArquivo('documentos', $data, $idContrato) == true) {

                $dataLog = [
                    'usuario' => $this->session->userdata('nome_admin'),
                    'nota' => 'Adicionou um arquivo na seção ' . $secao,
                    'etapa' => urldecode($etapa),
                    'data' => date('d-m-Y'),
                    'hora' => date('H:i:s')
                ];
        
                $this->clientes_model->adicionarLog($dataLog, $idReferencia, $idContrato);

                $this->session->set_flashdata('success', 'Arquivo adicionado com sucesso!');

                log_info('Adicionou um arquivo na seção ' . $secao . ' no cliente com o id ' . $idReferencia);

                redirect(site_url('clientes/visualizar/' . $idReferencia));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        $this->data['view'] = 'clientes/adicionarArquivo';

        return $this->layout();
    }

    public function do_upload()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aArquivo')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar arquivos.');
            redirect(base_url());
        }

        $date = date('d-m-Y');

        $config['upload_path'] = './assets/arquivos/' . $date;
        $config['allowed_types'] = 'txt|jpg|jpeg|gif|png|pdf|PDF|JPG|JPEG|GIF|PNG';
        $config['max_size'] = 0;
        $config['max_width'] = '3000';
        $config['max_height'] = '2000';
        $config['encrypt_name'] = true;

        if (!is_dir('./assets/arquivos/' . $date)) {
            mkdir('./assets/arquivos/' . $date, 0777, true);
        }

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = ['error' => $this->upload->display_errors()];

            $this->session->set_flashdata('error', 'Erro ao fazer upload do arquivo, verifique se a extensão do arquivo é permitida.');
            redirect(site_url('arquivos/adicionar'));
        } else {
            //$data = array('upload_data' => $this->upload->data());
            return $this->upload->data();
        }
    }

    public function adicionar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar clientes.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        //$senhaCliente = $this->input->post('senha') ? $this->input->post('senha') : preg_replace('/[^\p{L}\p{N}\s]/', '', set_value('documento'));

        //$cpf_cnpj = preg_replace('/[^\p{L}\p{N}\s]/', '', set_value('documento'));

        /*if (strlen($cpf_cnpj) == 11) {
            $pessoa_fisica = true;
        } else {
            $pessoa_fisica = false;
        }*/

        if ($this->form_validation->run('clientes') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = [
                'nomeCliente' => set_value('nomeCliente'),
                'documento' => set_value('documento'),
                'telefone' => set_value('telefone'),
                'descricao' => set_value('descricao'),
                'email' => set_value('email'),
                //'senha' => password_hash($senhaCliente, PASSWORD_DEFAULT),
                'dataCadastro' => date('Y-m-d'),
                'responsavel' => set_value(field: 'responsavel'),
                //'fornecedor' => (set_value('fornecedor') == true ? 1 : 0),
            ];

            $idContrato = $this->clientes_model->add('clientes', $data);

            if ($idContrato) {

                $dataEndereco = [
                    'rua' => set_value('rua'),
                    'numero' => set_value('numero'),
                    'complemento' => set_value('complemento'),
                    'bairro' => set_value('bairro'),
                    'cidade' => set_value('cidade'),
                    'estado' => set_value('estado'),
                    'cep' => set_value('cep'),
                ];

                $this->clientes_model->vincularEndereco($idContrato, 'adicionar', $dataEndereco);
                
                $this->session->set_flashdata('success', 'Cliente adicionado com sucesso!');
                log_info('Adicionou um cliente.');
                redirect(site_url('clientes/'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        $this->data['usuarios'] = $this->clientes_model->getUsuarios();
        $this->data['view'] = 'clientes/adicionarCliente';

        return $this->layout();
    }

    public function addContrato($idCliente) {
        $this->clientes_model->addContrato($idCliente);
        redirect(site_url('clientes/visualizar/' . $idCliente));
    }
    

    public function vincularFornecedor()
    {
        //echo "<script>console.log('entrou');</script>";

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para vincular o cliente ao fornecedor.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $idContrato = $this->uri->segment(4);
        $idCliente = $this->input->post('idCliente');
        $idFornecedor = $this->input->post('idFornecedor');
        $nomeFornecedor = $this->input->post('fornecedor');
        $etapa = $this->input->post('etapa');

        if ($this->form_validation->run('vincular') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error"> Preencha o campo do Fornecedor corretamente </div>' : false);
        } else {

            if ($this->clientes_model->vincularFornecedor($idContrato, $idFornecedor) == true) {

                $data = [
                    'usuario' => $this->session->userdata('nome_admin'),
                    'nota' => 'Vinculou o fornecedor ' . $nomeFornecedor,
                    'etapa' => urldecode($etapa),
                    'data' => date('d-m-Y'),
                    'hora' => date('H:i:s')
                ];
        
                $this->clientes_model->adicionarLog($data, $idCliente, $idContrato);

                $this->session->set_flashdata('success', 'Fornecedor vinculado com sucesso!');

                log_info('Vinculou um cliente a um fornecedor.');
                redirect(site_url('clientes/visualizar/' . $idCliente));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        $this->data['etapa_atual'] = $this->clientes_model->getEtapas();
        $this->data['result'] = $this->clientes_model->getById($this->uri->segment(3));
        $this->data['fornecedor_cliente'] = $this->clientes_model->getFornecedorCliente($this->data['result']->idClientes);

        if ($this->data['fornecedor_cliente'] && isset($this->data['fornecedor_cliente']->idFornecedor)) {
            $this->data['fornecedor_by_id'] = $this->clientes_model->getFornecedorById($this->data['fornecedor_cliente']->idFornecedor);
        } else {
            $this->data['fornecedor_by_id'] = null;
        }

        $this->data['view'] = 'clientes/vincularFornecedor';

        return $this->layout();
    }

    public function gerarFinanceiro()
    {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para gerar financeiros');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $idCliente = $this->uri->segment(3);
        $idContrato = $this->uri->segment(4);
        $etapa = $this->uri->segment(5);

        if ($this->form_validation->run('gerarFinanceiro') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error"> Preencha os campos corretamente </div>' : false);
        } else {

            $vencimento = $this->input->post('vencimento');
            $parcelas = $this->input->post('parcelas');
            $idCliente = $this->input->post('idCliente');
            $status = $this->input->post('status');
            $taxaInstalacao = $this->input->post('taxaInstalacao');
            $valorTotal = $this->input->post('valorTotal');

            try {
                $vencimento = DateTime::createFromFormat('d/m/Y', $vencimento);
                if (!$vencimento) {
                    throw new Exception('Data inválida');
                }
                $vencimentoFormatado = $vencimento->format('Y-m-d');
            } catch (Exception $e) {
                $vencimentoFormatado = date('Y-m-d');
            }

            $data = [
                'idCliente' => $idCliente,
                'parcelas' => $parcelas,
                'vencimento' => $vencimentoFormatado,
                'taxaInstalacao' => $taxaInstalacao,
                'valorTotal' => $valorTotal,
            ];

            if ($this->clientes_model->addFinanceiro('financeiro_cliente', $data, $idContrato) == true) {

                $dataLog = [
                    'usuario' => $this->session->userdata('nome_admin'),
                    'nota' => 'Gerou um Financeiro',
                    'etapa' => urldecode($etapa),
                    'data' => date('d-m-Y'),
                    'hora' => date('H:i:s')
                ];
        
                $this->clientes_model->adicionarLog($dataLog, $idCliente, $idContrato);

                $valorPorParcela = $valorTotal / $parcelas;

                $vencimento = DateTime::createFromFormat('Y-m-d', $vencimentoFormatado);

                for ($i = 0; $i < $parcelas; $i++) {
                    $vencimento->modify('+1 month');
                    $vencimentoFormatado = $vencimento->format('Y-m-d');
                    $valorAtual = $i == 0 ? $valorPorParcela + $taxaInstalacao : $valorPorParcela;

                    $dataParcela = [
                        'idCliente' => $idCliente,
                        'valor' => $valorAtual,
                        'vencimento' => $vencimentoFormatado,
                    ];

                    $this->clientes_model->add('parcelas', $dataParcela);
                }

                $this->session->set_flashdata('success', 'Financeiro gerado com sucesso!');
                log_info('Gerou um financeiro a um cliente.');
                redirect(site_url('clientes/visualizar/' . $data['idCliente']));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }

        }

        $this->data['result'] = $this->clientes_model->getById($this->uri->segment(3));
        $this->data['etapa_atual'] = $this->clientes_model->getEtapas();
        $this->data['view'] = 'clientes/gerarFinanceiro';

        return $this->layout();
    }

    public function aprovarParcela()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para aprovar parcelas.');
            redirect(base_url());
        }

        $idParcela = $this->input->post('idParcela');

        $idCliente = $this->uri->segment(3);
        $idContrato = $this->uri->segment(4);
        $etapa = $this->uri->segment(5);

        $meio_pagamento = $this->input->post('meio_pagamento');
        $valorJuros = $this->input->post('valorJuros');

        if ($idParcela == null) {
            $this->session->set_flashdata('error', 'Erro ao tentar aprovar parcela.');
            redirect(site_url('clientes/'));
        }

        $this->clientes_model->aprovarParcela($idParcela, $meio_pagamento, $valorJuros);
        log_info('Aprovou uma parcela. ID' . $idParcela);

        $data = [
            'usuario' => $this->session->userdata('nome_admin'),
            'nota' => 'Aprovou uma parcela',
            'etapa' => urldecode($etapa),
            'data' => date('d-m-Y'),
            'hora' => date('H:i:s')
        ];

        $this->clientes_model->adicionarLog($data, $idCliente, $idContrato);

        $this->session->set_flashdata('success', 'Parcela aprovada com sucesso!');
        redirect(site_url('clientes/visualizar/' . $this->uri->segment(3)));
    }

    public function adicionarParcelaUnica()
    {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar parcelas');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('adicionarParcelaUnica') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error"> Preencha os campos corretamente </div>' : false);
        } else {

            $vencimento = $this->input->post('vencimento');

            try {
                $vencimento = DateTime::createFromFormat('d/m/Y', $vencimento);
                if (!$vencimento) {
                    throw new Exception('Data inválida');
                }
                $vencimentoFormatado = $vencimento->format('Y-m-d');
            } catch (Exception $e) {
                $vencimentoFormatado = date('Y-m-d');
            }

            $data = [
                'idCliente' => $this->uri->segment(3),
                'vencimento' => $vencimentoFormatado,
                'valor' => $this->input->post('valorParcela'),
            ];

            if ($this->clientes_model->add('parcelas', $data) == true) {

                $this->session->set_flashdata('success', 'Parcela adicionada com sucesso!');
                log_info('Adicionou uma parcela única ao cliente: ' . $data['idCliente']);
                redirect(site_url('clientes/visualizar/' . $data['idCliente']));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }

        }

        $this->data['result'] = $this->clientes_model->getById($this->uri->segment(3));

        return $this->layout();
    }

    public function excluirFinanceiro()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir clientes.');
            redirect(base_url());
        }

        $idCliente = $this->uri->segment(3);
        $idContrato = $this->uri->segment(4);
        $etapa = $this->uri->segment(5);

        if ($idCliente == null) {
            $this->session->set_flashdata('error', 'Erro ao tentar excluir financeiro.');
            redirect(site_url('clientes/gerenciar/'));
        }

        $this->clientes_model->delete('financeiro_cliente', 'idCliente', $idCliente);
        $this->clientes_model->delete('parcelas', 'idCliente', $idCliente);
        $this->clientes_model->excluirItemContrato('idFinanceiro', $idContrato);
        log_info('Removeu um financeiro do cliente: ' . $idCliente);

        $this->session->set_flashdata('success', 'Financeiro removido com sucesso!');

        $data = [
            'usuario' => $this->session->userdata('nome_admin'),
            'nota' => 'Removeu o financeiro',
            'etapa' => urldecode($etapa),
            'data' => date('d-m-Y'),
            'hora' => date('H:i:s')
        ];

        $this->clientes_model->adicionarLog($data, $idCliente, $idContrato);

        redirect(site_url('clientes/visualizar/' . $idCliente));
    }

    public function excluirFornecedor()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir fornecedores.');
            redirect(base_url());
        }

        $idCliente = $this->uri->segment(3);
        $idContrato = $this->uri->segment(4);
        $etapa = $this->uri->segment(5);
        if ($idCliente == null && $idContrato == null) {
            $this->session->set_flashdata('error', 'Erro ao tentar excluir fornecedor.');
            redirect(site_url('clientes/gerenciar/'));
        }

        $this->clientes_model->excluirItemContrato('idFornecedor', $idContrato);
        log_info('Removeu o fornecedor do cliente: ' . $idCliente);

        $data = [
            'usuario' => $this->session->userdata('nome_admin'),
            'nota' => 'Removeu um fornecedor',
            'etapa' => urldecode($etapa),
            'data' => date('d-m-Y'),
            'hora' => date('H:i:s')
        ];

        $this->clientes_model->adicionarLog($data, $idCliente, $idContrato);

        $this->session->set_flashdata('success', 'Fornecedor removido com sucesso!');

        redirect(site_url('clientes/visualizar/' . $idCliente));
    }

    public function adicionarLog()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar notas a clientes.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $idCliente = $this->input->post('idCliente');
        $idContrato = $this->uri->segment(4);

        if ($this->form_validation->run('notas_clientes') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = [
                'usuario' => set_value('usuario'),
                'nota' => set_value('nota'),
                'etapa' => set_value('etapa'),
                'data' => date('d-m-Y'),
                'hora' => date('H:i:s')
            ];

            if ($this->clientes_model->adicionarLog($data, $idCliente, $idContrato) == true) {
                $this->session->set_flashdata('success', 'Nota adicionada ao cliente com sucesso!');
                log_info('Adicionou uma nota a um cliente.');
                redirect(site_url('clientes/visualizar/' . $idCliente));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        $this->data['result'] = $this->clientes_model->getById($this->uri->segment(3));
        $this->data['etapa_atual'] = $this->clientes_model->getEtapas();
        $this->data['view'] = 'clientes/adicionarLog';

        return $this->layout();
    }

    public function autoCompleteFornecedor()
    {

        header('Content-Type: application/json');

        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $result = $this->clientes_model->autoCompleteFornecedor($q);
            echo json_encode($result);
        } else {
            echo json_encode([]);
        }
    }

    public function editar()
    {
        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar clientes.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('clientes') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $senha = $this->input->post('senha');
            if ($senha != null) {
                $senha = password_hash($senha, PASSWORD_DEFAULT);

                $data = [
                    'nomeCliente' => $this->input->post('nomeCliente'),
                    'documento' => $this->input->post('documento'),
                    'descricao' => $this->input->post('descricao'),
                    'telefone' => $this->input->post('telefone'),
                    'email' => $this->input->post('email'),
                    //'senha' => $senha,
                    'rua' => $this->input->post('rua'),
                    'numero' => $this->input->post('numero'),
                    'complemento' => $this->input->post('complemento'),
                    'bairro' => $this->input->post('bairro'),
                    'cidade' => $this->input->post('cidade'),
                    'estado' => $this->input->post('estado'),
                    'cep' => $this->input->post('cep'),
                    'responsavel' => $this->input->post('responsavel'),
                ];
            } else {
                $data = [
                    'nomeCliente' => $this->input->post('nomeCliente'),
                    'documento' => $this->input->post('documento'),
                    'descricao' => $this->input->post('descricao'),
                    'telefone' => $this->input->post('telefone'),
                    'email' => $this->input->post('email'),
                    'rua' => $this->input->post('rua'),
                    'numero' => $this->input->post('numero'),
                    'complemento' => $this->input->post('complemento'),
                    'bairro' => $this->input->post('bairro'),
                    'cidade' => $this->input->post('cidade'),
                    'estado' => $this->input->post('estado'),
                    'cep' => $this->input->post('cep'),
                    'responsavel' => $this->input->post('responsavel'),
                ];
            }

            if ($this->clientes_model->edit('clientes', $data, 'idClientes', $this->input->post('idClientes')) == true) {
                $this->session->set_flashdata('success', 'Cliente editado com sucesso!');
                log_info('Alterou um cliente. ID' . $this->input->post('idClientes'));
                redirect(site_url('clientes/editar/') . $this->input->post('idClientes'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }

        $this->data['result'] = $this->clientes_model->getById($this->uri->segment(3));
        $this->data['usuarios'] = $this->clientes_model->getUsuarios();
        $this->data['etapa_atual'] = $this->clientes_model->getEtapas();
        $this->data['view'] = 'clientes/editarCliente';

        return $this->layout();
    }

    public function editarEndereco()
    {
        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar endereços de clientes.');
            redirect(base_url());
        }

        $idContrato = $this->uri->segment(3);
        $idEndereco = $this->uri->segment(4);
        $idCliente = $this->uri->segment(5);
        $etapa = $this->uri->segment(6);

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('endereco_cliente') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {

                $idEndereco = $this->input->post('id');
            
                $data = [
                    'id' => $idEndereco,
                    'rua' => $this->input->post('rua'),
                    'numero' => $this->input->post('numero'),
                    'complemento' => $this->input->post('complemento'),
                    'bairro' => $this->input->post('bairro'),
                    'cidade' => $this->input->post('cidade'),
                    'estado' => $this->input->post('estado'),
                    'cep' => $this->input->post('cep'),
                ];

            if ($this->clientes_model->editEndereco($data, $idEndereco, $idCliente) == true) {

                $data = [
                    'usuario' => $this->session->userdata('nome_admin'),
                    'nota' => 'Editou um endereço',
                    'etapa' => urldecode($etapa),
                    'data' => date('d-m-Y'),
                    'hora' => date('H:i:s')
                ];
        
                $this->clientes_model->adicionarLog($data, $idCliente, $idContrato);

                $this->session->set_flashdata('success', 'Cliente editado com sucesso!');
                log_info('Alterou um endereço do cliente. ID' . $idCliente);
                redirect(site_url('clientes/visualizar/') . $idCliente);
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }

        $this->data['result'] = $this->clientes_model->getEnderecoById($idCliente, $idEndereco);

        $this->data['usuarios'] = $this->clientes_model->getUsuarios();
        $this->data['etapa_atual'] = $this->clientes_model->getEtapas();
        $this->data['view'] = 'clientes/editarEndereco';

        return $this->layout();
    }

    public function editarParcela()
    {
        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar parcelas de clientes.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $idParcela = $this->uri->segment(3);
        $idCliente = $this->uri->segment(4);

        if ($this->form_validation->run('parcelas') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = [
                'codigo' => $this->input->post('codigo'),
            ];


            if ($this->clientes_model->edit('parcelas', $data, 'idParcelas', $idParcela) == true) {
                $this->session->set_flashdata('success', 'Parcela editada com sucesso!');
                log_info('Alterou uma parcela do cliente. ID' . $idCliente);
                redirect(site_url('clientes/visualizar/') . $idCliente);
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }

        }

        $this->data['result'] = $this->clientes_model->getParcela($idParcela);
        $this->data['view'] = 'clientes/editarParcela';

        return $this->layout();
    }

    public function proximaEtapa()
    {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para promover clientes.');
            redirect(base_url());
        }

        $idContrato = $this->uri->segment(3);
        $etapaAtual = $this->uri->segment(4);
        $idCliente = $this->uri->segment(5);
        $etapa = $this->uri->segment(6);

        $etapa_atual_nome = $this->input->post('etapa_atual');
        $etapa_promovida_nome = $this->input->post('etapa_promovida');

        if ($idContrato == null || $etapaAtual == null) {
            $this->session->set_flashdata('error', 'Erro ao tentar promover cliente.');
            redirect(site_url('clientes/gerenciar/'));
        }

        $this->clientes_model->proximaEtapa($idContrato, $etapaAtual);
        log_info('Promoveu um cliente. Contrato ID' . $idContrato);

        $data = [
            'usuario' => $this->session->userdata('nome_admin'),
            'nota' => 'Promoveu o contrato de ' . $etapa_atual_nome . ' para ' . $etapa_promovida_nome,
            'etapa' => urldecode($etapa),
            'data' => date('d-m-Y'),
            'hora' => date('H:i:s')
        ];

        $this->clientes_model->adicionarLog($data, $idCliente, $idContrato);

        $this->session->set_flashdata('success', 'Cliente promovido com sucesso!');
        redirect(site_url('clientes/visualizar/' . $idCliente));

    }

    public function vincularEndereco()
    {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para vincular endereços a clientes.');
            redirect(base_url());
        }

        $idContrato = $this->uri->segment(3);
        $idCliente = $this->uri->segment(4);
        $etapa = $this->uri->segment(5);

        if ($idContrato == null) {
            $this->session->set_flashdata('error', 'Erro ao tentar vincular endereço a cliente.');
            redirect(site_url('clientes/gerenciar/'));
        }

        $this->clientes_model->vincularEndereco($idContrato, 'vincular', null);
        log_info('Vinculou um endereço a um cliente. ID' . $idCliente);

        $data = [
            'usuario' => $this->session->userdata('nome_admin'),
            'nota' => 'Vinculou o endereço principal',
            'etapa' => urldecode($etapa),
            'data' => date('d-m-Y'),
            'hora' => date('H:i:s')
        ];

        $this->clientes_model->adicionarLog($data, $idCliente, $idContrato);

        $this->session->set_flashdata('success', 'Endereco vinculado com sucesso!');
        redirect(site_url('clientes/visualizar/' . $idCliente));

    }

    public function excluirEndereco()
    {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para vincular endereços a clientes.');
            redirect(base_url());
        }

        $idContrato = $this->uri->segment(3);
        $idEndereco = $this->uri->segment(4);
        $idCliente = $this->uri->segment(5);
        $etapa = $this->uri->segment(6);

        if ($idContrato == null && $idEndereco == null) {
            $this->session->set_flashdata('error', 'Erro ao tentar vincular endereço a cliente.');
            redirect(site_url('clientes/gerenciar/'));
        }

        $this->clientes_model->excluirEndereco($idContrato, $idEndereco);
        log_info('Excluiu um endereço de um cliente. ID' . $idCliente);

        $data = [
            'usuario' => $this->session->userdata('nome_admin'),
            'nota' => 'Excluiu um endereço',
            'etapa' => urldecode($etapa),
            'data' => date('d-m-Y'),
            'hora' => date('H:i:s')
        ];

        $this->clientes_model->adicionarLog($data, $idCliente, $idContrato);

        $this->session->set_flashdata('success', 'Endereço excluído com sucesso!');
        redirect(site_url('clientes/visualizar/' . $idCliente));

    }

    public function adicionarEndereco()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar endereço a clientes.');
            redirect(base_url());
        }

        $idContrato = $this->uri->segment(3);
        $idCliente = $this->uri->segment(4);
        $etapa = $this->uri->segment(5);

        //echo '<script>console.log("' . $idContrato . '");</script>';

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('adicionarEndereco') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = [
                'rua' => set_value('rua'),
                'numero' => set_value('numero'),
                'complemento' => set_value('complemento'),
                'bairro' => set_value('bairro'),
                'cidade' => set_value('cidade'),
                'estado' => set_value('estado'),
                'cep' => set_value('cep'),
            ];

            if ($this->clientes_model->vincularEndereco($idContrato, 'adicionar', $data) == true) {

                $data = [
                    'usuario' => $this->session->userdata('nome_admin'),
                    'nota' => 'Adicionou um endereço',
                    'etapa' => urldecode($etapa),
                    'data' => date('d-m-Y'),
                    'hora' => date('H:i:s')
                ];
        
                $this->clientes_model->adicionarLog($data, $idCliente, $idContrato);

                $this->session->set_flashdata('success', 'Endereço adicionado com sucesso!');
                log_info('Adicionou um cliente.');
                redirect(site_url('clientes/'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        $this->data['view'] = 'clientes/adicionarEndereco';

        return $this->layout();
    }

    public function relatarPendencia()
    {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para relatar pendências de clientes.');
            redirect(base_url());
        }

        $idContrato = $this->uri->segment(3);
        $idCliente = $this->uri->segment(4);
        $etapa = $this->uri->segment(5);

        $etapa_atual_nome = $this->input->post('etapa_atual');

        if ($idContrato == null || $etapa_atual_nome == null) {
            $this->session->set_flashdata('error', 'Erro ao tentar relatar pendência de cliente.');
            redirect(site_url('clientes/gerenciar/'));
        }

        $dataPendencia = [
            'etapaPendencia' => $etapa_atual_nome,
            'justificativa' => $this->input->post('justificativa')
        ];

        $this->clientes_model->relatarPendencia($idContrato, $idCliente, $dataPendencia);
        log_info('Relatou uma pendência a um contrato. ID' . $idContrato);

        $data = [
            'usuario' => $this->session->userdata('nome_admin'),
            'nota' => 'Relatou uma pendência',
            'etapa' => urldecode($etapa),
            'data' => date('d-m-Y'),
            'hora' => date('H:i:s')
        ];

        $this->clientes_model->adicionarLog($data, $idCliente, $idContrato);

        $this->session->set_flashdata('success', 'Pendência relatada com sucesso!');
        redirect(site_url('clientes/visualizar/' . $idCliente));

    }


    public function visualizar()
    {
        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar clientes.');
            redirect(base_url());
        }

        $this->data['custom_error'] = '';
        $this->data['result'] = $this->clientes_model->getById($this->uri->segment(3));
        $this->data['contratos'] = $this->clientes_model->getContratoById($this->data['result']->idClientes);

        $indexContratos = 1;
        foreach ($this->data['contratos'] as $contrato) {
            if ($contrato->idFinanceiro) {
                $this->data['financeiro_cliente_' . $indexContratos] = $this->clientes_model->getFinanceiroCliente($contrato->idFinanceiro);
                $this->data['parcelas_cliente_' . $indexContratos] = $this->clientes_model->getParcelasCliente($this->data['result']->idClientes);
            } else {
                $this->data['financeiro_cliente_' . $indexContratos] = null;
                $this->data['parcelas_cliente_' . $indexContratos] = null;
            }
            if ($contrato->idFornecedor) {
                $this->data['fornecedor_cliente_' . $indexContratos] = $this->clientes_model->getFornecedorCliente($contrato->idFornecedor);
            } else {
                $this->data['fornecedor_cliente_' . $indexContratos] = null;
            }

            if ($contrato->idPendencia) {
                $this->data['motivo_pendencia_' . $indexContratos] = $this->clientes_model->getMotivoPendencia($contrato->idContratos)[0];
            }

            $indexContratos++;
        }

        $this->data['notas_clientes'] = $this->clientes_model->getNotas($this->data['result']->idClientes);
        $this->data['enderecos'] = $this->clientes_model->getEnderecos($this->data['result']->idClientes);

        $this->data['os_cliente'] = $this->clientes_model->getOsCliente($this->data['result']->idClientes);

        //$this->data['financeiro_cliente'] ? $this->data['parcelas_cliente'] = $this->clientes_model->getParcelasCliente($this->data['result']->idClientes) : $this->data['parcelas_cliente'] = false;

        //$this->data['results'] = $this->clientes_model->getOsByCliente($this->uri->segment(3));
        $this->data['etapa_atual'] = $this->clientes_model->getEtapas();
        $this->data['results_arquivos_financeiro'] = $this->clientes_model->getAllArquivos('', $this->data['result']->idClientes, 'financeiro');
        $this->data['results_arquivos_evidencias'] = $this->clientes_model->getAllArquivos('', $this->data['result']->idClientes, 'evidencias');
        $this->data['results_arquivos_contratos'] = $this->clientes_model->getAllArquivos('', $this->data['result']->idClientes, 'contratos');
        $this->data['view'] = 'clientes/visualizar';

        return $this->layout();
    }

    public function excluir()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir clientes.');
            redirect(base_url());
        }

        $id = $this->input->post('id');
        if ($id == null) {
            $this->session->set_flashdata('error', 'Erro ao tentar excluir cliente.');
            redirect(site_url('clientes/gerenciar/'));
        }

        $os = $this->clientes_model->getAllOsByClient($id);
        if ($os != null) {
            $this->clientes_model->removeClientOs($os);
        }

        // excluindo Vendas vinculadas ao cliente
        $vendas = $this->clientes_model->getAllVendasByClient($id);
        if ($vendas != null) {
            $this->clientes_model->removeClientVendas($vendas);
        }

        $this->clientes_model->delete('clientes', 'idClientes', $id);
        log_info('Removeu um cliente. ID' . $id);

        $this->session->set_flashdata('success', 'Cliente excluido com sucesso!');
        redirect(site_url('clientes/gerenciar/'));
    }

    public function importar()
    {
        if ($_FILES['arquivo']) {
            try {
                $resultado = $this->clientes_model->importar_clientes($_FILES['arquivo']);

                $erros_detalhados_str = '';
                if (!empty($resultado['erros_detalhados'])) {
                    $erros_detalhados_str = ' Erros detalhados:<br>' . implode('<br>', $resultado['erros_detalhados']);
                }

                $this->session->set_flashdata('success', "{$resultado['importadas']} linhas importadas com sucesso. {$resultado['erro']} linhas com erro.<br>{$erros_detalhados_str}");
            } catch (Exception $e) {
                $this->session->set_flashdata('error', 'Erro ao importar: ' . $e->getMessage());
            }
            redirect('clientes');
        } else {
            $this->load->view('importar_cliente');
        }
    }
}
