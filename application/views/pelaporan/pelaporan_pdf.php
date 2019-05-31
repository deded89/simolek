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
        <h2>LIST PELAPORAN</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Lap</th>
		<th>Id Skpd</th>
		<th>Id Status</th>
		<th>Id Jab</th>
		<th>Tgl Upload</th>
		
            </tr><?php
            foreach ($pelaporan_data as $pelaporan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $pelaporan->id_lap ?></td>
		      <td><?php echo $pelaporan->id_skpd ?></td>
		      <td><?php echo $pelaporan->id_status ?></td>
		      <td><?php echo $pelaporan->id_jab ?></td>
		      <td><?php echo $pelaporan->tgl_upload ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>