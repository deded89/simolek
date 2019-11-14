<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Rencana dan Realisasi</h3>
      </div>
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tbody>
            <tr>
              <th>Bulan</th>
              <th>Rencana Keuangan</th>
              <th>Realisasi Keuangan</th>
              <th>Capaian Keuangan</th>
              <th>Rencana Fisik</th>
              <th>Realisasi Fisik</th>
              <th>Capaian Fisik</th>
            </tr>
            <?php
              $kode_bulan = array("b01","b02","b03","b04","b05","b06","b07","b08","b09","b10","b11","b12");
              $bulan = array("Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
            ?>
              <tr>
              <td><?php echo $bulan[0] ?></td>
              <td><?php $renkeu = ren_perbulan($keg,$pp,"ren_keu",$kode_bulan[0]);
                        $persen = persenkeu_perbulan($keg,$pp,$renkeu);
                        echo number_format($renkeu,2,',','.')." (".number_format($persen,2,',','.')." %)";
                  ?>
              </td>
              <td><?php $real_keu = real_perbulan($keg,"real_keu",$kode_bulan[0]);
                        $persen = persenkeu_perbulan($keg,$pp,$real_keu);
                        echo number_format($real_keu,2,',','.')." (".number_format($persen,2,',','.')." %)";
                  ?>
              </td>
              <td><?php
                        if ($renkeu > 0){
                          $cap_keu = $real_keu / $renkeu *100;
                        }else{
                          $cap_keu = 0;
                        }
                        echo number_format($cap_keu,2,',','.');
                  ?>
              </td>
              <td><?php $ren_fisik = ren_perbulan($keg,$pp,"ren_fisik",$kode_bulan[0]);
                        echo number_format($ren_fisik,2,',','.');
                  ?>
              </td>
              <td><?php $real_fisik = real_perbulan($keg,"real_fisik",$kode_bulan[0]);
                        echo number_format($real_fisik,2,',','.');
                  ?>
              </td>
              <td><?php
                        if ($ren_fisik > 0){
                          $cap_fisik = $real_fisik / $ren_fisik *100;
                        }else{
                          $cap_fisik = 0;
                        }
                        echo number_format($cap_fisik,2,',','.');
                  ?>
              </td>
              </tr>
            <?php
              for($x=1; $x<12; $x++){ ?>
                <tr>
                <td><?php echo $bulan[$x] ?></td>
                <td><?php $renkeu = $renkeu + ren_perbulan($keg,$pp,"ren_keu",$kode_bulan[$x]);
                          $persen = persenkeu_perbulan($keg,$pp,$renkeu);
                          echo number_format($renkeu,2,',','.')." (".number_format($persen,2,',','.')." %)";
                    ?>
                </td>
                <td><?php $real_keu = real_perbulan($keg,"real_keu",$kode_bulan[$x])+$real_keu;
                          $persen = persenkeu_perbulan($keg,$pp,$real_keu);
                          echo number_format($real_keu,2,',','.')." (".number_format($persen,2,',','.')." %)";
                    ?>
                </td>
                <td><?php
                          if ($renkeu > 0){
                            $cap_keu = $real_keu / $renkeu*100;
                          }else{
                            $cap_keu = 0;
                          }
                          echo number_format($cap_keu,2,',','.');
                    ?>
                </td>
                <td><?php $ren_fisik = ren_perbulan($keg,$pp,"ren_fisik",$kode_bulan[$x])+$ren_fisik;
                          echo number_format($ren_fisik,2,',','.');
                    ?>
                </td>
                <td><?php $real_fisik = real_perbulan($keg,"real_fisik",$kode_bulan[$x])+$real_fisik;
                          echo number_format($real_fisik,2,',','.');
                    ?>
                </td>
                <td><?php
                          if ($ren_fisik > 0){
                            $cap_fisik = $real_fisik / $ren_fisik *100;
                          }else{
                            $cap_fisik = 0;
                          }
                          echo number_format($cap_fisik,2,',','.');
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
