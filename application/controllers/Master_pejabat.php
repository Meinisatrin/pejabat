<?php
class Master_pejabat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Master_pejabat_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->view('pejabat/index');
    }

    public function create()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pejabat/create');
        } else {
            $data = array(
                'nama' => $this->input->post('nama'),
                'tglBuat' => date('Y-m-d H:i:s'),
                'tglUbah' => date('Y-m-d H:i:s')
            );
            $this->Master_pejabat_model->insert($data);
            redirect('master_pejabat');
        }
    }

    public function edit($id)
    {
        $data['pejabat'] = $this->Master_pejabat_model->get_by_id($id);

        if (empty($data['pejabat'])) {
            show_404();
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pejabat/edit', $data);
        } else {
            $data_update = array(
                'nama' => $this->input->post('nama'),
                'tglUbah' => date('Y-m-d H:i:s')
            );
            $this->Master_pejabat_model->update($id, $data_update);
            redirect('master_pejabat');
        }
    }

    public function delete($id)
    {
        $this->Master_pejabat_model->delete($id);
        redirect('master_pejabat');
    }

	public function get_data() {
        $draw = $this->input->post('draw');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search')['value'];

        $recordsTotal = $this->Master_pejabat_model->get_total_records(); 
        $recordsFiltered = $this->Master_pejabat_model->get_filtered_records($search);
        $data = $this->Master_pejabat_model->get_data($start, $length, $search);

        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $data
        );

        echo json_encode($response);
    }
}


