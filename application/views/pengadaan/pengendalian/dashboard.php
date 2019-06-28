<div class="row">
  <div class="col-md-4">
    <div class="box box-primary">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Jenis Pengadaan</th>
              <th class="text-center">Jumlah Pekerjaan</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($count_jenis as $cj) { ?>
              <tr>
                <td><?php echo $cj->nama ?></td>
                <td class="text-center"><?php echo $cj->c_jenis ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
    </div>
  </div>
  <div class="col-md-4">
    <div class="box box-primary">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Metode Pemilihan</th>
              <th class="text-center">Jumlah Pekerjaan</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($count_metode as $cm) { ?>
              <tr>
                <td><?php echo $cm->nama ?></td>
                <td class="text-center"><?php echo $cm->c_metode ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
    </div>
  </div>
  <div class="col-md-4">
    <div class="box box-primary">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Batasan Pagu</th>
              <th class="text-center">Jumlah Pekerjaan</th>
            </tr>
          </thead>
          <tbody>
              <tr>
                <td>>200jt s.d 2,5M</td>
                <td class="text-center"><?php echo $c200 ?></td>
              </tr>
              <tr>
                <td>>2,5M s.d 50M</td>
                <td class="text-center"><?php echo $c25 ?></td>
              </tr>
              <tr>
                <td>>50M</td>
                <td class="text-center"><?php echo $c50 ?></td>
              </tr>
          </tbody>
          <tfoot>
            <tr>
              <td><strong>Total</strong></td>
              <td class="text-center"><strong><?php echo $c200+$c25+$c50 ?></strong></td>
            </tr>
          </tfoot>
        </table>
    </div>
  </div>
</div>

<!-- ROW KEDUA -->
<div class="row">
  <div class="col-md-4">
    <div class="box box-primary">
      <div class="box-title">
        <p style="text-align:center"><strong>Pengadaan >200 jt s.d 2,5 M</strong> </p>
      </div>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Tahapan</th>
            <th class="text-center">Jumlah Pekerjaan</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tahapan_200 as $tahapan){  ?>
            <tr>
              <td><?php echo $tahapan->nama ?></td>
              <td style="text-align:center"><?php echo $tahapan->c_progress ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-4">
    <div class="box box-primary">
      <div class="box-title">
        <p style="text-align:center"><strong>Pengadaan >2,5 M s.d 50 M</strong> </p>
      </div>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Tahapan</th>
            <th class="text-center">Jumlah Pekerjaan</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tahapan_25 as $tahapan){  ?>
            <tr>
              <td><?php echo $tahapan->nama ?></td>
              <td style="text-align:center"><?php echo $tahapan->c_progress ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-4">
    <div class="box box-primary">
      <div class="box-title">
        <p style="text-align:center"><strong>Pengadaan >50 M</strong> </p>
      </div>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Tahapan</th>
            <th class="text-center">Jumlah Pekerjaan</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tahapan_50 as $tahapan){  ?>
            <tr>
              <td><?php echo $tahapan->nama ?></td>
              <td style="text-align:center"><?php echo $tahapan->c_progress ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
