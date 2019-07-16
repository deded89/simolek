<?php if ($pic_data) { ?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info box-solid">
            <table class="table table-hover">
              <thead>
                <tr class="bg-aqua">
                  <th>Status</th>
                  <th>Nama</th>
                  <th>NIP</th>
                  <th>Terhitung Mulai Tanggal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($pic_data as $pic){ ?>
                <tr>
                  <!-- STYLING -->
                  <?php if ($pic->status == 'pa'){
                    $style = "badge bg-red";
                  }else if($pic->status == 'pptk'){
                    $style = "badge bg-aqua";
                  }else if($pic->status == 'ppk'){
                    $style = "badge bg-yellow";
                  }else $style = "badge bg-green";
                  ?>
                  <td><span class="<?php echo $style ?> "> <?php echo strtoupper($pic->status) ?></span></td>
                  <td><?php echo $pic->nama ?></td>
                  <td><?php echo $pic->nip ?></td>
                  <td><?php echo $pic->tmt ?></td>
                  <td>
                    <a href="<?php echo site_url('pengadaan/pic_pekerjaan/delete/'.$pic->id."/".$pic->pekerjaan) ?>" title="Hapus" class="btn btn-danger btn-xs" onclick="return confirm('Are You Sure ?')"><i class="fa fa-trash-o"></i></a>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
              </table>
            </div>
        </div>
      </div>
  <?php } else { ?>
    <p>Data Penanggung Jawab tidak tersedia  </p>
  <?php } ?>
