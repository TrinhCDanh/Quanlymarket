<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\UserGroupRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    private $user;
    private $user_group;

    public function __construct(UserRepositoryInterface $user, UserGroupRepositoryInterface $user_group)
    {
        $this->user         = $user;
        $this->user_group   = $user_group;
    }

    public function addUser()
    {
        $view = [];
        $view['group'] = $this->user_group->all();
        return view('admin.user.add', $view);
    }

    public function listUser()
    {
        $view = [];
        $view['list'] = $this->user->paginate(20);
        return view('admin.user.list', $view);
    }

    public function save(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $data = $this->user->save($data);
        if ($data) {
            return redirect()->to(route('admin.user.list'));
        } else {
            return redirect()->to(route('admin.user.add'));
        }
    }

    public function editUser(Request $request, $id)
    {
        $view['user'] = $this->user->get($id);
        $view['group'] = $this->user_group->all();
        return view('admin.user.edit', $view);
    }

    public function deleteUser($id){
        // $this->user->delete($id);
        if($id==1)
            set_flash_message('Không thể xóa tài khoản root', 'danger');
        else
            set_flash_message($this->user->delete($id) ? 'Deleted' : 'Fail', 'success');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $data = $request->all();
        // dd($data);
        if ($data['password'] != null && $data['password'] != '' ) {
            $data['password'] = bcrypt($data['password']);
        }
        else{
            unset($data['password']);
        }
        $data = $this->user->update($data,$id);
        if ($data) {
            return redirect()->to(route('admin.user.list'));
        } else {
            return redirect()->to(route('admin.user.add'));
        }
    }

    public function getProfile(Request $request, $id)
    {
        if (\Auth::user()->id == $id) {
            $view['user'] = $this->user->get($id);
            return view('admin.user.profile', $view);
        }
        else{
            return 'You not authentication';
        }
    }

    public function updateProfile(Request $request, $id)
    {
        if ($request->get('password') != '') {
            $validator = \Validator::make($request->all(), [
                'email' => 'required|unique:users,email,' . $id,
                'name' => 'required',
                'password' => 'min:6|same:re_password',
                're_password' => 'same:password'
            ]);
        } else {
            $validator = \Validator::make($request->all(), [
                'email' => 'required|unique:users,email,' . $id,
                'name' => 'required'
            ]);
        }
        if (!$validator->fails()) {
            $data = $request->all();
            if ($data['password'] != null && $data['password'] != '' ) {
                $data['password'] = bcrypt($data['password']);
            }
            else{
                unset($data['password']);
            }
            $data = $this->user->update($data, $id);
            if ($data) {
                $request->session()->flash('message', 'Task was successful!');
                return redirect()->to(route('admin.user.get_profile', ['id' => $id]));
            }
        } else {
            return redirect()->back()->withErrors($validator);
        }
    }

}
