<div class="col-md-8">
<div class="panel panel-default">
    <div class="panel-body">
    <?php
    	$getID = $_GET['id'];

        $sql = "SELECT *FROM tb_lowongan 
                INNER JOIN tb_kategori_pekerjaan ON 
                (tb_lowongan.id_kategori_pekerjaan=tb_kategori_pekerjaan.id_kategori_kerja)
                INNER JOIN tb_kategori_pendidikan ON 
                (tb_lowongan.id_pendidikan=tb_kategori_pendidikan.id_pendidikan)
                INNER JOIN tb_perusahaan ON 
                (tb_lowongan.user_id=tb_perusahaan.user_id) WHERE tb_lowongan.id_lowongan = '$getID' ";
                $res = $conn->query($sql);
                foreach ($res as $row => $data) {
    ?>

    <h5 class="title-entry" >
                    
                   <?php echo $data['posisi']; ?>
                </h5><br>
				<img class="img-responsive" src="dist/images/img/<?php echo $data['img']; ?>" alt="" sizes="{max-width: 750px} 100vw, 750px" width="750">
				<p><span class="fa fa-calendar fa-fw"></span> <?php echo date_format(date_create($data['tgl_posting']), 'd/m/Y').'  <span class="glyphicon glyphicon-user"></span> '.$data['nama_perusahaan']; ?></p>
				<hr>
				<h5 class="title-entry"> Posisi</h5>
				<?php echo $data['posisi']; ?>
                <hr>
                <h5 class="title-entry"> Deadline</h5>
				<?php echo date_format(date_create($data['tgl_akhir']), 'd/m/Y'); ?>
                <hr>
                <?php } ?>


</div>
</div>
</div>
<?php require('sidebar.php'); ?>