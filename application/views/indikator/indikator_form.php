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
    <label for="int">Standar <?php echo form_error('id_standar') ?></label>
    <?php echo cmb_dinamis('id_standar','standar','nama_standar','id_standar',$id_standar); ?>
  </div>
  <div class="form-group">
    <label for="int">Lampiran <?php form_error('nilai') ?></label><br>
    <label class="radio-inline">
      <input type="radio" name="lampiran" id="lampiran" placeholder="nilai" value="A" <?php if (isset($lampiran_data)) {if($lampiran_data=="A"){echo "checked"; }} ?>>A</label>
      <label class="radio-inline">
        <input type="radio" name="lampiran" id="lampiran" placeholder="nilai" value="B" <?php if (isset($lampiran_data)) {if($lampiran_data=="B"){echo "checked"; }} ?>>B</label>
      </div>
  <div class="form-group">
    <label for="int">Keterangan <?php form_error('nilai') ?></label><br>
    <label class="radio-inline">
      <input type="radio" name="keterangan" id="keterangan" value="<?php echo $keterangan[0]; ?>" <?php if (isset($keterangan_data)) {if($keterangan_data==1){echo "checked"; }} ?>>Bab</label>
      <label class="radio-inline">
        <input type="radio" name="keterangan" id="keterangan" value="<?php echo $keterangan[1]; ?>" <?php if (isset($keterangan_data)) {if($keterangan_data==2){echo "checked"; }} ?>>Sub Bab</label>
      </div>
      <div class="form-group">
        <label for="int">Indikator</label>
        <select id="indikator_select" class="form-control">
          <option value="">-- Jenis --</option>
          <option value="1">Ada Indikator</option>
          <option value="0">Tidak Ada Indikator</option>
        </select>
      </div>
      <div class="form-group">
        <label for="isian">Deskriptor <?php echo form_error('nama') ?></label>
        <textarea  name="nama" id="nama"  rows="10" cols="80">
          <?php if(isset($nama)){echo $nama;} ?>
        </textarea>
        <script>
        CKEDITOR.replace( 'nama' );
        </script>
      </div>
      <div class="hidden" id="indikator">

        <div class="form-group">
          <label for="int">Bobot <?php echo form_error('bobot') ?></label>
          <input type="text" class="form-control" name="bobot" id="bobot" placeholder="Bobot" value="<?php echo $bobot; ?>" />
        </div>
        <!-- <div class="form-group">
          <label for="int">Level <?php //echo form_error('level') ?></label>
          <?php //echo cmb_dinamis('level','indikator','nama','id_indikator',$level); ?>
        </div> -->
        <div class="form-group">
          <label for="int">Level <?php echo form_error('id_indikator') ?></label>
          <div>
            <select name="id_indikator" class="subkategori form-control" data-live-search="true">
              <option value="0">-PILIH-</option>
            </select>
          </div>

        </div>
        <div class="form-group">
          <label for="int">Jangka Waktu <?php echo form_error('jangka_waktu') ?></label>
          <input type="text" class="form-control" name="jangka_waktu" id="jangka_waktu" placeholder="Jangka Waktu" value="<?php echo $jangka_waktu; ?>" />
        </div>
        <div class="form-group">
          <label for="date">Tgl Mulai <?php echo form_error('tgl_mulai') ?></label>
          <input type="date" class="form-control" name="tgl_mulai" id="tgl_mulai" placeholder="Tgl Mulai" value="<?php echo $tgl_mulai; ?>" />
        </div>
      </div>

      <input type="hidden" name="id_indikator" value="<?php echo $id_indikator; ?>" />
      <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
      <a href="<?php echo site_url('indikator') ?>" class="btn btn-default">Cancel</a>

    </form><?php $this->load->view('templates/footer');?>
    <script type="text/javascript">
    $(document).ready(function(){
      $('#indikator_select').change(function(){
        var a=$('#indikator_select').val();
        if (a==1) {
          $("#indikator").removeClass('hidden');
        }else{
          $("#indikator").addClass('hidden');
        }
      });
      $('#id_standar').change(function(){
        var a=$('#id_standar').val();
        // /alert(lampiran);
        $.ajax({
          url : "<?php echo base_url();?>indikator_ta/indikator_by_standar2",
          method : "POST",
          data : {id: a},
          async : false,
          dataType : 'json',
          success: function(data){
            //console.log(data);
            var html = '<option value="0">-PILIH-</option>';
            var i;
            for(i=0; i<data.length; i++){
              html += '<option value="'+data[i].id_indikator+'" data-tokens="'+data[i].nama+'">'+data[i].nama+'</option>';
            }
            $('.subkategori').html(html);
          }
        });
      });
    });
    </script>
