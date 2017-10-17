<?php $this->load->view('templates/header');?>
<div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>User indikator <?php echo $button ?></h2>
            </div>
            <div class="col-md-8 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">User <?php echo form_error('id_user') ?></label>
            <select class="form-control selectpicker" name="id_user[]" multiple>
            <?php foreach ($data_level as $key => $value) {?>
               <optgroup label="<?php echo $value->nama_level; ?>" >
                  <?php $user_level=$this->User_model->get_user_level($value->nama_level);  ?>
                  <?php foreach ($user_level as $key => $value) {?>
                    <option value="<?php echo $value->id_user; ?>"><?php echo $value->username; ?></option>
                  <?php } ?>
               </optgroup>
              <?php
            } ?>
 
    
</select>

             <?php //echo cmb_dinamis('id_user','user','username','id_user',$id_user); ?>
        </div>
	    <div class="form-group">
            <label for="int">Id Indikator <?php echo form_error('id_indikator') ?></label>
             <?php echo cmb_dinamis('id_indikator','indikator','nama','id_indikator'); ?>
        </div>
	    <input type="hidden" name="id_user_indikator" value="<?php echo $id_user_indikator; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('user_indikator') ?>" class="btn btn-default">Cancel</a>
	</form><?php $this->load->view('templates/footer');?>