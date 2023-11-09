<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-9">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        </div>
        <div class="col-3 text-right">
            <a href="<?= base_url('Tabungan'); ?>" class="btn btn-warning btn-sm">Kembali</a>
        </div>
    </div>

    <?= $this->session->flashdata('message'); ?>
    <div class="card pl-2 pr-2 pt-2">
        <div class="row mb-2">
            <div class="card-title mx-2">
                <h4>Identitas Siswa</h4>
            </div>
            <!-- <div class="col-7 text-right text-nowrap">
                <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#cetakDetail"><i class="fa fa-file-pdf"></i> Export Pdf</button>
                <a href="<?= base_url('report/cetak/') . $ds_image['id_siswa'] ?>" class="btn btn-outline-success btn-sm"><i class="fa fa-file-excel"></i> Export Excel</a>
            </div> -->
        </div>
        <div class="row">
            <div class="col-md-9 col-sm-8 col-xs-12">
                <div class="table table-responsive">
                    <table class="table text-dark">
                        <?php foreach ($detail_siswa as $ds) : ?>
                            <tr>
                                <td class="font-weight-bold" width="7%">Nama</td>
                                <td>: <?= $ds->nama ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" width="7%">Email</td>
                                <td>: <?= $ds->email ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" width="7%">Alamat</td>
                                <td>: <?= $ds->alamat ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" width="7%">Gender</td>
                                <td>: <?php if ($ds->jenis_kelamin == 'L') { ?>
                                        Laki - Laki
                                    <?php } else { ?> Perempuan <?php } ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" width="7%">Kelas</td>
                                <td>: <?= $ds->kelas ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" width="7%">Jurusan</td>
                                <td>: <?= $ds->id_jurusan ?> - <?= $jurusan['jurusan'] ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" width="7%">Telepon</td>
                                <td>: <?= $ds->no_hp ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" width="7%">Saldo</td>
                                <td>: Rp.&nbsp;<?= rupiah($ds->jml_setoran - $ds->jml_penarikan) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 d-none d-sm-block d-md-block text-center">
                <img class="img-fluid img-thumbnail mb-3 shadow" src="<?= base_url('assets/') ?>img/<?= $ds_image['image'] ?>" width="200">
                <?php foreach ($detail_siswa as $ds) : ?>
                    <p class="card-text"><small class="text-muted">Member Sejak <?= date('d F Y', $ds->date_created) ?></small></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="card pr-2 pl-2 pt-2 mt-3 mb-3">
        <div class="card-title mx-2">
            <div class="row">
                <div class="col-lg-5">
                    <h4>Riwayat Transaksi</h4>
                </div>
                <div class="col-lg-7 text-right text-nowrap">
                    <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#cetakDetail"><i class="fa fa-file-pdf"></i> Cetak Pdf</button>
                    <!-- <a href="<?= base_url('report/cetak/') . $ds_image['id_siswa'] ?>" class="btn btn-outline-success btn-sm"><i class="fa fa-file-excel"></i> Export Excel</a> -->
                </div>
            </div>
        </div>

        <div class="table-responsive px-1 pb-2 anyClasss">
            <table id="example" class="table table-hover table-sm text-nowrap">
                <thead class="thead-dark sticky-top">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Petugas</th>
                        <th>Setoran</th>
                        <th>Penarikan</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($tmp_riwayat as $tr) : ?>
                        <tr style="color:<?php if ($tr->setoran == 0) { ?>
                            red;
                            <?php } else { ?>
                             green;   
                                <?php } ?>">
                            <td style="width: 2%;"><?= $no++ ?></td>
                            <td style="width: 20%;"><?= tgl_id($tr->tanggal) ?></td>
                            <td><?= $tr->petugas ?></td>
                            <td>Rp. <?= rupiah($tr->setoran) ?></td>
                            <td>Rp. <?= rupiah($tr->penarikan) ?></td>
                            <td><?= $tr->keterangan ?></td>
                            <td class="text-center">
                                <a href="#modalEditTrans<?= $tr->id_tabungan ?>" class="badge badge-warning" data-toggle="modal"><i class="fas fa-pencil-alt fa-xs"></i> Edit</a>
                                <a href="#modalHapus<?= $tr->id_tabungan ?>" class="badge badge-danger" data-toggle="modal"><i class="fas fa-trash fa-xs"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal Hapus Data -->
<?php foreach ($tmp_riwayat as $tr) : ?>
    <div class="modal fade" id="modalHapus<?= $tr->id_tabungan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle">Menghapus Data</h4>
                </div>
                <div class="modal-body">
                    Yakin Anda Ingin Menghapus Data Ini ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <?= anchor('detail/hapus/' . $tr->id_tabungan, '<button class="btn btn-primary">Yakin</button>') ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Akhir modal hapus data -->

<!-- Modal update data -->
<?php foreach ($tmp_riwayat as $ds) : ?>
    <div class="modal fade" id="modalEditTrans<?= $ds->id_tabungan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h4 class="modal-title" id="exampleModalLabel">Update Transaksi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="<?= base_url() . 'detail/edit/' . $ds->id_tabungan ?>" method="post">
                        <div class="form-group">
                            <input type="hidden" name="id_tabungan" class="form-control" value="<?= $ds->id_tabungan ?>">
                            <input type="hidden" name="id_siswa" class="form-control" value="<?= $ds->id_siswa ?>">
                            <label>Tanggal Transaksi</label>
                            <input type="text" name="tanggal" class="form-control" value="<?= date("d-m-Y", strtotime($ds->tanggal)) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Setoran</label>
                            <input id="frm-str" type="text" name="setoran" class="form-control penset" value="<?= $ds->setoran ?>" onkeypress="return inputAngka(event)" required>
                        </div>
                        <div class="form-group">
                            <label>Penarikan</label>
                            <input id="frm-pnr" type="text" name="penarikan" class="form-control" value="<?= $ds->penarikan ?>" onkeypress="return inputAngka(event)" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" value="<?= $ds->keterangan ?>">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Akhir modal update data -->
<!-- Modal Ceetak Laporan Detail -->
<div class="modal fade bd-example-modal-lg" id="cetakDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Print Laporan Detail Tabungan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe name="display-frame" src="<?= base_url('report/cetakDetail/') . $ds_image['id_siswa'] ?>" style="width:100%;height:520px;border:2px solid #4e46e5;"></iframe>
            </div>
        </div>
    </div>
</div>
<!-- Akhir Modal Cetak Laporan Detail -->

</div>
<!-- End of Main Content -->