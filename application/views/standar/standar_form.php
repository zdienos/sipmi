<?php $this->load->view('templates/header');?>
<div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>Standar <?php echo $button ?></h2>
            </div>
            <div class="col-md-8 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="nama_standar">Nama Standar <?php echo form_error('nama_standar') ?></label>
            <textarea class="form-control" rows="3" name="nama_standar" id="nama_standar" placeholder="Nama Standar"><?php echo $nama_standar; ?></textarea>
        </div>
	    <input type="hidden" name="id_standar" value="<?php echo $id_standar; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('standar') ?>" class="btn btn-default">Cancel</a>
	</form><?php $this->load->view('templates/footer');?>