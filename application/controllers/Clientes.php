<?php

if (! defined('BASEPATH')) {
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
        if($pesquisa) {
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
    

    public function adicionar()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'aCliente')) {
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
    
    public function adicionarLog()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
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

    public function gerarFinanceiro()
    {
        echo "<script>console.log('entrou');</script>";
    
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

            try {
                $vencimento = explode('/', $vencimento);
                $vencimento = $vencimento[2] . '-' . $vencimento[1] . '-' . $vencimento[0];
            } catch (Exception $e) {
                $vencimento = date('Y/m/d');
                $dataFinal = date('Y/m/d');
            }
    
            $data = [
                'idCliente' => set_value('idCliente'),
                'parcelas' => set_value('parcelas'),
                'vencimento' => $vencimento,
                'taxaInstalacao' => set_value('taxaInstalacao'),
                'valorTotal' => set_value('valorTotal'),
                'responsavel' => set_value('responsavel'),
            ];

            if ($this->clientes_model->add('financeiro_cliente', $data) == true) {
                $this->session->set_flashdata('success', 'Financeiro gerado com sucesso!');
                log_info('Gerou um financeiro a um cliente.');
                redirect(site_url('clientes/visualizar/' . $data['idCliente']));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }

        }
    
        // Carrega os dados do cliente e fornecedor
        $this->data['result'] = $this->clientes_model->getById($this->uri->segment(3));
    
        $this->data['view'] = 'clientes/gerarFinanceiro';
    
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
        if (! $this->uri->segment(3) || ! is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }

        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
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
        if (! $this->uri->segment(3) || ! is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }

        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')) {
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

        $this->data['results'] = $this->clientes_model->getOsByCliente($this->uri->segment(3));
        $this->data['result_vendas'] = $this->clientes_model->getAllVendasByClient($this->uri->segment(3));
        $this->data['view'] = 'clientes/visualizar';

        return $this->layout();
    }

    public function excluir()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'dCliente')) {
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
