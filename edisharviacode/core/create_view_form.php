<?php
/*  bagian atas  */

$string =
"<div class='row'>
	<div class='col-xs-12'>
		<div class='box box-info'>
			<div class='box-header with-border bg-aqua'>
				<h3 class='box-title'>Form Tambah Data $table_name</h3>
				<a href='<?php echo site_url('$sf$c') ?>'>
					<span class='btn btn-danger btn-xs pull-right'><i class='fa fa-arrow-left'></i> Batal</span>
				</a>
			</div>
			<form class='form-horizontal' action=\"<?php echo \$action; ?>\" method=\"post\">
        <div class='box-body'>
";
$i = 1;
foreach ($non_pk as $row) {
	if ($i == 1){
		$af = 'autofocus';
	}else{
		$af = '';
	}
$string .= "
          <div class='form-group'>
            <label for=\"".$row['data_type']."\" class='col-sm-2 control-label'>".label($row["column_name"])."</label>
            <div class='col-sm-9'>
              <input $af type='text' class='form-control' name='".$row['column_name']."' id='".$row['column_name']."' placeholder='Isikan ".label($row["column_name"])."' value='<?php echo $".$row["column_name"]."; ?>'>
							<?php echo form_error('".$row['column_name']."') ?>
            </div>
          </div>
";
$i++;
}
$string .= "
					<input type='hidden' name='$pk' value='<?php echo $".$row['column_name']." ?>'>
	        <!-- CSRF TOKEN -->
	        <?php
	          \$csrf = array(
	            'name' => \$this->security->get_csrf_token_name(),
	            'hash' => \$this->security->get_csrf_hash()
	          );
	        ?>
	        <input type='hidden' name=\"<?=\$csrf['name'];?>\" value=\"<?=\$csrf['hash'];?>\" />
					<div class='col-xs-12 text-center'>
						<input type='submit' name='simpan' value='Simpan' class='btn btn-info'>
					</div>
				</div>
    	</form>
		</div>
	</div>
</div>

<!-- jQuery 2.2.3 -->
<script src=\"<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js\"></script>
<script type=\"text/javascript\">

</script>
";
/*  tampilkan hasil  */
$directoryName = $target."views/".$table_name;
if(!is_dir($directoryName)){
mkdir($directoryName,0777,true);
}
$hasil_view_form = createFile($string, $target."views/".$table_name."/". $v_form_file);

?>
