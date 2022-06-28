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
                <h3>เเก้ไขข้อมูลลูกค้าไอดี : C<?php echo $customer['cusid']; ?></h3>
            </center>
            <div class="row">
                <div class="col">
                    <form method="post" id="editUser" action="<?= base_url('/updateCustomer/' . $customer['cusid']) ?>" enctype="multipart/form-data">
                        <div class="col-lg-6">
                            <!-- <label style="margin-top:8px"><b> ไอดีสมาชิก </b></label> -->
                            <input type="hidden" id="userid" value="<?= $lastIdUser + 1 ?>" class="form-control" required>
                        </div>
                        <div class="col-lg-12">
                            <label style="margin-top:8px"><b> ชื่อ </b></label>
                            <input class="form-control" type="text" name="name" id="name" value="<?php echo $customer['name']; ?>" required>
                        </div>
                        <div class="col-lg-12">
                            <label style="margin-top:8px"><b> นามสกุล </b></label>
                            <input type="text" id="surname" name="surname" value="<?php echo $customer['surname']; ?>" class="form-control" required>
                        </div>
                        <div class="col-lg-12">
                            <label style="margin-top:8px"><b> สถานะ </b></label>
                            <select class="form-select" name="status" aria-label="Default select example" required>
                                <option value="<?php echo $customer['status']; ?>"><?php echo $customer['status']; ?></option>
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