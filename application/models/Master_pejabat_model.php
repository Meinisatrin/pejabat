<?php
class Master_pejabat_model extends CI_Model
{

    public function get_pejabat_options() {
        $this->db->select('id, nama'); // Kolom yang ingin Anda tampilkan sebagai pilihan
        $query = $this->db->get('master_pejabat');
        return $query->result();
    }
    
    public function get_by_id($id)
    {
        return $this->db->get_where('master_pejabat', array('id' => $id))->row();
    }

    public function insert($data)
    {
        $this->db->insert('master_pejabat', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('master_pejabat', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('master_pejabat');
    }

	public function get_total_records() {
        return $this->db->count_all('master_pejabat');
    }

    public function get_filtered_records($search) {
        $this->db->like('nama', $search); // kolom yang ingin Anda cari
        return $this->db->get('master_pejabat')->num_rows();
    }

    public function get_data($start, $length, $search) {
        $this->db->select('*');
        $this->db->from('master_pejabat');
        if (!empty($search)) {
            $this->db->like('nama', $search); 
        }
            $this->db->order_by('id', 'asc'); 
            $this->db->limit($length, $start);
            return $this->db->get()->result();
    }


    public function get_data_paginated($search, $page, $page_limit) {
        $offset = ($page - 1) * $page_limit;

        $this->db->select('id, nama'); // Sesuaikan kolom yang ingin diambil
        $this->db->from('master_pejabat'); // Ganti dengan nama tabel yang sesuai
        if ($search) {
            $this->db->like('nama', $search); // Gunakan kriteria pencarian
        }
        $this->db->limit($page_limit, $offset);

        $query = $this->db->get();
        return $query->result();
    }
	
	

    public function get_total_count($search) {
        $this->db->from('master_pejabat'); // Ganti dengan nama tabel yang sesuai
        if ($search) {
            $this->db->like('nama', $search); // Gunakan kriteria pencarian
        }
        return $this->db->count_all_results();
    }

}
