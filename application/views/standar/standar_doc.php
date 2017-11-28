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
        <h2>Standar List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Standar</th>
		<th>Urutan</th>
		
            </tr><?php
            foreach ($standar_data as $standar)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $standar->nama_standar ?></td>
		      <td><?php echo $standar->urutan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>