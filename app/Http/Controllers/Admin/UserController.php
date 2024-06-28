<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getUserList(Request $request){
        $query = User::query();

        if ($request->has('role') && $request->role) {
            $role = $request->role;
            $query->where('role', $role);
        }

        if ($request->has('status') && $request->status) {
            $status = $request->status;
            $query->where('status', $status);
        }

        $users = $query->paginate($request->rowPerPage ?? 10);

        if ($users->isEmpty()) {
            return response()->json([
                'message' => 'Không tồn tại người dùng!',
            ], 404);
        }

        $data=[];
        foreach($users as $user){
            $data[]=[
                'id' => $user->id,
                'email' => $user->email,
                'role' => $user->role,
                'status' => $user->status,
            ];
        }

        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $data,
            $users->total(),
            $users->perPage(),
            $users->currentPage(),
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );
        return response()->json([
            'users' =>$paginator,
        ],200);
    }

    public function updateUser(Request $request)
    {
        $id = $request->id;
        $data = [];
        $data['status'] = $request->status;
        User::where('id', $id)->update($data);
        return response()->json(['message' => 'Sửa thành công!'], 200);
    }

    public function deleteUser(Request $request)
    {
        if (User::find($request->id)->delete()) {
            return response()->json([
                'message' => 'Xóa thành công!'
            ], 200);
        }
    }
}
