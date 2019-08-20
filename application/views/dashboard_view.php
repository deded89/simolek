

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<form action="<?php echo $action ?>" method="post">
				<div class="box-body">
					<div class="col-xs-6"><?php echo cmb_list_laporan() ?></div>
					<div class="col-xs-4"><button type="submit" class="btn btn-primary">Lihat Status</button></div>
				</div>
				<!-- CSRF TOKEN -->
				<?php
					$csrf = array(
						'name' => $this->security->get_csrf_token_name(),
						'hash' => $this->security->get_csrf_hash()
					);
				?>
				<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
			</form>
		</div>
	</div>
</div>


<!-- DONUT CHART -->
<div class="row">
        <div class="col-md-4">
          <div class="box box-danger <?php echo $collapsed ?>">
            <div class="box-header with-border">
              <h3 class="box-title">Status Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
				<canvas id="oilChart" width="500" height="400"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
		</div>
		<div class="col-md-8">
          <div class="box box-danger <?php echo $collapsed ?>">
            <div class="box-header with-border">
              <h3 class="box-title">Status Icon</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
			<!--
			+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			-->

					<div class="col-lg-4 col-xs-6">
					  <!-- small box -->
					  <div class="small-box bg-red">
						<div class="inner">
						  <p>Belum Lapor  <br>:</p>
						  <h1><?php echo $jml_belum_lapor ?></h1>

						  <p>
						  dari <?php echo $jml_pelapor ?> Pelapor
						  </p>
						</div>
						<div class="icon">
						  <i class="fa fa-close"></i>
						</div>
						<a href="<?php echo site_url('dashboard/lihat_status_belum_lapor/'.$id_lap) ?>" class="small-box-footer">
						  Info Lanjut <i class="fa fa-arrow-circle-right"></i>
						</a>
					  </div>
					</div>
					<!-- ./col -->
					<div class="col-lg-4 col-xs-6">
					  <!-- small box -->
					  <div class="small-box bg-yellow">
						<div class="inner">
						  <p>Sudah Lapor/ <br>Diminta Perbaiki/ Direvisi : </p>
						  <h1><?php echo $jml_sudah_lapor ?></h1>

						  <p>
						  dari <?php echo $jml_pelapor ?> Pelapor
						  </p>
						</div>
						<div class="icon">
						  <i class="fa fa-exclamation"></i>
						</div>
						<a href="<?php echo site_url('dashboard/lihat_status_sudah_lapor/'.$id_lap) ?>" class="small-box-footer">
						  Info Lanjut <i class="fa fa-arrow-circle-right"></i>
						</a>
					  </div>
					</div>
					<!-- ./col -->
					<div class="col-lg-4 col-xs-6">
					  <!-- small box -->
					  <div class="small-box bg-green">
						<div class="inner">
						  <p>Laporan Oke  <br>:</p>
						  <h1><?php echo $jml_oke ?></h1>

						  <p>
						  dari <?php echo $jml_pelapor ?> Pelapor
						  </p>
						</div>
						<div class="icon">
						  <i class="fa fa-check"></i>
						</div>
						<a href="<?php echo site_url('dashboard/lihat_status_oke/'.$id_lap) ?>" class="small-box-footer">
						  Info Lanjut <i class="fa fa-arrow-circle-right"></i>
						</a>
					  </div>
					</div>
					<!-- ./col -->

			<!--
			+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			-->
            </div>
            <!-- /.box-body -->
          </div>
		</div>
</div>
<!-- /.box -->

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><strong><?php echo strtoupper($nama_lap).' '.$filter ?> </strong></h3>
					<?php if($nama_lap <> ''){ ?>
					<p>Data diambil : <?php echo date("d-m-Y H:i:s") ?> WITA<p>
					<?php } ?>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
						</button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
			<div class="box-body table-responsive">
				<table class="table table-bordered table-striped" cellspacing="0" width="100%" id="mytable">
				   <thead>
						<tr>
							<th width="10px">No</th>
							<!-- <th>Id Lap</th> -->
							<th>Nama SKPD</th>
							<th>Status Pelaporan</th>
							<th>Keterangan</th>
							<th>Last Upload by</th>
							<th>Last Upload on</th>
							<th>Download</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$start = 0;
						foreach ($pelaporan_data as $pelaporan){
					?>
						<tr>
							<td><?php echo ++$start ?></td>
							<!-- <td><?php echo $pelaporan->id_lap ?></td> -->
							<td><?php echo $pelaporan->nama_skpd ?></td>
							<!-- WARNAI STATUS -->

							<?php
							if($pelaporan->id_status==1){ //belum lapor
								$warna = "badge bg-red";
							}else if($pelaporan->id_status==2){ //sudah lapor
								$warna = "badge bg-yellow";
							}else if($pelaporan->id_status==3){ //diminta revisi
								$warna = "badge bg-yellow";
							}else if($pelaporan->id_status==4){ //diterima
								$warna = 'badge bg-green';
							}else if($pelaporan->id_status==5){ //diterima
								$warna = "badge bg-blue";
							}else{
								$warna = "badge bg-yellow";
							}
							?>

							<td><span class="<?php echo $warna ?>"><?php echo $pelaporan->status ?></td>
							<td><?php echo $pelaporan->ket ?></td>
							<td><?php echo $pelaporan->nama_jab ?></td>
							<td>
							<?php
								if ($pelaporan->tgl_upload <> null){
									echo date("d-m-Y H:i:s",strtotime($pelaporan->tgl_upload));
								}else {
									echo $pelaporan->tgl_upload;
								}
							?>
							</td>
							<td style="text-align:center">
								<?php
								if($pelaporan->id_status <> 1 && $laporan->id_jab == $this->session->userdata('id_jab') || $pelaporan->id_status <> 1 && $pelaporan->id_skpd == $this->session->userdata('id_skpd')){
									echo anchor(site_url('dashboard/hal_download/'.$pelaporan->id_pelaporan.'/'.$pelaporan->id_lap.'/'.$pelaporan->id_skpd),'<i class="fa fa-download"></i>', 'target="_blank" title="Hal Download" class="btn btn-primary btn-sm"');
								}
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
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
		$('#id_lap').select2({
			placeholder: "Pilih Laporan",
			allowClear:	true,
		});
		$("#mytable").dataTable({
			"iDisplayLength": 50,
			responsive: {
				details: {
					//display: $.fn.dataTable.Responsive.display.childRowImmediate,
					renderer: function ( api, rowIdx, columns ) {
						var data = $.map( columns, function ( col, i ) {
                        return col.hidden ?
                            '<tr style="border-bottom: solid 1px #d9d2d2" data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                '<td><b>'+col.title+'</b></td> '+
                                '<td style="padding: 5px 5px 5px 10px;">'+col.data+'</td>'+
                            '</tr>' :
                            '';
						} ).join('');

						return data ?
                        $('<table/>').append( data ) :
                        false;
					}
				}
			}
		});
		//-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var oilCanvas = document.getElementById("oilChart");

	Chart.defaults.global.defaultFontFamily = "Lato";
	Chart.defaults.global.defaultFontSize = 12;

	var oilData = {
		labels: [
			"Belum Lapor",
			"Sudah Lapor/ Diminta Perbaikan/ Revisi",
			"Laporan Oke"
		],
		datasets: [
			{
				data: [<?php echo $jml_belum_lapor ?>, <?php echo $jml_sudah_lapor ?>, <?php echo $jml_oke ?>],
				backgroundColor: [
					"#dd4b39", //danger
					"#f39c12", //warning
					"#00a65a" //success
				]
			}]
	};

	var pieChart = new Chart(oilCanvas, {
			type: 'doughnut',
			data: oilData,
			options: {
				legend: {
					display: true,
					position: 'bottom',
				}
			}
	});
});
</script>
