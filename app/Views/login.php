<div class="container">
    <section class="vh-100">
        <div class="container-fluid h-custom" style="margin-top:100px">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form action="<?php echo base_url(); ?>/loginAuth" method="post">
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">

                            <p class="lead fw-normal mb-0 me-3" style="font-size:36px">เข้าสู่ระบบ</p>
                        </div>
                        <br>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Username</label>
                            <input type="text" name="username" id="form3Example3" class="form-control form-control-lg" placeholder="ใส่ Username" />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="form3Example4">Password</label>
                            <input type="password" name="password" id="form3Example4" class="form-control form-control-lg" placeholder="ใส่ Password" />
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success">ตกลง</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    <?php if (session()->getFlashdata('success')) : ?>
        swal("สำเร็จ", "<?= session()->getFlashdata('success') ?>", "success");
    <?php endif; ?>
</script>
<script>
    <?php if (session()->getFlashdata('fail')) : ?>
        swal("ผิดพลาด", "<?= session()->getFlashdata('fail') ?>", "error");
    <?php endif; ?>
</script>