<?php $this->load->view('templates/header');?>
<div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>Indikator Read</h2>
            </div>
            <div class="col-md-8 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <table class="table">
	    <tr><td>Id Standar</td><td><?php echo $id_standar; ?></td></tr>
	    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>Bobot</td><td><?php echo $bobot; ?></td></tr>
	    <tr><td>Level</td><td><?php echo $level; ?></td></tr>
	    <tr><td>Jangka Waktu</td><td><?php echo $jangka_waktu; ?></td></tr>
	    <tr><td>Tgl Mulai</td><td><?php echo $tgl_mulai; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('indikator') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table><?php $this->load->view('templates/footer');?>