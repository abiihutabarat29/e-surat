<!DOCTYPE html>
<html lang="en">

<head>
  <title><?= $title ?></title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

  <link rel="stylesheet" href="<?= base_url(); ?>/template/login/assets/css/style.css" />
  <link rel="stylesheet" href="<?= base_url(); ?>/template/admin/plugins/toastr/toastr.min.css">
  <link rel="icon" href="<?= base_url(); ?>/media/logo/logo.png" type="image/x-icon" />
</head>

<body>
  <section class="ftco-section">
    <div class="swal-login" data-swal="<?= session()->getFlashdata('m'); ?>"></div>
    <div class="swal-logout" data-swal="<?= session()->getFlashdata('ml'); ?>"></div>
    <div class="container">
      <div class="row justify-content-center"></div>
      <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
          <div class="wrap d-md-flex">
            <div class="img" style="background-image: url(<?= base_url(); ?>/template/login/assets/img/ilustrasi.jpg)"></div>
            <div class="login-wrap p-4 p-md-5">
              <div class="d-flex">
                <div class="w-100">
                  <h4 class="mb-4">Administrator</h4>
                </div>
              </div>
              <form class="signin-form" action="<?= base_url('auth/verify') ?>" method="post">
                <?= csrf_field(); ?>
                <div class="form-group mb-3">
                  <label class="label" for="name">Username</label>
                  <input name="username" type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" value="<?= old('username'); ?>" placeholder=" Username" required />
                  <span class="text-danger text-sm <?= ($validation->hasError('password')) ? 'xtime' : ''; ?>"> <?= $validation->getError('username'); ?></span>
                </div>
                <div class="form-group mb-4">
                  <label class="label" for="password">Password</label>
                  <input name="password" type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" placeholder="Password" required />
                  <span class="text-danger text-sm <?= ($validation->hasError('password')) ? 'xtime' : ''; ?>"> <?= $validation->getError('password'); ?></span>
                </div>
                <div class="form-group">
                  <button type="submit" class="form-control btn btn-primary submit px-3">
                    Masuk
                  </button>
                </div>
              </form>
            </div>
          </div>
          <footer class="main-footer mt-2" style="display: flex; align-items: center; justify-content: center;">
            <small>
              <span style="margin-right: 10px;">Copyright &copy;<?= date('Y') ?> <a href="https://diskominfo.batubarakab.go.id" target="blank">Dinas Komunikasi dan
                  Informatika Kab. Batu Bara</a> All rights reserved.</span>
            </small>
          </footer>
        </div>
      </div>
    </div>
  </section>
  <script>
    window.setTimeout(function() {
      $(".xtime").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      })
    }, 3000);
  </script>
  <script src="<?= base_url(); ?>/template/login/assets/js/jquery.min.js"></script>
  <script src="<?= base_url(); ?>/template/login/assets/js/popper.js"></script>
  <script src="<?= base_url(); ?>/template/login/assets/js/bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>/template/login/assets/js/main.js"></script>
  <script src="<?= base_url(); ?>/template/admin/plugins/sweetalert2/script.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url(); ?>/template/admin/dist/js/adminlte.min.js"></script>
  <!-- Toastr -->
  <script src="<?= base_url(); ?>/template/admin/plugins/toastr/toastr.min.js"></script>
</body>

</html>