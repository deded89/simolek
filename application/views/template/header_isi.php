<!-- HEADER HALAMAN ISI -->
    <section class="content-header">
      <h1>
        <?php echo strtoupper($uri1)?>
        <!-- <small><?php //echo $title2?></small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
		<?php if($controller){ ?>
        <li><?php echo $controller ?></li>		
		<?php  }?>
		<li class="active"><?php echo $uri1?></li>
      </ol>
    </section>