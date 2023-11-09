<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->
    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Saldo Anda</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= rupiah($saldo['total_setoran'] - $saldo['total_penarikan']); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-wallet fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Setoran Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= rupiah($setoran_harian['total_setoran']); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Penarikan Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= rupiah($penarikan_harian['total_penarikan']); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-3 trans-month" style="height: 28.6rem;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Riwayat Transaksi Bulan Ini (<?= date('M') ?>)</h6>
                </div>
                <div class="card-body anyClass">
                    <?php
                    foreach ($transaksi_bulanan as $thr) : ?>
                        <div class="card mb-2 px-2 py-2 <?php if ($thr->penarikan != 0) { ?>
                            border-left-danger
                            <?php } else { ?>
                                border-left-success
                                <?php } ?>">
                            <table>
                                <td style="width: 70%;"><?= tgl_id($thr->tanggal) ?></td>
                                <td class="<?php if ($thr->setoran != 0) { ?>
                                    badge badge-success
                                    <?php } else { ?>
                                        badge badge-danger
                                        <?php } ?>">
                                    <span style="<?php if ($thr->setoran == 0) { ?>
                                    display:none;
                                        <?php } ?>">Rp. <?= rupiah($thr->setoran) ?></span>
                                    <span style="<?php if ($thr->penarikan == 0) { ?>
                                    display:none;
                                        <?php } ?>">Rp. <?= rupiah($thr->penarikan) ?></span>
                                </td>
                            </table>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="card-footer py-3 d-flex flex-row align-items-center justify-content-between text-center">
                    <div class="small">
                        <span class="mr-2">
                            <i class="fas fa-square text-success"></i> Setoran
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-square text-danger"></i> Penarikan
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Papan Peringkat</h6>
                </div>
                <div class="card-body">
                    <?php
                    $no = 1;
                    $num = 4;
                    foreach ($leaderboard as $ldd) : ?>
                        <div class="card border-left-info mb-2 px-2 py-2">
                            <table>
                                <td style="width: 50px;" class="text-center font-weight-bold"><?php if ($no == 1) { ?>
                                        <img src="<?= base_url('assets/img/win1.png') ?>" width="40px">
                                    <?php } elseif ($no == 2) { ?>
                                        <img src="<?= base_url('assets/img/win2.png') ?>" width="40px">
                                    <?php } elseif ($no == 3) { ?>
                                        <img src="<?= base_url('assets/img/win3.png') ?>" width="40px">
                                    <?php } else { ?>
                                        <?= $num++ ?>
                                    <?php } ?>
                                </td>
                                <td style="width: 5%; display:none;"><?= $no++ ?></td>
                                <td style="width: 13%;"><img class="img-profile rounded-circle" style="width: 45px; height:45px;" src="<?= base_url('assets/img/') . $ldd->image ?>"></td>
                                <td class="item-nama"><span class="text-secondary"><?= $ldd->nama ?></span></td>
                                <td class="text-left item-saldo"><span class="badge badge-info">Rp. <?= rupiah($ldd->jml_setoran - $ldd->jml_penarikan) ?></span></td>
                            </table>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->