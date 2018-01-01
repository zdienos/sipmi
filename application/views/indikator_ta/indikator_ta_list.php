<?php $this->load->view('templates/header');?>
<?php echo $menu_ta; ?>
        <div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>Indikator</h2>
            </div>
            <div class="col-md-4 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
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
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {"url": "indikator_ta/json", "data":{id:1},"type": "POST"},
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
                          }else{
                            return '<label class="label label-success">'+data+'</label>';
                          }
                      }},
                        {"data": "isian"},
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        }
                    ],
                    order: [[0, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
                $('#id1').on('click', function(e){
    t.ajax.reload();
});
            });
        </script>
