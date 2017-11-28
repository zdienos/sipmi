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
        <h2>Indikator List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Standar</th>
		<th>Nama</th>
		<th>Bobot</th>
		<th>Level</th>
		<th>Jangka Waktu</th>
		<th>Tgl Mulai</th>
		
            </tr><?php
            foreach ($indikator_data as $indikator)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $indikator->id_standar ?></td>
		      <td><?php echo $indikator->nama ?></td>
		      <td><?php echo $indikator->bobot ?></td>
		      <td><?php echo $indikator->level ?></td>
		      <td><?php echo $indikator->jangka_waktu ?></td>
		      <td><?php echo $indikator->tgl_mulai ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>