<?php $this->load->view('templates/header');?>
<div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>Indikator <?php echo $button ?></h2>
            </div>
            <div class="col-md-8 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Standar <?php echo form_error('id_standar') ?></label>
            <input type="text" class="form-control" name="id_standar" id="id_standar" placeholder="Id Standar" value="<?php echo $id_standar; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Bobot <?php echo form_error('bobot') ?></label>
            <input type="text" class="form-control" name="bobot" id="bobot" placeholder="Bobot" value="<?php echo $bobot; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Level <?php echo form_error('level') ?></label>
            <input type="text" class="form-control" name="level" id="level" placeholder="Level" value="<?php echo $level; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Jangka Waktu <?php echo form_error('jangka_waktu') ?></label>
            <input type="text" class="form-control" name="jangka_waktu" id="jangka_waktu" placeholder="Jangka Waktu" value="<?php echo $jangka_waktu; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tgl Mulai <?php echo form_error('tgl_mulai') ?></label>
            <input type="text" class="form-control" name="tgl_mulai" id="tgl_mulai" placeholder="Tgl Mulai" value="<?php echo $tgl_mulai; ?>" />
        </div>
	    <input type="hidden" name="id_indikator" value="<?php echo $id_indikator; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('indikator') ?>" class="btn btn-default">Cancel</a>
	</form><?php $this->load->view('templates/footer');?>