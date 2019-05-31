<?php 
/*  bagian atas  */

$string = "<div class='row'>
	<div class='col-xs-12'>
	    <div class='box box-primary'>
			<form action=\"<?php echo \$action; ?>\" method=\"post\">
				<table class='table table-bordered'>		
		";
foreach ($non_pk as $row) {
    $string .= "\n\t\t\t\t\t<tr>
						<td><label for=\"".$row["data_type"]."\">".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></label></td>
						<td><input type=\"text\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\" value=\"<?php echo $".$row["column_name"]."; ?>\" /></td>    
					</tr>
            ";
};
$string .= "\n\t\t\t\t\t<input type=\"hidden\" name=\"".$pk."\" value=\"<?php echo $".$pk."; ?>\" /> 
					<tr>
						<td colspan='2'>
							<button type=\"submit\" class=\"btn btn-primary\"><?php echo \$button ?></button> 
							<a href=\"<?php echo site_url('$c') ?>\" class=\"btn btn-danger\">Cancel</a>
						</td>	
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
	
<!-- jQuery 2.2.3 -->
<script src=\"<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js\"></script>
<script type=\"text/javascript\">
	$(document).ready(function () {  		
		$(\"#".$row["column_name"]."\").focus();
	});
</script>
";
/*  tampilkan hasil  */
$directoryName = $target."views/".$table_name;
if(!is_dir($directoryName)){
mkdir($directoryName,0777,true);
}
$hasil_view_form = createFile($string, $target."views/".$table_name."/". $v_form_file);

?>