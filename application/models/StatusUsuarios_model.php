<?php

class StatusUsuarios_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($table, $fields, $where = '', $perpage = 0, $start = 0, $one = false, $array = 'array')
    {
        $this->db->select($fields);
        $this->db->from($table);
        
        $this->db->order_by('idUsuarios', 'desc');
        $this->db->limit($perpage, $start);
        
        if ($where) {
            $this->db->like('nome', $where);
            $this->db->or_like('cpf', $where);
            $this->db->or_like('email', $where);
        }
    
        $query = $this->db->get();
    
        $result = !$one ? $query->result() : $query->row();
    
        return $result;
    }

    public function getById($id)
    {
        $this->db->where('idUsuarios', $id);
        $this->db->limit(1);

        return $this->db->get('usuarios')->row();
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

    public function count($table)
    {
        return $this->db->count_all($table);
    }

}
