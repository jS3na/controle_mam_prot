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

        if ($where !== '') {
            $this->db->group_start(); //inicia o grupo de filtros
            $this->db->like('nomeCliente', $where);
            $this->db->or_like('documento', $where);
            $this->db->or_like('email', $where);
            $this->db->or_like('telefone', $where);
            $this->db->or_like('cidade', $where);
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
            echo '<script>console.log("Erro ao executar a query.")</script>';
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
            echo '<script>console.log("Erro ao executar a query.")</script>';
            return false;
        }

        $result = $query->row();

        if ($result && isset($result->enderecos)) {
            $enderecos = json_decode($result->enderecos, true);
            return $enderecos;
        }

        return [];
    }

    public function getMotivoPendencia($idCliente)
    {
        $this->db->select('*');
        $this->db->from('pendencias');
        $this->db->where('idCliente', $idCliente);
        $this->db->limit(1);
        $query = $this->db->get();

        echo '<script>console.log("' . json_encode($query->result()) . '")</script>';

        return $query->result();
    }

    public function getLogs($idCliente)
    {
        $this->db->select('*');
        $this->db->from('logs_cliente');
        $this->db->where('idCliente', $idCliente);
        $this->db->order_by('data', 'desc');
        $this->db->order_by('hora', 'desc');
        $query = $this->db->get();

        return $query->result();
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

    public function proximaEtapa($idCliente, $etapaAtual)
    {
        $this->db->where('idClientes', $idCliente);
        $this->db->set('etapa', $etapaAtual + 1);

        $this->db->update('clientes');
    }

    public function relatarPendencia($idCliente, $data)
    {
        $this->db->where('idClientes', $idCliente);
        $this->db->set('pendencia', 1);

        $this->db->update('clientes');

        $this->db->insert('pendencias', $data);
        if ($this->db->affected_rows() == '1') {
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

    public function vincularFornecedor($idCliente, $data)
    {

        $table = 'fornecedor_cliente';

        $this->db->where('idCliente', $idCliente);
        $query = $this->db->get($table);

        if ($query->num_rows() > 0) {

            $this->db->where('idCliente', $idCliente);
            $this->db->update($table, $data);

            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {

            $this->db->insert($table, $data);

            if ($this->db->affected_rows() == 1) {
                return $this->db->insert_id();
            } else {
                return false;
            }
        }
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



    public function add($table, $data)
    {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() == '1') {
            return $this->db->insert_id($table);
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

    public function getOsByCliente($id)
    {
        $this->db->where('clientes_id', $id);
        $this->db->order_by('idOs', 'desc');
        $this->db->limit(10);

        return $this->db->get('os')->result();
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
