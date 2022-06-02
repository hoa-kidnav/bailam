<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Services\UserService;
class UserController extends BaseController
{
        /**
        * @var Service
        */
      
        private $service;

        public function __construct()
        {
            # code...
            $this->service=new UserService();
         

        }
    public function list()

    {


        $data=[];
       
        //    dd($data ['users']);
        $cssFiles=[
            'https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css',
            base_url() .'/admin/assets/admin/css/datatable.css'
        ];
        $jsFiles=[
            'http://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js',
            base_url() .'/admin/assets/admin/js/datatable.js'
        ];

        $dataLayout ['users']=$this->service->getAllUsers();

        $data = $this -> loadMasterLayout($data,'Danh Sách tai khoảng','admin/pages/user/list',$dataLayout,$cssFiles,$jsFiles);


        return view('admin/main',$data);
    }
    public function add()
    {
            # code...
        $data=[];

        $data = $this -> loadMasterLayout($data,'Thêm tài khoảng','admin/pages/user/add');
        return view('admin/main',$data);

    }
    public function create()
    {
        // Lấy thông tin dữ liệu truyên thành array
        // dd($this->request);
        $result= $this->service->addUserInfo($this->request);
        return redirect()->back()->withInput()->with($result['massageCode'],$result['massages']);

        # code...
    }
}