Requirements:
- Redis (https://redis.io/, https://github.com/microsoftarchive/redis/releases)
- php version 7.2+
- nodejs

Websocket là 1 loại công nghệ hỗ trợ giao tiếp 2 chiều giữa Client và server.
Thông qua kỹ thuật giao tiếp TCP (Transmission Control Protocol) để kết nối thông tin với nhau trong môi trường Internet.
Nếu chúng ta xây dựng các mô hình gọi video, chơi game trực tuyến, v.v... sẽ được xây dựng tốt hơn. Những lập trình viên tạo web app hoặc app có tính năng realtime sẽ ưu tiên sử dụng giao thức WebSocket hơn.
- Cấu trúc chung Websocket:
- Nếu chúng ta sử dụng thư viện laravel-echo thì WebSocket có 2 tiêu chuẩn và cấu trúc như sau.

Step 2: create-project laravel
- new laravel
- php artisan laravel/ui (composer require laravel/ui)
- php artisan ui vue --auth

Step 3: Install laravel-echo + socket.io (npm install --save-dev laravel-echo socket.io-client@2.4.0)
- install laravel-echo-server (https://github.com/tlaverdure/laravel-echo-server)

Step 4: Cấu hình laravel-echo-server
Import Echo từ bên 'laravel-echo'

window.Echo = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

Step 5: Make Event (php artisan make:event NewMessage)
- 3 Mode: có 3 kiểu channel: public, private, presence

public function broadcastOn() // define channel
{
    return new PrivateChannel('chat');
    return new PresenceChannel('chat');
    return new PublicChannel('chat');
}

public function broadcastWith() { // return data channel
    return ['user' => $this->user];
}

Step 6: config database
Cấu hình nhanh mysql
Ghi đè lại phần BROADCAST_DRIVER=log. Khi broadcast sẽ ghi log để lọc dữ liệu lại
(nên dùng redis hoặc database record trước redis).

BROADCAST_DRIVER=redis
REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

Step 7: Hướng dẫn từng bước cấu hình socket.io-client vào laravel
B1/ ở thư mục config/broadcasting.php
Đảm bảo drive redis
'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
],

B2/ Tạo route nhận dữ liệu từ client gởi lên

Route::post('/message', [MessageController::class, 'store']);

- ở đây là route /message gọi controller với class là store
- Khi vào class store của controller
 + Tìm id của user gởi lên 
 + Ta sẽ broadcast 1 tin nhắn broadcast(new NewMessage($return_user, $request->input('message'))); với nội dung tin nhắn là user, và tin nhắn nhập vào

 B3/ Cấu hình broacast
   + Tạo event mới: php artisan make:events NewMessage
   Bên trong thư mục App\Events\NewMessage ta sẽ fire sự kiện broadcast với tên channel là
   chat và data được gởi lên từ client là function broadcastWith()
B4/ Cấu hình client gởi dữ liệu lên server với socket.io-client
window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});
+ ở đây mặc định công socket là 6001
+ ở client có thể sử dụng vue/react để xử lí việc re-render lại data 





