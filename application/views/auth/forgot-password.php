<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-md-center">

        <div class="col-lg-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center mb-4">
                                <h3 class="h4 text-gray-900"><?= $title ?></h3>
                            </div>
                            <?= $this->session->flashdata('message'); ?>
                            <form class="user" method="POST" action="<?= base_url('auth/forgot_password'); ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Masukan Email..." value="<?= set_value('email'); ?>">
                                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">
                                    Reset Password
                                </button>
                            </form>
                            <hr>
                            <div class="text-center mt-5">
                                <a class="small" href="<?= base_url('Auth') ?>">Kembali Ke Halaman Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>