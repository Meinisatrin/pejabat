<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_pejabat_table
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->database();
    }

    public function create($data)
    {
        return $this->CI->db->insert('master_pejabat', $data);
    }

    public function cari_data_by_id($id)
    {
        return $this->CI->db->get_where('master_pejabat', array('id' => $id))->row();
    }

    public function tampilkan_semua_data()
    {
        return $this->CI->db->get('master_pejabat')->result();
    }

    public function update($id, $data)
    {
        $this->CI->db->where('id', $id);
        return $this->CI->db->update('master_pejabat', $data);
    }

    public function delete($id)
    {
        return $this->CI->db->delete('master_pejabat', array('id' => $id));
    }
}
