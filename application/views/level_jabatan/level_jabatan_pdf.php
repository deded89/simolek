<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
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
        <h2>LIST LEVEL_JABATAN</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Level</th>
		<th>Nama Level</th>
		
            </tr><?php
            foreach ($level_jabatan_data as $level_jabatan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $level_jabatan->level ?></td>
		      <td><?php echo $level_jabatan->nama_level ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>