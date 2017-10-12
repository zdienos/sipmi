<?php $this->load->view('templates/header');?>
        <div class="row" style="margin-bottom: 20px">
            <div class="col-md-4">
                <h2>Indikator ta List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
				<div style="margin-top:20px;">
                <?php echo anchor(site_url('indikator_ta/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('indikator_ta/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('indikator_ta/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div></div>
        </div>
        <table class="table table-bordered table-striped table-condensed" style="font-size:11px" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
		    <th>Id Ta</th>
		    <th>Id Indikator</th>
		    <th>Tgl Isi</th>
		    <th>Tgl Update</th>
		    <th>File</th>
		    <th>Nilai</th>
		    <th>Status</th>
		    <th>Isian</th>
		    <th>Action</th>
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
                    ajax: {"url": "indikator_ta/json", "type": "POST"},
                    columns: [
                        {
                            "data": "id_indikator_ta",
                            "orderable": false
                        },{"data": "id_ta"},{"data": "id_indikator"},{"data": "tgl_isi"},{"data": "tgl_update"},{"data": "file"},{"data": "nilai"},{"data": "status"},{"data": "isian"},
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
            });
        </script>