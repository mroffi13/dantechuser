<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        if ($users) {
            return response()->json([
                'message' => 'Users found!',
                'result' => $users,
            ]);
        } else {
            return response()->json([
                'message' => 'Users Not found!',
            ], 404);
        }
    }
    //
}
