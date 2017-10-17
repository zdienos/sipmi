<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_indikator extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('User_indikator_model');
        $this->load->model('User_model');
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
        $this->load->view('user_indikator/user_indikator_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->User_indikator_model->json();
    }

    public function read($id) 
    {
        $row = $this->User_indikator_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_user_indikator' => $row->id_user_indikator,
		'id_user' => $row->id_user,
		'id_indikator' => $row->id_indikator,
	    );
            $this->load->view('user_indikator/user_indikator_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user_indikator'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'data_level' => $this->Level_model->get_all(),
            'action' => site_url('user_indikator/create_action'),
	    'id_user_indikator' => set_value('id_user_indikator'),
	    'id_user' => set_value('id_user'),
	    'id_indikator' => set_value('id_indikator'),
	);
        $this->load->view('user_indikator/user_indikator_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_user' => implode(",",$this->input->post('id_user',TRUE)),
		'id_indikator' => $this->input->post('id_indikator',TRUE),
	    );

            $this->User_indikator_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('user_indikator'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->User_indikator_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('user_indikator/update_action'),
		'id_user_indikator' => set_value('id_user_indikator', $row->id_user_indikator),
		'id_user' => set_value('id_user', $row->id_user),
		'id_indikator' => set_value('id_indikator', $row->id_indikator),
	    );
            $this->load->view('user_indikator/user_indikator_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user_indikator'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_user_indikator', TRUE));
        } else {
            $data = array(
		'id_user' => $this->input->post('id_user',TRUE),
		'id_indikator' => $this->input->post('id_indikator',TRUE),
	    );

            $this->User_indikator_model->update($this->input->post('id_user_indikator', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('user_indikator'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->User_indikator_model->get_by_id($id);

        if ($row) {
            $this->User_indikator_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('user_indikator'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user_indikator'));
        }
    }

    public function _rules() 
    {
	//$this->form_validation->set_rules('id_user', 'id user', 'trim|required');
	$this->form_validation->set_rules('id_indikator', 'id indikator', 'trim|required');

	$this->form_validation->set_rules('id_user_indikator', 'id_user_indikator', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "user_indikator.xls";
        $judul = "user_indikator";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id User");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Indikator");

	foreach ($this->User_indikator_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_user);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_indikator);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=user_indikator.doc");

        $data = array(
            'user_indikator_data' => $this->User_indikator_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('user_indikator/user_indikator_doc',$data);
    }

}

/* End of file User_indikator.php */
/* Location: ./application/controllers/User_indikator.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-10-10 05:19:36 */
/* http://harviacode.com */