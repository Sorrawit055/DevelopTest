<body>
    <?php $session = session(); ?>
    <div class="ex-basic-1 pt-5 pb-5" style=" margin: auto;
  width: 50%;
  border: 3px solid green;
  padding: 10px;
  margin-top:36px;
  ">
        <div class="container">
            <center>
                <h3>เเก้ไขข้อมูลลูกค้าไอดี : C<?php echo $product['productid']; ?></h3>
            </center>
            <div class="row">
                <div class="col">
                    <form method="post" id="editUser" action="<?= base_url('/updateProduct/' . $product['productid']) ?>" enctype="multipart/form-data">
                        <div class="col-lg-6">
                            <!-- <label style="margin-top:8px"><b> ไอดีสมาชิก </b></label> -->
                            <input type="hidden" id="productid" value="<?= $lastIdUser + 1 ?>" class="form-control" required>
                            <input type="hidden" id="code" name="code" value="<?php echo $product['code']; ?>" class="form-control">

                        </div>
                        <div class="col-lg-12">
                            <label style="margin-top:8px"><b> ชื่อสินค้า </b></label>
                            <input class="form-control" type="text" name="productname" id="productname" value="<?php echo $product['productname']; ?>" required>
                        </div>
                        <div class="col-lg-12">
                            <label style="margin-top:8px"><b> หมวดหมู่ </b></label>
                            <select class="form-select" name="categoryid" aria-label="Default select example" required>
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
                                <option value="<?php echo $product['status']; ?>"><?php echo $product['status']; ?></option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Delete">Delete</option>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label style="margin-top:8px"><b> ราคา </b></label>
                            <input class="form-control" type="text" name="price" id="price" value="<?php echo $product['price']; ?>" required>
                        </div>
                        <br>
                        <div class="text-center">
                            <input type="reset" id="button" class="btn btn-secondary" value="ยกเลิก" />
                            <button type="submit" class="btn btn-primary">ตกลง</button>
                        </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</body>