<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Indikator_ta_model extends CI_Model
{

  public $table = 'indikator_ta';
  public $id = 'id_indikator_ta';
  public $order = 'DESC';

  function __construct()
  {
    parent::__construct();
  }

  // datatables
  function json() {
    $this->datatables->select('id_indikator_ta,nama_ta,indikator.nama as nama_indikator,tgl_isi,tgl_update,file,nilai,indikator_ta.status as status,isian,concat(user.username," : " ,level.nama_level) as username, concat(ta.status,"," ,indikator_ta.id_indikator_ta,",",indikator_ta.status) as status_ta');
    $this->datatables->from('indikator_ta');
    //add this line for join
    $this->datatables->join('ta', 'indikator_ta.id_ta = ta.id_ta');
    $this->datatables->join('user', 'indikator_ta.id_user = user.id_user');
    $this->datatables->join('level', 'level.id_level = user.id_level');
    $this->datatables->join('indikator', 'indikator_ta.id_indikator = indikator.id_indikator');
    if($this->session->userdata('data')->nama_level=="UPM"||$this->session->userdata('data')->nama_level=="Admin"){

      $this->datatables->add_column('action', anchor(site_url('indikator_ta/update/$1'),'<i class="fa fa-pencil"></i>','class="btn btn-warning btn-xs"')." ".anchor(site_url('indikator_ta/delete/$1'),'<i class="fa fa-trash"></i>','class="btn btn-danger btn-xs"'.' onclick="javasciprt: return confirm(\'Apakah anda yakin akan menghapus data ini??\')"'), 'id_indikator_ta');
    }else if($this->session->userdata('data')->nama_level=="Direktorat"){
      $this->datatables->add_column('action', anchor(site_url('indikator_ta/read/$1'),'<i class="fa fa-info"></i>','class="btn btn-success"'));
    }else{
      $this->datatables->where('indikator_ta.id_user',$this->session->userdata('data')->id_user);
      $this->datatables->add_column('action', anchor(site_url('indikator_ta/update/$1'),'<i class="fa fa-pencil"></i>','class="btn btn-warning btn-xs"'), 'id_indikator_ta');
    }
    return $this->datatables->generate();
  }
  // datatables
  function json_ta($id_ta) {
    $this->datatables->select('id_indikator_ta,nama_ta,indikator.nama as nama_indikator,tgl_isi,tgl_update,file,nilai,indikator_ta.status as status,isian,concat(user.username," : " ,level.nama_level) as username');
    $this->datatables->from('indikator_ta');
    //add this line for join
    $this->datatables->join('ta', 'indikator_ta.id_ta = ta.id_ta');
    $this->datatables->join('user', 'indikator_ta.id_user = user.id_user');
    $this->datatables->join('level', 'level.id_level = user.id_level');
    $this->datatables->join('indikator', 'indikator_ta.id_indikator = indikator.id_indikator');
    $this->datatables->where('ta.id_ta', $id_ta);
    if($this->session->userdata('data')->nama_level=="UPM"||$this->session->userdata('data')->nama_level=="Admin"){

      $this->datatables->add_column('action', anchor(site_url('indikator_ta/update/$1'),'<i class="fa fa-pencil"></i>','class="btn btn-warning btn-xs"')." ".anchor(site_url('indikator_ta/delete/$1'),'<i class="fa fa-trash"></i>','class="btn btn-danger btn-xs"'.' onclick="javasciprt: return confirm(\'Apakah anda yakin akan menghapus data ini??\')"'), 'id_indikator_ta');
    }else if($this->session->userdata('data')->nama_level=="Direktorat"){
      $this->datatables->add_column('action', anchor(site_url('indikator_ta/read/$1'),'<i class="fa fa-info"></i>','class="btn btn-success"'));
    }else{
      $this->datatables->where('indikator_ta.id_user',$this->session->userdata('data')->id_user);
      $this->datatables->add_column('action', anchor(site_url('indikator_ta/update/$1'),'<i class="fa fa-pencil"></i>','class="btn btn-warning btn-xs"'), 'id_indikator_ta');
    }
    return $this->datatables->generate();
  }

  // get all
  function get_all()
  {
    $this->db->join('ta', 'indikator_ta.id_ta = ta.id_ta');
    $this->db->join('user', 'indikator_ta.id_user = user.id_user');
    $this->db->join('level', 'level.id_level = user.id_level');
    $this->db->join('indikator', 'indikator_ta.id_indikator = indikator.id_indikator');
    $this->db->order_by($this->id, $this->order);
    return $this->db->get($this->table)->result();
  }

  // get data by id
  function get_by_id($id)
  {
    $this->db->select('*,indikator_ta.status as statuss');
    $this->db->where($this->id, $id);
    $this->db->join('indikator','indikator.id_indikator=indikator_ta.id_indikator');
    $this->db->join('ta','ta.id_ta=indikator_ta.id_ta');
    return $this->db->get($this->table)->row();
  }

  // get redudan data
  function get_data_duplikat($id_ta,$id_indikator,$id_user)
  {
    $this->db->where('id_ta', $id_ta);
    $this->db->where('id_indikator', $id_indikator);
    $this->db->where('id_user', $id_user);
    return $this->db->get($this->table)->row();
  }

  // get total rows
  function total_rows($q = NULL) {
    $this->db->like('id_indikator_ta', $q);
    $this->db->or_like('id_ta', $q);
    $this->db->or_like('id_indikator', $q);
    $this->db->or_like('tgl_isi', $q);
    $this->db->or_like('tgl_update', $q);
    $this->db->or_like('file', $q);
    $this->db->or_like('nilai', $q);
    $this->db->or_like('status', $q);
    $this->db->or_like('isian', $q);
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

  // get data with limit and search
  function get_limit_data($limit, $start = 0, $q = NULL) {
    $this->db->order_by($this->id, $this->order);
    $this->db->like('id_indikator_ta', $q);
    $this->db->or_like('id_ta', $q);
    $this->db->or_like('id_indikator', $q);
    $this->db->or_like('tgl_isi', $q);
    $this->db->or_like('tgl_update', $q);
    $this->db->or_like('file', $q);
    $this->db->or_like('nilai', $q);
    $this->db->or_like('status', $q);
    $this->db->or_like('isian', $q);
    $this->db->limit($limit, $start);
    return $this->db->get($this->table)->result();
  }

  // insert data
  function insert($data)
  {
    $this->db->insert($this->table, $data);
  }

  // update data
  function update($id, $data)
  {
    $this->db->where($this->id, $id);
    $this->db->update($this->table, $data);
  }

  // delete data
  function delete($id)
  {
    $this->db->where($this->id, $id);
    $this->db->delete($this->table);
  }

}

/* End of file Indikator_ta_model.php */
/* Location: ./application/models/Indikator_ta_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-10-10 05:19:36 */
/* http://harviacode.com */
