<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Standar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Standar_model');
        $this->load->library('form_validation');

        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('standar/standar_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Standar_model->json();
    }

    public function read($id) 
    {
        $row = $this->Standar_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_standar' => $row->id_standar,
		'nama_standar' => $row->nama_standar,
	    );
            $this->load->view('standar/standar_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('standar'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('standar/create_action'),
	    'id_standar' => set_value('id_standar'),
	    'nama_standar' => set_value('nama_standar'),
	);
        $this->load->view('standar/standar_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_standar' => $this->input->post('nama_standar',TRUE),
	    );

            $this->Standar_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('standar'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Standar_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('standar/update_action'),
		'id_standar' => set_value('id_standar', $row->id_standar),
		'nama_standar' => set_value('nama_standar', $row->nama_standar),
	    );
            $this->load->view('standar/standar_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('standar'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_standar', TRUE));
        } else {
            $data = array(
		'nama_standar' => $this->input->post('nama_standar',TRUE),
	    );

            $this->Standar_model->update($this->input->post('id_standar', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('standar'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Standar_model->get_by_id($id);

        if ($row) {
            $this->Standar_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('standar'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('standar'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_standar', 'nama standar', 'trim|required');

	$this->form_validation->set_rules('id_standar', 'id_standar', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "standar.xls";
        $judul = "standar";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Standar");

	foreach ($this->Standar_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_standar);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=standar.doc");

        $data = array(
            'standar_data' => $this->Standar_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('standar/standar_doc',$data);
    }

}

/* End of file Standar.php */
/* Location: ./application/controllers/Standar.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-10-10 05:19:36 */
/* http://harviacode.com */