<?php 
namespace App\Repositories; 
use Illuminate\Support\ServiceProvider; 
class RegisterRepositories extends ServiceProvider 
{ 
  public function register() 
  { 
 
        $this->app->bind( 
           'App\Repositories\Contracts\ATTPRepositoryInterface',
           'App\Repositories\Eloquent\ATTPRepository' 
 
        ); 
        $this->app->bind( 
           'App\Repositories\Contracts\ChoRepositoryInterface', 
           'App\Repositories\Eloquent\ChoRepository' 
 
        ); 
        $this->app->bind( 
           'App\Repositories\Contracts\CoSoCungCapRepositoryInterface', 
           'App\Repositories\Eloquent\CoSoCungCapRepository' 
 
        ); 
        $this->app->bind( 
           'App\Repositories\Contracts\DonViTinhRepositoryInterface', 
           'App\Repositories\Eloquent\DonViTinhRepository' 
 
        ); 
        $this->app->bind( 
           'App\Repositories\Contracts\HoKinhDoanhRepositoryInterface', 
           'App\Repositories\Eloquent\HoKinhDoanhRepository' 
 
        ); 
        $this->app->bind( 
           'App\Repositories\Contracts\LogHoKinhDoanhRepositoryInterface', 
           'App\Repositories\Eloquent\LogHoKinhDoanhRepository' 
 
        ); 
        $this->app->bind( 
           'App\Repositories\Contracts\MatHangKinhDoanhRepositoryInterface', 
           'App\Repositories\Eloquent\MatHangKinhDoanhRepository' 
 
        ); 
        $this->app->bind( 
           'App\Repositories\Contracts\NganhKinhDoanhRepositoryInterface', 
           'App\Repositories\Eloquent\NganhKinhDoanhRepository' 
 
        ); 
        $this->app->bind( 
           'App\Repositories\Contracts\PhuongRepositoryInterface', 
           'App\Repositories\Eloquent\PhuongRepository' 
 
        ); 
        $this->app->bind( 
           'App\Repositories\Contracts\QuanRepositoryInterface', 
           'App\Repositories\Eloquent\QuanRepository' 
 
        ); 
        $this->app->bind( 
           'App\Repositories\Contracts\SapRepositoryInterface', 
           'App\Repositories\Eloquent\SapRepository' 
 
        );
        $this->app->bind( 
           'App\Repositories\Contracts\UserGroupRepositoryInterface', 
           'App\Repositories\Eloquent\UserGroupRepository' 
 
        ); 
        $this->app->bind( 
           'App\Repositories\Contracts\UserRepositoryInterface', 
           'App\Repositories\Eloquent\UserRepository' 
 
        );

      $this->app->bind(
          'App\Repositories\Contracts\ThongkeRepositoryInterface',
          'App\Repositories\Eloquent\ThongkeRepository'

      );
  } 
} 
