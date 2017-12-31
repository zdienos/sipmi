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
  <?php if(($this->session->userdata('data')->nama_level=="UPM"||$this->session->userdata('data')->nama_level=="Admin")){ ?>
    <div class="form-group">
      <label for="int">Tahun Ajaran <?php echo form_error('id_ta') ?></label>
      <?php echo cmb_dinamis_ta_aktif('id_ta','ta','nama_ta','id_ta',$id_ta); ?>
    </div>
  <?php }else{?>
    <div class="form-group">
      <label for="date">Tahun Ajaran</label>
      <input type="text" class="form-control" readonly name="nama_ta" id="nama_ta" value="<?php echo $nama_ta; ?>">
    </div>


  <?php }?>
  <?php if($this->session->userdata('data')->nama_level=="UPM"||$this->session->userdata('data')->nama_level=="Admin"){ ?>
    <div class="form-group">
      <label for="int">User <?php echo form_error('id_user') ?></label>
      <?php if($this->uri->segment(2)=='update'){
        echo cmb_dinamis('id_user','user','username','id_user',$id_user);
      }else{
        ?>

        <select class="form-control selectpicker" name="id_user[]" multiple data-live-search="true">
          <?php foreach ($data_level as $key => $value) {?>
            <optgroup label="<?php echo $value->nama_level; ?>" >
              <?php $user_level=$this->User_model->get_user_level($value->nama_level);  ?>
              <?php foreach ($user_level as $key => $value) {?>
                <option value="<?php echo $value->id_user; ?>" data-tokens="<?php echo $value->username; ?>"><?php echo $value->username; ?></option>
              <?php } ?>
            </optgroup>
            <?php
          } ?>
        </select>
        <?php
      } ?>
    </div>
  <?php } ?>

      <div class="form-group">


        <?php if(($this->session->userdata('data')->nama_level!="UPM"||$this->session->userdata('data')->nama_level!="Admin")&&$this->uri->segment(2)=='update'){?>

          <div class="form-group">
            <label for="date">Indikator<?php echo form_error('id_indikator') ?></label>
            <input type="text" class="form-control" name="nama_indikator" id="nama_indikator" readonly value="<?php echo $nama_indikator; ?>" />
            <input type="hidden" class="form-control" name="id_indikator" id="id_indikator" readonly value="<?php echo $id_indikator; ?>" />
          </div>
          <?php
        }else{?>
          <div class="form-group">
            <label for="int">Lampiran <?php form_error('nilai') ?></label><br>
            <label class="radio-inline">
              <input type="radio" name="lampiran" id="lampiran" placeholder="nilai" value="A" <?php if (isset($nilai_data)) {if($nilai_data==2){echo "checked"; }} ?>>A</label>
              <label class="radio-inline">
                <input type="radio" name="lampiran" id="lampiran" placeholder="nilai" value="B" <?php if (isset($nilai_data)) {if($nilai_data==3){echo "checked"; }} ?>>B</label>
              </div>
          <label for="int">Standar <?php echo form_error('id_indikator') ?></label>
          <?php echo cmb_dinamis('id_standar','standar','nama_standar','id_standar'); ?>
          <div class="form-group">
            <label for="int">Indikator <?php echo form_error('id_indikator') ?></label>
            <div>
              <select name="id_indikator" class="subkategori form-control" data-live-search="true">
                <option value="0">-PILIH-</option>
              </select>
            </div>

          </div>
        </div>

        <?php

        //echo cmb_dinamis_user_indikator('id_indikator','indikator','nama','id_indikator',$id_indikator);
      } ?>
      <div class="form-group">
        <label for="date">Tgl Isi <?php echo form_error('tgl_isi') ?></label>
        <input type="date" class="form-control" name="tgl_isi" id="tgl_isi" readonly placeholder="Tgl Isi" value="<?php if ($tgl_isi=="") {echo date("Y-m-d");}else{echo $tgl_isi;} ?>" />
      </div>

      <div class="form-group">
        <!-- <label for="date">Tgl Update <?php echo form_error('tgl_update') ?></label> -->
        <input type="hidden" class="form-control" name="tgl_update" id="tgl_update" placeholder="Tgl Update" value="<?php echo date("Y-m-d"); ?>" />
      </div>
      <?php if($this->session->userdata('data')->nama_level=="UPM"||$this->session->userdata('data')->nama_level=="Admin"){ ?>
        <div class="form-group">
          <label for="date">Tgl Akhir <?php echo form_error('tgl_akhir') ?></label>
          <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" value="<?php if ($tgl_akhir=="") {echo date("Y-m-d");}else{echo $tgl_akhir;} ?>" />
        </div>
        <div class="form-group">
          <label for="int">Nilai <?php form_error('nilai') ?></label><br>
          <label class="radio-inline">
            <input type="radio" name="nilai" id="nilai" placeholder="nilai" value="2" <?php if (isset($nilai_data)) {if($nilai_data==2){echo "checked"; }} ?>>2</label>
            <label class="radio-inline">
              <input type="radio" name="nilai" id="nilai" placeholder="nilai" value="3" <?php if (isset($nilai_data)) {if($nilai_data==3){echo "checked"; }} ?>>3</label>
              <label class="radio-inline">
                <input type="radio" name="nilai" id="nilai" placeholder="nilai" value="4" <?php if (isset($nilai_data)) {if($nilai_data==4){echo "checked"; }} ?>>4</label>
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
                  <?php } if($this->session->userdata('data')->nama_level!="UPM"){ ?>
                    <div class="form-group">
                      <label for="varchar">File <?php echo form_error('file') ?></label>
                      <input type="file" class="form-control" name="file" id="file" placeholder="File" value="<?php echo $file; ?>" accept=".xls,.xlsx,.doc,.docx,.jpg,.jpeg,.png,.pdf"/>
                    </div>
                    <div class="form-group">
                      <label for="isian">Isian <?php echo form_error('isian') ?></label>
                      <textarea  name="isian" id="isian"  rows="10" cols="80">
                        <?php echo $isian; ?>
                      </textarea>
                      <script>
                      // Replace the <textarea id="editor1"> with a CKEditor
                      // instance, using default configuration.
                      CKEDITOR.replace( 'isian' );
                      </script>
                      <!--  <textarea class="form-control" rows="3" name="isian" id="isian" placeholder="Isian"><?php echo $isian; ?></textarea> -->
                    </div>

                  <?php } ?>
                  <input type="hidden" name="id_indikator_ta" value="<?php echo $id_indikator_ta; ?>" />
                  <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                  <a href="<?php echo site_url('indikator_ta') ?>" class="btn btn-default">Cancel</a>
                </form><?php $this->load->view('templates/footer');?>
                <script type="text/javascript">
                $(document).ready(function(){
                  // $('#standar').change(function(){
                  //   var a=$('#standar').val();
                  //   //alert(a);
                  //   // if (a==1) {
                  //   //   $("#indikator").removeClass('hidden');
                  //   // }else{
                  //   //   $("#indikator").addClass('hidden');
                  //   // }
                  // });

                  $('#id_standar').change(function(){
                    var lampiran = $('input[name=lampiran]:checked').val();
                    var a=$('#id_standar').val();
                    // /alert(lampiran);
                    $.ajax({
                      url : "<?php echo base_url();?>indikator_ta/indikator_by_standar",
                      method : "POST",
                      data : {id: a,lampiran:lampiran},
                      async : false,
                      dataType : 'json',
                      success: function(data){
                        //console.log(data);
                        var html = '';
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
