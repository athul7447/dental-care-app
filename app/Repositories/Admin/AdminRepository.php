<?php
namespace App\Repositories\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminRepository
{
    public function updateProfile($id,$request)
    {
        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        if($request->password){
            $admin->password = Hash::make($request->password);
        }
        $admin->save();
        return true;
    }
}
