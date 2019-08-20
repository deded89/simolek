<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <div class="box-body">
        <form action="<?php echo $form_action ?>" method="post">
          <?php $id = $id_p; ?>
          <p><?php echo cmb_dinamiss2('pekerjaan','epiz_21636198_pengendalian.pekerjaan','nama','id',$id) ?></p>
          <p><?php echo cmb_dinamiss2('users','users','username','id',false) ?></p>
          <!-- CSRF TOKEN -->
          <?php
            $csrf = array(
              'name' => $this->security->get_csrf_token_name(),
              'hash' => $this->security->get_csrf_hash()
            );
          ?>
          <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
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
              <th width="30px">No</th>
              <th>Nama Pekerjaan</th>
              <th>Nama Kegiatan</th>
              <th>SKPD</th>
              <th>Pagu</th>
              <th>User Pengelola</th>
              <th>Nama PPTK</th>
              <th width="50px">Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php
          	$start = 0;
            foreach ($user_pekerjaan_data as $user_pekerjaan){ ?>
            <tr>
              <td><?php echo ++$start ?></td>
              <td><?php echo $user_pekerjaan->nama ?></td>
              <td><?php echo $user_pekerjaan->kegiatan ?></td>
              <td><?php echo $user_pekerjaan->nama_skpd ?></td>
              <td style="white-space:nowrap;"><?php echo "Rp " . number_format($user_pekerjaan->pagu,2,',','.'); ?></td>
              <td><?php echo $user_pekerjaan->username ?></td>
              <td><?php echo $user_pekerjaan->nama_pptk ?></td>
              <td>
                <a href="<?php echo site_url('pengadaan/user_pekerjaan/list_user_pekerjaan/'.$user_pekerjaan->id_p) ?>" class="btn btn-sm btn-warning" title="Set User"><i class="fa fa-gears"></i></a>
                <a href="<?php echo site_url('pengadaan/user_pekerjaan/unset_user/'.$user_pekerjaan->id_p) ?>" class="btn btn-sm btn-danger" title="Unset User"><i class="fa fa-trash"></i></a>
              </td>
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

    // SETTING DATATABLE
    var groupColumn = 3;
  	var table = $('#mytable').DataTable({
      // stateSave: true,
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
  						'<tr class="group"><td colspan="7"><strong> '+group+' </strong></td></tr>'
  					);

  					last = group;
  				}
  			});
  		}
  	});

    $('.dataTables_filter input[type="search"]').
      attr('placeholder','Cari Pekerjaan ....').
      css({'width':'450px','display':'inline-block'});
	});
</script>
