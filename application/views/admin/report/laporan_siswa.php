<html>

<head>
    <style>
        /** Define the margins of your page **/
        @page {
            margin: 100px 25px;
        }

        #table {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 12px;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
        }

        .sty_th {
            width: 10.5rem;
        }

        main {
            position: relative;
            top: -3rem;
        }

        header {
            /* position: fixed; */
            position: relative;
            top: -80px;
            left: 0px;
            right: 0px;
            height: auto;
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            font-size: 14px;

            /** Extra personal styles **/
            text-align: center;
            line-height: 35px;
        }

        .line-title {
            border: 0;
            border-style: inset;
            border-top: 2px solid black;
        }

        .ttd {
            margin-top: 1rem;
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            font-size: 12px;
            width: 15rem;
            position: relative;
            left: 31.5rem;
            /* border: 1px solid; */
            text-align: center;
        }

        footer {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 30px;
            font-size: 12px;

            /** Extra personal styles **/
            border: 1px solid black;
            color: black;
            text-align: center;
            line-height: 23px;

        }

        .page-number:after {
            content: counter(page);
        }

        .judul-lap {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            position: absolute;
            top: 2.5rem;
            text-align: center;
            font-size: 14px;
            width: 100%;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Define header and footer blocks before your content -->
    <header>
        <img src="<?= base_url('assets/img/' . $sekolah['logo'] . '') ?>" style="position:absolute ; width:75px; height:auto;">
        <table style="width: 100%;">
            <tr>
                <td align="center">
                    <span style="line-height: 1.6; font-weight:bold;">
                        <?= strtoupper($sekolah['jenjang']) ?>
                        <br>
                        <span style="color: #4169FF; font-size:18px;">
                            <?= strtoupper($sekolah['nama_sekolah']) ?>
                        </span>
                        <br><small style="font-weight: normal;">
                            <?= $sekolah['alamat_sekolah'] ?>
                            <br>
                            <?= $sekolah['alamat_2'] ?>
                        </small>
                    </span>
                </td>
            </tr>
        </table>
        <hr class="line-title">
    </header>

    <footer>
        &copy; Tabungan Siswa <?= ucwords(strtolower($sekolah['jenjang'])) ?> <?= ucwords(strtolower($sekolah['nama_sekolah'])) ?>
        <p style="font-size: 10px;" class="page-number"></p>
    </footer>

    <!-- Wrap the content of your PDF inside a main tag -->
    <div class="judul-lap">
        <span>LAPORAN DATA SISWA</span>
    </div>
    <main>
        <table id="table">
            <thead>
                <tr>
                    <th style="text-align:center;">No</th>
                    <th class="sty_th">Nama</th>
                    <th>Alamat</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Jenis Kelamin</th>
                    <th>Telepon</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($siswa as $sw) : ?>
                    <tr>
                        <td style="width: 5%;"><?= $no++ ?></td>
                        <td id="nm_sw"><?= $sw->nama ?></td>
                        <td><?= $sw->alamat ?></td>
                        <td><?= $sw->kelas ?></td>
                        <td><?= $sw->id_jurusan ?></td>
                        <td><?php if ($sw->jenis_kelamin == 'L') { ?>
                                Laki - Laki
                            <?php } else { ?> Perempuan <?php } ?></td>
                        <td><?= $sw->no_hp ?></td>
                    </tr>
                <?php endforeach; ?>
                <!-- <?php
                        for ($x = 1; $x <= 30; $x++) { ?>
                    <tr>
                        <td><?= $x ?></td>
                    </tr>
                <?php } ?> -->

            </tbody>
        </table>

        <div class="ttd">
            <table width="100%">
                <tr style="text-align: center;">
                    <td>
                        Pengelola Tabungan,
                        <br /><br /><br /><br />
                        <?= $pengelola['nama_pengelola'] ?>
                    </td>
                </tr>
            </table>
        </div>
    </main>
</body>

</html>