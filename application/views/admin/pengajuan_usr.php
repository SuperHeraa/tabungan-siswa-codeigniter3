<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4 px-4 py-4">
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable">
                <thead>
                    <th style="width: 6%;">No</th>
                    <th>Nama</th>
                    <th>Subjek</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($pengajuan as $pj) :
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $pj->nama ?></td>
                            <td><?= $pj->subjek ?></td>
                            <td><?= substr($pj->keterangan, 0, 50) ?>....</td>
                            <td><span class="<?php if ($pj->status == '0') { ?>
                                badge badge-warning
                                <?php } elseif ($pj->status == '1') { ?>
                                    badge badge-success
                                    <?php } elseif ($pj->status == '2') { ?>
                                        badge badge-danger 
                                        <?php } else { ?>
                                            badge badge-secondary 
                                            <?php } ?>">
                                    <?php if ($pj->status == '0') { ?>
                                        Pending
                                    <?php } elseif ($pj->status == '1') { ?>
                                        Diterima
                                    <?php } elseif ($pj->status == '2') { ?>
                                        Ditolak
                                    <?php } else { ?>
                                        error
                                    <?php } ?>
                                </span></td>
                            <td class="text-nowrap">
                                <a href="#detail<?= $pj->id_pengajuan ?>" class="btn btn-secondary btn-sm" data-toggle="modal"><i class="fas fa-eye"></i></a>
                                <a href="#catatan<?= $pj->id_pengajuan ?>" class="btn btn-success btn-sm <?php if ($pj->status == '1') { ?>  d-none <?php } ?>" data-toggle="modal"><i class="fas fa-check"></i></a>
                                <a href="#reject<?= $pj->id_pengajuan ?>" class="btn btn-danger btn-sm <?php if ($pj->status == '1') { ?>  d-none <?php } ?>" data-toggle="modal"><i class="fas fa-times"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- modal catatan acc-->
<?php foreach ($pengajuan as $pj) : ?>
    <div id="catatan<?= $pj->id_pengajuan ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-light">Catatan (Acc)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url() . 'pengajuan/acc/' . $pj->id_pengajuan ?>" method="post">
                        <div class="form-group">
                            <textarea style="height: 10rem;" type="textarea" class="form-control" name="catatan" required></textarea>
                            <input type="hidden" class="form-control" name="nominal" value="<?= $pj->nominal; ?>">
                            <input type="hidden" class="form-control" name="id_siswa" value="<?= $pj->id_siswa; ?>">
                            <input type="hidden" class="form-control" name="keterangan" value="<?= $pj->subjek; ?>">
                        </div>
                </div>
                <div class="from-group row justify-content-end">
                    <div class="col-sm-3 mb-2 mr-3">
                        <button type="submit" class="btn btn-primary btn-sm">Selesai</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Akhir modal catatan -->

<!-- modal catatan ditolak-->
<?php foreach ($pengajuan as $pj) : ?>
    <div id="reject<?= $pj->id_pengajuan ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-light">Catatan (Reject)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url() . 'pengajuan/reject/' . $pj->id_pengajuan ?>" method="post">
                        <div class="form-group">
                            <textarea style="height: 10rem;" type="textarea" class="form-control" name="catatan" required></textarea>
                        </div>
                </div>
                <div class="from-group row justify-content-end">
                    <div class="col-sm-3 mb-2 mr-3">
                        <button type="submit" class="btn btn-primary btn-sm">Selesai</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Akhir modal catatan -->

<!-- modal detail-->
<?php foreach ($pengajuan as $pj) : ?>
    <div id="detail<?= $pj->id_pengajuan ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pengajuan </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <table class="table table-borderless table-sm">
                            <tr>
                                <td style="width: 20%;font-weight:bold;">Nama</td>
                                <td>: <?= $pj->nama ?></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;font-weight:bold;">Kelas</td>
                                <td>: <?= $pj->kelas ?></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;font-weight:bold;">Jurusan</td>
                                <td>: <?= $pj->id_jurusan ?></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;font-weight:bold;">Saldo</td>
                                <td>: Rp. <?= rupiah($pj->saldo) ?></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;font-weight:bold;">Penarikan</td>
                                <td class="text-danger">: Rp. <?= rupiah($pj->nominal) ?></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;font-weight:bold;">Tanggal Pengajuan</td>
                                <td>: <?= date('d-m-Y', $pj->date_created) ?></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;font-weight:bold;">Subjek</td>
                                <td>: <?= $pj->subjek ?></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;font-weight:bold;">Keterangan</td>
                                <td>: <?= $pj->keterangan ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="from-group">
                    <div class="col-sm-2 mb-2 mr-3">
                        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Selesai</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Akhir modal detail -->



</div>
<!-- End of Main Content -->