<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
        <h2>LIST JABATAN</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Level</th>
		<th>Nama Jab</th>
		<th>Id Skpd</th>
		
            </tr><?php
            foreach ($jabatan_data as $jabatan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $jabatan->id_level ?></td>
		      <td><?php echo $jabatan->nama_jab ?></td>
		      <td><?php echo $jabatan->id_skpd ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>