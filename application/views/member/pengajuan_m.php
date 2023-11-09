<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <div class="box mb-2">
        <a href="<?= base_url('pengajuan/tambah') ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Pengajuan</a>
    </div>
    <div class="card shadow mb-4 px-4 py-4">
        <div class="table-responsive">
            <table class="table" id="dataTable">
                <thead>
                    <th style="width: 6%;">No</th>
                    <th>Subjek</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($ri_pengajuan as $pj) :
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $pj->subjek ?></td>
                            <td><?= substr($pj->keterangan, 0, 50); ?>....</td>
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
                            <td><a href="<?= base_url('detail_p/index/' . encrypt_url($pj->id_pengajuan)); ?>" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->



</div>
<!-- End of Main Content -->