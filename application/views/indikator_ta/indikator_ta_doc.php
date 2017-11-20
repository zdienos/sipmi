<!doctype html>
<html>
    <head>
        <title>SOCIANOVATION - Web Administration</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Indikator_ta List</h2>
        <table class="word-table" style="margin-bottom: 10px">
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
		
            </tr><?php
            foreach ($indikator_ta_data as $indikator_ta)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $indikator_ta->id_ta ?></td>
		      <td><?php echo $indikator_ta->id_indikator ?></td>
		      <td><?php echo $indikator_ta->tgl_isi ?></td>
		      <td><?php echo $indikator_ta->tgl_update ?></td>
		      <td><?php echo $indikator_ta->file ?></td>
		      <td><?php echo $indikator_ta->nilai ?></td>
		      <td><?php echo $indikator_ta->status ?></td>
		      <td><?php echo $indikator_ta->isian ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>