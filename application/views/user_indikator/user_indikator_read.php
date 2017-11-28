<?php $this->load->view('templates/header');?>
<div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>User indikator Read</h2>
            </div>
            <div class="col-md-8 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <table class="table">
	    <tr><td>Id User</td><td><?php echo $id_user; ?></td></tr>
	    <tr><td>Id Indikator</td><td><?php echo $id_indikator; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('user_indikator') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table><?php $this->load->view('templates/footer');?>