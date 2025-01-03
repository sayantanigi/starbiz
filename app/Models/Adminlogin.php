<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Adminlogin extends Model
{    
    
    protected $table = 'admin';

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'status',
        'created_at',
        'updated_at',
    ];
    
	
	public function checkAuthLogin()
	{
	    if (!session()->get('ID_LOGIN') || !session()->get('ADMINLOGINID')) {
			//$redirectto = urlencode(current_url());
			return redirect()->intended('admin');
		}
	}

}