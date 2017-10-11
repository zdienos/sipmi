<?php  if ( ! defined("BASEPATH")) exit("No direct script access allowed");
	function cmb_dinamis($name, $table, $field, $pk, $selected = null, $extra = null) {
		$ci = & get_instance();
		$cmb = "<select name='$name' class='form-control' $extra>";
		$data = $ci->db->get($table)->result();
		foreach ($data as $row) {
			$cmb .="<option value='" . $row->$pk . "'";
			$cmb .= $selected == $row->$pk ? 'selected' : '';
			$cmb .=">" . $row->$field . "</option>";
		}
		$cmb .= "</select>";
		return $cmb;
	}
	function generate_sidemenu()
	{
		return '<li>
		<a href="'.site_url('indikator').'"><i class="fa fa-list fa-fw"></i> Indikator</a>
	</li><li>
	<a href="'.site_url('indikator_ta').'"><i class="fa fa-list fa-fw"></i> Indikator ta</a>
	</li><li>
	<a href="'.site_url('level').'"><i class="fa fa-list fa-fw"></i> Level</a>
	</li><li>
	<a href="'.site_url('standar').'"><i class="fa fa-list fa-fw"></i> Standar</a>
	</li><li>
	<a href="'.site_url('ta').'"><i class="fa fa-list fa-fw"></i> Ta</a>
	</li><li>
	<a href="'.site_url('user').'"><i class="fa fa-list fa-fw"></i> User</a>
	</li><li>
	<a href="'.site_url('user_indikator').'"><i class="fa fa-list fa-fw"></i> User indikator</a>
	</li>';
	}
