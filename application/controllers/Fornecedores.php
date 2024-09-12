<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Fornecedores extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('fornecedores_model');
        $this->data['menuFornecedores'] = 'fornecedores';
    }

    public function index()
    {
        $this->gerenciar();
    }

    public function gerenciar()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar fornecedores.');
            redirect(base_url());
        }

        $pesquisa = $this->input->get('pesquisa');

        $this->load->library('pagination');

        $this->data['configuration']['base_url'] = site_url('fornecedores/gerenciar/');
        $this->data['configuration']['total_rows'] = $this->fornecedores_model->count('fornecedores');
        if($pesquisa) {
            $this->data['configuration']['suffix'] = "?pesquisa={$pesquisa}";
            $this->data['configuration']['first_url'] = base_url("index.php/fornecedores")."\?pesquisa={$pesquisa}";
        }

        $this->pagination->initialize($this->data['configuration']);

        $this->data['results'] = $this->fornecedores_model->get('fornecedores', '*', $pesquisa, $this->data['configuration']['per_page'], $this->uri->segment(3));

        $this->data['view'] = 'fornecedores/fornecedores';

        return $this->layout();
    }

    public function adicionar()
    {

        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'aCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar fornecedores.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        //$senhaFornecedor = $this->input->post('senha') ? $this->input->post('senha') : preg_replace('/[^\p{L}\p{N}\s]/', '', set_value('documento'));

        $cpf_cnpj = preg_replace('/[^\p{L}\p{N}\s]/', '', set_value('documento'));

        if (strlen($cpf_cnpj) == 11) {
            $pessoa_fisica = true;
        } else {
            $pessoa_fisica = false;
        }

        if ($this->form_validation->run('fornecedores') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = [
                'nomeFornecedor' => set_value('nomeFornecedor'),
                'cnpj' => set_value('cnpj'),
                'descricao' => set_value('descricao'),
                'telefone_comercial' => set_value('telefone_comercial'),
                'telefone_financeiro' => set_value('telefone_financeiro'),
                'telefone_suporte' => set_value('telefone_suporte'),
                'email' => set_value('email'),
                //'senha' => password_hash($senhaFornecedor, PASSWORD_DEFAULT),
                'rua' => set_value('rua'),
                'numero' => set_value('numero'),
                'complemento' => set_value('complemento'),
                'bairro' => set_value('bairro'),
                'cidade' => set_value('cidade'),
                //'estado' => set_value('estado'),
                'cep' => set_value('cep'),
                'dataCadastro' => date('Y-m-d'),
            ];

            if ($this->fornecedores_model->add('fornecedores', $data) == true) {
                $this->session->set_flashdata('success', 'Fornecedor adicionado com sucesso!');
                log_info('Adicionou um fornecedor.');
                redirect(site_url('fornecedores/'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        $this->data['view'] = 'fornecedores/adicionarFornecedor';

        return $this->layout();
    }

    public function editar()
    {
        if (! $this->uri->segment(3) || ! is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }

        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar fornecedores.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('fornecedores') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $senha = $this->input->post('senha');
            if ($senha != null) {
                $senha = password_hash($senha, PASSWORD_DEFAULT);

                $data = [
                    'nomeFornecedor' => $this->input->post('nomeFornecedor'),
                    'cnpj' => $this->input->post('cnpj'),
                    'descricao' => $this->input->post('descricao'),
                    'telefone_comercial' => $this->input->post('telefone_comercial'),
                    'telefone_financeiro' => $this->input->post('telefone_financeiro'),
                    'telefone_suporte' => $this->input->post('telefone_suporte'),
                    'email' => $this->input->post('email'),
                    'rua' => $this->input->post('rua'),
                    'numero' => $this->input->post('numero'),
                    'complemento' => $this->input->post('complemento'),
                    'bairro' => $this->input->post('bairro'),
                    'cidade' => $this->input->post('cidade'),
                    'estado' => $this->input->post('estado'),
                    'cep' => $this->input->post('cep'),
                ];
            } else {
                $data = [
                    'nomeFornecedor' => $this->input->post('nomeFornecedor'),
                    'cnpj' => $this->input->post('cnpj'),
                    'descricao' => $this->input->post('descricao'),
                    'telefone_comercial' => $this->input->post('telefone_comercial'),
                    'telefone_financeiro' => $this->input->post('telefone_financeiro'),
                    'telefone_suporte' => $this->input->post('telefone_suporte'),
                    'email' => $this->input->post('email'),
                    'rua' => $this->input->post('rua'),
                    'numero' => $this->input->post('numero'),
                    'complemento' => $this->input->post('complemento'),
                    'bairro' => $this->input->post('bairro'),
                    'cidade' => $this->input->post('cidade'),
                    'estado' => $this->input->post('estado'),
                    'cep' => $this->input->post('cep'),
                ];
            }

            if ($this->fornecedores_model->edit('fornecedores', $data, 'idFornecedores', $this->input->post('idFornecedores')) == true) {
                $this->session->set_flashdata('success', 'Fornecedor editado com sucesso!');
                log_info('Alterou um fornecedor. ID' . $this->input->post('idFornecedores'));
                redirect(site_url('fornecedores/editar/') . $this->input->post('idFornecedores'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }

        $this->data['result'] = $this->fornecedores_model->getById($this->uri->segment(3));
        $this->data['view'] = 'fornecedores/editarFornecedor';

        return $this->layout();
    }

    public function visualizar()
{
    if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
        $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
        redirect('mapos');
    }

    if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')) {
        $this->session->set_flashdata('error', 'Você não tem permissão para visualizar fornecedores.');
        redirect(base_url());
    }

    $this->data['custom_error'] = '';
    $this->data['result'] = $this->fornecedores_model->getById($this->uri->segment(3));
    $this->data['clientes_vinculados'] = $this->fornecedores_model->getClientesVinculados($this->data['result']->idFornecedores);

    $clienteIds = array_column($this->data['clientes_vinculados'], 'idCliente'); // Extrair IDs dos clientes vinculados

    if (!empty($clienteIds)) {
        $this->data['clientes_by_id'] = $this->fornecedores_model->getClientesByIds($clienteIds);
    } else {
        $this->data['clientes_by_id'] = [];
        echo '<script>console.log("Nenhum cliente vinculado encontrado para o fornecedor com ID: ' . $this->data['result']->idFornecedores . '");</script>';
    }

    $this->data['view'] = 'fornecedores/visualizar';

    return $this->layout();
}


    public function excluir()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'dCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir fornecedores.');
            redirect(base_url());
        }

        $id = $this->input->post('id');
        if ($id == null) {
            $this->session->set_flashdata('error', 'Erro ao tentar excluir fornecedor.');
            redirect(site_url('fornecedores/gerenciar/'));
        }

        $this->fornecedores_model->delete('fornecedores', 'idFornecedores', $id);
        log_info('Removeu um fornecedor. ID' . $id);

        $this->session->set_flashdata('success', 'Fornecedor excluido com sucesso!');
        redirect(site_url('fornecedores/gerenciar/'));
    }
}
