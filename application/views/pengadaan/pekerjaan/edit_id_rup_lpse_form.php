<div class="row">
  <div class="col-xs-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Update Deskripsi dan ID Pengadaan</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" action="<?php echo $action; ?>" method="post">
        <div class="box-body">
          <div class="form-group">
            <label for="deskripsi" class="col-sm-2 control-label">Deskripsi</label>

            <div class="col-sm-10">
              <textarea rows="5" class="form-control" name='deskripsi' id="deskripsi" placeholder="Deskripsi Singkat Pekerjaan"><?php echo $deskripsi ?></textarea>
              <?php echo form_error('deskripsi') ?>
            </div>
          </div>
          <div class="form-group">
            <label for="id_rup" class="col-sm-2 control-label">ID SiRUP</label>

            <div class="col-sm-10">
              <input type="number" class="form-control" name='id_rup' id="id_rup" placeholder="ID SiRUP" value="<?php echo $id_rup ?>">
              <?php echo form_error('id_rup') ?>
            </div>
          </div>
          <div class="form-group">
            <label for="id_lpse" class="col-sm-2 control-label">ID LPSE (ID Lelang)</label>

            <div class="col-sm-10">
              <input type="number" class="form-control" name='id_lpse' id="id_lpse" placeholder="ID LPSE / ID Lelang" value="<?php echo $id_lpse ?>">
              <?php echo form_error('id_lpse') ?>
            </div>
          </div>
        </div>
        <input type="hidden" name="id" value="<?php echo $id_p ?>">
        <!-- CSRF TOKEN -->
        <?php
          $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
          );
        ?>
        <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?php echo site_url('pengadaan/pekerjaan/read/'.$id_p) ?>"><button type="button" class="btn btn-danger">Kembali</button></a>
          <button type="submit" class="btn btn-primary pull-right"><?php echo $button ?></button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>
  </div>
</div>
