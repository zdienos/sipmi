<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Log extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Log_model');
        $this->load->library('form_validation');

        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('log/log_list');
    }

    public function json() {
        header('Content-Type: application/json');
        echo $this->Log_model->json();
    }

    public function read($id)
    {
        $row = $this->Log_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_log' => $row->id_log,
		'id_user' => $row->id_user,
		'aktivitas' => $row->aktivitas,
		'waktu' => $row->waktu,
	    );
            $this->load->view('log/log_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('log'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('log/create_action'),
	    'id_log' => set_value('id_log'),
	    'id_user' => set_value('id_user'),
	    'aktivitas' => set_value('aktivitas'),
	    'waktu' => set_value('waktu'),
	);
        $this->load->view('log/log_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_user' => $this->input->post('id_user',TRUE),
		'aktivitas' => $this->input->post('aktivitas',TRUE),
		'waktu' => $this->input->post('waktu',TRUE),
	    );

            $this->Log_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('log'));
        }
    }

    public function update($id)
    {
        $row = $this->Log_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('log/update_action'),
		'id_log' => set_value('id_log', $row->id_log),
		'id_user' => set_value('id_user', $row->id_user),
		'aktivitas' => set_value('aktivitas', $row->aktivitas),
		'waktu' => set_value('waktu', $row->waktu),
	    );
            $this->load->view('log/log_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('log'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_log', TRUE));
        } else {
            $data = array(
		'id_user' => $this->input->post('id_user',TRUE),
		'aktivitas' => $this->input->post('aktivitas',TRUE),
		'waktu' => $this->input->post('waktu',TRUE),
	    );

            $this->Log_model->update($this->input->post('id_log', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('log'));
        }
    }

    public function delete($id)
    {
        $row = $this->Log_model->get_by_id($id);

        if ($row) {
            $this->Log_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('log'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('log'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('id_user', 'id user', 'trim|required');
	$this->form_validation->set_rules('aktivitas', 'aktivitas', 'trim|required');
	$this->form_validation->set_rules('waktu', 'waktu', 'trim|required');

	$this->form_validation->set_rules('id_log', 'id_log', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "log.xls";
        $judul = "log";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Aktivitas");
	xlsWriteLabel($tablehead, $kolomhead++, "Waktu");

	foreach ($this->Log_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_user);
	    xlsWriteLabel($tablebody, $kolombody++, $data->aktivitas);
	    xlsWriteLabel($tablebody, $kolombody++, $data->waktu);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=log.doc");

        $data = array(
            'log_data' => $this->Log_model->get_all(),
            'start' => 0
        );

        $this->load->view('log/log_doc',$data);
    }

}

/* End of file Log.php */
/* Location: ./application/controllers/Log.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-26 08:21:59 */
/* http://harviacode.com */
