<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\ProductCategoryModel;
use App\Models\OrderModel;
use App\Models\Order_item;

class AdminController extends BaseController
{
    private $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        echo view('component/header');

        $UserModel = new UserModel();
        $CustomerModel = new CustomerModel();
        $ProductModel = new ProductModel();
        $ProductCategoryModel = new ProductCategoryModel();

        $status = ['Active', 'Inactive'];
        $data['user'] = $UserModel->whereIn('status', $status, 'ASC')->findAll();
        $data['customer'] = $CustomerModel->whereIn('status', $status, 'ASC')->findAll();

        $product = $this->db->query("SELECT * FROM `product` a JOIN productcategory b on a.categoryid = b.categoryid WHERE a.status != 'Delete'")->getResult();
        $data['product'] = $product;
        $data['categoryproduct'] = $ProductCategoryModel->whereIn('status', $status, 'ASC')->findAll();

        $data['categoryproductselect'] = $ProductCategoryModel->whereIn('status', $status, 'ASC')->findAll();


        $data['lastIdUser'] = $UserModel->orderby('userid', 'DESC LIMIT 1')->get()->getNumRows();
        $data['lastIdCustomer'] = $CustomerModel->orderby('cusid', 'DESC LIMIT 1')->get()->getNumRows();
        $data['lastIdProduct'] = $ProductModel->orderby('productid', 'DESC LIMIT 1')->get()->getNumRows();
        $data['lastIdCategoryProduct'] = $ProductCategoryModel->orderby('categoryid', 'DESC LIMIT 1')->get()->getNumRows();

        return view('/admin/dashboard', $data);
    }

    public function deleteProduct($id = null)
    {
        $ProductModel = new ProductModel();
        $Accept = $ProductModel->set('status', 'Delete')->where('productid', $id)->update($id);
        if ($Accept === TRUE) {
            return redirect()->to('/dashboard')->with('success', 'สินค้า ID : P' . $id . ' ลบสินค้าเรียบร้อย');
        }
    }

    // public function deleteProduct($id = null)
    // {
    //     $ProductModel = new ProductModel();
    //     $ProductModel->where('productid', $id)->delete($id);
    //     return redirect()->to('/dashboard')->with('success', 'สินค้า ID : P' . $id . ' ลบสินค้าเรียบร้อย');
    // }

    public function deleteUser($id = null)
    {
        $UserModel = new UserModel();
        $Accept = $UserModel->set('status', 'Delete')->where('userid', $id)->update($id);
        if ($Accept === TRUE) {
            return redirect()->to('/dashboard')->with('success', 'สมาชิก ID : I' . $id . ' ลบสมาชิกเรียบร้อย');
        }
    }

    // public function deleteUser($id = null)
    // {
    //     $UserModel = new UserModel();
    //     $UserModel->where('userid', $id)->delete($id);
    //     return redirect()->to('/dashboard')->with('success', 'สมาชิก ID : I' . $id . ' ลบสมาชิกเรียบร้อย');
    // }

    public function deleteCustomer($id = null)
    {
        $CustomerModel = new CustomerModel();
        $Accept = $CustomerModel->set('status', 'Delete')->where('cusid', $id)->update($id);
        if ($Accept === TRUE) {
            return redirect()->to('/dashboard')->with('success', 'ลูกค้า ID : C' . $id . ' ลบลูกค้าเรียบร้อย');
        }
    }

    // public function deleteCustomer($id = null)
    // {
    //     $CustomerModel = new CustomerModel();
    //     $CustomerModel->where('cusid', $id)->delete($id);
    //     return redirect()->to('/dashboard')->with('success', 'ลูกค้า ID : C' . $id . ' ลบลูกค้าเรียบร้อย');
    // }

    public function deleteCategoryProduct($id = null)
    {
        $ProductCategoryModel = new ProductCategoryModel();
        $Accept = $ProductCategoryModel->set('status', 'Delete')->where('categoryid', $id)->update($id);
        if ($Accept === TRUE) {
            return redirect()->to('/dashboard')->with('success', 'หมวดหมู่ ID : CAT' . $id . ' ลบหมวดหมู่เรียบร้อย');
        }
    }

    // public function deleteCategoryProduct($id = null)
    // {
    //     $ProductCategoryModel = new ProductCategoryModel();
    //     $ProductCategoryModel->where('categoryid', $id)->delete($id);
    //     return redirect()->to('/dashboard')->with('success', 'หมวดหมู่ ID : CAT' . $id . ' ลบหมวดหมู่เรียบร้อย');
    // }

    public function InsertUser()
    {
        $UserModel = new UserModel();
        $data = [
            'userid' => $this->request->getVar('userid'),
            'name' => $this->request->getVar('name'),
            'surname' => $this->request->getVar('surname'),
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'status' => $this->request->getVar('status'),
        ];
        $checkUser = $UserModel->where('userid', $data['userid'])->first();
        $checkUsername = $UserModel->where('username', $data['username'])->first();
        if ($checkUser === NULL) {
            if ($checkUsername === NULL) {
                $UserModel->insert($data);
                $data = $UserModel->select('name', 'DESC LIMIT 1')->get()->getNumRows();
                return redirect()->to('/dashboard')->with('success',' เพิ่มสมาชิกเสร็จสิ้น');
                // return redirect()->to('/dashboard')->with('success', 'ไอดี ' . $data . ' เพิ่มสมาชิกเสร็จสิ้น');
            } else {
                return redirect()->to('/dashboard')->with('fail', 'ไอดีสมาชิกซํ้ากรุณาลองใหม่');
            }
        }
    }
    public function InsertCustomer()
    {
        $CustomerModel = new CustomerModel();
        $data = [
            'cusid' => $this->request->getVar('cusid'),
            'name' => $this->request->getVar('name'),
            'surname' => $this->request->getVar('surname'),
            'status' => $this->request->getVar('status'),
        ];
        $checkCustomerId = $CustomerModel->where('cusid', $data['cusid'])->first();
        if ($checkCustomerId === NULL) {
            $CustomerModel->insert($data);
            return redirect()->to('/dashboard')->with('success', ' เพิ่มลูกค้าเสร็จสิ้น');
        } else {
            return redirect()->to('/dashboard')->with('fail', 'ไอดีลูกค้าซํ้ากรุณาลองใหม่');
        }
    }
    public function InsertProduct()
    {
        $ProductModel = new ProductModel();
        $data = [
            'productid' => $this->request->getVar('productid'),
            'productname' => $this->request->getVar('productname'),
            'categoryid' => $this->request->getVar('categoryid'),
            'code' => $this->request->getVar('code'),
            'status' => $this->request->getVar('status'),
            'price' => $this->request->getVar('price'),
        ];
        $checkProductId = $ProductModel->where('productid', $data['productid'])->first();
        if ($checkProductId === NULL) {
            $ProductModel->insert($data);
            return redirect()->to('/dashboard')->with('success', ' เพิ่มสินค้าเสร็จสิ้น');
        } else {
            return redirect()->to('/dashboard')->with('fail', 'ไอดีสินค้าซํ้ากรุณาลองใหม่');
        }
    }
    public function InsertCategoryProduct()
    {
        $ProductCategoryModel = new ProductCategoryModel();
        $data = [
            'categoryid' => $this->request->getVar('categoryid'),
            'categoryname' => $this->request->getVar('categoryname'),
            'code' => $this->request->getVar('code'),
            'status' => $this->request->getVar('status'),
        ];
        $checkCategoryProductId = $ProductCategoryModel->where('categoryid', $data['categoryid'])->first();
        if ($checkCategoryProductId === NULL) {
            $ProductCategoryModel->insert($data);
            return redirect()->to('/dashboard')->with('success', ' เพิ่มหมวดหมู่เสร็จสิ้น');
        } else {
            return redirect()->to('/dashboard')->with('fail', 'ไอดีหมวดหมู่ซํ้ากรุณาลองใหม่');
        }
    }

    public function editUser($id = null)
    {
        echo view('component/header');
        $UserModel = new UserModel();
        $data['user'] = $UserModel->where('userid', $id)->first();
        return view('admin/edituser', $data);
    }

    public function updateUser($id)
    {
        $UserModel = new UserModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'surname' => $this->request->getVar('surname'),
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'status' => $this->request->getVar('status'),
        ];

        $UserModel->update($id, $data);
        return redirect()->to('/dashboard')->with('success', 'ไอดีสมาชิก ID : I' . $id . ' แก้ไขข้อมูลเสร็จสิ้น');
    }

    public function editCustomer($id = null)
    {
        echo view('component/header');
        $CustomerModel = new CustomerModel();
        $data['customer'] = $CustomerModel->where('cusid', $id)->first();
        return view('admin/editcustomer', $data);
    }

    public function updateCustomer($id)
    {
        $CustomerModel = new CustomerModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'surname' => $this->request->getVar('surname'),
            'status' => $this->request->getVar('status'),
        ];

        $CustomerModel->update($id, $data);
        return redirect()->to('/dashboard')->with('success', 'ไอดีลูกค้า ID : C' . $id . ' แก้ไขข้อมูลเสร็จสิ้น');
    }

    public function editProduct($id = null)
    {
        echo view('component/header');
        $ProductModel = new ProductModel();
        $ProductCategoryModel = new ProductCategoryModel();
        $status = ['Active', 'Inactive'];
        $data['categoryproductselect'] = $ProductCategoryModel->whereIn('status', $status, 'ASC')->findAll();
        $data['product'] = $ProductModel->where('productid', $id)->first();
        return view('admin/editproduct', $data);
    }

    public function updateProduct($id)
    {
        $ProductModel = new ProductModel();
        $data = [
            'code' => $this->request->getVar('code'),
            'productname' => $this->request->getVar('productname'),
            'status' => $this->request->getVar('status'),
            'price' => $this->request->getVar('price'),
            'categoryid' => $this->request->getVar('categoryid'),
        ];

        $ProductModel->update($id, $data);
        return redirect()->to('/dashboard')->with('success', 'ไอดีสินค้า ID : P' . $id . ' แก้ไขข้อมูลเสร็จสิ้น');
    }

    public function editCategoryProduct($id = null)
    {
        echo view('component/header');
        $ProductCategoryModel = new ProductCategoryModel();
        $data['categoryproduct'] = $ProductCategoryModel->where('categoryid', $id)->first();
        return view('admin/editcategoryproduct', $data);
    }

    public function updateCategoryProduct($id)
    {
        $ProductCategoryModel = new ProductCategoryModel();
        $data = [
            'code' => $this->request->getVar('code'),
            'categoryname' => $this->request->getVar('categoryname'),
            'status' => $this->request->getVar('status'),
        ];

        $ProductCategoryModel->update($id, $data);
        return redirect()->to('/dashboard')->with('success', 'ไอดีหมวดหมู่สินค้า ID : CAT' . $id . ' แก้ไขข้อมูลเสร็จสิ้น');
    }

    public function searchDataCustomer($search = Null)
    {
        echo view('component/header');
        $UserModel = new UserModel();
        $CustomerModel = new CustomerModel();
        $ProductModel = new ProductModel();
        $ProductCategoryModel = new ProductCategoryModel();
        $OrderModel = new OrderModel();
        $Order_item = new Order_item();

        $request = service('request');
        $searchData = $request->getGet();

        $search = "";
        if (isset($searchData) && isset($searchData['search'])) {
            $search = $searchData['search'];
        }
        if ($search == '') {
            $paginateData = $OrderModel->paginate(1);
            $paginateData2 = $CustomerModel->paginate(1);
        } else {
            $paginateData = $OrderModel->select('*')->join('customer', 'customer.cusid = order.cusid')
                ->orLike('customer.cusid', $search)
                ->paginate(1);

            $paginateDat2 = $CustomerModel->select('*')
                ->orLike('cusid', $search)
                ->paginate(1);

            $paginateDat3 = $OrderModel->select('*')
                ->orLike('cusid', $search)
                ->paginate(3);
        }
        $data = [
            'customerData' => $paginateData,
            'customerData2' => $paginateDat2,
            'customerData3' => $paginateDat3,
            'pager' => $OrderModel->pager,
            'search' => $search
        ];



        $status = ['Active', 'Inactive'];

        $data['user'] = $UserModel->whereIn('status', $status, 'ASC')->findAll();
        $data['customer'] = $CustomerModel->whereIn('status', $status, 'ASC')->findAll();

        $product = $this->db->query("SELECT * FROM `product` a JOIN productcategory b on a.categoryid = b.categoryid WHERE a.status != 'Delete'")->getResult();
        $data['product'] = $product;
        $data['categoryproduct'] = $ProductCategoryModel->whereIn('status', $status, 'ASC')->findAll();
        $data['categoryproductselect'] = $ProductCategoryModel->orderBy('status', 'ASC')->findAll();


        $data['lastIdUser'] = $UserModel->orderby('userid', 'DESC LIMIT 1')->get()->getNumRows();
        $data['lastIdCustomer'] = $CustomerModel->orderby('cusid', 'DESC LIMIT 1')->get()->getNumRows();
        $data['lastIdProduct'] = $ProductModel->orderby('productid', 'DESC LIMIT 1')->get()->getNumRows();
        $data['lastIdCategoryProduct'] = $ProductCategoryModel->orderby('categoryid', 'DESC LIMIT 1')->get()->getNumRows();


        $orderitem = $this->db->query("SELECT d.productid,d.productname ,a.price as 'ราคาเต็ม',a.price as 'ราคาขาย',COUNT(a.id) as 'จำนวน' , SUM(a.price) as 'ยอด' FROM `order_item` a JOIN `order` b ON a.orderid = b.orderid JOIN product d ON a.productid = d.productid WHERE a.cusid = '$search' GROUP BY a.productid;")->getResult();
        $totalPiece = $this->db->query("SELECT COUNT(a.productid) as 'จำนวนสินค้าทั้งหมด' FROM `order_item` a JOIN `order` b ON a.orderid = b.orderid JOIN product d ON a.productid = d.productid WHERE a.cusid = '$search';")->getResult();
        $totalPrice = $this->db->query("SELECT SUM(a.price) as 'ราคาสินค้าทั้งหมด' FROM `order_item` a JOIN `order` b ON a.orderid = b.orderid JOIN product d ON a.productid = d.productid WHERE a.cusid = '$search';")->getResult();

        $order = $this->db->query("SELECT * FROM `order` WHERE cusid = '$search' AND order_status != 'Delete'")->getResult();
        $data['order'] = $order;
        // $order = $this->db->query("SELECT * FROM product WHERE productid NOT IN ( SELECT a.productid FROM order_item a JOIN product b ON a.productid = b.productid WHERE a.cusid = '$search');")->getResult();

        $data['orderitem'] = $orderitem;
        $data['totalPiece'] = $totalPiece;
        $data['totalPrice'] = $totalPrice;

        return view('admin/dashboard', $data);
    }
    public function order($cusid = Null, $date = Null)
    {
        echo view('component/header');
        $UserModel = new UserModel();
        $CustomerModel = new CustomerModel();
        $ProductModel = new ProductModel();
        $ProductCategoryModel = new ProductCategoryModel();
        $OrderModel = new OrderModel();
        $Order_item = new Order_item();
        $data['cusid'] = $cusid;
        $data['date'] = $date;

        $orderNext = $this->db->query("SELECT * FROM `order` WHERE cusid = $cusid AND date(datetime) = date(CURDATE());")->getResult();
        $data['orderNext'] = $orderNext;

        $status = ['Active', 'Inactive'];

        $data['user'] = $UserModel->whereIn('status', $status, 'ASC')->findAll();
        $data['customer'] = $CustomerModel->whereIn('status', $status, 'ASC')->findAll();
        $data['customerid'] = $CustomerModel->where('cusid', $cusid)->first();

        $product = $this->db->query("SELECT * FROM `product` a JOIN productcategory b on a.categoryid = b.categoryid WHERE a.status != 'Delete'")->getResult();
        $data['product'] = $product;
        $data['categoryproduct'] = $ProductCategoryModel->whereIn('status', $status, 'ASC')->findAll();
        $data['categoryproductselect'] = $ProductCategoryModel->orderBy('status', 'ASC')->findAll();


        $data['lastIdUser'] = $UserModel->orderby('userid', 'DESC LIMIT 1')->get()->getNumRows();
        $data['lastIdCustomer'] = $CustomerModel->orderby('cusid', 'DESC LIMIT 1')->get()->getNumRows();
        $data['lastIdProduct'] = $ProductModel->orderby('productid', 'DESC LIMIT 1')->get()->getNumRows();
        $data['lastIdCategoryProduct'] = $ProductCategoryModel->orderby('categoryid', 'DESC LIMIT 1')->get()->getNumRows();


        $orderitem = $this->db->query("SELECT d.productid,d.productname ,a.price as 'ราคาเต็ม',a.price as 'ราคาขาย',COUNT(a.id) as 'จำนวน' , SUM(a.price) as 'ยอด' FROM `order_item` a JOIN `order` b ON a.orderid = b.orderid JOIN product d ON a.productid = d.productid WHERE a.cusid = $cusid AND b.datetime = '$date' GROUP BY a.productid;")->getResult();
        $totalPiece = $this->db->query("SELECT COUNT(a.productid) as 'จำนวนสินค้าทั้งหมด' FROM `order_item` a JOIN `order` b ON a.orderid = b.orderid JOIN product d ON a.productid = d.productid WHERE a.cusid = '$cusid' AND b.datetime = '$date';")->getResult();
        $totalPrice = $this->db->query("SELECT SUM(a.price) as 'ราคาสินค้าทั้งหมด' FROM `order_item` a JOIN `order` b ON a.orderid = b.orderid JOIN product d ON a.productid = d.productid WHERE a.cusid = '$cusid' AND b.datetime = '$date';")->getResult();

        $order = $this->db->query("SELECT * FROM `order` WHERE cusid = '$cusid' AND datetime = '$date' ")->getResult();
        $data['order'] = $order;






        // $order = $this->db->query("SELECT * FROM product WHERE productid NOT IN ( SELECT a.productid FROM order_item a JOIN product b ON a.productid = b.productid WHERE a.cusid = '$search');")->getResult();

        $data['orderitem'] = $orderitem;
        $data['totalPiece'] = $totalPiece;
        $data['totalPrice'] = $totalPrice;

        return view('admin/dashboard', $data);
    }

    public function Cartindex()
    {
        echo view('component/header');
        $ProductModel = new ProductModel();
        $UserModel = new UserModel();
        $CustomerModel = new CustomerModel();
        $ProductModel = new ProductModel();
        $ProductCategoryModel = new ProductCategoryModel();
        $status = ['Active', 'Inactive'];

        $data['user'] = $UserModel->whereIn('status', $status, 'ASC')->findAll();
        $data['customer'] = $CustomerModel->whereIn('status', $status, 'ASC')->findAll();

        $product = $this->db->query("SELECT * FROM `product` a JOIN productcategory b on a.categoryid = b.categoryid WHERE a.status != 'Delete'")->getResult();
        $data['product'] = $product;
        $data['categoryproduct'] = $ProductCategoryModel->whereIn('status', $status, 'ASC')->findAll();

        $data['categoryproductselect'] = $ProductCategoryModel->orderBy('status', 'ASC')->findAll();


        $data['lastIdUser'] = $UserModel->orderby('userid', 'DESC LIMIT 1')->get()->getNumRows();
        $data['lastIdCustomer'] = $CustomerModel->orderby('cusid', 'DESC LIMIT 1')->get()->getNumRows();
        $data['lastIdProduct'] = $ProductModel->orderby('productid', 'DESC LIMIT 1')->get()->getNumRows();
        $data['lastIdCategoryProduct'] = $ProductCategoryModel->orderby('categoryid', 'DESC LIMIT 1')->get()->getNumRows();
        $product = $this->db->query("SELECT * FROM `product` a JOIN productcategory b on a.categoryid = b.categoryid WHERE a.status != 'Delete'")->getResult();
        $data['product'] = $product;

        $data['item'] = array_values(session('cart'));
        $data['total'] = $this->total();
        $data['test'] = $this->test();
        return view('/admin/dashboard', $data);
    }

    public function buy($id)
    {
        $ProductModel = new ProductModel();
        $moblie = $ProductModel->find($id);
        $item = array(
            'productid' => $moblie['productid'],
            'productname' => $moblie['productname'],
            'price' => $moblie['price'],
            'quantity' => 1,
            'test' => 1
        );
        $session = session();
        if ($session->has('cart')) {
            $index = $this->exists($id);
            $cart = array_values(session('cart'));
            if ($index == -1) {
                array_push($cart, $item);
            } else {
                $cart[$index]['quantity']++;
            }
            $session->set('cart', $cart);
        } else {
            $cart = array($item);
            $session->set('cart', $cart);
        }
        return $this->response->redirect(site_url('dashboard/index'));
    }

    public function remove($id)
    {
        $index = $this->exists($id);
        $cart = array_values(session('cart'));
        unset($cart[$index]);
        $session = session();
        $session->set('cart', $cart);
        return $this->response->redirect(site_url('dashboard/index'));
    }
    public function update()
    {
        $cart = array_values(session('cart'));
        for ($i = 0; $i < count($cart); $i++) {
            $cart[$i]['quantity'] = $_POST['quantity'][$i];
        }
        $session = session();
        $session->set('cart', $cart);
        return $this->response->redirect(site_url('dashboard/index'));
    }
    private function exists($id)
    {
        $item = array_values(session('cart'));
        for ($i = 0; $i < count($item); $i++) {
            if ($item[$i]['productid'] == $id) {
                return $i;
            }
        }
        return -1;
    }
    private function total()
    {
        $s = 0;
        $item = array_values(session('cart'));
        foreach ($item as $item) {
            $s += $item['price'] * $item['quantity'];
        }
        return $s;
    }
    private function test()
    {
        $s = 0;
        $item = array_values(session('cart'));
        foreach ($item as $item) {
            $s += $item['test']++;
        }
        return $s;
    }
}
