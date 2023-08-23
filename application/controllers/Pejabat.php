<?php
class Pejabat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pejabat_model');
        $this->load->model('Master_pejabat_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['pejabat'] = $this->Pejabat_model->get_all();
        $data['datetime_now'] = date('Y-m-d H:i:s');
        $this->load->view('pejabat_master/index', $data);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           $data = array(
               'nama' => $this->input->post('nama'),
               'jenis_kelamin' => $this->input->post('jenis_kelamin'),
               'alamat' => $this->input->post('alamat'),
               'm_pejabat_id' => $this->input->post('m_pejabat_id'),
       /*         $tglBuat => date('Y-m-d H:i:s'),
               $tglUbah => date('Y-m-d H:i:s') */
           );
            $this->Pejabat_model->insert($data);
            redirect('pejabat');//nama controller
        } else {
       
         //tambah
        $this->load->model('Master_pejabat_model');
        // $data['pejabat_options'] = $this->Master_pejabat_model->get_pejabat_options();
        
        $this->load->view('pejabat_master/create', $data);
        }        
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array(
                'nama' => $this->input->post('nama'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'alamat' => $this->input->post('alamat'),
                'm_pejabat_id' => $this->input->post('m_pejabat_id'),
                // 'tglBuat' => date('Y-m-d H:i:s'),
                // 'tglUbah' => date('Y-m-d H:i:s')
            );
            $this->Pejabat_model->update($id, $data);
            redirect('pejabat');
        } else {

            $this->load->model('Master_pejabat_model');
            $data['pejabat_options'] = $this->Master_pejabat_model->get_pejabat_options();
            $data['pejabat'] = $this->Pejabat_model->get_by_id($id);
            $this->load->view('pejabat_master/edit', $data);
        }
    }

    public function update($id) {
        $data = array(
            'nama' => $this->input->post('nama'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'alamat' => $this->input->post('alamat'),
            'm_pejabat_id' => $this->input->post('m_pejabat_id'),
        );
        $this->Pejabat_model-->update($id, $data);
        redirect('pejabat');
    }

    public function delete($id)
    {
        $this->Pejabat_model->delete($id);
        redirect('pejabat');
    }

	public function get_data() {
        $draw = $this->input->post('draw');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search')['value'];

        $recordsTotal = $this->Pejabat_model->get_total_records();
        $recordsFiltered = $this->Pejabat_model->get_filtered_records($search);
        $data = $this->Pejabat_model->get_data($start, $length, $search); 

        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $data
        );

        echo json_encode($response);
    }

    public function search_pejabat() {
        $this->load->model('Pejabat_model'); 

        $search = $this->input->get('q');
        $page = $this->input->get('page');
        $page_limit = 10; // JUMLAH DATA YANG TAMPIL

        $data = $this->Pejabat_model->get_data_paginated($search, $page, $page_limit);
        $total_count = $this->Pejabat_model->get_total_count($search);

        $response = array(
            'results' => array(),
            'pagination' => array(
                'more' => ($page * $page_limit) < $total_count
            )
        );

        foreach ($data as $pejabat) {
            $response['results'][] = array(
                'id' => $pejabat->id, 
                'text' => $pejabat->nama, //KOLOM YANG AKAN DIAMBIL DATANYA
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }


}
