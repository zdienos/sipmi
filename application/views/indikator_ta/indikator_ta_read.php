<?php $this->load->view('templates/header');?>
<div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>Indikator ta Read</h2>
            </div>
            <div class="col-md-8 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <table class="table">
	    <tr><td>Id Ta</td><td><?php echo $id_ta; ?></td></tr>
	    <tr><td>Id Indikator</td><td><?php echo $id_indikator; ?></td></tr>
	    <tr><td>Tgl Isi</td><td><?php echo $tgl_isi; ?></td></tr>
	    <tr><td>Tgl Update</td><td><?php echo $tgl_update; ?></td></tr>
	    <tr><td>File</td><td><?php echo $file; ?></td></tr>
	    <tr><td>Nilai</td><td><?php echo $nilai; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td>Isian</td><td><?php echo $isian; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('indikator_ta') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table><?php $this->load->view('templates/footer');?>