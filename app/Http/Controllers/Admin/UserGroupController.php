<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
// use App\UserGroup;
use Illuminate\Support\Facades\Route;
use Auth;

use App\Repositories\Contracts\UserGroupRepositoryInterface;

class UserGroupController extends Controller
{
    private $user_group;

    public function __construct(UserGroupRepositoryInterface $user_group){
        $this->user_group = $user_group;
    }
    public function index(Request $request){
        $group = $this->user_group->all();
        return view('admin.user-group.list')->with('data',$group);
    }
    public function add(Request $request){
    	$this->validate($request, [
            'name' => 'required',
            'status'=>'required',
        ]);
        $data=$request->all();
        $this->user_group->save($data);
        return redirect()->route('admin.group.list');       
    }
    public function edit($id,Request $request){
        $this->validate($request, [
            'name' => 'required',
            'status'=>'required',
        ]);
        $group = $request->all();
        if($group){
            $group['name'] = $request->name;
            $group['status'] = $request->status;
        }
        $this->user_group->update($group, $id);
        set_flash_message('Saved','success');
        return redirect()->route('admin.group.list');
    }

    public function delete($id){
        set_flash_message($this->user_group->delete($id) ? 'Deleted' : 'Fail', 'success');
        return redirect()->back();
    }

    public function form($id=''){
        $group = ($id!='') ? $this->user_group->get($id) : '';
    	return view('admin.user-group.form')->with('group',$group);
    }

    public function save_permission($id,Request $request){
        $group['permission']=json_encode($request->permission);
        $this->user_group->update($group, $id);
        set_flash_message('saved');
        return redirect()->route('admin.group.permission',['id'=>$id]);
    }

    public function permission($id){
        if (Auth::user()->id_group != 0 && $id <= Auth::user()->id_group ){
            return 'You not permission access this page';
        }
        $routeCollection = Route::getRoutes();
        $resources=[];
        foreach ($routeCollection as $value) {
            if(strpos($value->getName(),'admin')!==false){
                $resources[]= $value->getName();
            }
        }
        // $group=UserGroup::find($id);
        $group = $this->user_group->get($id);
        $permission=json_decode($group->permission,true);
     
        if(!$permission){
            $permission=[];
        }
        /*if(Auth::user()->id !=1){
            $resources=$permission;
        }
        else{
            $resources=array_unique($resources);
        }*/
        $resources=array_unique($resources);
        return view('admin.user-group.permission')->with([
            'resources'  => $resources,
            'permission' => $permission,
            'id'         => $id
        ]);
    }


}
