<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function home()
    {
        $user = Auth::user(); // hoặc auth()->user();
        return view('content.home', compact('user'));
    }
    public function control()
    {
        $user = Auth::user(); // hoặc auth()->user();
        return view('content.control', compact('user'));
    }
    public function log()
    {
        $user = Auth::user(); // hoặc auth()->user();
        return view('content.log', compact('user'));
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json([
                'code' => 200,
                'message' => 'Đăng nhập thành công'
            ]);
        }

        return response()->json([
            'code' => 401,
            'message' => 'Thông tin đăng nhập không đúng'
        ], 200);
    }
    public function create(Request $request)
    {
        $data = $request->all();
        if (!empty($data['fullname']) && !empty($data['email']) && !empty($data['password'])) {
            $create = User::create([
                'name' => $request['fullname'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'created_at' => Carbon::now()->format('Y-m-d h:m:s'),
                'updated_at' => Carbon::now()->format('Y-m-d h:m:s')
            ]);
            if ($create) {
                return response()->json(['message' => 'Đăng kí thành công','code' => 200], 200);
            }
        } else {
            return response()->json(['message' => 'Thiếu thông tin'], 401);
        }
    }
}
