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
          <?php echo $nama_skpd.' Kondisi '.$nama_bulan.' '.$ta ?>
				</h4>
        <a href='<?php echo site_url('lkpk/Ren_real/cetak_laporan_rfk_skpd/'.$skpd.'/'.$bulan.'/'.$periode.'/'.$ta) ?>'>
          <span class='btn btn-warning pull-right'>Cetak</span>
        </a>
			</div>
      <div class="box-body table-responsive">
        <table class="table table-bordered table-striped" id="mytable">
          <thead>
            <tr style="font-weight:bold; background-color: #d9d6d0">
              <th style="vertical-align: middle" rowspan="2">Nama Kegiatan</th>
              <th style="vertical-align: middle" rowspan="2">Pagu Anggaran</th>
              <th style="text-align:center" colspan="4">Keuangan</th>
              <th style="vertical-align: middle" rowspan="2">Sisa Anggaran</th>
              <th style="text-align:center" colspan="3">Fisik</th>
              <th style="vertical-align: middle" rowspan="2">Capaian Avg</th>
              <th style="vertical-align: middle" rowspan="2">Kategori</th>
            </tr>
            <tr style="font-weight:bold; background-color: #d9d6d0">
              <th>Ren</th>
              <th >Real(Rp)</th>
              <th >Real(%)</th>
              <th>Capaian</th>
              <th>Ren</th>
              <th >Real</th>
              <th>Capaian</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $start = 0;
            foreach ($rfk_data as $rfk){
              ?>
              <tr>
                <td ><?php echo $rfk['nama_kegiatan'] ?></td>
                <td nowrap ><?php echo $rfk['nilai'] ?></td>
                <!-- keuangan -->
                <td nowrap><?php echo $rfk['ren_keu'] ?></td>
                <td nowrap style="background-color: yellow"><?php echo $rfk['real_keu'] ?></td>
                <td nowrap style="background-color: yellow"><?php echo $rfk['nilai']>0 ? $rfk['real_keu'] / $rfk['nilai'] *100 :0  ?></td>
                <td ><?php echo $rfk['ren_keu'] * 100>0 ? $rfk['real_keu'] / $rfk['ren_keu'] * 100 : $rfk['real_keu']?></td>
                <td nowrap ><?php echo $rfk['nilai'] - $rfk['real_keu'] ?></td>
                <!-- fisik -->
                <td ><?php echo $rfk['ren_fisik'] ?></td>
                <td style="background-color: yellow"><?php echo $rfk['real_fisik'] ?></td>
                <td ><?php echo $rfk['ren_fisik']>0 ? $rfk['real_fisik'] / $rfk['ren_fisik'] * 100 :$rfk['real_fisik'] ?></td>
                <?php
                  $cap_keu = $rfk['ren_keu']>0 ? $rfk['real_keu'] / $rfk['ren_keu'] * 100 : $rfk['real_keu'];
                  $cap_fisik =  $rfk['ren_fisik']>0 ? $rfk['real_fisik'] / $rfk['ren_fisik'] * 100 : $rfk['real_fisik'];
                  $cap_avg = round(($cap_keu + $cap_fisik)/2,2);
                  $cap_keu_skpd = $rfk_total_data['ren_keu_skpd']>0 ? $rfk_total_data['real_keu_skpd'] / $rfk_total_data['ren_keu_skpd'] * 100 : $rfk_total_data['real_keu_skpd'];
                  $cap_fisik_skpd = $rfk_total_data['ren_fisik_skpd']>0 ? $rfk_total_data['real_fisik_skpd'] / $rfk_total_data['ren_fisik_skpd'] * 100 : $rfk_total_data['real_fisik_skpd'];
                  $cap_avg_skpd = ($cap_keu_skpd + $cap_fisik_skpd)/2;
                  if ($cap_avg >= 85){
                    $color = "bg-green";
                    $kat = 1000;
                  }elseif ($cap_avg >= $cap_avg_skpd){
                    $color = "bg-yellow";
                    $kat = 2000;
                  }elseif ($cap_avg < $cap_avg_skpd){
                    $color = "bg-red";
                    $kat = 3000;
                  }
                 ?>
                 <td><?php echo$cap_avg ?> %</span> </td>
                 <td><span class="badge <?php echo $color ?>"><?php echo $kat ?></span></td>
              </tr>

            <?php
            }
              ?>
          </tbody>
          <tfoot>
            <tr class="total">
              <th>Total</th>
              <th nowrap><?php echo "Rp " . number_format($rfk_total_data['nilai'],2,',','.'); ?></th>
              <th nowrap><?php echo "Rp " . number_format($rfk_total_data['ren_keu_skpd'],2,',','.'); ?></th>
              <th nowrap><?php echo "Rp " . number_format($rfk_total_data['real_keu_skpd'],2,',','.'); ?></th>
              <th nowrap><?php echo number_format($rfk_total_data['nilai']>0 ? $rfk_total_data['real_keu_skpd'] / $rfk_total_data['nilai'] * 100 : 0,2,',','.').' %' ?></th>
              <th nowrap><?php echo number_format($cap_keu_skpd,2,',','.').' %' ?></th>
              <th nowrap><?php echo "Rp " . number_format($rfk_total_data['nilai'] - $rfk_total_data['real_keu_skpd'],2,',','.'); ?></th>
              <th nowrap><?php echo number_format($rfk_total_data['ren_fisik_skpd'],2,',','.').' %' ?></th>
              <th nowrap><?php echo number_format($rfk_total_data['real_fisik_skpd'],2,',','.').' %' ?></th>
              <th nowrap><?php echo number_format($cap_fisik_skpd,2,',','.').' %' ?></th>
              <th nowrap><?php echo number_format(isset($cap_avg_skpd) ? $cap_avg_skpd : 0 ,2,',','.').' %' ?></th>
              <th></th>
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
    "order": [[ 4, "asc" ]],
    // "scrollX": true
    "columnDefs": [
      {
        "render": $.fn.dataTable.render.number( '.', ',', 2,'Rp '),
        "targets": 1
      },
      {
        "render": $.fn.dataTable.render.number( '.', ',', 2,'Rp '),
        "targets": 2
      },
      {
        "render": $.fn.dataTable.render.number( '.', ',', 2,'Rp '),
        "targets": 3
      },
      {
        "render": $.fn.dataTable.render.number( '.', ',', 2,'',' %'),
        "targets": 4
      },
      {
        "render": $.fn.dataTable.render.number( '.', ',', 2,'',' %'),
        "targets": 5
      },
      {
        "render": $.fn.dataTable.render.number( '.', ',', 2,'Rp '),
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
        "render": $.fn.dataTable.render.number( '.', ',', 2,'',' %'),
        "targets": 9
      },
    ]
  });
});
</script>
