<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition register-page">
<div class="register-box"  id="app">
  <div class="register-logo">
    <p>Phân loại sản phẩm</p>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Phân loại sản phẩm</p>

      <form @submit.prevent="handleLogin">
        <div class="input-group mb-3">
          <input type="text" class="form-control" v-model="email" placeholder="Email">
        </div>
        <div v-if="errors.email" class="text-danger mb-2">@{{errors.email}}</div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" v-model="password" placeholder="Password">
        </div>
        <div v-if="errors.password" class="text-danger mb-2">@{{errors.password}}</div>

        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>
<script src="{{asset('dist/js/jquery.min.js')}}"></script>
<script src="{{asset('dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('dist/js/axios.min.js')}}"></script>
<script src="{{asset('dist/js/vue.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script>
    new Vue({
      el: '#app',
      data: {
        email: '',
        password: '',
        errors: {
        }
      },
      methods: {
        async handleLogin() {
          this.errors = {};

          // Kiểm tra rỗng
          const gmailRegex = /^[a-z0-9](\.?[a-z0-9]){15,}@gmail\.com$/;
          if (!this.email) {
            this.errors.email = 'Vui lòng nhập email';
          }
          else if(!gmailRegex.test(this.email)){
                this.errors.email = 'Email phải có chứa chữ cái viết thường, ';
                this.errors.email +=  "1 số, dấu chấm, không bắt đầu và kết thúc bằng dấu chấm, ";
                this.errors.email +=  "và phải đúng định dạng @gmail.com";
            }
          //==============password: 1 số, 1 chữ hoa, 1 chữ thường, 1 kí tự đặc biệt và ít nhất 8 kí tự
          const gmailPasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/;

          if (!this.password) {
            this.errors.password = 'Vui lòng nhập mật khẩu';
          }
          else if(!gmailRegex.test(this.password)){
            this.errors.password = 'Passowrd phải có ít nhất 1 chữ thường, ';
            this.errors.password += '1 chữ hoa, ';
            this.errors.password += '1 kí tự đặc biệt, ';
            this.errors.password += '1 kí tự là số';
          }

          // Nếu có lỗi -> không gửi
          if (Object.keys(this.errors).length > 0) {
            return;
          }

          // Gửi request đến API
          $response = await axios.post('/login', {
            email: this.email,
            password: this.password
          });
          if(response.code==200){
            window.location.href = '/'; // hoặc route nào bạn muốn chuyển tới
          }
          else{
            this.errors.email = 'Email hoặc mật khẩu không đúng';
          }
        }
      }
    });
    </script>
</body>
</html>
