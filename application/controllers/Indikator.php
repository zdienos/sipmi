<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Indikator extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Indikator_model');
        $this->load->library('form_validation');

        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('indikator/indikator_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Indikator_model->json();
    }

    public function read($id) 
    {
        $row = $this->Indikator_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_indikator' => $row->id_indikator,
		'id_standar' => $row->id_standar,
		'nama' => $row->nama,
		'bobot' => $row->bobot,
		'level' => $row->level,
		'jangka_waktu' => $row->jangka_waktu,
		'tgl_mulai' => $row->tgl_mulai,
	    );
            $this->load->view('indikator/indikator_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('indikator'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('indikator/create_action'),
	    'id_indikator' => set_value('id_indikator'),
	    'id_standar' => set_value('id_standar'),
	    'nama' => set_value('nama'),
	    'bobot' => set_value('bobot'),
	    'level' => set_value('level'),
	    'jangka_waktu' => set_value('jangka_waktu'),
	    'tgl_mulai' => set_value('tgl_mulai'),
	    'keterangan' => set_value('keterangan',array(1,2)),
	);
        $this->load->view('indikator/indikator_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
        if($this->input->post('keterangan')==1){
            $data = array(
                'id_standar' => $this->input->post('id_standar',TRUE),
                'nama' => $this->input->post('nama',TRUE),
                'bobot' => "$this->input->post('bobot',TRUE)",
                'level' => 0,
                'jangka_waktu' => $this->input->post('jangka_waktu',TRUE),
                'tgl_mulai' => $this->input->post('tgl_mulai',TRUE),
                'keterangan' => $this->input->post('keterangan',TRUE),
                );
        }else{
            $data = array(
                'id_standar' => $this->input->post('id_standar',TRUE),
                'nama' => $this->input->post('nama',TRUE),
                'bobot' => $this->input->post('bobot',TRUE),
                'level' => $this->input->post('level',TRUE),
                'jangka_waktu' => $this->input->post('jangka_waktu',TRUE),
                'tgl_mulai' => $this->input->post('tgl_mulai',TRUE),
                'keterangan' => $this->input->post('keterangan',TRUE),
                );
        }
            

            $this->Indikator_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('indikator'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Indikator_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('indikator/update_action'),
		'id_indikator' => set_value('id_indikator', $row->id_indikator),
		'id_standar' => set_value('id_standar', $row->id_standar),
		'nama' => set_value('nama', $row->nama),
		'bobot' => set_value('bobot', $row->bobot),
		'level' => set_value('level', $row->level),
		'jangka_waktu' => set_value('jangka_waktu', $row->jangka_waktu),
		'tgl_mulai' => set_value('tgl_mulai', $row->tgl_mulai),
	    'keterangan' => set_value('keterangan',array(1,2)),
	    'keterangan_data' => $row->keterangan,
	    );
            $this->load->view('indikator/indikator_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('indikator'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_indikator', TRUE));
        } else {
            $data = array(
		'id_standar' => $this->input->post('id_standar',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'bobot' => $this->input->post('bobot',TRUE),
		'level' => $this->input->post('level',TRUE),
		'jangka_waktu' => $this->input->post('jangka_waktu',TRUE),
        'tgl_mulai' => $this->input->post('tgl_mulai',TRUE),
        'keterangan' => $this->input->post('keterangan',TRUE),
	    );

            $this->Indikator_model->update($this->input->post('id_indikator', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('indikator'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Indikator_model->get_by_id($id);

        if ($row) {
            $this->Indikator_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('indikator'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('indikator'));
        }
    }

    public function _rules() 
    {
	

	$this->form_validation->set_rules('id_indikator', 'id_indikator', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "indikator.xls";
        $judul = "indikator";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Standar");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Bobot");
	xlsWriteLabel($tablehead, $kolomhead++, "Level");
	xlsWriteLabel($tablehead, $kolomhead++, "Jangka Waktu");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Mulai");

	foreach ($this->Indikator_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_standar);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteNumber($tablebody, $kolombody++, $data->bobot);
	    xlsWriteNumber($tablebody, $kolombody++, $data->level);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jangka_waktu);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_mulai);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=indikator.doc");

        $data = array(
            'indikator_data' => $this->Indikator_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('indikator/indikator_doc',$data);
    }

}

/* End of file Indikator.php */
/* Location: ./application/controllers/Indikator.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-10-10 05:19:36 */
/* http://harviacode.com */