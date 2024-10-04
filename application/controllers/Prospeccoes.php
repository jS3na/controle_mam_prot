<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Prospeccoes extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->model('prospeccoes_model');
        $this->data['menuProspeccoes'] = 'Prospeccoes';
    }

    public function index()
    {
        $this->gerenciar();
    }

    public function gerenciar()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'vServico')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar prospeccoes.');
            redirect(base_url());
        }

        $pesquisa = $this->input->get('pesquisa');

        $this->load->library('pagination');

        $this->data['configuration']['base_url'] = site_url('prospeccoes/gerenciar/');
        $this->data['configuration']['total_rows'] = $this->prospeccoes_model->count('prospeccoes');
        if($pesquisa) {
            $this->data['configuration']['suffix'] = "?pesquisa={$pesquisa}";
            $this->data['configuration']['first_url'] = base_url("index.php/prospeccoes")."\?pesquisa={$pesquisa}";
        }

        $this->pagination->initialize($this->data['configuration']);

        $this->data['results'] = $this->prospeccoes_model->get('prospeccoes', '*', $pesquisa, $this->data['configuration']['per_page'], $this->uri->segment(3));

        $this->data['view'] = 'prospeccoes/prospeccoes';

        return $this->layout();
    }

    public function adicionar()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'aServico')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar prospeccoes.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('prospeccoes') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $preco = $this->input->post('preco');
            $preco = str_replace(',', '', $preco);

            $data = [
                'nome' => set_value('nome'),
                'descricao' => set_value('descricao'),
                'preco' => $preco,
            ];

            if ($this->prospeccoes_model->add('prospeccoes', $data) == true) {
                $this->session->set_flashdata('success', 'Prospeccao adicionado com sucesso!');
                log_info('Adicionou um prospeccao');
                redirect(site_url('prospeccoes/adicionar/'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['view'] = 'prospeccoes/adicionarProspeccao';

        return $this->layout();
    }

    public function editar()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'eServico')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar prospeccoes.');
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('prospeccoes') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $preco = $this->input->post('preco');
            $preco = str_replace(',', '', $preco);
            $data = [
                'nome' => $this->input->post('nome'),
                'descricao' => $this->input->post('descricao'),
                'preco' => $preco,
            ];

            if ($this->prospeccoes_model->edit('prospeccoes', $data, 'idProspeccoes', $this->input->post('idProspeccoes')) == true) {
                $this->session->set_flashdata('success', 'Prospeccao editado com sucesso!');
                log_info('Alterou um prospeccao. ID: ' . $this->input->post('idProspeccoes'));
                redirect(site_url('prospeccoes/editar/') . $this->input->post('idProspeccoes'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um errro.</p></div>';
            }
        }

        $this->data['result'] = $this->prospeccoes_model->getById($this->uri->segment(3));

        $this->data['view'] = 'prospeccoes/editarProspeccao';

        return $this->layout();
    }

    public function excluir()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'dServico')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir prospeccoes.');
            redirect(base_url());
        }

        $id = $this->input->post('id');
        if ($id == null) {
            $this->session->set_flashdata('error', 'Erro ao tentar excluir prospeccao.');
            redirect(site_url('prospeccoes/gerenciar/'));
        }

        $this->prospeccoes_model->delete('prospeccoes_os', 'prospeccoes_id', $id);
        $this->prospeccoes_model->delete('prospeccoes', 'idProspeccoes', $id);

        log_info('Removeu um prospeccao. ID: ' . $id);

        $this->session->set_flashdata('success', 'Prospeccao excluido com sucesso!');
        redirect(site_url('prospeccoes/gerenciar/'));
    }
}
