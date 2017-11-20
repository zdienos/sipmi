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
        $this->datatables->select('id_indikator_ta,nama_ta,indikator.nama as nama_indikator,tgl_isi,tgl_update,file,nilai,status,isian');
        $this->datatables->from('indikator_ta');
        //add this line for join
        $this->datatables->join('ta', 'indikator_ta.id_ta = ta.id_ta');
        $this->datatables->join('indikator', 'indikator_ta.id_indikator = indikator.id_indikator');
        $this->datatables->add_column('action', anchor(site_url('indikator/read/$1'),'<i class="fa fa-info"></i>','class="btn btn-success"')." ".anchor(site_url('indikator/update/$1'),'<i class="fa fa-pencil"></i>','class="btn btn-warning"')." ".anchor(site_url('indikator/delete/$1'),'<i class="fa fa-trash"></i>','class="btn btn-danger"','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_indikator');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
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