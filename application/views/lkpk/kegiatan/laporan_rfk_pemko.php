<style media="screen">
  table, th, td {
  border: 1px solid gray !important;
  font-size: 12px !important;
  }
  .badge{
    color:rgba(0, 0, 0, 0) !important;
  }
  .total{
    background-color: #94d4f2;
  }
</style>
<!-- TABEL LAPORAN -->
<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary box-solid">
      <div class="box-header with-border bg-aqua">
				<h4 class="box-title">
					<?php echo 'Pemerintah Kota Banjarmasin Kondisi '.$nama_bulan.' '.$ta ?>
				</h4>
			</div>
      <div class="box-body table-responsive">
        <table class="table table-bordered table-striped" id="mytable">
          <thead>
            <tr style="font-weight:bold; background-color: #d9d6d0">
              <th style="vertical-align: middle;" rowspan="2">Nama SKPD</th>
              <th style="vertical-align: middle" rowspan="2">Pagu Anggaran</th>
              <th style="text-align:center" colspan="4">Keuangan</th>
              <th style="vertical-align: middle" rowspan="2">Sisa Anggaran</th>
              <th style="text-align:center" colspan="3">Fisik</th>
              <th style="vertical-align: middle" rowspan="2">Capaian Avg</th>
              <th style="vertical-align: middle" rowspan="2">Kategori</th>
            </tr>
            <tr style="font-weight:bold; background-color: #d9d6d0">
              <th>Ren</th>
              <th>Real(Rp)</th>
              <th>Real(%)</th>
              <th>Capaian</th>
              <th>Ren</th>
              <th>Real</th>
              <th>Capaian</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $start = 0;
            $ren_fisik_pemko = 0;
            $real_fisik_pemko = 0;
            foreach ($rfk_data as $rfk){
              $cap_keu_pemko = $rfk_total_data['ren_keu_pemko']>0 ? $rfk_total_data['real_keu_pemko'] / $rfk_total_data['ren_keu_pemko'] * 100 : $rfk_total_data['real_keu_pemko'];
              $ren_fisik_pemko = $ren_fisik_pemko + ($rfk['ren_fisik']*($rfk['nilai']/$rfk_total_data['pagu_pemko']*100)/100);
              $real_fisik_pemko = $real_fisik_pemko + ($rfk['real_fisik']*($rfk['nilai']/$rfk_total_data['pagu_pemko']*100)/100);
              $cap_fisik_pemko = $ren_fisik_pemko>0 ? $real_fisik_pemko / $ren_fisik_pemko * 100 : $real_fisik_pemko;
              $cap_avg_pemko = ($cap_keu_pemko + $cap_fisik_pemko)/2;
            }
            foreach ($rfk_data as $rfk){
              $cap_keu = $rfk['ren_keu']>0 ? $rfk['real_keu'] / $rfk['ren_keu'] * 100 : $rfk['real_keu'];
              $cap_fisik =  $rfk['ren_fisik']>0 ? $rfk['real_fisik'] / $rfk['ren_fisik'] * 100 : $rfk['real_fisik'];
              $cap_avg = round(($cap_keu + $cap_fisik)/2,2);

              ?>
              <tr>
                <td ><?php echo $rfk['nama_skpd'] ?></td>
                <td nowrap ><?php echo $rfk['nilai'] ?></td>
                <!-- keuangan -->
                <td nowrap><?php echo $rfk['ren_keu'] ?></td>
                <td nowrap style="background-color:yellow;"><?php echo $rfk['real_keu'] ?></td>
                <td nowrap style="background-color:yellow;"><?php echo $rfk['real_keu'] / $rfk['nilai'] *100 ?></td>
                <td ><?php echo $cap_keu ?></td>
                <td nowrap ><?php echo $rfk['nilai'] - $rfk['real_keu'] ?></td>
                <!-- fisik -->
                <td ><?php echo $rfk['ren_fisik'] ?></td>
                <td style="background-color:yellow;"><?php echo $rfk['real_fisik'] ?></td>
                <td ><?php echo $cap_fisik ?></td>
                <td ><?php echo $cap_avg ?> %</td>
                <?php
                  if ($cap_avg >= 85){
                    $color = "green";
                    $kat = 3000;
                  }elseif ($cap_avg >= $cap_avg_pemko){
                    $color = "yellow";
                    $kat = 2000;
                  }elseif ($cap_avg < $cap_avg_pemko){
                    $color = "red";
                    $kat = 1000;
                  }
                 ?>
                 <td><span class="badge bg-<?php echo $color ?>"><?php echo $kat ?></span> </td>
              </tr>

            <?php
            }
              ?>
          </tbody>
          <tfoot>
            <tr class="total">
              <th>Total Pemko</th>
              <th nowrap><?php echo "Rp " . number_format($rfk_total_data['pagu_pemko'],0,',','.'); ?></th>
              <th nowrap><?php echo "Rp " . number_format($rfk_total_data['ren_keu_pemko'],0,',','.'); ?></th>
              <th nowrap><?php echo "Rp " . number_format($rfk_total_data['real_keu_pemko'],0,',','.'); ?></th>
              <th nowrap><?php echo number_format($rfk_total_data['pagu_pemko']>0 ? $rfk_total_data['real_keu_pemko'] / $rfk_total_data['pagu_pemko'] * 100 : 0,2,',','.').' %' ?></th>
              <th nowrap><?php echo number_format($cap_keu_pemko,2,',','.').' %' ?></th>
              <th nowrap><?php echo "Rp " . number_format($rfk_total_data['pagu_pemko'] - $rfk_total_data['real_keu_pemko'],0,',','.'); ?></th>
              <th nowrap><?php echo number_format($ren_fisik_pemko,2,',','.').' %' ?></th>
              <th nowrap><?php echo number_format($real_fisik_pemko,2,',','.').' %' ?></th>
              <th nowrap><?php echo number_format($cap_fisik_pemko,2,',','.').' %' ?></th>
              <th nowrap><?php echo number_format(isset($cap_avg_pemko) ? $cap_avg_pemko : 0 ,2,',','.').' %' ?></th>
              <th></th>
            </tr>
          <tr style="font-weight:bold; background-color: #d9d6d0">
            <td style="vertical-align: middle" rowspan="2">Nama SKPD</td>
            <td style="vertical-align: middle" rowspan="2">Pagu Anggaran</td>
            <td>Ren</td>
            <td>Real(Rp)</td>
            <td>Real(%)</td>
            <td>Capaian</td>
            <td style="vertical-align: middle" rowspan="2">Sisa Anggaran</td>
            <td>Ren</td>
            <td>Real</td>
            <td>Capaian</td>
            <td style="vertical-align: middle" rowspan="2">Capaian Avg</td>
            <td style="vertical-align: middle" rowspan="2">Kategori</td>
          </tr>
          <tr style="font-weight:bold; background-color: #d9d6d0">
            <td style="text-align:center" colspan="4">Keuangan</td>
            <td style="text-align:center" colspan="3">Fisik</td>
          </tr>
        </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>


<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {

  $("#mytable").dataTable({
   "order": [
     [ 11, "asc" ],[ 1, "desc" ]
   ],
    dom: 'lBfrtip',
    buttons: [ 'colvis' ],
    // "aaSorting": [],
    "columnDefs": [
      {
        "render": $.fn.dataTable.render.number( '.', ',', 0,'Rp '),
        "targets": 1
      },
      {
        "render": $.fn.dataTable.render.number( '.', ',', 0,'Rp '),
        "targets": 2
      },
      {
        "render": $.fn.dataTable.render.number( '.', ',', 0,'Rp '),
        "targets": 3
      },
      {
        "render": $.fn.dataTable.render.number( '.', ',', 2,'',' %'),
        "targets": 4
      },
      {
        "visible": false,
        "render": $.fn.dataTable.render.number( '.', ',', 2,'',' %'),
        "targets": 5
      },
      {
        "render": $.fn.dataTable.render.number( '.', ',', 0,'Rp '),
        "targets": 6
      },
      {
        "render": $.fn.dataTable.render.number( '.', ',', 2,'',' %'),
        "targets": 7
      },
      {
        "render": $.fn.dataTable.render.number( '.', ',', 2,'',' %'),
        "targets": 8
      },
      {
        "visible": false,
        "render": $.fn.dataTable.render.number( '.', ',', 2,'',' %'),
        "targets": 9
      },
      {
        "visible": false,
        "targets": 10
      },
    ]
  });
});
</script>
