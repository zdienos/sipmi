<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Indikator_ta extends CI_Controller
{
  //public $format_file='doc|docx|pdf|xls|xlsx|jpeg|jpg|png|zip|rar';
  function __construct()
  {
    parent::__construct();

    $this->load->model('Indikator_ta_model');
    $this->load->model('Indikator_model');
    $this->load->model('Level_model');
    $this->load->model('User_model');
    $this->load->model('Log_model');
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
    $ta=$this->Ta_model->get_all();
    $urls=base_url()."indikator_ta/filter/";
    $ta_view ='<ul class="nav nav-tabs">';
    foreach ($ta as $key => $value) {
      $url =$urls."".$value->id_ta;
      $ta_view .= '<li><a id="id'.$key.'" href="'.$url.'">'.$value->nama_ta.'</a></li>';
    }
    $ta_view .="</ul>";
    $data['menu_ta']=$ta_view;
    $this->load->view('indikator_ta/indikator_ta_list',$data);
  }
  public function filter($id_ta=0)
  {
    $ta=$this->Ta_model->get_all();
    $urls=base_url()."indikator_ta/filter/";
    $ta_view ='<ul class="nav nav-tabs">';
    if ($id_ta==0) {
      $ta_view .= '<li><a class="btn btn-primary" href="'.$urls.'">All</a></li>';
    }else{
      $ta_view .= '<li><a href="'.$urls.'">All</a></li>';
    }
    foreach ($ta as $key => $value) {
      $url =$urls."".$value->id_ta;
      if ($id_ta==$value->id_ta) {
        $ta_view .= '<li><a class="btn btn-primary" href="'.$url.'">'.$value->nama_ta.'</a></li>';
      }else{
        $ta_view .= '<li><a href="'.$url.'">'.$value->nama_ta.'</a></li>';
      }
    }
    $ta_view .="</ul>";
    $data['menu_ta']=$ta_view;
    $data['id_ta']=$id_ta;
    $this->load->view('indikator_ta/indikator_ta_list_filter',$data);
  }
  // public function filter($id_ta)
  // {
  //     $ta=$this->Ta_model->get_all();
  //     $urls=base_url()."indikator_ta/filter/";
  //     $ta_view ='<ul class="nav nav-tabs">';
  //     foreach ($ta as $key => $value) {
  //       $url =$urls."".$value->id_ta;
  //       $ta_view .= '<li><a href="'.$url.'">'.$value->nama_ta.'</a></li>';
  //     }
  //     $ta_view .="</ul>";
  //     $data['menu_ta']=$ta_view;
  //     $data['id_ta']= $id_ta;
  //     $this->load->view('indikator_ta/indikator_ta_list_filter',$data);
  // }


  public function json() {
    header('Content-Type: application/json');
    $id_ta=$this->input->post('id');
    if ($id_ta==0) {
      echo $this->Indikator_ta_model->json();
    }else{
      echo $this->Indikator_ta_model->json_ta($id_ta);
    }
  }
  public function indikator_by_standar()
  {
    $id=$id=$this->input->post('id');
      $lampiran=$this->input->post('lampiran');
    $data=$this->Indikator_model->get_by_idstandar($id,$lampiran);
    //print_r($data);
    echo json_encode($data);
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
      redirect(site_url('indikator_ta/filter'));
    }
  }

  public function create()
  {
    $data = array(
      'button' => 'Create',
      'data_level' => $this->Level_model->get_all(),
      'action' => site_url('indikator_ta/create_action'),
      'id_indikator_ta' => set_value('id_indikator_ta'),
      'id_ta' => set_value('id_ta'),
      'id_indikator' => set_value('id_indikator'),
      'tgl_isi' => set_value('tgl_isi'),
      'tgl_akhir' => set_value('tgl_akhir'),
      'tgl_update' => set_value('tgl_update'),
      'file' => set_value('file'),
      'nilai' => set_value('nilai',array("2","3","4")),
      'status' => set_value('status',array("Belum Lengkap","Draft","Lengkap")),
      'isian' => set_value('isian'),
    );
    $this->load->view('indikator_ta/indikator_ta_form', $data);
  }

  public function create_action()
  {
    $this->_rules();
    $temp_error="";
    $temp_succes="";
    $temp_user_error="";
    $temp_user_succes="";
    if ($this->form_validation->run() == FALSE) {
      $this->create();
    } else {
      $id_indikator=$this->input->post('id_indikator',TRUE);
      $config['upload_path']       = './upload/';
      $config['allowed_types']     =  "*";
      $config['overwrite']         = 'true';
      $config['file_name']         = $id_indikator."_".round(microtime(true) * 1000);

      $this->load->library('upload', $config);
      $result="";
      if (!$this->upload->do_upload('file')) {
        $error = $this->upload->display_errors();
        // menampilkan pesan error
        print_r($error);
      } else {
        $result = $this->upload->data();
      }
      //echo $result['file_name'];
      if(!empty($result)){
        $data_user=$this->input->post('id_user');
        for ($i=0; $i < count($data_user); $i++) {
          if(empty($this->Indikator_ta_model->get_data_duplikat($this->input->post('id_ta',TRUE),$this->input->post('id_indikator',TRUE),$data_user[$i]))){
            $data = array(
              'id_ta' => $this->input->post('id_ta',TRUE),
              'id_user' => $data_user[$i],
              'id_indikator' => $this->input->post('id_indikator',TRUE),
              'tgl_isi' => $this->input->post('tgl_isi',TRUE),
              'tgl_akhir' => $this->input->post('tgl_akhir',TRUE),
              'tgl_update' => $this->input->post('tgl_update',TRUE),
              'file' => $result['file_name'],
              'nilai' => $this->input->post('nilai',TRUE),
              'status' => $this->input->post('status',TRUE),
              'isian' => $this->input->post('isian',TRUE),
            );
            $data_users=$this->User_model->get_by_id($data_user[$i]);
            $temp_user_succes .= $data_users->username.", ";
            $this->Indikator_ta_model->insert($data);
            $data_log = array(
              'id_user' => $this->session->userdata('data')->id_user,
              'aktivitas' => 'Menambahkan',
              'waktu' => date("Y-m-d h:i:s"),
              'tabel' => 'indikator_ta',
            );
            $this->Log_model->insert($data_log);
          }else{
                $data_users=$this->User_model->get_by_id($data_user[$i]);
                $temp_user_error .= $data_users->username.", ";
                //echo $data_users->username;
          }
        }
      }else{
        $data_user=$this->input->post('id_user');
        //print_r($data_user);
        for ($i=0; $i < count($data_user); $i++) {
          //echo $data_user[$i];
          if(empty($this->Indikator_ta_model->get_data_duplikat($this->input->post('id_ta',TRUE),$this->input->post('id_indikator',TRUE),$data_user[$i]))){
            $data = array(
              'id_ta' => $this->input->post('id_ta',TRUE),
              'id_user' => $data_user[$i],
              'id_indikator' => $this->input->post('id_indikator',TRUE),
              'tgl_isi' => $this->input->post('tgl_isi',TRUE),
              'tgl_akhir' => $this->input->post('tgl_akhir',TRUE),
              'tgl_update' => $this->input->post('tgl_update',TRUE),
              'file' => '',
              'nilai' => $this->input->post('nilai',TRUE),
              'status' => $this->input->post('status',TRUE),
              'isian' => $this->input->post('isian',TRUE),
            );
            $data_users=$this->User_model->get_by_id($data_user[$i]);
            $temp_user_succes .= $data_users->username.", ";
            $this->Indikator_ta_model->insert($data);
            $data_log = array(
              'id_user' => $this->session->userdata('data')->id_user,
              'aktivitas' => 'Menambahkan',
              'waktu' => date("Y-m-d h:i:s"),
              'tabel' => 'indikator_ta',
            );
            $this->Log_model->insert($data_log);
          }else{
                $data_users=$this->User_model->get_by_id($data_user[$i]);
                $temp_user_error .= $data_users->username.", ";
                //echo $data_users->username;
          }
        }
      }
      $temp_error .= "User <b>".$temp_user_error."</b> gagal ditambahkan karena data sudah ada!!";
      $temp_succes .= "User <b>".$temp_user_succes."</b> berhasil ditambahkan!!";
      //echo $temp_error;
      if(empty($temp_user_error)){
          $this->session->set_flashdata('message', '<div class="alert alert-success">'.$temp_succes.'</div>');
      }else if(empty($temp_user_succes)){
          $this->session->set_flashdata('message_error', '<div class="alert alert-danger">'.$temp_error."</div>");
      }else{
          $this->session->set_flashdata('message_error', '<div class="alert alert-danger">'.$temp_error."</div>");
          $this->session->set_flashdata('message', '<div class="alert alert-success">'.$temp_succes.'</div>');
      }
      redirect(site_url('indikator_ta/filter'));
    }
  }

  public function update($id)
  {
    $row = $this->Indikator_ta_model->get_by_id($id);

    if ($row) {
      $data = array(
        'button' => 'Update',
        'action' => site_url('indikator_ta/update_action'),
        'id_user' => set_value('id_user', $row->id_user),
        'id_indikator_ta' => set_value('id_indikator_ta', $row->id_indikator_ta),
        'id_ta' => set_value('id_ta', $row->id_ta),
        'id_indikator' => set_value('id_indikator', $row->id_indikator),
        'tgl_isi' => set_value('tgl_isi', $row->tgl_isi),
        'tgl_update' => set_value('tgl_update', $row->tgl_update),
        'tgl_akhir' => set_value('tgl_akhir', $row->tgl_akhir),
        'file' => set_value('file', $row->file),
        'nilai' => set_value('nilai',array("2","3","4")),
        'status' => set_value('status',array("Belum Lengkap","Draft","Lengkap")),
        'nilai_data' => set_value('nilai', $row->nilai),
        'status_data' => set_value('status', $row->statuss),
        'isian' => set_value('isian', $row->isian),
        'nama_indikator' => set_value('nama_indikator', $row->nama),
        'nama_ta' => set_value('nama_ta', $row->nama_ta),
      );
      $this->load->view('indikator_ta/indikator_ta_form', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('indikator_ta/filter'));
    }
  }

  public function update_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('id_indikator_ta', TRUE));
    } else {
      $id_indikator=$this->input->post('id_indikator',TRUE);
      $config['upload_path']       = './upload/';
      $config['allowed_types']     = "*";
      $config['overwrite']         = 'true';
      $config['file_name']         = $id_indikator."_".round(microtime(true) * 1000);

      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('file')) {
        $error = $this->upload->display_errors();
        // menampilkan pesan error
        //print_r($error);
        if($this->session->userdata('data')->nama_level!="UPM"){
          $data = array(
            'tgl_update' => $this->input->post('tgl_update',TRUE),
            'isian' => $this->input->post('isian',TRUE),
          );
        }else if($this->session->userdata('data')->nama_level=="UPM"){
          $data = array(
            'id_user' => $this->input->post('id_user', TRUE),
            'id_ta' => $this->input->post('id_ta',TRUE),
            'id_indikator' => $this->input->post('id_indikator',TRUE),
            'tgl_akhir' => $this->input->post('tgl_akhir',TRUE),
            'nilai' => $this->input->post('nilai',TRUE),
            'status' => $this->input->post('status',TRUE),
          );
        }else{
          $data = array(
            'id_user' => $this->input->post('id_user', TRUE),
            'id_ta' => $this->input->post('id_ta',TRUE),
            'id_indikator' => $this->input->post('id_indikator',TRUE),
            'tgl_akhir' => $this->input->post('tgl_akhir',TRUE),
            'tgl_update' => $this->input->post('tgl_update',TRUE),
            'nilai' => $this->input->post('nilai',TRUE),
            'status' => $this->input->post('status',TRUE),
            'isian' => $this->input->post('isian',TRUE),
          );
        }
      } else {
        $row = $this->Indikator_ta_model->get_by_id($this->input->post('id_indikator_ta', TRUE));
        unlink("./upload/".$row->file);
        $result = $this->upload->data();
        if($this->session->userdata('data')->nama_level=="UPM"){
          $data = array(
            'id_user' => $this->input->post('id_user', TRUE),
            'id_ta' => $this->input->post('id_ta',TRUE),
            'tgl_akhir' => $this->input->post('tgl_akhir',TRUE),
            'id_indikator' => $this->input->post('id_indikator',TRUE),
            'tgl_update' => $this->input->post('tgl_update',TRUE),
            'file' =>  $result['file_name'],
            'nilai' => $this->input->post('nilai',TRUE),
            'status' => $this->input->post('status',TRUE),
            'isian' => $this->input->post('isian',TRUE),
          );
        }else{
          $data = array(
            'tgl_update' => $this->input->post('tgl_update',TRUE),
            'file' =>  $result['file_name'],
            'isian' => $this->input->post('isian',TRUE),
          );
        }
      }


      $this->Indikator_ta_model->update($this->input->post('id_indikator_ta', TRUE), $data);
      $data_log = array(
        'id_user' => $this->session->userdata('data')->id_user,
        'aktivitas' => 'Mengedit',
        'waktu' => date("Y-m-d h:i:s"),
        'tabel' => 'indikator_ta',
        'id_aksi' => $this->input->post('id_indikator_ta', TRUE),
      );
      $this->Log_model->insert($data_log);
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('indikator_ta/filter'));
    }
  }

  public function delete($id)
  {
    $row = $this->Indikator_ta_model->get_by_id($id);

    if ($row) {
      $data_log = array(
        'id_user' => $this->session->userdata('data')->id_user,
        'aktivitas' => 'Menghapus',
        'waktu' => date("Y-m-d h:i:s"),
        'tabel' => 'indikator_ta'
      );
      $this->Log_model->insert($data_log);
      $this->Indikator_ta_model->delete($id);

      $this->session->set_flashdata('message', '<div class="alert alert-success">Berhasil Menghapus Data</div>');
      redirect(site_url('indikator_ta/filter'));
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('indikator_ta/filter'));
    }
  }

  public function _rules()
  {

    if($this->session->userdata('data')->nama_level=="UPM"){
      $this->form_validation->set_rules('id_ta', 'id ta', 'trim|required');
      $this->form_validation->set_rules('id_indikator', 'id indikator', 'trim|required');
      $this->form_validation->set_rules('tgl_isi', 'tgl isi', 'trim|required');
      //$this->form_validation->set_rules('file', 'file', 'trim|required');
    }
    if($this->session->userdata('data')->nama_level!="UPM"){
      $this->form_validation->set_rules('tgl_update', 'tgl update', 'trim|required');
      $this->form_validation->set_rules('isian', 'isian', 'trim|required');
    }
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
