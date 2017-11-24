<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_indikator_model extends CI_Model
{

    public $table = 'user_indikator';
    public $id = 'id_user_indikator';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_user_indikator,username,indikator.nama as nama_indikator');
        $this->datatables->from('user_indikator');
        //add this line for join
        $this->datatables->join('indikator', 'user_indikator.id_indikator = indikator.id_indikator');
        $this->datatables->join('user', 'user_indikator.id_user = user.id_user');
        $this->datatables->add_column('action', anchor(site_url('user_indikator/read/$1'),'<i class="fa fa-info"></i>','class="btn btn-success"')." ".anchor(site_url('user_indikator/update/$1'),'<i class="fa fa-pencil"></i>','class="btn btn-warning"')." ".anchor(site_url('user_indikator/delete/$1'),'<i class="fa fa-trash"></i>','class="btn btn-danger"','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_user_indikator');
        return $this->datatables->generate();
    }

    // datatables untuk kepala unit
    function json_ka($id_user) {
        $this->datatables->select('user_indikator.id_indikator,id_user_indikator,username,indikator.nama as nama_indikator');
        $this->datatables->from('user_indikator');
        //Filter
        $this->datatables->where('user_indikator.id_user',$id_user);
        //add this line for join
        $this->datatables->join('indikator', 'user_indikator.id_indikator = indikator.id_indikator');
        $this->datatables->join('user', 'user_indikator.id_user = user.id_user');
        $this->datatables->add_column('action', anchor(site_url('user_indikator/update/$1'),'<i class="fa fa-plus"></i>','class="btn btn-primary"'), 'id_indikator');
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
        $this->db->like('id_user_indikator', $q);
	$this->db->or_like('id_user', $q);
	$this->db->or_like('id_indikator', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_user_indikator', $q);
	$this->db->or_like('id_user', $q);
	$this->db->or_like('id_indikator', $q);
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

/* End of file User_indikator_model.php */
/* Location: ./application/models/User_indikator_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-10-10 05:19:36 */
/* http://harviacode.com */