<?php  if ( ! defined("BASEPATH")) exit("No direct script access allowed");
	function cmb_dinamis($name, $table, $field, $pk, $selected = null, $extra = null) {
		$ci = & get_instance();
		$cmb = "<select name='$name'  id='$name' class='selectpicker form-control' $extra data-live-search='true'>";
		$cmb .="<option value='0' >--Pilih--</option>";
		$data = $ci->db->get($table)->result();
		foreach ($data as $row) {
			$cmb .="<option value='" . $row->$pk . "' data-tokens='" . $row->$field . "'";
			$cmb .= $selected == $row->$pk ? 'selected' : '';
			$cmb .=">" . $row->$field . "</option>";
		}
		$cmb .= "</select>";
		return $cmb;
	}
	function cmb_dinamis_ta_aktif($name, $table, $field, $pk, $selected = null, $extra = null) {
		$ci = & get_instance();
		$cmb = "<select name='$name'  id='$name' class='selectpicker form-control' $extra data-live-search='true'>";
		$cmb .="<option value='0' >--Pilih--</option>";
		$ci->db->where('status','Aktif');
		$data = $ci->db->get($table)->result();
		foreach ($data as $row) {
			$cmb .="<option value='" . $row->$pk . "' data-tokens='" . $row->$field . "'";
			$cmb .= $selected == $row->$pk ? 'selected' : '';
			$cmb .=">" . $row->$field . "</option>";
		}
		$cmb .= "</select>";
		return $cmb;
	}
	function cmb_dinamis_user_indikator($name, $table, $field, $pk, $selected = null, $extra = null) {
		$ci = & get_instance();
		$cmb = "<select name='$name'  id='$name' class='selectpicker form-control' $extra data-live-search='true'>";
		$cmb .="<option value='0' >--Pilih--</option>";
		$data = $ci->db->get($table)->result();
		foreach ($data as $row) {
			$cmb .="<option value='" . $row->$pk . "' data-tokens='" . $row->$field . "'";
			$cmb .= $selected == $row->$pk ? 'selected' : '';
			$cmb .=">" . $row->$field . "</option>";
		}
		$cmb .= "</select>";
		return $cmb;
	}
	function cmb_dinamis_user_indikator_ka($id_user,$name, $table, $field, $pk, $selected = null, $extra = null) {
		$ci = & get_instance();
		$cmb = "<select name='$name'  id='$name' class='selectpicker form-control' $extra data-live-search='true'>";
		$cmb .="<option value='0' >--Pilih--</option>";
		$ci->db->join('user_indikator','user_indikator.id_indikator=indikator.id_indikator');
		$ci->db->where('indikator.keterangan',2);
		$ci->db->where('user_indikator.id_user',$id_user);
		$data = $ci->db->get($table)->result();
		foreach ($data as $row) {
			$cmb .="<option value='" . $row->$pk . "' data-tokens='" . $row->$field . "'";
			$cmb .= $selected == $row->$pk ? 'selected' : '';
			$cmb .=">" . $row->$field . "</option>";
		}
		$cmb .= "</select>";
		return $cmb;
	}
	function generate_sidemenu()
	{
		return '<li> <a href="#" data-toggle="collapse" data-target="#toggleDemo2" data-parent="#sidenav01" class="collapsed">
          <span class="fa fa-tachometer"></span>  Indikator <span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleDemo2" style="height: 0px;">
            <ul class="nav nav-list">
              <li>
		<a href="'.site_url('indikator').'"><i class="fa fa-list fa-fw"></i> Indikator</a>
	</li><li>
	<a href="'.site_url('indikator_ta/filter').'"><i class="fa fa-list fa-fw"></i> Indikator ta</a>
	</li>
            </ul>
          </div></li>
          <li> <a href="#" data-toggle="collapse" data-target="#toggleDemo3" data-parent="#sidenav02" class="collapsed">
          <span class="fa fa-user"></span>  User <span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleDemo3" style="height: 0px;">
            <ul class="nav nav-list">
              <li>
	<a href="'.site_url('user').'"><i class="fa fa-list fa-fw"></i> User</a>
	</li><li>

            </ul>
          </div></li>
          <li>
	<a href="'.site_url('level').'"><i class="fa fa-level-up"></i> Level</a>
	</li><li>
	<a href="'.site_url('standar').'"><i class="fa fa-sticky-note-o"></i> Standar</a>
	</li><li>
	<a href="'.site_url('ta').'"><i class="fa fa-calendar"></i> Tahun Ajaran</a>
	</li>';
	}
	function generate_sidemenu_ka()
	{
		return '<li> <a href="#" data-toggle="collapse" data-target="#toggleDemo2" data-parent="#sidenav01" class="collapsed">
          <span class="fa fa-tachometer"></span>  Indikator <span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleDemo2" style="height: 0px;">
            <ul class="nav nav-list">
             <li>
	<a href="'.site_url('indikator_ta/filter').'"><i class="fa fa-list fa-fw"></i> Indikator ta</a>
	</li>
            </ul>
          </div></li>

   ';
	}
