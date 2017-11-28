<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
		parent::__construct();
		$this->load->model('User_model');
    }

    public function index()
    {
		if($this->session->userdata('logined') && $this->session->userdata('logined') == true)
		{
			redirect('home');
		}
		
		if(!$this->input->post())
		{
			$this->load->view('login');
		}
		else
		{
			$username	= $this->input->post('username');
			$password	= $this->input->post('password');
			$cek_login	= $this->User_model->get_by_login($username,$password);
			if(!empty($cek_login))
			{
				$this->session->set_userdata('logined', true);
				$this->session->set_userdata('data', $cek_login);
				
				redirect("home");
			}
			else 
			{
				redirect("/");
			}
		}
        
    } 
	
	public function logout()
    {
		$this->session->unset_userdata('logined');
		redirect("/");
    } 
}

/* End of file Workflows.php */
/* Location: ./application/controllers/Workflows.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-04-15 00:43:10 */
/* http://harviacode.com */