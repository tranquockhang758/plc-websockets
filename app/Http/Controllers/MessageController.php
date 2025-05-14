<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Events\NewMessage;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        try {

            //Thực hiện kiểm tra và lưu dữ liệu vào đây
            $validated = $request->validate([
                'sender_id' => 'required|exists:users,id',
                'message'     => 'required|string|max:5000',
            ]);
            $message = Message::create([
                'sender_id'   => $request->input('sender_id'), // ID người gửi (tự động từ user đăng nhập)
                'message'     => $request->input('message'),
                'is_read'     => false,
            ]);
            $return_user = User::find($request->input('sender_id'));
            broadcast(new NewMessage($return_user, $request->input('message')));
            return response()->json([
                'code' => 200,
                'message' => $request->input('message'),
            ], 200);
        } catch (ValidationException $e) {
            return response()->json(['code' => 422, 'message' => 'Invalid data', 'errors' => $e->errors()], 422);
        }
    }
}
