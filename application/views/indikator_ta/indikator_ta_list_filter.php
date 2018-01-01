<?php $this->load->view('templates/header');?>

<div class="row" style="margin-bottom: 20px">
  <div class="col-md-4">
    <h2>Indikator</h2>
  </div>
  <div class="col-md-4 text-center">

      <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>


      <?php echo $this->session->userdata('message_error') <> '' ? $this->session->userdata('message_error') : ''; ?>

  </div>
  <div class="col-md-4 text-right">
    <div style="margin-top:20px;">
      <?php if($this->session->userdata('data')->nama_level=="UPM"||$this->session->userdata('data')->nama_level=="Admin"){
        echo anchor(site_url('indikator_ta/create'), 'Create', 'class="btn btn-primary"');
      }?>
      <?php echo anchor(site_url('indikator_ta/excel'), 'Excel', 'class="btn btn-primary"'); ?>
      <?php echo anchor(site_url('indikator_ta/word'), 'Word', 'class="btn btn-primary"'); ?>
    </div></div>
  </div>
  <?php echo $menu_ta; ?>
  <div class="row">
    <div class="col col-md-4">
      <div class="form-group">
        <label for="int">Status</label>
        <select id="status" class="form-control">
          <option value="">-- Pilih Status --</option>
          <option value="Lengkap">Lengkap</option>
          <option value="Draft">Draft</option>
          <option value="Belum Lengkap">Belum Lengkap</option>
        </select>
      </div>
    </div>
  </div>
  <table class="table table-bordered table-striped table-condensed" style="font-size:11px" id="mytable">
    <thead>
      <tr>
        <th>No</th>
        <th>Tahun Ajaran</th>
        <th>Indikator</th>
        <th>Sumber Data</th>
        <th>Tgl Isi</th>
        <th>Tgl Update</th>
        <th>File</th>
        <th>Nilai</th>
        <th>Status</th>
        <th>Isian</th>
        <th width="6%">Action</th>
      </tr>
    </thead>

  </table><?php $this->load->view('templates/footer'); ?><script type="text/javascript">
  $(document).ready(function() {
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
      return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
      };
    };

    var t = $("#mytable").dataTable({
      initComplete: function() {
        var api = this.api();
        $('#status').change(function(){
          //alert(this.value);
          api.search(this.value).draw();
        });
      },
      oLanguage: {
        sProcessing: "loading..."
      },
      processing: true,
      serverSide: true,
      ajax: {"url": "<?php echo base_url()."/indikator_ta/json"; ?>", "data":{id:<?php if(isset($id_ta)){echo $id_ta;}else if($id_ta==0){echo "0";} ?>},"type": "POST"},
      columns: [
        {
          "data": "id_indikator_ta",
          "orderable": false
        },{"data": "nama_ta"},
        {"data": "nama_indikator"},
        {"data": "username"},
        {"data": "tgl_isi"},
        {"data": "tgl_update"},
        {"data": "file",
        "render": function ( data, type, row, meta ) {
          if(data==""){
            return '<a href="#" class="label label-danger">File Tidak Ada</span>';
          }else{
            return '<a href="<?php echo base_url()."upload/"; ?>'+data+'" class="label label-success">Download</span>';
          }

        }},
        {"data": "nilai"},
        {"data": "status",
        "render":function (data, type, row, meta) {
          if (data=="Belum Lengkap") {
            return '<label class="label label-danger">'+data+'</label>';
          }else if(data=="Draft"){
            return '<label class="label label-warning">'+data+'</label>';
          }else if(data=="Kosong"){
            return '<label class="label label-default">'+data+'</label>';
          }else{
            return '<label class="label label-success">'+data+'</label>';
          }
        }},
        {"data": "isian"},
        <?php   if($this->session->userdata('data')->nama_level=="UPM"||$this->session->userdata('data')->nama_level=="Admin"||$this->session->userdata('data')->nama_level=="Direktorat"){ ?>
          {
              "data" : "status_aksi",
              "orderable": false,
              "className" : "text-center",
              "render": function ( data, type, row, meta ) {
                if(data){
                var replace = data.replace(/\s/g,'');
                var array = replace.split(',');
                if (array[0]=="Edit") {
                  return '<a href="<?php echo base_url()."indikator_ta/update/"; ?>'+array[1]+'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a> <a href="<?php echo base_url()."indikator_ta/delete/"; ?>'+array[1]+'" class="btn btn-danger btn-xs" onclick="javasciprt: return confirm(\'Apakah anda yakin akan menghapus data ini??\')"><i class="fa fa-trash"></i></a>';
                }else{
                  return '<a href="<?php echo base_url()."indikator_ta/update/"; ?>'+array[1]+'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="<?php echo base_url()."indikator_ta/delete/"; ?>'+array[1]+'" class="btn btn-danger btn-xs" onclick="javasciprt: return confirm(\'Apakah anda yakin akan menghapus data ini??\')"><i class="fa fa-trash"></i></a>';
                }
                }

              }
          }
        <?php }else{ ?>
          {"data": "status_ta",
          "render": function ( data, type, row, meta ) {
            if(data){
            var replace = data.replace(/\s/g,'');
            var array = replace.split(',');
            if(array[0]=="Aktif"&&array[2]!="Lengkap"){
              return '<a href="<?php echo base_url()."indikator_ta/update/"; ?>'+array[1]+'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></span>';
            }else if(array[2]=="Lengkap"){
              return '<label class="label label-success">Data Sudah Lengkap</label> ';
            }else{
              return '<label class="label label-default">Tahun Ajaran Non Aktif</label> ';
            }
          }else{
            return '';
          }
          },
          "orderable": false,
          "className" : "text-center"}
          <?php } ?>
      ],
      order: [[0, 'desc']],
      rowCallback: function(row, data, iDisplayIndex) {
        if(data.status=="Belum Lengkap"){
          $(row).find('td').addClass('danger');
        }else if(data.status=="Lengkap"){
          $(row).find('td').addClass('success');
        }else if(data.status=="Draft"){
          $(row).find('td').addClass('warning');
        }
        var info = this.fnPagingInfo();
        var page = info.iPage;
        var length = info.iLength;
        var index = page * length + (iDisplayIndex + 1);
        $('td:eq(0)', row).html(index);
      }
    });


  });
  </script>
