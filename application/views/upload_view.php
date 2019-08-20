

<!-- MENAMPILKAN LIST FILE YANG SUDAH DIUPLOAD -->
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
			<div class="box-body table-responsive">

				<!-- FORM -->
				<?php echo form_open_multipart($action); ?>

				<div class="row" style="margin:0px; padding:10px; text-align:center;">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
						<button id="addFile" class="btn btn-danger">Click to Upload File</button>
					</div>
				</div>

				<div class="row" style="margin:0px; text-align:center;">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
						<div id="uploadFileContainer"></div>
						<div id="submit" style="display:none">
							<input type="submit" name="submit" value="Submit" class="btn btn-primary">

						</div>
					</div>
				</div>
        

				<?php echo form_close(); ?>
				<!-- AKHIR FORM -->

				<div class="box-header with-border">
				  <h3 class="box-title"><strong><?php echo $nama_lap ?> </strong></h3>
				</div>

				<div class="box-body">
				<table class="table table-bordered table-striped" id="mytable">
					<thead>
						<tr>
							<th>Uploaded Files</th>
							<th>Waktu Upload</th>
							<th>Uploader</th>
							<th width="120px" style="text-align:center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($uploaded_files as $file): ?>
						<tr>
							<td><?php echo $file->nama_file ?></td>
							<td><?php echo date('d-m-Y H:i:s',strtotime($file->tgl_upload))." WITA" ?></td>
							<td><?php echo $file->nama_jab ?></td>
							<td style="text-align:center">
							<?php
							echo anchor(site_url('upload/download/'.$id_lap.'/'.$id_skpd.'/'.$file->nama_file),'<i class="fa fa-download"></i>', 'title="Download" class="btn btn-info btn-sm"');
							echo "  ";
							echo anchor(site_url('upload/hapus/'.$id_lap.'/'.$id_skpd.'/'.$file->nama_file.'/'.$file->id_file),'<i class="fa fa-eraser"></i>', 'title="Hapus" class="btn btn-danger btn-sm"'); ?>
							</td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>

				<div>
					<?php 	echo anchor(site_url('upload/download_all/'.$id_lap.'/'.$id_skpd),'Download All as Zip', 'title="Download All" class="btn btn-primary"'); ?>
				</div>

				</div>
			</div>
			<div id="loading" class="overlay" style="display: none">
			  <i class="fa fa-refresh fa-spin"></i>
			</div>
		</div>
	</div>
</div>


<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script>
jQuery(document).ready(function() {
	$("#mytable").dataTable({
		"aaSorting": [],
	});
	$("#submit").click(function(){
			$("#loading").show();
		});
	$(document).on('click', 'button#addFile', function(event) {
		event.preventDefault();

		$('div#submit').css("display","block");
		addFileInput();
	});

	function addFileInput(){
		var html = '';
		html	+= '<div class="alert alert-info">';
		html	+= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times</button>';
		html	+= '<strong>Upload File</strong>';
		html	+= '<input type="file" name="multipleFiles[]" multiple>';
		html	+= '</div>';

		$('div#uploadFileContainer').append(html);
	}
});
</script>
