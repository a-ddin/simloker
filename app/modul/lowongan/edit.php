
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"> Pasang Lowongan</h3>
        </div>
    </div>
    <div class="row"> 
        <div class="col-lg-12">
            <div class="panel panel-default">
            <div class="panel-heading">Informasi Lowongan</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-10">
                    
    <?php
        $GetID  = $_GET['id'];
        $sql = "SELECT *FROM tb_lowongan WHERE id_lowongan='$GetID'";
        $res = $conn->query($sql);
        $data = $res->fetch_assoc();

            $sql = "SELECT * FROM tb_jenis_pekerjaan";
                $res = $conn->query($sql);
                while ($row = $res->fetch_assoc()) {
                    $jenis_kerja .= "<option value='{$row['id_jenis']}'> {$row['nama_jenis_kerja']} </option>";
                }

            $sql = "SELECT * FROM tb_kategori_pekerjaan";
                $res = $conn->query($sql);
                while ($row = $res->fetch_assoc()) {
                    $kategori_kerja .= "<option value='{$row['id_kategori_kerja']}'> {$row['nama_kategori_kerja']} </option>";
                }

            $sql = "SELECT * FROM tb_kategori_pendidikan";
                $res = $conn->query($sql);
                while ($row = $res->fetch_assoc()) {
                    $kategori_pendidikan .= "<option value='{$row['id_pendidikan']}'> {$row['nama_pendidikan']} </option>";
                }
    ?>    
                   
                <form class="" role="form" style="margin-top: 10px;" action="?p=lowongan.action" id="defaultForm" method="post" enctype="multipart/form-data">              
                    <!-- <div class="form-group">
                    <label> Judul</label>
                        <input type="text" class="form-control" name="judul" placeholder="Judul Lowongan" required/>
                    </div> -->
                    <input type="hidden" name="id" value="<?php echo $GetID; ?>">
                    <div class="form-group">
                    <label> Kategori Pekerjaan</label>
                        <select class="form-control" name="id_kategori_pekerjaan"/>
                            <option value="<?php echo $data['id_kategori_pekerjaan']; ?>"><?php echo $data['id_kategori_pekerjaan']; ?></option>
                            <?php echo $kategori_kerja; ?>
                        </select>
                    </div>
                    <div class="form-group">
                    <label> Posisi</label>
                        <input type="text" class="form-control" name="posisi" value="<?php echo $data['posisi']; ?>"/>
                    </div>
                    <div class="form-group">
                    <label> Jenis Kelamin</label>
                        <select class="form-control" name="jk_require"/>
                            <option value="<?php echo $data['jk_require']; ?>"><?php echo $data['jk_require']; ?></option>
                            <option value="P">Pria</option>
                            <option value="W">Wanita</option>
                            <option value="PW">Pria dan Wanita</option>
                        </select>
                    </div>
                    <div class="form-group">
                    <label> Usia</label>
                        <input type="text" class="form-control" name="usia" value="<?php echo $data['usia']; ?>"/>
                    </div>
                    <div class="form-group">
                    <label> Lulusan</label>
                        <select class="form-control" name="id_pendidikan" value="<?php echo $data['id_pendidikan']; ?>"/>
                            <option value="<?php echo $data['id_pendidikan']; ?>"><?php echo $data['id_pendidikan']; ?></option>
                            <?php echo $kategori_pendidikan; ?>
                        </select>
                    </div>
                    <div class="form-group">
                    <label> Pengalaman</label>
                        <input type="text" class="form-control" name="pengalaman" value="<?php echo $data['pengalaman']; ?>" />
                    </div>
                    <div class="form-group">
                    <label> Tanggal Akhir Lowongan</label>
                            <input type="text" name="tgl_akhir" id="datepicker" value="<?php echo date_format(date_create($data['tgl_akhir']), 'd-m-Y'); ?>" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label> Deskripsi Lowongan</label>
                        <textarea id="editor" name="deskripsi"><?php echo $data['deskripsi'];?>
                        </textarea>
                    </div>
                    <div class="form-group">
                    <label></label>
                        <a class="btn btn-default" href="?p=lowongan.view">Batal</a>
                        <button class="btn btn-primary" type="submit" name="edit">Ubah</button>
                    </div>                   
                </form>
            </div>
        </div>
    </div>
</div>
</div>
