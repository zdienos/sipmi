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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
         <div class="form-group">
            <label for="int">Ta <?php echo form_error('id_ta') ?></label>
            <?php echo cmb_dinamis('id_ta','ta','nama_ta','id_ta'); ?>
        </div>
        <div class="form-group">
            <label for="int">Indikator <?php echo form_error('id_indikator') ?></label>
            <?php echo cmb_dinamis('id_indikator','indikator','nama','id_indikator'); ?>
        </div>
        <div class="form-group">
            <label for="date">Tgl Isi <?php echo form_error('tgl_isi') ?></label>
            <input type="date" class="form-control" name="tgl_isi" id="tgl_isi" readonly placeholder="Tgl Isi" value="<?php if ($tgl_isi=="") {echo date("Y-m-d");}else{echo $tgl_isi;} ?>" />
        </div>
        <div class="form-group">
            <!-- <label for="date">Tgl Update <?php echo form_error('tgl_update') ?></label> -->
            <input type="hidden" class="form-control" name="tgl_update" id="tgl_update" placeholder="Tgl Update" value="<?php echo date("Y-m-d"); ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">File <?php echo form_error('file') ?></label>
            <input type="file" class="form-control" name="file" id="file" placeholder="File" value="<?php echo $file; ?>" accept=".xls,.xlsx,.doc,.docx,.jpg,.jpeg,.png,.pdf"/>
        </div>
        <div class="form-group">
            <label for="int">Nilai <?php form_error('nilai') ?></label><br>
             <label class="radio-inline">
              <input type="radio" name="nilai" id="nilai" placeholder="nilai" value="<?php echo $nilai[0]; ?>" <?php if (isset($nilai_data)) {if($nilai_data==2){echo "checked"; }} ?>>2</label>
          <label class="radio-inline">
          <input type="radio" name="nilai" id="nilai" placeholder="nilai" value="<?php echo $nilai[1]; ?>" <?php if (isset($nilai_data)) {if($nilai_data==3){echo "checked"; }} ?>>3</label>
          <label class="radio-inline">
          <input type="radio" name="nilai" id="nilai" placeholder="nilai" value="<?php echo $nilai[2]; ?>" <?php if (isset($nilai_data)) {if($nilai_data==4){echo "checked"; }} ?>>4</label>
        </div>

        <div class="form-group">
            <label for="varchar">Status <?php echo form_error('status') ?></label><br>
            <label class="radio-inline">
              <input type="radio" name="status" id="status" placeholder="Status" value="<?php echo $status[0]; ?>" <?php if (isset($status_data)){if($status_data=="Belum Lengkap"){echo "checked"; }} ?>>Belum Lengkap</label>
          <label class="radio-inline">
          <input type="radio" name="status" id="status" placeholder="Status" value="<?php echo $status[1]; ?>" <?php if (isset($status_data)){if($status_data=="Draft"){echo "checked"; }} ?>>Draft</label>
          <label class="radio-inline">
          <input type="radio" name="status" id="status" placeholder="Status" value="<?php echo $status[2]; ?>" <?php if (isset($status_data)){if($status_data=="Lengkap"){echo "checked"; }} ?>>Lengkap</label>
      </div>
      <div class="form-group">
        <label for="isian">Isian <?php echo form_error('isian') ?></label>
        <textarea class="form-control" rows="3" name="isian" id="isian" placeholder="Isian"><?php echo $isian; ?></textarea>
    </div>
    <input type="hidden" name="id_indikator_ta" value="<?php echo $id_indikator_ta; ?>" /> 
    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
    <a href="<?php echo site_url('indikator_ta') ?>" class="btn btn-default">Cancel</a>
    </form><?php $this->load->view('templates/footer');?>