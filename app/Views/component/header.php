<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/85b7049ed9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link href="<?php echo base_url(); ?>/css/style.css" rel="stylesheet">

</head>

<body>
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <?php $session = session(); ?>
                <?php if (isset($_SESSION['status']) && $_SESSION["status"] == "Active") { ?>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>/LoginController/dashboard">HOME</a>
                <?php } else { ?>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>/LoginController/index">HOME</a>
                <?php } ?>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    </ul>
                    <form class="d-flex">
                        <?php if (isset($_SESSION['status']) && $_SESSION["status"] == "Active") { ?>

                            <ul>
                                <li> <a style="color:white;line-height:30px;"><?php echo $session->get('name'); ?> <?php echo $session->get('surname'); ?></a>
                                    <a class="btn btn-primary" style="color:white;line-height:80%;" href="<?php echo base_url(); ?>/LoginController/logout" style="color:black">ออกจากระบบ</a>
                                </li>
                            </ul>

                        <?php } else { ?>
                            <a class="btn btn-primary" href="<?php echo base_url(); ?>/LoginController/index" style="color:black">เข้าสู่ระบบ</a> </li>
                        <?php } ?>
                    </form>

                </div>
            </div>
        </nav>




    </div>
</body>

</html>