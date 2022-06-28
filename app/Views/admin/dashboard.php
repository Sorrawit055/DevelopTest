<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    form.example input[type=text] {
        padding: 10px;
        font-size: 17px;
        border: 1px solid grey;
        float: left;
        width: 80%;
        background: #f1f1f1;
    }

    form.example button {
        float: left;
        width: 20%;
        padding: 10px;
        background: #2196F3;
        color: white;
        font-size: 17px;
        border: 1px solid grey;
        border-left: none;
        cursor: pointer;
    }

    form.example button:hover {
        background: #0b7dda;
    }

    form.example::after {
        content: "";
        clear: both;
        display: table;
    }
</style>

<body>
    <?php $session = session(); ?>
    <div class="container">

        <br><br>
        <p>
            <button class="btn btn-success" style="margin-top:8px;margin-right:8px" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                จัดการ User
            </button>

            <button class="btn btn-success" style="margin-top:8px;margin-right:8px" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                จัดการ Customer
            </button>

            <button class="btn btn-success" style="margin-top:8px;margin-right:8px" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample">
                จัดการ product
            </button>

            <button class="btn btn-success" style="margin-top:8px;margin-right:8px" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample4" aria-expanded="false" aria-controls="collapseExample">
                จัดการ Categoryproduct
            </button>

            <button class="btn btn-success" style="margin-top:8px;margin-right:8px" type="button" data-bs-toggle="collapse" data-bs-target="#testcode" aria-expanded="false" aria-controls="collapseExample">
                Test Code ตะกร้าสินค้า
                <?php if ($test == NULL) { ?>
                    [0]
                <?php } else { ?>
                    [<?= $test ?>]
                <?php } ?>
            </button>

        </p>
        <label>ไอดีลูกค้า(<a style="color:red">*00001</a>)</label><br>
        <form class="example" action="/searchDataCustomer" style="margin:0px;max-width:300px">
            <input type="text" placeholder="Search.." value='<?= $search ?><?= $cusid ?>' name="search" required>
            <?php if ($search == NULL) { ?>
                <button type="submit" id='btnsearch'><i class="fa fa-search"></i></button>
            <?php } else { ?>
                <button type="submit" id='btnsearch' onclick='document.getElementById("searchForm").submit();'><i class="fa fa-search"></i></button>
            <?php } ?>
        </form>
        <!-- <a class="btn btn-secondary" href="<?php echo base_url(); ?>/dashboard">ยกเลิก</a> -->
        <hr>
        <?php if ($search != NULL) { ?>
            <?php if ($customerData == NULL) { ?>
                <div class="center">
                    <center>
                        <p class="center" style="color:red;margin: auto;
width: 50%;
border: 3px solid red;
padding: 10px;
margin-top:36px;">ไอดีนี้ไม่มีการสั่งซื้อสินค้า</p>
                    </center>
                </div>
            <?php } ?>
        <?php } ?>

        <?php if ($cusid == NULL) { ?>


        <?php } else { ?>
            <div class="container">
                <div class="row">
                    <div class="col-4" style="border: 1px solid black;width:33%">
                        <div class="container">
                            <h3>C<?php echo $customerid['cusid']; ?></h3>
                            <h5>ชื่อ : <?php echo $customerid['name']; ?></h5>
                            <h5>นามสกุล : <?php echo $customerid['surname']; ?></h5>
                            <h5>สถานะ : <?php echo $customerid['status']; ?></h5>
                        </div>
                    </div>
                    <div class="col-8">
                        <?php
                        $i = 1;
                        foreach ($order as $row) { ?>
                            <div class="text-center">
                                <h1>Order</h1>
                                <h3><?php $strDate = $row->datetime;
                                    echo DateThai($strDate); ?></h3>
                                <h3>สถานะ : <?php echo $row->order_status ?></h3>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4" style="border: 1px solid gray;width:33%;margin-right:2px;margin-top:2px">
                        <div class="container"><br>
                            <h1 class="text-center">สถานะ</1>
                                <h1 class="text-center" style=color:green>ยืนยัน</1>
                        </div>
                    </div>
                    <div class="col-8" style="border: 1px solid gray;margin-top:2px">
                        <?php if ($orderitem == Null) { ?>
                        <?php } else { ?>
                            <table style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ไอดีสินค้า</th>
                                        <th>ชื่อสินค้า</th>
                                        <th>ราคาเต็ม</th>
                                        <th>จำนวน</th>
                                        <th>ราคาขาย</th>
                                        <th>ยอด</th>
                                    </tr>
                                </thead>
                                <?php
                                $i = 1;
                                foreach ($orderitem as $row) { ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $i++ ?></td>
                                            <td>I<?php echo $row->productid ?></td>
                                            <td><?php echo $row->productname ?></td>
                                            <td><?php echo $row->ราคาเต็ม ?></td>
                                            <td><?php echo $row->จำนวน ?></td>
                                            <td><?php echo $row->ราคาขาย ?></td>
                                            <td><?php echo $row->ยอด ?></td>

                                        </tr>
                                    <?php } ?>
                                    <?php
                                    foreach ($totalPiece as $row) { ?>
                                        <tr>
                                            <td style="text-align: right;" colspan="7">
                                                จำนวนสินค้าทั้งหมด : <?php echo $row->จำนวนสินค้าทั้งหมด ?> ชิ้น
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    foreach ($totalPrice as $row) { ?>
                                        <tr>
                                            <td style="text-align: right;" colspan="7">
                                                จำนวนเงินทั้งหมด : <?php echo $row->ราคาสินค้าทั้งหมด ?> บาท
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td style="text-align: right;" colspan="7">
                                            ชำระด้วย : เงินสด
                                        </td>
                                    </tr>
                                    <?php
                                    foreach ($totalPrice as $row) { ?>
                                        <tr>
                                            <td style="text-align: right;" colspan="7">
                                                ยอดรวม : <?php echo $row->ราคาสินค้าทั้งหมด ?> บาท
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                            </table>
                        <?php } ?>
                    </div>
                </div>
            </div>
    </div><br>
<?php } ?>
<?php if ($search == NULL) { ?>

<?php } else { ?>
    <div class="container">
        <?php
        if ($customerData2) : ?>
            <?php foreach ($customerData2 as $customerData2) :
                if ($customerData) : ?>
                    <?php foreach ($customerData as $customerData) : ?>
                        <?php if ($customerData2['status'] == 'Active') { ?>
                            <?php if ($customerData['order_status'] == 'Active') { ?>
                                <div class="row">
                                    <div class="col-4" style="border: 1px solid black;">
                                        <div class="container">
                                            <h3>C<?php echo $customerData['cusid']; ?></h3>
                                            <h5>ชื่อ : <?php echo $customerData['name']; ?></h5>
                                            <h5>นามสกุล : <?php echo $customerData['surname']; ?></h5>
                                            <h5>สถานะ : <?php echo $customerData['status']; ?></h5>
                                        </div>
                                    </div>

                                    <div class="col-8" style="border: 1px solid black;">
                                        <div class="collapse" id="test">
                                            <div class="card card-body">
                                                <div class="text-center">
                                                    <h1>Order</h1>
                                                    <h2>OrderStatus : <?php $strDate = $customerData['datetime'];
                                                                        echo DateThai($strDate); ?></h2>
                                                    <h2>OrderStatus : <?php echo $customerData['order_status']; ?></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4" style="border: 1px solid black;">
                                        <div class="container">
                                            <h3>Order อื่นๆ</h3>
                                            <?php
                                            if ($customerData3) : ?>
                                                <?php foreach ($customerData3 as $customerData3) : ?>

                                                    <a class="btn btn-success" href="<?php echo base_url(); ?>/order/<?php echo $customerData3['cusid']; ?>/<?php echo $customerData3['datetime']; ?>">Order วันที่ <?php $strDate = $customerData3['datetime'];
                                                                                                                                                                                                                    echo DateThai($strDate); ?></a><br><br>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <div class="d-flex justify-content-end">
                                                <?php if ($pager) : ?>
                                                    <nav aria-label="...">
                                                        <ul class="pagination">
                                                            <li class="page-item disabled">
                                                            </li>

                                                            <?php $pagi_path = 'searchDataCustomer'; ?>
                                                            <?php $pager->setPath($pagi_path); ?>
                                                            <?= $pager->links() ?>

                                                            <li class="page-item">
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                <?php endif ?>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-8" style="border: 1px solid black;">


                                    </div>
                                </div>
                            <?php } else if ($customerData['order_status'] == "Delete") { ?>
                                <div class="center">
                                    <center>
                                        <p class="center" style="color:red;margin: auto;
  width: 50%;
  border: 3px solid red;
  padding: 10px;
  margin-top:36px;">ไอดีนี้มีการสั่งซื้อสินค้าเเต่ไอดีถูกลบอยู่</p>
                                    </center>
                                </div>
                            <?php } else if ($customerData['order_status'] == "Inactive") { ?>
                                <div class="center">
                                    <center>
                                        <p class="center" style="color:red;margin: auto;
  width: 50%;
  border: 3px solid red;
  padding: 10px;
  margin-top:36px;">ไอดีนี้มีการสั่งซื้อสินค้าเเต่ไอดีถูกปิดกั้นอยู่</p>
                                    </center>
                                </div>
                            <?php  } ?>
                        <?php } else if ($customerData2['status'] == 'Delete') { ?>
                            <div class="center">
                                <center>
                                    <p class="center" style="color:red;margin: auto;
  width: 50%;
  border: 3px solid red;
  padding: 10px;
  margin-top:36px;">ไอดีนี้ถูกลบอยู่</p>
                                </center>
                            </div>
                        <?php } else if ($customerData2['status'] == 'Inactive') { ?>
                            <div class="center">
                                <center>
                                    <p class="center" style="color:red;margin: auto;
  width: 50%;
  border: 3px solid red;
  padding: 10px;
  margin-top:36px;">ไอดีนี้ถูกปิดกั้นอยู่</p>
                                </center>
                            </div>
                        <?php  } ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
<?php } ?>
<div class="container">

    <div class="collapse" id="collapseExample1">
        <h3 style="margin-top:16px">จัดการ User</h3>
        <button style="margin-bottom:16px" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertuser">
            <i class="fa-solid fa-plus"></i> เพิ่ม User
        </button>
        <div class="card card-body">
            <div style="width: 100%; padding-left: -15px;">
                <div class="table-responsive">
                    <table class="table table-bordered" id="user-list" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #<?= $test ?>
                                </th>
                                <th>ชื่อ</th>
                                <th>นามสกุล</th>
                                <th>username</th>
                                <th>password</th>
                                <th class="text-center">สถานะ</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            if ($user) : ?>
                                <?php foreach ($user as $user) : ?>
                                    <tr>
                                        <td class="text-center">C<?php echo $user['userid']; ?></td>
                                        <td><?php echo $user['name']; ?></td>
                                        <td><?php echo $user['surname']; ?></td>
                                        <td><?php echo $user['username']; ?></td>
                                        <td><?php echo $user['password']; ?></td>
                                        <td class="text-center"><?php echo $user['status']; ?></td>
                                        <td class="text-center">
                                            <a type="button" href="<?php echo base_url(); ?>/editUser/<?= $user['userid']; ?>" class="btn btn-info btn-min-width mr-1 mb-1" data-toggle="tooltip" data-placement="top" title="รายละเอียดข้อมูล" data-container="body" data-animation="true"> <i class="fa-solid fa-pen-to-square"></i></a>
                                        </td>
                                        <td class="text-center">
                                            <button onclick="validateDeleteUser(this)" value="<?= $user['userid']; ?>" class="btn btn-danger btn-min-width mr-1 mb-1" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล" data-container="body" data-animation="true"><i class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="collapse" id="collapseExample2">
        <h3 style="margin-top:16px">จัดการ Customer</h3>
        <button style="margin-bottom:16px" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertcustomer">
            <i class="fa-solid fa-plus"></i> เพิ่ม Customer
        </button>
        <div class="card card-body">
            <div style="width: 100%; padding-left: -15px;">
                <div class="table-responsive">
                    <table class="table table-bordered" id="customer-list" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #<?= $test ?>
                                </th>
                                <th>ชื่อ</th>
                                <th>นามสกุล</th>
                                <th class="text-center">สถานะ</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            if ($customer) : ?>
                                <?php foreach ($customer as $customer) : ?>
                                    <tr>
                                        <td class="text-center">C<?php echo $customer['cusid']; ?></td>
                                        <td><?php echo $customer['name']; ?></td>
                                        <td><?php echo $customer['surname']; ?></td>
                                        <td class="text-center"><?php echo $customer['status']; ?></td>

                                        <td class="text-center">
                                            <a type="button" href="<?php echo base_url(); ?>/editCustomer/<?= $customer['cusid']; ?>" class="btn btn-info btn-min-width mr-1 mb-1" data-toggle="tooltip" data-placement="top" title="รายละเอียดข้อมูล" data-container="body" data-animation="true"> <i class="fa-solid fa-pen-to-square"></i></a>
                                        </td>
                                        <td class="text-center">
                                            <button onclick="validateDeleteCustomer(this)" value="<?= $customer['cusid']; ?>" class="btn btn-danger btn-min-width mr-1 mb-1" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล" data-container="body" data-animation="true"><i class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="collapse" id="collapseExample3">
        <h3 style="margin-top:16px">จัดการ สินค้า</h3>
        <button style="margin-bottom:16px" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertproduct">
            <i class="fa-solid fa-plus"></i>เพิ่ม สินค้า
        </button>
        <div class="card card-body">
            <div style="width: 100%; padding-left: -15px;">
                <div class="table-responsive">
                    <table class="table table-bordered" id="product-list" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>ชื่อสินค้า</th>
                                <th>หมวดหมู่</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">ราคา</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($product as $row) { ?>
                                <tr>
                                    <td class="text-center">P<?php echo $row->productid ?></td>
                                    <td><?php echo $row->productname ?></td>
                                    <td><?php echo $row->categoryname ?></td>
                                    <td class="text-center"><?php echo $row->status ?></td>
                                    <td class="text-center"><?php echo $row->price ?></td>
                                    <td class="text-center">
                                        <a type="button" href="<?php echo base_url(); ?>/editProduct/<?php echo $row->productid ?>" class="btn btn-info btn-min-width mr-1 mb-1" data-toggle="tooltip" data-placement="top" title="รายละเอียดข้อมูล" data-container="body" data-animation="true"> <i class="fa-solid fa-pen-to-square"></i></a>
                                    </td>
                                    <td class="text-center">
                                        <button onclick="validateDeleteProduct(this)" value="<?php echo $row->productid ?>" class="btn btn-danger btn-min-width mr-1 mb-1" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล" data-container="body" data-animation="true"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="collapse" id="collapseExample4">
        <h3 style="margin-top:16px">จัดการ categoryproduct</h3>
        <button style="margin-bottom:16px" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertcategoryproduct">
            <i class="fa-solid fa-plus"></i>เพิ่ม categoryproduct
        </button>
        <div class="card card-body">
            <div style="width: 100%; padding-left: -15px;">
                <div class="table-responsive">
                    <table class="table table-bordered" id="categoryproduct-list" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>ชื่อหนวดหมู่สินค้า</th>
                                <th class="text-center">สถานะ</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            if ($categoryproduct) : ?>
                                <?php foreach ($categoryproduct as $categoryproduct) : ?>
                                    <tr>
                                        <td class="text-center">CAT<?php echo $categoryproduct['categoryid']; ?></td>
                                        <td><?php echo $categoryproduct['categoryname']; ?></td>
                                        <td class="text-center"><?php echo $categoryproduct['status']; ?></td>

                                        <td class="text-center">
                                            <a type="button" href="<?php echo base_url(); ?>/editCategoryProduct/<?= $categoryproduct['categoryid']; ?>" class="btn btn-info btn-min-width mr-1 mb-1" data-toggle="tooltip" data-placement="top" title="รายละเอียดข้อมูล" data-container="body" data-animation="true"> <i class="fa-solid fa-pen-to-square"></i></a>
                                        </td>
                                        <td class="text-center">
                                            <button onclick="validateDeleteCategoryProduct(this)" value="<?= $categoryproduct['categoryid']; ?>" class="btn btn-danger btn-min-width mr-1 mb-1" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล" data-container="body" data-animation="true"><i class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><br>
    <div class="collapse" id="testcode">
        <h3 style="margin-top:16px">TestCode</h3>
        <div class="card card-body">
            <table class="table table-bordered" id="product-list" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">
                            #
                        </th>
                        <th>ชื่อสินค้า</th>
                        <th>หมวดหมู่</th>
                        <th class="text-center">สถานะ</th>
                        <th class="text-center">ราคา</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($product as $row) { ?>
                        <tr>
                            <td class="text-center">P<?php echo $row->productid ?></td>
                            <td><?php echo $row->productname ?></td>
                            <td><?php echo $row->categoryname ?></td>
                            <td class="text-center"><?php echo $row->status ?></td>
                            <td class="text-center"><?php echo $row->price ?></td>
                            <td class="text-center">
                                <a href="<?= site_url('dashboard/buy/' . $row->productid) ?>"><i class="fa-solid fa-cart-shopping"></i></a>
                            </td>
                            </td>

                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php if ($item == NULL) { ?>
                <div class="text-center" style="margin-top:36px;color:red;">ไม่มีสินค้าในตะกร้า</div>
            <?php } else { ?>
                <form method="post" action="<?= site_url('dashboard/update') ?>">
                    <table class="table table-bordered" id="product-list" style="width:100%">
                        <tr>
                            <th>ไอดี</th>
                            <th>ชื่อสินค้า</th>
                            <th>จำนวน <input type="submit" value="Update"></th>
                            <th>ราคา</th>
                            <th></th>
                        </tr>
                        <?php $i = 1;
                        if ($item) : ?>
                            <?php foreach ($item as $item) : ?>
                                <tr>
                                    <td><?php echo $item['productid']; ?></td>
                                    <td><?php echo $item['productname']; ?></td>
                                    <td>
                                        <input type="number" min="1" value="<?php echo $item['quantity']; ?>" style="width:55px" name="quantity[]">
                                    </td>
                                    <td><?php echo $item['price']; ?></td>
                                    <td><a href="<?= site_url('dashboard/remove/' . $item['productid']) ?>" style="color:red"><i class="fa-solid fa-xmark"></i></a> </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <!-- จำนวนสินค้าที่ซื้อ[<?= $test ?>]; -->
                                <td colspan="5" align="right">ราคารวม</td>
                                <td><?= $total ?></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </form>
            <?php } ?>

        </div>
    </div>

    <br><br><br><br><br>
    <div class="container">

    </div>


</div>

<!-- Modal User -->
<div class="modal fade" id="insertuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มสมาชิก</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="insertUser" action="<?= base_url('/insertUser') ?>" enctype="multipart/form-data">
                    <div class="col-lg-12">
                        <!-- <label style="margin-top:8px"><b> ไอดีสมาชิก </b></label> -->
                        <input type="hidden" id="userid" value="<?= $lastIdUser + 1 ?>" class="form-control" required>
                    </div>
                    <div class="col-lg-12">
                        <label style="margin-top:8px"><b> ชื่อ </b></label>
                        <input class="form-control" type="text" name="name" id="name" required>
                    </div>
                    <div class="col-lg-12">
                        <label style="margin-top:8px"><b> นามสกุล </b></label>
                        <input type="text" id="surname" name="surname" class="form-control" required>
                    </div>
                    <div class="col-lg-12">
                        <label style="margin-top:8px"><b> Username </b></label>
                        <input class="form-control" type="text" name="username" id="username" required>
                    </div>
                    <div class="col-lg-12">
                        <label style="margin-top:8px"><b> Password </b></label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="col-lg-12">
                        <label style="margin-top:8px"><b> สถานะ </b></label>
                        <select class="form-select" name="status" aria-label="Default select example" required>
                            <option selected>กรุณาเลือกสถานะ</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            <option value="Delete">Delete</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-primary">ตกลง</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

<!-- Modal Customer -->
<div class="modal fade" id="insertcustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มลูกค้า</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="insertCustomer" action="<?= base_url('/insertCustomer') ?>" enctype="multipart/form-data">
                    <div class="col-lg-12">
                        <!-- <label style="margin-top:8px"><b> ไอดีสมาชิก </b></label> -->
                        <input type="hidden" id="cusid" value="<?= $lastIdCustomer + 1 ?>" class="form-control" required>
                    </div>
                    <div class="col-lg-12">
                        <label style="margin-top:8px"><b> ชื่อ </b></label>
                        <input class="form-control" type="text" name="name" id="name" required>
                    </div>
                    <div class="col-lg-12">
                        <label style="margin-top:8px"><b> นามสกุล </b></label>
                        <input type="text" id="surname" name="surname" class="form-control" required>
                    </div>
                    <div class="col-lg-12">
                        <label style="margin-top:8px"><b> สถานะ </b></label>
                        <select class="form-select" name="status" aria-label="Default select example" required>
                            <option selected>กรุณาเลือกสถานะ</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            <option value="Delete">Delete</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-primary">ตกลง</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

<!-- Modal Product -->
<div class="modal fade" id="insertproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มสินค้า</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="insertProduct" action="<?= base_url('/insertProduct') ?>" enctype="multipart/form-data">
                    <div class="col-lg-12">
                        <!-- <label style="margin-top:8px"><b> ไอดีสมาชิก </b></label> -->
                        <input type="hidden" id="productid" value="<?= $lastIdProduct + 1 ?>" class="form-control" required>
                    </div>
                    <div class="col-lg-12">
                        <label style="margin-top:8px"><b> ชื่อสินค้า </b></label>
                        <input class="form-control" type="text" name="productname" id="productname" required>
                    </div>

                    <input class="form-control" type="hidden" name="code" id="code" value="404">

                    <div class="col-lg-12">
                        <label style="margin-top:8px"><b> หมวดหมู่ </b></label>
                        <select class="form-select" name="categoryid" aria-label="Default select example" required>
                            <option selected>กรุณาเลือกหมวดหมู่</option>
                            <?php $i = 1;
                            if ($categoryproductselect) : ?>
                                <?php foreach ($categoryproductselect as $categoryproductselect) : ?>
                                    <option value="<?php echo $categoryproductselect['categoryid']; ?>"><?php echo $categoryproductselect['categoryname']; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <label style="margin-top:8px"><b> สถานะ </b></label>
                        <select class="form-select" name="status" aria-label="Default select example" required>
                            <option selected>กรุณาเลือกสถานะ</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            <option value="Delete">Delete</option>
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <label style="margin-top:8px"><b> ราคา </b></label>
                        <input type="number" id="price" name="price" class="form-control" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-primary">ตกลง</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

<!-- Modal CategoryProduct -->
<div class="modal fade" id="insertcategoryproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มหมวดหมู่</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="insertProduct" action="<?= base_url('/insertCategoryProduct') ?>" enctype="multipart/form-data">
                    <div class="col-lg-12">
                        <!-- <label style="margin-top:8px"><b> ไอดีสมาชิก </b></label> -->
                        <input type="hidden" id="categoryid" value="<?= $lastIdCategoryProduct + 1 ?>" class="form-control" required>
                    </div>
                    <div class="col-lg-12">
                        <label style="margin-top:8px"><b> ชื่อหมวดหมู่ </b></label>
                        <input class="form-control" type="text" name="categoryname" id="categoryname" required>
                    </div>

                    <input class="form-control" type="hidden" name="code" id="code" value="404">

                    <div class="col-lg-12">
                        <label style="margin-top:8px"><b> สถานะ </b></label>
                        <select class="form-select" name="status" aria-label="Default select example" required>
                            <option selected>กรุณาเลือกสถานะ</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            <option value="Delete">Delete</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-primary">ตกลง</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
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
<script>
    $(document).ready(function() {
        $('#user-list').DataTable({
            "language": {
                "emptyTable": "ไม่พบข้อมูล"
            },

        });
        $('#customer-list').DataTable({
            "language": {
                "emptyTable": "ไม่พบข้อมูล"
            },

        });
        $('#product-list').DataTable({
            "language": {
                "emptyTable": "ไม่พบข้อมูล"
            },

        });
        $('#categoryproduct-list').DataTable({
            "language": {
                "emptyTable": "ไม่พบข้อมูล"
            },

        });
    });

    $.extend(true, $.fn.dataTable.defaults, {
        "language": {
            "sProcessing": "กำลังดำเนินการ...",
            "sLengthMenu": "แสดง_MENU_ แถว",
            "sZeroRecords": "ไม่พบข้อมูล",
            "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
            "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
            "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
            "sInfoPostFix": "",
            "sSearch": "ค้นหา:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "เริ่มต้น",
                "sPrevious": "ก่อนหน้า",
                "sNext": "ถัดไป",
                "sLast": "สุดท้าย"
            }
        }
    });

    function validateDeleteProduct(a) {
        var id = a.value;

        swal({
            title: "ต้องการลบใช่รึไม่?",
            text: "คุณต้องการลบจริงใช่รึไม่!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "ตกลง",
            cancelButtonText: "ยกเลิก",

            closeOnConfirm: false
        }, function() {
            $(location).attr('href', '<?php echo base_url() ?>/deleteProduct/' + id);
        });
    }

    function validateDeleteUser(a) {
        var id = a.value;

        swal({
            title: "ต้องการลบใช่รึไม่?",
            text: "คุณต้องการลบจริงใช่รึไม่!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "ตกลง",
            cancelButtonText: "ยกเลิก",

            closeOnConfirm: false
        }, function() {
            $(location).attr('href', '<?php echo base_url() ?>/deleteUser/' + id);
        });
    }

    function validateDeleteCustomer(a) {
        var id = a.value;

        swal({
            title: "ต้องการลบใช่รึไม่?",
            text: "คุณต้องการลบจริงใช่รึไม่!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "ตกลง",
            cancelButtonText: "ยกเลิก",

            closeOnConfirm: false
        }, function() {
            $(location).attr('href', '<?php echo base_url() ?>/deleteCustomer/' + id);
        });
    }

    function validateDeleteCategoryProduct(a) {
        var id = a.value;

        swal({
            title: "ต้องการลบใช่รึไม่?",
            text: "คุณต้องการลบจริงใช่รึไม่!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "ตกลง",
            cancelButtonText: "ยกเลิก",

            closeOnConfirm: false
        }, function() {
            $(location).attr('href', '<?php echo base_url() ?>/deleteCategoryProduct/' + id);
        });
    }
</script>
<?php
function DateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = array("", "มกราคม.", "กุมภาพันธ์.", "มีนาคม.", "เมษายน.", "พฤษภาคม.", "มิถุนายน.", "กรกฎาคม.", "สิงหาคม.", "กันยายน.", "ตุลาคม.", "พฤศจิกายน.", "ธันวาคม.");
    $strMonthThai = $strMonthCut[$strMonth];
    return " $strDay $strMonthThai พ.ศ $strYear เวลา $strHour:$strMinute น.";
}
?>