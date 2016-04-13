<?php 
class RegisterController extends BaseController
{
 
    public function registerForm()
    {
        return View::make('singup');
    }
     
    public function registerCreate()
    {
     
        $validator = Validator::make(Input::all(),array(
                'name'                              => 'required|min:4|max:100',
                'surname'                           => 'required|min:4|max:100',
                'password'                          => 'required|min:4|max:15|confirmed',
                'password_confirmation'             => 'required|min:4|max:15',
                'email'                             => 'required|email|max:100|unique:tbl_user',
            ),
            array(
                'name.required'                     => 'Name ไม่สามารถเป็นค่าว่างได้',
                'surname.required'                  => 'Surname ไม่สามารถเป็นค่าว่างได้',
                'email.required'                    => 'email ไม่สามารถเป็นค่าว่างได้',
                'email.email'                       => 'รูปแบบ E-Mail ไม่ถูกต้อง',
                'email.unique'                      => 'email นี้มีอยู่ในระบบแล้ว',       
                'password.required'                 => 'password ไม่สามารถเป็นค่าว่างได้',
                'password.confirmed'                => 'รหัสผ่านไม่ตรงกัน',
                'password_confirmation.required'    => 'confirm password ไม่สามารถเป็นค่าว่างได้',
            )
        );
         
        if ($validator->passes()) {
             
            $addUser                = new User1();
            $addUser->name          = Input::get('name');
            $addUser->surname       = Input::get('surname');
            $addUser->password      = Hash::make(Input::get('password'));
            $addUser->email         = Input::get('email');
            $addUser->create_at     = date("Y-m-d H:i:s",time());
            $addUser->save();
             
            return Redirect::to('register')->with('flashC_notice','success'); 
             
        }else{
         
            return Redirect::to('register')->withErrors($validator)
                    ->withInput(Input::except('password'))
                    ->withInput(Input::except('password_confirmation'))
                    ->withInput(); 
                     
        }
    }
     
}

?>