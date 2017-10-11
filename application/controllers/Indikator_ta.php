<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Indikator_ta extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Indikator_ta_model');
        $this->load->library('form_validation');

        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }        
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('indikator_ta/indikator_ta_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Indikator_ta_model->json();
    }

    public function read($id) 
    {
        $row = $this->Indikator_ta_model->get_by_id($id);
        if ($row) {
            $data = array(
              'id_indikator_ta' => $row->id_indikator_ta,
              'id_ta' => $row->id_ta,
              'id_indikator' => $row->id_indikator,
              'tgl_isi' => $row->tgl_isi,
              'tgl_update' => $row->tgl_update,
              'file' => $row->file,
              'nilai' => $row->nilai,
              'status' => $row->status,
              'isian' => $row->isian,
              );
            $this->load->view('indikator_ta/indikator_ta_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('indikator_ta'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('indikator_ta/create_action'),
            'id_indikator_ta' => set_value('id_indikator_ta'),
            'id_ta' => set_value('id_ta'),
            'id_indikator' => set_value('id_indikator'),
            'tgl_isi' => set_value('tgl_isi'),
            'tgl_update' => set_value('tgl_update'),
            'file' => set_value('file'),
            'nilai' => set_value('nilai'),
            'status' => set_value('status'),
            'isian' => set_value('isian'),
            );
        $this->load->view('indikator_ta/indikator_ta_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
           $config['upload_path']       = './upload/';
           $config['allowed_types']     = 'xls|xlsx|doc|docx';
           $config['overwrite']         = 'true';

           $this->load->library('upload', $config);
           if (!$this->upload->do_upload('file')) {
            $error = $this->upload->display_errors();
            // menampilkan pesan error
            print_r($error);
            } else {
                $result = $this->upload->data();
            }
            //echo $result['file_name'];
           $data = array(
              'id_ta' => $this->input->post('id_ta',TRUE),
              'id_indikator' => $this->input->post('id_indikator',TRUE),
              'tgl_isi' => $this->input->post('tgl_isi',TRUE),
              'tgl_update' => $this->input->post('tgl_update',TRUE),
              'file' => $result['file_name'],
              'nilai' => $this->input->post('nilai',TRUE),
              'status' => $this->input->post('status',TRUE),
              'isian' => $this->input->post('isian',TRUE),
            );
        
        $this->Indikator_ta_model->insert($data);
        $this->session->set_flashdata('message', 'Create Record Success');
        redirect(site_url('indikator_ta'));
    }
}

public function update($id) 
{
    $row = $this->Indikator_ta_model->get_by_id($id);

    if ($row) {
        $data = array(
            'button' => 'Update',
            'action' => site_url('indikator_ta/update_action'),
            'id_indikator_ta' => set_value('id_indikator_ta', $row->id_indikator_ta),
            'id_ta' => set_value('id_ta', $row->id_ta),
            'id_indikator' => set_value('id_indikator', $row->id_indikator),
            'tgl_isi' => set_value('tgl_isi', $row->tgl_isi),
            'tgl_update' => set_value('tgl_update', $row->tgl_update),
            'file' => set_value('file', $row->file),
            'nilai' => set_value('nilai', $row->nilai),
            'status' => set_value('status', $row->status),
            'isian' => set_value('isian', $row->isian),
            );
        $this->load->view('indikator_ta/indikator_ta_form', $data);
    } else {
        $this->session->set_flashdata('message', 'Record Not Found');
        redirect(site_url('indikator_ta'));
    }
}

public function update_action() 
{
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
        $this->update($this->input->post('id_indikator_ta', TRUE));
    } else {
        $data = array(
          'id_ta' => $this->input->post('id_ta',TRUE),
          'id_indikator' => $this->input->post('id_indikator',TRUE),
          'tgl_isi' => $this->input->post('tgl_isi',TRUE),
          'tgl_update' => $this->input->post('tgl_update',TRUE),
          'file' => $this->input->post('file',TRUE),
          'nilai' => $this->input->post('nilai',TRUE),
          'status' => $this->input->post('status',TRUE),
          'isian' => $this->input->post('isian',TRUE),
          );

        $this->Indikator_ta_model->update($this->input->post('id_indikator_ta', TRUE), $data);
        $this->session->set_flashdata('message', 'Update Record Success');
        redirect(site_url('indikator_ta'));
    }
}

public function delete($id) 
{
    $row = $this->Indikator_ta_model->get_by_id($id);

    if ($row) {
        $this->Indikator_ta_model->delete($id);
        $this->session->set_flashdata('message', 'Delete Record Success');
        redirect(site_url('indikator_ta'));
    } else {
        $this->session->set_flashdata('message', 'Record Not Found');
        redirect(site_url('indikator_ta'));
    }
}

public function _rules() 
{
	$this->form_validation->set_rules('id_ta', 'id ta', 'trim|required');
	$this->form_validation->set_rules('id_indikator', 'id indikator', 'trim|required');
	$this->form_validation->set_rules('tgl_isi', 'tgl isi', 'trim|required');
	$this->form_validation->set_rules('tgl_update', 'tgl update', 'trim|required');
	//$this->form_validation->set_rules('file', 'file', 'trim|required');
	$this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('isian', 'isian', 'trim|required');

	$this->form_validation->set_rules('id_indikator_ta', 'id_indikator_ta', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
}

public function excel()
{
    $this->load->helper('exportexcel');
    $namaFile = "indikator_ta.xls";
    $judul = "indikator_ta";
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
    xlsWriteLabel($tablehead, $kolomhead++, "Id Ta");
    xlsWriteLabel($tablehead, $kolomhead++, "Id Indikator");
    xlsWriteLabel($tablehead, $kolomhead++, "Tgl Isi");
    xlsWriteLabel($tablehead, $kolomhead++, "Tgl Update");
    xlsWriteLabel($tablehead, $kolomhead++, "File");
    xlsWriteLabel($tablehead, $kolomhead++, "Nilai");
    xlsWriteLabel($tablehead, $kolomhead++, "Status");
    xlsWriteLabel($tablehead, $kolomhead++, "Isian");

    foreach ($this->Indikator_ta_model->get_all() as $data) {
        $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteNumber($tablebody, $kolombody++, $data->id_ta);
        xlsWriteNumber($tablebody, $kolombody++, $data->id_indikator);
        xlsWriteLabel($tablebody, $kolombody++, $data->tgl_isi);
        xlsWriteLabel($tablebody, $kolombody++, $data->tgl_update);
        xlsWriteLabel($tablebody, $kolombody++, $data->file);
        xlsWriteNumber($tablebody, $kolombody++, $data->nilai);
        xlsWriteLabel($tablebody, $kolombody++, $data->status);
        xlsWriteLabel($tablebody, $kolombody++, $data->isian);

        $tablebody++;
        $nourut++;
    }

    xlsEOF();
    exit();
}

public function word()
{
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=indikator_ta.doc");

    $data = array(
        'indikator_ta_data' => $this->Indikator_ta_model->get_all(),
        'start' => 0
        );

    $this->load->view('indikator_ta/indikator_ta_doc',$data);
}

}

/* End of file Indikator_ta.php */
/* Location: ./application/controllers/Indikator_ta.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-10-10 05:19:36 */
/* http://harviacode.com */