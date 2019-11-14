<?php

/*  Atas sampai penulisan Nomor  */
$string ="\n
<!-- setting tombol tambah data -->

<div class=\"row\" style=\"margin-bottom: 10px\">
	<div class=\"col-md-4 text-left\">
		<?php echo anchor(site_url('".$sf.$c_url."/create'), 'Tambah Data', 'class=\"btn btn-primary\"'); ?>";

if ($export_excel == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), 'Excel', 'class=\"btn btn-success\"'); ?>";
}
if ($export_word == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), 'Word', 'class=\"btn btn-primary\"'); ?>";
}
if ($export_pdf == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), 'PDF', 'class=\"btn btn-warning\"'); ?>";
}
$string .="\n\t
	</div>
</div>
<!-- isi halaman -->
<div class=\"row\">
    <div class=\"col-xs-12\">
        <div class=\"box box-primary\">
			<div class=\"box-body table-responsive\">
				<table class=\"table table-bordered table-striped\" id=\"mytable\">
				   <thead>
						<tr>
							<th width=\"30px\">No</th>";

/*  Penulisan table header  */
foreach ($non_pk as $row) {
    $string .= "\n\t\t\t\t\t\t\t<th>" . label($row['column_name']) . "</th>";
}
$string .= "\n\t\t\t\t\t\t\t<th style=\"text-align:center\">Aksi</th>
						</tr>
					</thead>";
$string .= "\n\t\t\t\t\t<tbody>
					<?php
						\$start = 0;
						foreach ($" . $c_url . "_data as \$$c_url){
					?>
						<tr>
							<td><?php echo ++\$start ?></td>";

/*  Penulisan table data  */
foreach ($non_pk as $row) {
    $string .= "\n\t\t\t\t\t\t\t<td><?php echo $" . $c_url ."->". $row['column_name'] . " ?></td>";
}
/*  Penulisan tombol lihat, edit dan hapus sampai script  */
$string .= "\n\t\t\t\t\t\t\t <td style=\"text-align:center\" width=\"120px\">
							<?php
								echo anchor(site_url('".$sf.$c_url."/read/'.$".$c_url."->".$pk."),'<i class=\"fa fa-eye\"></i>', 'title=\"Lihat\" class=\"btn btn-info btn-sm\"');
								echo '  ';
								echo anchor(site_url('".$sf.$c_url."/update/'.$".$c_url."->".$pk."),'<i class=\"fa fa-pencil-square-o\"></i>', 'title=\"Update\" class=\"btn btn-warning btn-sm\"');
								echo '  ';
								echo anchor(site_url('".$sf.$c_url."/delete/'.$".$c_url."->".$pk."),'<i class=\"fa fa-trash-o\"></i>', 'title=\"Hapus\" class=\"btn btn-danger btn-sm\" onclick=\"javasciprt: return confirm(\'Are You Sure ?\')\"');
							?>
							</td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		 </div>
	</div>
</div>

<!-- jQuery 2.2.3 -->
<script src=\"<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js\"></script>
<script type=\"text/javascript\">
	$(document).ready(function () {
		$(\"#mytable\").dataTable();
	});
</script>
";

/*  tampilkan hasil  */
$directoryName = $target."views/".$table_name;
if(!is_dir($directoryName)){
mkdir($directoryName,0777,true);
}
$hasil_view_list = createFile($string, $target."views/" .$table_name."/". $v_list_file);

?>
