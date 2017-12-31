<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Log_model extends CI_Model
{

    public $table = 'log';
    public $id = 'id_log';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_log,id_user,aktivitas,waktu');
        $this->datatables->from('log');
        //add this line for join
        //$this->datatables->join('table2', 'log.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('log/read/$1'),'Read')." | ".anchor(site_url('log/update/$1'),'Update')." | ".anchor(site_url('log/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_log');
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
        $this->db->like('id_log', $q);
	$this->db->or_like('id_user', $q);
	$this->db->or_like('aktivitas', $q);
	$this->db->or_like('waktu', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_log', $q);
	$this->db->or_like('id_user', $q);
	$this->db->or_like('aktivitas', $q);
	$this->db->or_like('waktu', $q);
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

/* End of file Log_model.php */
/* Location: ./application/models/Log_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-26 08:21:59 */
/* http://harviacode.com */