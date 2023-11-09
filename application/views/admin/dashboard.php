<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Saldo Tersimpan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= rupiah($total_saldo['total_setoran'] - $total_saldo['total_penarikan']); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-wallet fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Setoran (Harian)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= $pemasukan_harian['total_setoran'] != null ? rupiah($pemasukan_harian['total_setoran']) : 0 ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Penarikan (Harian)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= $penarikan_harian['total_penarikan'] != null ? rupiah($penarikan_harian['total_penarikan']) : 0 ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Siswa yang menabung -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Member Terdaftar
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $siswa_nabung ?> <sup><small class="font-weight-bold">Siswa</small></sup></div>
                                </div>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-8">
            <div class="card shadow mb-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Setoran dan Penarikan (Bulanan)</h6>
                </div>
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Persentase -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Persentase Minat Siswa</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="pb-2">
                        <h6 class="text-xs font-weight-bold text-info text-uppercase mb-2">Siswa Yang Menabung</h6>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $persen_siswa ?> %</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: <?= $persen_siswa ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <small>Total Siswa Keseluruhan : <?= $jml_siswa['jumlah_siswa'] ?> Siswa</small>
                        <hr class="sidebar-divider">
                        <h6 class="text-xs font-weight-bold text-primary text-uppercase mb-2">Laki-Laki</h6>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $jml_laki ?> <sup><small>Orang</small></sup></div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $prog_laki ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small><?= $prog_laki ?> % dari total member</small>
                            </div>
                        </div>
                        <hr class="sidebar-divider">
                        <h6 class="text-xs font-weight-bold text-warning text-uppercase mb-2">Perempuan</h6>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $jml_perempuan ?> <sup><small>Orang</small></sup></div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $prog_perempuan ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small><?= $prog_perempuan ?> % dari total member</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card shadow mb-3" style="height: 28.5rem;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Transaksi Minggu Ini</h6>
                </div>
                <div class="card-body anyClass">
                    <?php
                    foreach ($transaksi_mingguan as $thr) : ?>
                        <div class="card mb-2 px-2 py-2 <?php if ($thr->penarikan != 0) { ?>
                            border-left-danger
                            <?php } else { ?>
                                border-left-success
                                <?php } ?>">
                            <table>
                                <span style="font-size: 10px;"><i><?= tgl_id($thr->tanggal) ?></i></span>
                                <td class="item-nama" style="width: 70%;"><?= $thr->nama ?></td>
                                <td class=" <?php if ($thr->setoran != 0) { ?>
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
        <div class="col-lg-7">
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

    <!-- Content Row -->
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->