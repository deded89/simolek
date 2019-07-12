<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <div class="box-body">
        <form action="<?php echo $form_action ?>" method="post">
          <p><?php echo cmb_dinamiss2('pekerjaan','epiz_21636198_pengendalian.pekerjaan','nama','id',false) ?></p>
          <p><?php echo cmb_dinamiss2('users','users','username','id',false) ?></p>
          <button class="btn btn-primary" type="submit" name="button">Set User</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <div class="box-body table-responsive">
				<table class="table table-bordered table-striped" id="mytable">
          <thead>
            <tr>
              <th>Nama Pekerjaan</th>
              <th>SKPD</th>
              <th>User Pengelola</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($user_pekerjaan_data as $user_pekerjaan){ ?>
            <tr>
              <td><?php echo $user_pekerjaan->nama ?></td>
              <td><?php echo $user_pekerjaan->nama_skpd ?></td>
              <td><?php echo $user_pekerjaan->username ?></td>
            </tr>
          <?php } ?>
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
		$('#users').select2({
			placeholder: "Pilih User",
		});
    $('#pekerjaan').select2({
			placeholder: "Pilih Pekerjaan",
		});
    $("#mytable").dataTable();
	});
</script>
