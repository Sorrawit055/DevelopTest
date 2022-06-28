<body>
    <?php $session = session(); ?>
    <div class="ex-basic-1 pt-5 pb-5" style="margin: auto;
  width: 50%;
  border: 3px solid green;
  padding: 10px;
  margin-top:36px;
  ">
        <div class="container">
            <center>
                <h3>เเก้ไขข้อมูลหมวดหมู่ไอดี : CAT<?php echo $categoryproduct['categoryid']; ?></h3>
            </center>
            <div class="row">
                <div class="col">
                    <form method="post" id="editUser" action="<?= base_url('/updateCategoryProduct/' . $categoryproduct['categoryid']) ?>" enctype="multipart/form-data">
                        <div class="col-lg-6">
                            <input type="hidden" id="categoryid" value="<?= $lastIdUser + 1 ?>" class="form-control" required>
                            <input type="hidden" id="code" name="code" value="<?php echo $categoryproduct['code']; ?>" class="form-control">
                        </div>
                        <div class="col-lg-12">
                            <label style="margin-top:8px"><b> ชื่อสินค้า </b></label>
                            <input class="form-control" type="text" name="categoryname" id="categoryname" value="<?php echo $categoryproduct['categoryname']; ?>" required>
                        </div>

                        <div class="col-lg-12">
                            <label style="margin-top:8px"><b> สถานะ </b></label>
                            <select class="form-select" name="status" aria-label="Default select example" required>
                                <option value="<?php echo $categoryproduct['status']; ?>"><?php echo $categoryproduct['status']; ?></option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Delete">Delete</option>
                            </select>
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