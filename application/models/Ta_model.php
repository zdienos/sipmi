<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ta_model extends CI_Model
{

    public $table = 'ta';
    public $id = 'id_ta';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_ta,nama_ta,awal,akhir');
        $this->datatables->from('ta');
        //add this line for join
        //$this->datatables->join('table2', 'ta.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('ta/read/$1'),'<i class="fa fa-info"></i>','class="btn btn-success"')." ".anchor(site_url('ta/update/$1'),'<i class="fa fa-pencil"></i>','class="btn btn-warning"')." ".anchor(site_url('ta/delete/$1'),'<i class="fa fa-trash"></i>','class="btn btn-danger"','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_ta');
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
        $this->db->like('id_ta', $q);
	$this->db->or_like('nama_ta', $q);
	$this->db->or_like('awal', $q);
	$this->db->or_like('akhir', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_ta', $q);
	$this->db->or_like('nama_ta', $q);
	$this->db->or_like('awal', $q);
	$this->db->or_like('akhir', $q);
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

/* End of file Ta_model.php */
/* Location: ./application/models/Ta_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-10-12 06:21:24 */
/* http://harviacode.com */