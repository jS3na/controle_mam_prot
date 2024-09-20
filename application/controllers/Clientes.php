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
        $status = $this->input->get('status');

        $this->load->library('pagination');

        $this->data['configuration']['base_url'] = site_url('clientes/gerenciar/');
        $this->data['configuration']['total_rows'] = $this->clientes_model->count('clientes');
        if ($pesquisa) {
            $this->data['configuration']['suffix'] = "?pesquisa={$pesquisa}&status={$status}";
            $this->data['configuration']['first_url'] = base_url("index.php/clientes") . "?pesquisa={$pesquisa}&status={$status}";
        } else if ($status) {
            $this->data['configuration']['suffix'] = "?status={$status}";
            $this->data['configuration']['first_url'] = base_url("index.php/clientes") . "?status={$status}";
        }

        $this->pagination->initialize($this->data['configuration']);

        $this->data['results'] = $this->clientes_model->get('clientes', '*', $pesquisa, $status, $this->data['configuration']['per_page'], $this->uri->segment(3));

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

            if ($this->clientes_model->add('documentos', $data) == true) {
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

        $cpf_cnpj = preg_replace('/[^\p{L}\p{N}\s]/', '', set_value('documento'));

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
                'rua' => set_value('rua'),
                'numero' => set_value('numero'),
                'complemento' => set_value('complemento'),
                'bairro' => set_value('bairro'),
                'cidade' => set_value('cidade'),
                'estado' => set_value('estado'),
                'cep' => set_value('cep'),
                'status' => set_value('status'),
                'dataCadastro' => date('Y-m-d'),
                //'fornecedor' => (set_value('fornecedor') == true ? 1 : 0),
            ];

            if ($this->clientes_model->add('clientes', $data) == true) {
                $this->session->set_flashdata('success', 'Cliente adicionado com sucesso!');
                log_info('Adicionou um cliente.');
                redirect(site_url('clientes/'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        $this->data['view'] = 'clientes/adicionarCliente';

        return $this->layout();
    }

    public function vincularFornecedor()
    {
        echo "<script>console.log('entrou');</script>";

        // Verifica permissão
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para vincular o cliente ao fornecedor.');
            redirect(base_url());
        }

        // Carrega a biblioteca de validação de formulário
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        // Verifica a validação do formulário
        if ($this->form_validation->run('vincular') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error"> Preencha o campo do Fornecedor corretamente </div>' : false);
        } else {
            $data = [
                'idCliente' => set_value('idCliente'),
                'idFornecedor' => set_value('idFornecedor'),
            ];

            // Vincula o fornecedor e verifica se a operação foi bem-sucedida
            if ($this->clientes_model->vincularFornecedor($data['idCliente'], $data) == true) {
                $this->session->set_flashdata('success', 'Fornecedor vinculado com sucesso!');

                $dataLog = [
                    'idCliente' => set_value('idCliente'),
                    'usuario' => set_value('usuario'),
                    'tarefa' => 'Vinculou o Fornecedor com o id: ' . $data['idFornecedor'],
                    'status' => set_value('status'),
                ];

                // Adiciona o log
                $this->clientes_model->add('logs_cliente', $dataLog);

                log_info('Vinculou um cliente a um fornecedor.');
                redirect(site_url('clientes/visualizar/' . $data['idCliente']));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        // Carrega os dados do cliente e fornecedor
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

        // Verifica permissão
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para gerar financeiros');
            redirect(base_url());
        }

        // Carrega a biblioteca de validação de formulário
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        // Verifica a validação do formulário
        if ($this->form_validation->run('gerarFinanceiro') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error"> Preencha os campos corretamente </div>' : false);
        } else {

            $vencimento = $this->input->post('vencimento');
            $parcelas = $this->input->post('parcelas');
            $idCliente = $this->input->post('idCliente');
            $taxaInstalacao = $this->input->post('taxaInstalacao');
            $valorTotal = $this->input->post('valorTotal');

            // Convertendo a data do formato 'd/m/Y' para 'Y-m-d'
            try {
                $vencimento = DateTime::createFromFormat('d/m/Y', $vencimento);
                if (!$vencimento) {
                    throw new Exception('Data inválida');
                }
                // Formatando a data para o banco de dados
                $vencimentoFormatado = $vencimento->format('Y-m-d');
            } catch (Exception $e) {
                // Se houver erro, usa a data atual
                $vencimentoFormatado = date('Y-m-d');
            }

            $data = [
                'idCliente' => $idCliente,
                'parcelas' => $parcelas,
                'vencimento' => $vencimentoFormatado,
                'taxaInstalacao' => $taxaInstalacao,
                'valorTotal' => $valorTotal,
            ];

            if ($this->clientes_model->add('financeiro_cliente', $data) == true) {

                $valorPorParcela = $valorTotal / $parcelas;

                $vencimento = DateTime::createFromFormat('Y-m-d', $vencimentoFormatado);

                for ($i = 0; $i < $parcelas; $i++) {
                    $vencimento->modify('+1 month');
                    $vencimentoFormatado = $vencimento->format('Y-m-d'); // Use o formato 'Y-m-d' para o banco de dados
                    $valorAtual = $i == 0 ? $valorPorParcela + $taxaInstalacao : $valorPorParcela;

                    $dataParcela = [
                        'idCliente' => $idCliente,
                        'valor' => $valorAtual,
                        'vencimento' => $vencimentoFormatado, // Certifique-se de usar o formato correto
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

        // Carrega os dados do cliente
        $this->data['result'] = $this->clientes_model->getById($this->uri->segment(3));
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
        $meio_pagamento = $this->input->post('meio_pagamento');
        $valorJuros = $this->input->post('valorJuros');

        if ($idParcela == null) {
            $this->session->set_flashdata('error', 'Erro ao tentar aprovar parcela.');
            redirect(site_url('clientes/'));
        }

        $this->clientes_model->aprovarParcela($idParcela, $meio_pagamento, $valorJuros);
        log_info('Aprovou uma parcela. ID' . $idParcela);

        $this->session->set_flashdata('success', 'Parcela aprovada com sucesso!');
        redirect(site_url('clientes/visualizar/' . $this->uri->segment(3)));
    }

    public function adicionarParcelaUnica()
    {

        // Verifica permissão
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar parcelas');
            redirect(base_url());
        }

        // Carrega a biblioteca de validação de formulário
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        // Verifica a validação do formulário
        if ($this->form_validation->run('adicionarParcelaUnica') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error"> Preencha os campos corretamente </div>' : false);
        } else {

            $vencimento = $this->input->post('vencimento');

            // Convertendo a data do formato 'd/m/Y' para 'Y-m-d'
            try {
                $vencimento = DateTime::createFromFormat('d/m/Y', $vencimento);
                if (!$vencimento) {
                    throw new Exception('Data inválida');
                }
                // Formatando a data para o banco de dados
                $vencimentoFormatado = $vencimento->format('Y-m-d');
            } catch (Exception $e) {
                // Se houver erro, usa a data atual
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

        // Carrega os dados do cliente
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
        if ($idCliente == null) {
            $this->session->set_flashdata('error', 'Erro ao tentar excluir financeiro.');
            redirect(site_url('clientes/gerenciar/'));
        }

        $this->clientes_model->delete('financeiro_cliente', 'idCliente', $idCliente);
        $this->clientes_model->delete('parcelas', 'idCliente', $idCliente);
        log_info('Removeu um financeiro do cliente: ' . $idCliente);

        $this->session->set_flashdata('success', 'Financeiro excluido com sucesso!');
        redirect(site_url('clientes/gerenciar/'));
    }

    public function adicionarLog()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar Logs.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('logs_cliente') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = [
                'idCliente' => set_value('idCliente'),
                'usuario' => set_value('usuario'),
                'tarefa' => set_value('log'),
                'status' => set_value('status'),
                //'data' => date('Y-m-d'),
                //'hora' => date('HH:MM:SS'),
                //'fornecedor' => (set_value('fornecedor') == true ? 1 : 0),
            ];

            if ($this->clientes_model->add('logs_cliente', $data) == true) {
                $this->session->set_flashdata('success', 'Nota adicionada adicionado com sucesso!');
                log_info('Adicionou um Log no Cliente.');
                redirect(site_url('clientes/visualizar/' . $data['idCliente']));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        $this->data['result'] = $this->clientes_model->getById($this->uri->segment(3));
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
                    'status' => $this->input->post('status'),
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
                    'status' => $this->input->post('status'),
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
        $this->data['view'] = 'clientes/editarCliente';

        return $this->layout();
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
        $this->data['logs_clientes'] = $this->clientes_model->getLogs($this->data['result']->idClientes);
        $this->data['fornecedor_cliente'] = $this->clientes_model->getFornecedorCliente($this->data['result']->idClientes);

        if ($this->data['fornecedor_cliente'] && isset($this->data['fornecedor_cliente']->idFornecedor)) {
            $this->data['fornecedor_by_id'] = $this->clientes_model->getFornecedorById($this->data['fornecedor_cliente']->idFornecedor);
        } else {
            $this->data['fornecedor_by_id'] = null;
        }

        $this->data['financeiro_cliente'] = $this->clientes_model->getFinanceiroCliente($this->data['result']->idClientes);

        $this->data['financeiro_cliente'] ? $this->data['parcelas_cliente'] = $this->clientes_model->getParcelasCliente($this->data['result']->idClientes) : $this->data['parcelas_cliente'] = false;

        $this->data['results'] = $this->clientes_model->getOsByCliente($this->uri->segment(3));
        $this->data['result_vendas'] = $this->clientes_model->getAllVendasByClient($this->uri->segment(3));
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
