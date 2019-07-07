
<!-- isi halaman -->
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
			<div class="box-body table-responsive">
				<table class="table table-bordered table-striped" id="mytable">
				   <thead>
						<tr>
							<th width="30px">No</th>
							<th><?php echo lang('index_username_th');?></th>
							<th><?php echo lang('index_email_th');?></th>
							<th><?php echo lang('index_groups_th');?></th>
							<th><?php echo lang('index_status_th');?></th>
							<th style="text-align:center"><?php echo lang('index_action_th');?></th>
						</tr>
					</thead>
					<tbody>
					<?php
						$start = 0;
						foreach ($users as $user){
					?>
						<tr>
							<td><?php echo ++$start ?></td>
							<td><?php echo htmlspecialchars($user->username,ENT_QUOTES,'UTF-8');?></td>
							<td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
							<td>
								<?php foreach ($user->groups as $group):?>
									<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
								<?php endforeach?>
							</td>
							<td>
							<?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?>
							</td>

							<td style="text-align:center" width="120px">
								<?php echo anchor("auth/edit_user/".$user->id, '<i class="fa fa-pencil-square-o"></i>', 'title="Update" class="btn btn-warning btn-sm"') ;?>
							</td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
				<p><?php echo anchor('auth/create_group', lang('index_create_group_link'))?></p>
			</div>
		 </div>
	</div>
</div>

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#mytable").dataTable();
	});
</script>
