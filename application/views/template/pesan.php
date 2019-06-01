<!-- TAMPILKAN PESAN -->
		<?php if($this->session->userdata('message') <> ''){ ?>
		<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <!-- <h4><i class="icon fa fa-check"></i> Sukses!</h4> -->
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message'): ''; ?>
        </div>
		<?php }?>

		<?php if($this->session->userdata('info') <> ''){ ?>
		<div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <!-- <h4><i class="icon fa fa-info"></i> Informasi!</h4> -->
                <?php echo $this->session->userdata('info') <> '' ? $this->session->userdata('info'): ''; ?>
        </div>
		<?php }?>

		<?php if($this->session->userdata('error') <> ''){ ?>
		<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <!-- <h4><i class="icon fa fa-ban"></i> Gagal!</h4> -->
                <?php echo $this->session->userdata('error') <> '' ? $this->session->userdata('error'): ''; ?>
        </div>
		<?php }?>
