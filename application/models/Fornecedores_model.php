<?php

class Fornecedores_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($table, $fields, $where = '', $perpage = 0, $start = 0, $one = false, $array = 'array')
    {
        $this->db->select($fields);
        $this->db->from($table);
        
        $this->db->join('fornecedor_endereco as en', 'fornecedores.idFornecedores = en.idFornecedor', 'inner');

        $this->db->group_by('idFornecedores');
        
        $this->db->order_by('idFornecedores', 'desc');
        $this->db->limit($perpage, $start);
        
        if ($where) {
            $this->db->like('nomeFornecedor', $where);
            $this->db->or_like('cnpj', $where);
            $this->db->or_like('en.cidade', $where);
        }
    
        $query = $this->db->get();

        echo '<script>console.log(' . json_encode($this->db->last_query()) . ');</script>';
    
        $result = !$one ? $query->result() : $query->row();
    
        return $result;
    }
    

    public function getClientesVinculados($idFornecedor)
    {
        $this->db->select('*');
        $this->db->from('fornecedor_cliente');
        $this->db->where('idFornecedor', $idFornecedor);
        $query = $this->db->get();
        
        $result = $query->result(); // Isso deve retornar todos os resultados como uma lista de objetos
        
        // Imprimir os dados no console para depuração
        echo '<script>console.log("Clientes Vinculados: ", ' . json_encode($result) . ');</script>';
        
        return $result; // Retorna todos os resultados
    }
    
    public function getClientesByIds($ids)
    {
        $this->db->select('*');
        $this->db->from('clientes');
        $this->db->where_in('idClientes', $ids); // Usa where_in para buscar múltiplos IDs
        $query = $this->db->get();
        
        $result = $query->result(); // Retorna todos os registros encontrados
        
        // Imprimir os dados no console para depuração
        echo '<script>console.log("Clientes por IDs: ", ' . json_encode($result) . ');</script>';
        
        return $result; // Retorna todos os resultados
    }

    public function getFornecedorEnderecoById($idFornecedor)
    {
        $this->db->select('*');
        $this->db->from('fornecedor_endereco');
        $this->db->where_in('idFornecedor', $idFornecedor);
        $query = $this->db->get();
        
        $result = $query->result();
        
        echo '<script>console.log("Endereços por IDs: ", ' . json_encode($result) . ');</script>';
        
        return $result;
    }

    public function getById($id)
    {
        $this->db->where('idFornecedores', $id);
        $this->db->limit(1);

        return $this->db->get('fornecedores')->row();
    }

    public function add($table, $data)
    {

        echo '<script>console.log("entrou");<script>';
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

}
