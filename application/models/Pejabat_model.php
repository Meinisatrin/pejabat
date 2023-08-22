<?php
class Pejabat_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    // public function get_jabatan_list() {
    //     $query = $this->db->get('master_pejabat');
    //     return $query->result();
    // }

    public function get_all()
    {
        // return $this->db->get('pejabat')->result();
        $this->db->select('pejabat.*, master_pejabat.nama as master_pejabat_name');
        $this->db->from('pejabat');
        $this->db->join('master_pejabat', 'pejabat.m_pejabat_id = master_pejabat.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('pejabat', array('id' => $id))->row();
    }

    public function insert($data)
    {
        $this->db->insert('pejabat', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('pejabat', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pejabat');
    }

	public function get_data($start, $length, $search) {
        $this->db->select('pejabat.*, master_pejabat.nama AS nama_master');
        $this->db->from('pejabat');
        $this->db->join('master_pejabat', 'pejabat.m_pejabat_id = master_pejabat.id', 'left');            
        if (!empty($search)) {
            $this->db->like('pejabat.nama', $search); // kolom yang ingin dicari
            $this->db->or_like('pejabat.alamat', $search);
            $this->db->or_like('master_pejabat.nama', $search);
        }
        $this->db->order_by('id', 'asc'); //mengurutkan data berdasarkan id
        $this->db->limit($length, $start);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_total_records() {
        return $this->db->count_all('pejabat'); 
    }

    //pencarian di datatables
    public function get_filtered_records($search) {
        $this->db->join('master_pejabat', 'pejabat.m_pejabat_id = master_pejabat.id', 'left');  

        $this->db->like('pejabat.nama', $search); //kolom yang mau dicari
        $this->db->or_like('pejabat.alamat', $search);
        $this->db->or_like('master_pejabat.nama', $search);
        return $this->db->get('pejabat')->num_rows();  
    }

    public function get_data_paginated($search, $page, $page_limit) {
        $offset = ($page - 1) * $page_limit;

        $this->db->select('id, nama'); 
        $this->db->from('master_pejabat'); 
        if ($search) {
            $this->db->like('nama', $search); 
        }
        $this->db->limit($page_limit, $offset);

        $query = $this->db->get();
        return $query->result();
    }

    public function get_total_count($search) {
        $this->db->from('master_pejabat'); 
        if ($search) {
            $this->db->like('nama', $search); 
        }
        return $this->db->count_all_results();
    }


}
