<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <!-- <div class="row justify-content-center mb-3">
        <div class="col-xs-12 col-sm-4 col-md-6 col-lg-3 border-bottom-primary text-center pb-3 pt-3 shadow">
            <?= $this->session->flashdata('message'); ?>
            <div id="uploaded_image">
                <img src="<?= base_url('assets/img/') . $siswa['image'] ?>" class=" img-fluid rounded img-thumbnail mb-4" width="200">
            </div>

            <h5 class="card-title font-weight-bold"><?= $siswa['nama']; ?></h5>
            <i class="fas fa-envelope"></i>
            <p class="card-text"><?= $siswa['email'] ?></p>
            <p class="card-text"><small class="text-muted">Terdaftar Sejak <?= date('d F Y', $siswa['date_created']) ?></small></p>
            <button class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#editNama">Edit Profil</button>
            <button class="btn btn-success btn-sm mb-1" data-toggle="modal" data-target="#editGambar">Edit Gambar</button>
            <a href="<?= base_url('Profil_m/change') ?>" class="btn btn-warning btn-sm">Edit Password</a>
        </div>
    </div> -->


    <div class="row">
        <div class="col-md-3 text-center mb-3">
            <div class="card shadow px-3 py-3">
                <?= $this->session->flashdata('message'); ?>
                <div id="uploaded_image">
                    <img src="<?= base_url('assets/img/') . $siswa['image'] ?>" class=" img-fluid rounded img-thumbnail mb-4" width="200">
                </div>

                <h5 class="card-title font-weight-bold"><?= $siswa['nama']; ?></h5>
                <p class="card-text"><small class="text-muted">Terdaftar Sejak <?= date('d F Y', $siswa['date_created']) ?></small></p>
                <div class="btton">
                    <button class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#editNama">Edit Profil</button>
                    <button class="btn btn-success btn-sm mb-1" data-toggle="modal" data-target="#editGambar">Edit Gambar</button>
                    <a href="<?= base_url('Profil_m/change') ?>" class="btn btn-warning btn-sm">Edit Password</a>
                </div>

            </div>
        </div>
        <div class="col-md-9">
            <div class="px-3 py-3 card shadow">
                <h5 class="mb-3">Tentang</h5>
                <table class="table">
                    <tr>
                        <td style="width: 20%;">Email</td>
                        <td>: <?= $siswa['email'] ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>: <?php if ($siswa['jenis_kelamin'] == 'L') { ?>
                                Laki - Laki
                            <?php } else { ?> Perempuan <?php } ?></td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>: <?= $siswa['kelas'] ?></td>
                    </tr>
                    <tr>
                        <td>Jurusan</td>
                        <td>: <?= $siswa['id_jurusan'] . ' - ' . $siswa['jurusan'] ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: <?= $siswa['alamat'] ?></td>
                    </tr>
                    <tr>
                        <td>Kontak</td>
                        <td>: <?= $siswa['no_hp'] ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal croppie -->
<div id="uploadimageModal" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Crop &amp; Upload Gambar</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div id="image_demo"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success crop_image">Crop &amp; Upload</button>
            </div>
        </div>
    </div>
</div>
<!-- Akhir Modal croppie -->

<!-- Modal ganti nama-->
<div class="modal fade" id="editNama" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() . 'profil_m/edit/' . $siswa['id_siswa'] ?>" method="post">
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" id="email" value="<?= $siswa['email']; ?>">
                            <input type="hidden" class="form-control" name="id_siswa" value="<?= $siswa['id_siswa']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" id="nama" value="<?= $siswa['nama']; ?>">
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-10">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal ganti gambar-->
<div class="modal fade" id="editGambar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ganti Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('profil_m/edit'); ?>
                <div class="form-group mx-2 my-2">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="upload_image" id="upload_image" accept="image/*">
                        <label class="custom-file-label" for="image">Pilih File</label>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>



</div>
<!-- End of Main Content -->