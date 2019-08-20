<div class='row'>
	<div class='col-xs-12'>
	    <div class='box box-primary'>
			<form action="<?php echo $action; ?>" method="post">
				<table class='table table-bordered'>
					<tr>
						<?php
							if($identity_column!=='email') {
								echo '<td width="200px">';
								echo lang('create_user_identity_label', 'identity');
								echo '</td><td>';
								echo form_error('identity');
								echo form_input($identity);
								echo '</td>';
							}
						?>
					</tr>
					<!-- CSRF TOKEN -->
					<?php
						$csrf = array(
							'name' => $this->security->get_csrf_token_name(),
							'hash' => $this->security->get_csrf_hash()
						);
					?>
					<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
					<?php echo form_input($phone);?>
					<?php echo form_input($company);?>
					<?php echo form_input($email);?>
					<?php echo form_input($password);?>
					<?php echo form_input($password_confirm);?>
					<!-- <tr>
					<td><?php //echo lang('create_user_phone_label', 'phone');?> </td>
					<td></td>
				</tr> -->
					<!--
					<tr>
					<td><?php //echo lang('create_user_email_label', 'email');?> </td>
					<td></td>
				</tr> -->
					<!-- <tr>
						<td><?php// echo lang('create_user_password_label', 'password');?> </td>
						<td></td>
					</tr>
					<tr>
						<td><?php// echo lang('create_user_password_confirm_label', 'password_confirm');?></td>
						<td></td>
					</tr> -->
						<td colspan='2'>
							<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
							<a href="<?php echo site_url('Pekerjaan') ?>" class="btn btn-danger">Cancel</a>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
