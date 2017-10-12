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
            <select class="form-control selectpicker" multiple>
  <optgroup label="Picnic" >
    <option>Mustard</option>
    <option>Ketchup</option>
    <option>Relish</option>
  </optgroup>
  <optgroup label="Camping">
    <option>Tent</option>
    <option>Flashlight</option>
    <option>Toilet Paper</option>
  </optgroup>
</select>

             <?php echo cmb_dinamis('id_user','user','username','id_user',$id_user); ?>
        </div>
	    <div class="form-group">
            <label for="int">Id Indikator <?php echo form_error('id_indikator') ?></label>
             <?php echo cmb_dinamis('id_indikator','indikator','nama','id_indikator'); ?>
        </div>
	    <input type="hidden" name="id_user_indikator" value="<?php echo $id_user_indikator; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('user_indikator') ?>" class="btn btn-default">Cancel</a>
	</form><?php $this->load->view('templates/footer');?>