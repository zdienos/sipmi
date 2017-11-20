<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Level extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Level_model');
        $this->load->library('form_validation');

        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('level/level_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Level_model->json();
    }

    public function read($id) 
    {
        $row = $this->Level_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_level' => $row->id_level,
		'nama_level' => $row->nama_level,
	    );
            $this->load->view('level/level_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('level'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('level/create_action'),
	    'id_level' => set_value('id_level'),
	    'nama_level' => set_value('nama_level'),
	);
        $this->load->view('level/level_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_level' => $this->input->post('nama_level',TRUE),
	    );

            $this->Level_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('level'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Level_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('level/update_action'),
		'id_level' => set_value('id_level', $row->id_level),
		'nama_level' => set_value('nama_level', $row->nama_level),
	    );
            $this->load->view('level/level_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('level'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_level', TRUE));
        } else {
            $data = array(
		'nama_level' => $this->input->post('nama_level',TRUE),
	    );

            $this->Level_model->update($this->input->post('id_level', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('level'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Level_model->get_by_id($id);

        if ($row) {
            $this->Level_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('level'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('level'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_level', 'nama level', 'trim|required');

	$this->form_validation->set_rules('id_level', 'id_level', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "level.xls";
        $judul = "level";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Level");

	foreach ($this->Level_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_level);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=level.doc");

        $data = array(
            'level_data' => $this->Level_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('level/level_doc',$data);
    }

}

/* End of file Level.php */
/* Location: ./application/controllers/Level.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-10-10 05:19:36 */
/* http://harviacode.com */