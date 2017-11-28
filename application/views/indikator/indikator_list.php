<?php $this->load->view('templates/header');?>
        <div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>Daftar Indikator</h2>
            </div>
            <div class="col-md-4 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
				<div style="margin-top:20px;">
                <?php echo anchor(site_url('indikator/create'), '<i class="fa fa-plus"></i> Tambah Indikator', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('indikator/excel'), 'Excel', 'class="btn btn-default"'); ?>
		<?php echo anchor(site_url('indikator/word'), 'Word', 'class="btn btn-default"'); ?>
	    </div></div>
        </div>
        <table class="table table-bordered table-striped table-condensed" style="font-size:11px" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Urutan</th>
		    <th>Standar</th>
		    <th>Nama</th>
		    <th>Bobot</th>
		    <th>Level</th>
		    <th>Jangka Waktu</th>
		    <th>Tgl Mulai</th>
		    <th width="15%">Action</th>
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
                    ajax: {"url": "indikator/json", "type": "POST"},
                    columns: [
                        {
                            "data": "id_indikator",
                            "orderable": false
                        },{"data": "urutan",
                            "className" : "text-center"},{"data": "nama_standar",
                            "className" : "text-center"},{"data": "nama",
                            "className" : "text-center"},{"data": "bobot",
                            "className" : "text-center"},{"data": "level",
                            "className" : "text-center"},{"data": "jangka_waktu",
                            "className" : "text-center"},{"data": "tgl_mulai",
                            "className" : "text-center"},
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        }
                    ],
                    order: [[0, 'asc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
            });
        </script>