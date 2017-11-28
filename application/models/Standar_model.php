<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Standar_model extends CI_Model
{

    public $table = 'standar';
    public $id = 'id_standar';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_standar,nama_standar,urutan');
        $this->datatables->from('standar');
        //add this line for join
        //$this->datatables->join('table2', 'standar.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('standar/read/$1'),'<i class="fa fa-info"></i>','class="btn btn-success"')." ".anchor(site_url('standar/update/$1'),'<i class="fa fa-pencil"></i>','class="btn btn-warning"')." ".anchor(site_url('standar/delete/$1'),'<i class="fa fa-trash"></i>','class="btn btn-danger"','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_standar');
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
        $this->db->like('id_standar', $q);
	$this->db->or_like('nama_standar', $q);
	$this->db->or_like('urutan', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_standar', $q);
	$this->db->or_like('nama_standar', $q);
	$this->db->or_like('urutan', $q);
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

/* End of file Standar_model.php */
/* Location: ./application/models/Standar_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-10-10 05:55:28 */
/* http://harviacode.com */