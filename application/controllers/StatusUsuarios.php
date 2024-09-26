<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class StatusUsuarios extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('statusUsuarios_model');
        $this->data['menuStatusUsuarios'] = 'statususuarios';
    }

    public function index()
    {
        $this->gerenciar();
    }

    public function gerenciar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vFornecedor')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar os Status dos Usuários.');
            redirect(base_url());
        }

        log_info('ENTROU status');

        $pesquisa = $this->input->get('pesquisa');

        $this->load->library('pagination');

        $this->data['configuration']['base_url'] = site_url('statusUsuarios/gerenciar/');
        $this->data['configuration']['total_rows'] = $this->statusUsuarios_model->count('usuarios');
        if ($pesquisa) {
            $this->data['configuration']['suffix'] = "?pesquisa={$pesquisa}";
            $this->data['configuration']['first_url'] = base_url("index.php/statususuarios") . "\?pesquisa={$pesquisa}";
        }

        $this->pagination->initialize($this->data['configuration']);

        $this->data['results'] = $this->statusUsuarios_model->get('usuarios', '*', $pesquisa, $this->data['configuration']['per_page'], $this->uri->segment(3));

        $this->data['view'] = 'statusUsuarios/statusUsuarios';

        return $this->layout();
    }

    public function editar()
    {
        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eFornecedor')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar Status dos Usuários.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('status_usuarios') == false) {
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
                    'sla_manutencao' => $this->input->post('sla_manutencao'),
                    'sla_instalacao' => $this->input->post('sla_instalacao'),
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
                    'sla_manutencao' => $this->input->post('sla_manutencao'),
                    'sla_instalacao' => $this->input->post('sla_instalacao'),
                ];
            }

            if ($this->statusUsuarios_model->edit('usuarios', $data, 'idUsuarios', $this->input->post('idUsuarios')) == true) {
                $this->session->set_flashdata('success', 'Usuário editado com sucesso!');
                log_info('Alterou um Usuário. ID' . $this->input->post('idUsuarios'));
                redirect(site_url('statususuarios/editar/') . $this->input->post('idUsuarios'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }

        $this->data['result'] = $this->statusUsuarios_model->getById($this->uri->segment(3));
        $this->data['view'] = 'statusUsuarios/editarStatusUsuarios';

        return $this->layout();
    }
}
