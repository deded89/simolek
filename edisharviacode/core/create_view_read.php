<?php

$string = "<div class='row'>
	<div class='col-xs-12'>
	    <div class='box box-primary'>
        <table class=\"table table-hover\">";
foreach ($non_pk as $row) {
    $string .= "\n\t    <tr><td width=\"200px\"><b>".label($row["column_name"])."</b></td><td><?php echo $".$row["column_name"]."; ?></td></tr>";
}
$string .= "\n\t    <tr><td colspan=\"2\"><a href=\"<?php echo site_url('".$sf.$c_url."') ?>\" class=\"btn btn-danger\">Kembali</a></td></tr>";
$string .= "\n\t</table>
        </div>
	</div>
</div>";
$directoryName = $target."views/".$table_name;
if(!is_dir($directoryName)){
mkdir($directoryName,0777,true);
}
$hasil_view_read = createFile($string, $target."views/".$table_name."/". $v_read_file);

?>
