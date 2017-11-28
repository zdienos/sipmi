<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ta extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Ta_model');
        $this->load->library('form_validation');

        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('ta/ta_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Ta_model->json();
    }

    public function read($id) 
    {
        $row = $this->Ta_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_ta' => $row->id_ta,
		'nama_ta' => $row->nama_ta,
		'awal' => $row->awal,
		'akhir' => $row->akhir,
		'status' => $row->status,
	    );
            $this->load->view('ta/ta_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ta'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('ta/create_action'),
	    'id_ta' => set_value('id_ta'),
	    'nama_ta' => set_value('nama_ta'),
	    'awal' => set_value('awal'),
	    'akhir' => set_value('akhir'),
	    'status' => set_value('status'),
	);
        $this->load->view('ta/ta_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_ta' => $this->input->post('nama_ta',TRUE),
		'awal' => $this->input->post('awal',TRUE),
		'akhir' => $this->input->post('akhir',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Ta_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('ta'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Ta_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ta/update_action'),
		'id_ta' => set_value('id_ta', $row->id_ta),
		'nama_ta' => set_value('nama_ta', $row->nama_ta),
		'awal' => set_value('awal', $row->awal),
		'akhir' => set_value('akhir', $row->akhir),
		'status' => set_value('status', $row->status),
	    );
            $this->load->view('ta/ta_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ta'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_ta', TRUE));
        } else {
            $data = array(
		'nama_ta' => $this->input->post('nama_ta',TRUE),
		'awal' => $this->input->post('awal',TRUE),
		'akhir' => $this->input->post('akhir',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Ta_model->update($this->input->post('id_ta', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('ta'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Ta_model->get_by_id($id);

        if ($row) {
            $this->Ta_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('ta'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ta'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_ta', 'nama ta', 'trim|required');
	$this->form_validation->set_rules('awal', 'awal', 'trim|required');
	$this->form_validation->set_rules('akhir', 'akhir', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('id_ta', 'id_ta', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "ta.xls";
        $judul = "ta";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Ta");
	xlsWriteLabel($tablehead, $kolomhead++, "Awal");
	xlsWriteLabel($tablehead, $kolomhead++, "Akhir");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");

	foreach ($this->Ta_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_ta);
	    xlsWriteLabel($tablebody, $kolombody++, $data->awal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->akhir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=ta.doc");

        $data = array(
            'ta_data' => $this->Ta_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('ta/ta_doc',$data);
    }

}

/* End of file Ta.php */
/* Location: ./application/controllers/Ta.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-27 20:47:43 */
/* http://harviacode.com */