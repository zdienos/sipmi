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
        <h2>Ta List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Ta</th>
		<th>Awal</th>
		<th>Akhir</th>
		<th>Status</th>
		
            </tr><?php
            foreach ($ta_data as $ta)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $ta->nama_ta ?></td>
		      <td><?php echo $ta->awal ?></td>
		      <td><?php echo $ta->akhir ?></td>
		      <td><?php echo $ta->status ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>