<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash as FacadesHash;


class AdminController extends Controller
{
    public function index()
    {
        //get all users
        $users = DB::table('users')
            ->rightJoin('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.*', 'roles.name as role')
            ->get();

        return response()->json($users);
        // return ResponseFormatter::success([
        //     'data' => $users,
        //     'message' => 'Data user berhasil di ambil',
        // ], 200);
    }

    //Start of function of register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:users',
            'role_id' => 'required|integer',
            'password' => 'required|min:6|max:100',
            'confirm_password' => 'required|same:password',
            // 'user_photoProfile' => 'required|min:8|max:1024',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => FacadesHash::make($request->password)
        ]);

        return response()->json([
            'message' => 'Registration successfull',
            'data' => $user,
        ], 200);
    }
    //End of function of register

    //start of function edit
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'confirmation' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        $user->update([
            'confirmation' => $request->confirmation,
        ]);

        return response()->json([
            'message' => 'Confirmation updated',
            'data' => $user,
        ], 200);
    }
    //end of function edit

    public function delete($id)
    {
        try {
            $user = User::find($id);
            return $user->delete();
            return ResponseFormatter::success([
                'message' => 'User deleted succesfull',
            ], 'User deleted succesfull', 500);
        } catch (QueryException $error) {
            return ResponseFormatter::error([
                'message' => 'something went wrong',
                'error' => $error,
            ], 'User not deleted', 500);
        }
    }
}
