<?php $this->load->view('templates/header');?>
<div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>User <?php echo $button ?></h2>
            </div>
            <div class="col-md-8 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Level <?php echo form_error('id_level') ?></label>
             <?php echo cmb_dinamis('id_level','level','nama_level','id_level',$id_level); ?>
        </div>
	    <div class="form-group">
            <label for="varchar">Username <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Password <?php echo form_error('password') ?></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Atasan <?php echo form_error('id_atasan') ?></label>
            <?php echo cmb_dinamis('id_atasan','user','username','id_user',$id_atasan); ?>
        </div>
        <div class="form-group">
            <label for="varchar">Status <?php echo form_error('status') ?></label><br>
            <label class="radio-inline">
              <input type="radio" name="status" id="status" value="Aktif" <?php if (isset($status)){if($status=="Aktif"){echo "checked"; }} ?>>Aktif</label>
          <label class="radio-inline">
          <input type="radio" name="status" id="status" value="Non aktif" <?php if (isset($status)){if($status=="Non aktif"){echo "checked"; }} ?>>Non aktif</label>
        </div>
	    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('user') ?>" class="btn btn-default">Cancel</a>
	</form><?php $this->load->view('templates/footer');?>