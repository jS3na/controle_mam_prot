<?php

class Clientes_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($table, $fields, $where = '', $etapa = '', $perpage = 0, $start = 0, $one = false, $array = 'array')
    {
        $this->db->select($fields);
        $this->db->from($table);
        //$this->db->where('responsavel', $this->session->userdata('nome_admin'));
        if ($this->session->userdata('permissao') != '1') {
            $this->db->where('pendencia !=', '1');
        }
        $this->db->order_by('idClientes', 'DESC');
        $this->db->limit($perpage, $start);

        /*
        if($this->session->userdata('nome_admin') == 'Admin'){
            echo '<script>console.log("teste")</script>';
        }
        */

        if ($where !== '') {
            $this->db->group_start(); //inicia o grupo de filtros
            $this->db->like('nomeCliente', $where);
            $this->db->or_like('documento', $where);
            $this->db->or_like('email', $where);
            $this->db->or_like('telefone', $where);
            $this->db->or_like('cidade', $where);
            $this->db->or_like('enderecos', $where);
            $this->db->group_end(); //fecha o grupo de filtros
        }

        if ($etapa !== '' && $etapa !== 'pendencias') {
            $this->db->like('etapa', $etapa);
        } elseif ($etapa !== '' && $etapa == 'pendencias') {
            $this->db->where('pendencia', '1');
        }

        $query = $this->db->get();

        $result = !$one ? $query->result() : $query->row();

        return $result;
    }

    public function getEtapas()
    {

        $this->db->select('valor');
        $this->db->from('configuracoes');
        $this->db->where('config', 'clientes_status_list');
        $query = $this->db->get();

        if ($query === false) {
            echo '<script>console.log("Erro ao executar a query.");</script>';
            return false;
        }

        $result = $query->row();

        $etapas = json_decode($result->valor, true);

        return $etapas;
    }

    public function getEnderecos($idCliente)
    {
        $this->db->select('enderecos');
        $this->db->from('clientes');
        $this->db->where('idClientes', $idCliente);
        $query = $this->db->get();

        if ($query === false) {
            echo '<script>console.log("Erro ao executar a query.");</script>';
            return false;
        }

        $result = $query->row();

        if ($result && isset($result->enderecos)) {
            $enderecos = json_decode($result->enderecos, true);
            return $enderecos;
        }

        return [];
    }

    public function getEnderecoById($idCliente, $idEndereco)
    {

        $this->db->select('enderecos');
        $this->db->from('clientes');
        $this->db->where('idClientes', $idCliente);
        $query = $this->db->get();

        if ($query === false) {
            echo '<script>console.log("Erro ao executar a query.");</script>';
            return false;
        }

        $result = $query->row();

        if ($result && isset($result->enderecos)) {
            $enderecos = json_decode($result->enderecos, true);

            if (is_array($enderecos)) {
                foreach ($enderecos as $endereco) {
                    if (isset($endereco['id']) && $endereco['id'] == $idEndereco) {
                        return $endereco;
                    }
                }
            }
        }

        return [];
    }


    public function getMotivoPendencia($idContrato)
    {

        $this->db->select('*');
        $this->db->from('contratos');
        $this->db->where('idContratos', $idContrato);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $idPendencia = $query->row()->idPendencia;
        } else {
            return null;
        }

        $this->db->select('*');
        $this->db->from('pendencias');
        $this->db->where('idPendencia', $idPendencia);
        $this->db->order_by('idPendencia', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->result();

    }

    public function getNotas($idCliente)
    {
        $this->db->select('notas');
        $this->db->from('clientes');
        $this->db->where('idClientes', $idCliente);
        $query = $this->db->get();

        if ($query === false) {
            echo '<script>console.log("Erro ao executar a query.");</script>';
            return false;
        }

        $result = $query->row();

        if ($result && isset($result->notas)) {
            $notas = json_decode($result->notas, true);
            return $notas;
        }

        return false;
    }

    public function getUsuarios()
    {
        $this->db->select('*');
        $this->db->from('usuarios');
        $query = $this->db->get();

        return $query->result();
    }

    public function getAllArquivos($where = '', $idReferencia, $secao)
    {
        $this->db->select('*');
        $this->db->from('documentos');
        $this->db->where('categoria', 'clientes');
        $this->db->where('idReferencia', $idReferencia);
        $this->db->where('secao', $secao);
        if ($where) {
            $this->db->where($where);
        }

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    public function getFornecedorCliente($idFornecedores)
    {

        $this->db->select('*');
        $this->db->from('fornecedores');
        $this->db->where('idFornecedores', $idFornecedores);
        $query = $this->db->get();

        return $query->result();

    }

    public function excluirItemContrato($idAlvo, $idContrato)
    {

        $this->db->where('idContratos', $idContrato);
        $this->db->set($idAlvo, null);

        $this->db->update('contratos');

    }

    public function vincularFornecedor($idContrato, $idFornecedor)
    {

        $this->db->where('idContratos', $idContrato);
        $this->db->set('idFornecedor', $idFornecedor);

        $this->db->update('contratos');

        return true;

    }

    public function getFinanceiroCliente($idFinanceiro)
    {
        $this->db->select('*');
        $this->db->from('financeiro_cliente');
        $this->db->where('idFinanceiroCliente', $idFinanceiro);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOsCliente($idCliente)
    {
        $this->db->select('*');
        $this->db->from('os');
        $this->db->where('clientes_id', $idCliente);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getParcelasCliente($idCliente)
    {
        $this->db->select('*');
        $this->db->from('parcelas');
        $this->db->where('idCliente', $idCliente);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getFornecedorById($idFornecedor)
    {
        $this->db->select('*');
        $this->db->from('fornecedores');
        $this->db->where('idFornecedores', $idFornecedor);
        $query = $this->db->get();

        return $query->result();
    }

    public function aprovarParcela($idParcela, $meioPagamento, $valorJuros)
    {
        $this->db->where('idParcelas', $idParcela);
        $this->db->set('pago', 1);
        $this->db->set('meio_pagamento', $meioPagamento);
        $this->db->set('data_pagamento', date('Y-m-d'));

        if ($valorJuros > 0) {
            $this->db->set('valorPago', 'valor + ' . (float) $valorJuros, FALSE);
        } else {
            $this->db->set('valorPago', 'valor', FALSE);
        }

        $this->db->update('parcelas');
    }

    public function proximaEtapa($idContrato, $etapaAtual)
    {
        $this->db->where('idContratos', $idContrato);
        $this->db->set('idEtapa', $etapaAtual + 1);

        $this->db->update('contratos');
    }

    public function relatarPendencia($idContrato, $idCliente, $data)
    {
        $this->db->where('idClientes', $idCliente);
        $this->db->set('pendencia', 1);

        $this->db->update('clientes');

        $this->db->insert('pendencias', $data);
        if ($this->db->affected_rows() == '1') {
            $idPendencia = $this->db->insert_id('pendencias');

            $this->db->where('idContratos', $idContrato);
            $this->db->set('idPendencia', $idPendencia);

            $this->db->update('contratos');

            return $this->db->insert_id('pendencias');
        }

        return false;
    }

    public function autoCompleteFornecedor($q)
    {
        $this->db->select('*');
        $this->db->limit(25);
        $this->db->like('nomeFornecedor', $q);
        $this->db->or_like('telefone_comercial', $q);
        $query = $this->db->get('fornecedores');
        $row_set = [];
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row_set[] = [
                    'label' => $row['nomeFornecedor'] . ' | Telefone: ' . $row['telefone_comercial'],
                    'id' => $row['idFornecedores']
                ];
            }
        }
        return $row_set;
    }

    public function getById($id)
    {
        $this->db->where('idClientes', $id);
        $this->db->limit(1);

        return $this->db->get('clientes')->row();
    }

    public function getContratoById($idCliente)
    {
        $this->db->select('*');
        $this->db->from('contratos');
        $this->db->where('idCliente', $idCliente);
        $query = $this->db->get();

        return $query->result();
    }

    public function getParcela($idParcela)
    {
        $this->db->where('idParcelas', $idParcela);
        $this->db->limit(1);

        return $this->db->get('parcelas')->row();
    }

    public function vincularEndereco($idContrato, $acao, $dataAdicionar)
    {
        $table = 'contratos';

        //$this->session->userdata('nome_admin')

        $this->db->where('idContratos', $idContrato);
        $query = $this->db->get($table);

        if ($query->num_rows() > 0) {

            $contrato = $query->row();

            $this->db->where('idClientes', $contrato->idCliente);
            $query_cliente = $this->db->get('clientes');

            $cliente = $query_cliente->row();

            if ($acao == 'vincular') {
                $data = ['idClienteEndereco' => 1];
                $this->db->where('idContratos', $idContrato);
                $this->db->update($table, $data);

                if ($this->db->affected_rows() > 0) {
                    return true;
                } else {
                    return false;
                }
            } elseif ($acao == 'adicionar') {

                $enderecos = json_decode($cliente->enderecos, true);

                $maiorId = 0;
                if (!empty($enderecos)) {
                    $maiorId = max(array_column($enderecos, 'id'));
                }

                $dataAdicionar['id'] = $maiorId + 1;

                $enderecos[] = $dataAdicionar;

                $data = ['enderecos' => json_encode($enderecos)];

                $this->db->where('idClientes', $contrato->idCliente);
                $this->db->update('clientes', $data);

                $data = ['idClienteEndereco' => count($enderecos)];

                $this->db->where('idContratos', $idContrato);
                $this->db->update($table, $data);

                //$this->session->userdata('nome_admin') = 'Admin';

                if ($this->db->affected_rows() > 0) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        return false;
    }

    public function adicionarLog($data, $idCliente, $idContrato)
    {

        $this->db->where('idClientes', $idCliente);
        $query_cliente = $this->db->get('clientes');

        if ($query_cliente->num_rows() > 0) {
            $cliente = $query_cliente->row();

            $this->db->where('idContratos', $idContrato);
            $query_contrato = $this->db->get('contratos');

            if ($query_contrato->num_rows() > 0) { 
                $contrato = $query_contrato->row();

                $notas = json_decode($cliente->notas, true);
                $idNotas = json_decode($contrato->idNotas, true);

                $maiorId = 0;
                if (!empty($notas)) {
                    $maiorId = max(array_column($notas, 'id'));
                }

                $data['id'] = $maiorId + 1;

                $notas[] = $data;

                $data_update = ['notas' => json_encode($notas)];
                $this->db->where('idClientes', $idCliente);
                $this->db->update('clientes', $data_update);

                if ($this->db->affected_rows() > 0) {
                    if (is_null($idNotas)) {
                        $idNotas = [];
                    }

                    $idNotas[] = $data['id'];

                    $data_contrato = ['idNotas' => json_encode($idNotas)];
                    $this->db->where('idContratos', $idContrato);
                    $this->db->update('contratos', $data_contrato);

                    if ($this->db->affected_rows() > 0) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    public function excluirEndereco($idContrato, $idEndereco)
    {
        $table = 'contratos';

        $this->db->where('idContratos', $idContrato);
        $query = $this->db->get($table);

        if ($query->num_rows() > 0) {

            $contrato = $query->row();

            if ($idEndereco != 1) {

                $this->db->where('idClientes', $contrato->idCliente);
                $query_cliente = $this->db->get('clientes');

                $cliente = $query_cliente->row();

                $enderecos = json_decode($cliente->enderecos, true);

                $enderecos_filtrados = array_filter($enderecos, function ($endereco) use ($idEndereco) {
                    return $endereco['id'] != $idEndereco;
                });

                $enderecos_filtrados = array_values($enderecos_filtrados);

                $data = ['enderecos' => json_encode($enderecos_filtrados)];
                $this->db->where('idClientes', $contrato->idCliente);
                $this->db->update('clientes', $data);

            }

            $data = ['idClienteEndereco' => null];
            $this->db->where('idContratos', $idContrato);
            $this->db->update($table, $data);

            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }

        return false;
    }

    public function add($table, $data)
    {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() == '1') {

            $idCliente = $this->db->insert_id($table);

            $dataContrato = [
                'idContratoCliente' => 1,
                'idCliente' => $idCliente,
                'idEtapa' => 1
            ];

            $this->db->insert('contratos', $dataContrato);

            return $this->db->insert_id('contratos');

        }

        return false;
    }

    public function addContrato($idCliente)
    {

        $this->db->select('*');
        $this->db->from('contratos');
        $this->db->where('idCliente', $idCliente);
        $this->db->order_by('idContratos', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            $ultimo_id = $query->row()->idContratoCliente;
        } else {
            $ultimo_id = 0;
        }

        $dataContrato = [
            'idContratoCliente' => $ultimo_id + 1,
            'idCliente' => $idCliente,
            'idEtapa' => 1
        ];

        $this->db->insert('contratos', $dataContrato);
    }


    public function addArquivo($table, $data, $idContrato)
    {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() == '1') {

            $idArquivo = $this->db->insert_id($table);

            $this->db->where('idContratos', $idContrato);
            $query_contrato = $this->db->get('contratos');

            if ($query_contrato->num_rows() > 0) {
                $contrato = $query_contrato->row();

                $idArquivos = json_decode($contrato->idArquivos, true) ?? [];

                $idArquivos[] = $idArquivo;

                log_info(json_encode($idArquivos));

                $this->db->where('idContratos', $idContrato);
                $this->db->update('contratos', ['idArquivos' => json_encode($idArquivos)]);
            }

            return true;
        }

        return false;
    }

    public function addFinanceiro($table, $data, $idContrato)
    {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() == '1') {

            $idFinanceiro = $this->db->insert_id($table);

            $this->db->where('idContratos', $idContrato);
            $query_contrato = $this->db->get('contratos');

            if ($query_contrato->num_rows() > 0) {

                $this->db->where('idContratos', $idContrato);
                $this->db->update('contratos', ['idFinanceiro' => $idFinanceiro]);
            }

            return true;
        }

        return false;
    }

    public function edit($table, $data, $fieldID, $ID)
    {
        $this->db->where($fieldID, $ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0) {
            return true;
        }

        return false;
    }

    public function editEndereco($data, $idEndereco, $idCliente)
    {

        $this->db->select('enderecos');
        $this->db->from('clientes');
        $this->db->where('idClientes', $idCliente);
        $query = $this->db->get();
        
        if ($query === false) {
            return false;
        }
    
        $result = $query->row();
    
        if ($result && isset($result->enderecos)) {

            $enderecos = json_decode($result->enderecos, true);
    
            $atualizado = false;
            foreach ($enderecos as &$endereco) {
                if ($endereco['id'] == $idEndereco) {

                    $endereco['rua'] = $data['rua'];
                    $endereco['numero'] = $data['numero'];
                    $endereco['complemento'] = $data['complemento'];
                    $endereco['bairro'] = $data['bairro'];
                    $endereco['cidade'] = $data['cidade'];
                    $endereco['estado'] = $data['estado'];
                    $endereco['cep'] = $data['cep'];
                    $atualizado = true;
                    break;
                }
            }
    
            if ($atualizado) {
                $enderecosAtualizados = json_encode($enderecos);
    
                $this->db->where('idClientes', $idCliente);
                $this->db->update('clientes', ['enderecos' => $enderecosAtualizados]);
    
                if ($this->db->affected_rows() >= 0) {
                    return true;
                }
            }
        }
    
        return false;
    }
    

    public function delete($table, $fieldID, $ID)
    {
        $this->db->where($fieldID, $ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1') {
            return true;
        }

        return false;
    }

    public function count($table)
    {
        return $this->db->count_all($table);
    }

    /**
     * Retorna todas as OS vinculados ao cliente
     *
     * @param  int  $id
     * @return array
     */
    public function getAllOsByClient($id)
    {
        $this->db->where('clientes_id', $id);

        return $this->db->get('os')->result();
    }

    /**
     * Remover todas as OS por cliente
     *
     * @param  array  $os
     * @return bool
     */
    public function removeClientOs($os)
    {
        try {
            foreach ($os as $o) {
                $this->db->where('os_id', $o->idOs);
                $this->db->delete('servicos_os');

                $this->db->where('os_id', $o->idOs);
                $this->db->delete('produtos_os');

                $this->db->where('idOs', $o->idOs);
                $this->db->delete('os');
            }
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * Retorna todas as Vendas vinculados ao cliente
     *
     * @param  int  $id
     * @return array
     */
    public function getAllVendasByClient($id)
    {
        $this->db->where('clientes_id', $id);

        return $this->db->get('vendas')->result();
    }

    /**
     * Remover todas as Vendas por cliente
     *
     * @param  array  $vendas
     * @return bool
     */
    public function removeClientVendas($vendas)
    {
        try {
            foreach ($vendas as $v) {
                $this->db->where('vendas_id', $v->idVendas);
                $this->db->delete('itens_de_vendas');

                $this->db->where('idVendas', $v->idVendas);
                $this->db->delete('vendas');
            }
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    public function importar_clientes($arquivo)
    {
        $linhas_importadas = 0;
        $linhas_erro = 0;
        $erros_detalhados = [];

        $dados_arquivo = fopen($arquivo['tmp_name'], 'r');

        $query_cliente = "INSERT INTO clientes(nomeCliente, telefone, email, dataCadastro, rua, numero, bairro, cidade, estado, cep, status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->trans_start();
        if ($stmt = $this->db->conn_id->prepare($query_cliente)) {

            $header = fgetcsv($dados_arquivo, 1000, ';');

            while ($linha = fgetcsv($dados_arquivo, 1000, ';')) {
                array_walk_recursive($linha, 'converter');

                $nomeCliente = $linha[1] . ' ' . $linha[2];

                $stmt->bind_param(
                    'sssssssssss',
                    $nomeCliente,
                    $linha[9],
                    $linha[10],
                    date('Y-m-d'),
                    $linha[3],
                    $linha[4],
                    $linha[6],
                    $linha[5],
                    $linha[8],
                    $linha[9],
                    $linha[0]
                );

                if ($stmt->execute()) {
                    if ($stmt->affected_rows > 0) {
                        $linhas_importadas++;
                    } else {
                        $linhas_erro++;
                        $erros_detalhados[] = "Linha {$linhas_erro}: Erro desconhecido para o cliente com ID " . ($linha[0] ?? 'NULL');
                    }
                } else {
                    $linhas_erro++;
                    $erros_detalhados[] = "Linha {$linhas_erro}: " . $stmt->error . " (Cliente ID: " . ($linha[0] ?? 'NULL') . ")";
                }
            }

            $stmt->close();
        } else {
            throw new Exception("Failed to prepare the SQL statement: " . $this->db->conn_id->error);
        }

        fclose($dados_arquivo);

        $this->db->trans_complete();

        return [
            'importadas' => $linhas_importadas,
            'erro' => $linhas_erro,
            'erros_detalhados' => $erros_detalhados,
        ];
    }
}

function converter(&$dados_arquivo)
{
    $dados_arquivo = mb_convert_encoding($dados_arquivo, "UTF-8", "ISO-8859-1");
}
