<div class="row" style="margin-bottom:20px">
  <div class="col-xs-12">
    <form class="form-inline" action="<?php echo site_url('pengadaan/report/filter') ?>" method="post">
      <div class="input-group date">
				<div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				</div>
					<input autocomplete="off" type="text" class="form-control" name="filter_tanggal" id="filter_tanggal" placeholder="Kondisi s.d Tanggal " value="<?php echo $filter_tanggal ?>" />
			</div>
      <select class="form-control" name="pagu">
        <option value="l200" <?php echo  set_select('pagu', 'l200', TRUE); ?> >200 JT - 2,5 M</option>
        <option value="l25" <?php echo  set_select('pagu', 'l25', TRUE); ?> >2,5 M - 50 M</option>
        <option value="l50" <?php echo  set_select('pagu', 'l50', TRUE); ?> >Diatas 50 M</option>
        <option value="all" <?php echo  set_select('pagu', 'all', TRUE); ?> >Semua</option>
      </select>
      <input type="submit" name="submit" value="Tampilkan" class="btn btn-primary">
      <a href="<?php echo site_url('pengadaan/report/cetak/'.$filter_tanggal.'/'.$filter_pagu) ?>" class="btn btn-warning">Cetak</a>
      <input type="text" class="btn btn-info pull-right" value="<?php echo date("d-m-Y H:i:s").' Wita' ?>">
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

<!-- COUNT PER PROGRESS -->

<div class="box box-info box-solid">
  <div class="box-header with-border">
    <h3 class="box-title">Kondisi Progress Pekerjaan per Progress</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body" style="">
    <div class="table-responsive">
      <table class="table no-margin">
        <thead>
          <tr>
            <th>Progress</th>
            <th>Jumlah Pekerjaan</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($count_data as $count) { ?>
          <tr>
            <td><?php echo $count->nama ?></td>
            <td><span class="label label-default"><?php echo $count->c_progress ?></span></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- LIST PEKERJAAN -->

<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary box-solid collapsed-box">
      <div class="box-header with-border">
        <h3 class="box-title">List Pekerjaan</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
        </div>
      </div>
      <div class="box-body table-responsive">
        <table class="table table-bordered table-striped" id="mytable">
          <thead>
            <tr>
              <th width="30px">No</th>
              <th>Nama Pekerjaan</th>
              <th>Kegiatan</th>
              <th>Skpd</th>
              <th>Progress</th>
              <th>Tanggal</th>
              <th>Detail</th>
              <th>Pagu</th>
              <th>Nilai Kontrak</th>
              <th>Realisasi <br>Keuangan</th>
              <th>Realisasi <br>Fisik</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $start = 0;
            foreach ($pekerjaan_data as $pekerjaan){
              ?>
              <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $pekerjaan->nama_pekerjaan ?></td>
                <td><?php echo $pekerjaan->kegiatan ?></td>
                <td><?php echo $pekerjaan->nama_skpd ?></td>
                <td><?php echo $pekerjaan->nama ?></td>
                <td><?php echo $pekerjaan->tgl_progress ?></td>
                <td><?php echo $pekerjaan->ket_progress ?></td>
                <td class="text-right" nowrap><?php echo "Rp " . number_format($pekerjaan->pagu,2,',','.'); ?></td>
                <td class="text-right" nowrap><?php echo "Rp " . number_format($pekerjaan->nilai,2,',','.'); ?></td>
                <td class="text-right" nowrap><?php echo "Rp " . number_format($pekerjaan->real_keu,2,',','.'); ?></td>
                <td class="text-center" nowrap><?php echo $pekerjaan->real_fisik ?> %</td>
                <td style="text-align:center" width="120px">
                 <?php
                   echo anchor(site_url('pengadaan/pekerjaan/read/'.$pekerjaan->id_p),'<i class="fa fa-eye"></i>', 'title="Lihat" class="btn btn-info btn-sm"');
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



<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
  $('#filter_tanggal').datepicker({
    autoclose: true,
    format:'yyyy-mm-dd',
    todayHighlight: true,
    todayBtn:'linked',
  });


	var groupColumn = 3;
	var table = $('#mytable').DataTable({
		"columnDefs": [
			{ "visible": false, "targets": groupColumn }
		],
		// "order": [[ groupColumn, 'asc' ]],
		// "displayLength": 25,
		"drawCallback": function ( settings ) {
			var api = this.api();
			var rows = api.rows( {page:'current'} ).nodes();
			var last=null;

			api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
				if ( last !== group ) {
					$(rows).eq( i ).before(
						'<tr class="group"><td colspan="11"><strong> '+group+' </strong></td></tr>'
					);

					last = group;
				}
			} );
		}
	});
});
</script>
