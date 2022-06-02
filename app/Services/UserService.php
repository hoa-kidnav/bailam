<?php

namespace App\Services;
use App\Models\UserModel;
use App\common\ResultUtils;
class  UserService extends  BaseService
{
    private $users;

    // Contruct 
     function __construct()
    {
        parent::__construct();
        $this->users= new UserModel();
    }

    // get all data users
    public function getAllUsers()
    {
        # code...
         return $this->users->findAll();
    }
    public function addUserInfo($requestData)
    {
        $validate=$this->validateAddUser($requestData);
        # code...
        if($validate->getErrors()){
           return [
               'status'=>ResultUtils::STATUS_CODE_ERR,
               'massageCode'=>ResultUtils::MESSAGE_CODE_ERR,
               'massages'=>$validate->getErrors()
           ];
        }
        dd("hệt lỗi rồi ");
    }
    private function validateAddUser($requestData)
    {
        $rule=[
            'email'=>'valid_email|is_unique[users.email]',
            'name'=>'max_length[100]',
            'password'=>'max_length[30]|min_length[6]|',
            'password-confirm'=>'matches[password]'
        ];
        $messages=[
            'email'=>[
                //field tương đường email 
                'valid_email'=>'tải khoảng{field}{value} khôn đúng định dạng!',
                'is_unique'=>'Email đã được đắng ký vui lòng kiểm tra lại'
            ],
            'name'=>[
          
                'max_length'=>'tên quá dài vui lòng nhập {param}ký tự !'
              
            ],
            'password'=>[
 
                'max_length'=>'mật khẩu quá  quá dài vui lòng nhập {param}ký tự !',
                'min_length'=>'mật khẩu ít nhất là {param}ký tự !'
              
            ],
            'password-confirm'=>[
           
               'matches'=>'mật khẩu không khớp vui lòng nhập lại'
              
            ]
        ];
        //kiểm trai 
        $this->validation->setRules($rule,$messages);
        // trả về thông tìn lỗi 35
        $this->validation->withRequest($requestData)->run();
        return  $this->validation;
        # code...
    }
}
