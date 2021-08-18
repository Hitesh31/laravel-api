<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input;

class UserController extends Controller
{
    public function getAllUsers()
    {
        $users = DB::table('user')->get() ; //fetch all users from DB
        return response()->json([
            'User'=>$users
        ]);
    }
    public function createUser(Request $request)
    {
        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $data = array('first_name' => $firstName , 'last_name'=>$lastName);
        $id = DB::table('user')->insertGetId($data);

        return response()->json([
            'id' => $id,
            'first_name' => $firstName,
            'last_name' => $lastName,
        ]);
    }

    public function showUserById($id)
    {
        $user = DB::table('user')->where('id', $id)->first();
        return response()->json([
            'user'=>$user
        ]);
    }


    public function deleteUser($id)
    {
        DB::table('user')->delete($id);
        return response()->json([
            "message" => "user deleted!"
        ]);
    }
}
