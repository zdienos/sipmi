<?php $this->load->view('templates/header');?>
<div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>Indikator ta <?php echo $button ?></h2>
            </div>
            <div class="col-md-8 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Ta <?php echo form_error('id_ta') ?></label>
            <input type="text" class="form-control" name="id_ta" id="id_ta" placeholder="Id Ta" value="<?php echo $id_ta; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Indikator <?php echo form_error('id_indikator') ?></label>
            <input type="text" class="form-control" name="id_indikator" id="id_indikator" placeholder="Id Indikator" value="<?php echo $id_indikator; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tgl Isi <?php echo form_error('tgl_isi') ?></label>
            <input type="text" class="form-control" name="tgl_isi" id="tgl_isi" placeholder="Tgl Isi" value="<?php echo $tgl_isi; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tgl Update <?php echo form_error('tgl_update') ?></label>
            <input type="text" class="form-control" name="tgl_update" id="tgl_update" placeholder="Tgl Update" value="<?php echo $tgl_update; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">File <?php echo form_error('file') ?></label>
            <input type="text" class="form-control" name="file" id="file" placeholder="File" value="<?php echo $file; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Nilai <?php echo form_error('nilai') ?></label>
            <input type="text" class="form-control" name="nilai" id="nilai" placeholder="Nilai" value="<?php echo $nilai; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Status <?php echo form_error('status') ?></label>
            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
        </div>
	    <div class="form-group">
            <label for="isian">Isian <?php echo form_error('isian') ?></label>
            <textarea class="form-control" rows="3" name="isian" id="isian" placeholder="Isian"><?php echo $isian; ?></textarea>
        </div>
	    <input type="hidden" name="id_indikator_ta" value="<?php echo $id_indikator_ta; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('indikator_ta') ?>" class="btn btn-default">Cancel</a>
	</form><?php $this->load->view('templates/footer');?>