<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\UserGroup;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()){
            
            if($request->user()->id_group!=0){
                $group=UserGroup::find($request->user()->id_group);
                $permission=json_decode($group->permission,true);
                $current_route_name=$request->route()->getName();
                    
                $allow_route=[
                    'admin', //dashboard
                    'home',
                    'default.error',
                ];
                if(in_array($current_route_name, $allow_route) ){
                    return $next($request);
                }
                if(!$permission || !in_array($current_route_name,$permission)){
                    set_flash_message('Bạn không có quyền vào trang này !','danger');//You not permission on this page
                    return redirect()->route('default.error');
                }
            }
            return $next($request);
        }
        else{
            return redirect()->to('login');
        }

    }
}
