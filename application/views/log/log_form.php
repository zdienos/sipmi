<?php $this->load->view('templates/header');?>
<div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>Log <?php echo $button ?></h2>
            </div>
            <div class="col-md-8 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id User <?php echo form_error('id_user') ?></label>
            <input type="text" class="form-control" name="id_user" id="id_user" placeholder="Id User" value="<?php echo $id_user; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Aktivitas <?php echo form_error('aktivitas') ?></label>
            <input type="text" class="form-control" name="aktivitas" id="aktivitas" placeholder="Aktivitas" value="<?php echo $aktivitas; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Waktu <?php echo form_error('waktu') ?></label>
            <input type="text" class="form-control" name="waktu" id="waktu" placeholder="Waktu" value="<?php echo $waktu; ?>" />
        </div>
	    <input type="hidden" name="id_log" value="<?php echo $id_log; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('log') ?>" class="btn btn-default">Cancel</a>
	</form><?php $this->load->view('templates/footer');?>