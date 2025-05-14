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
    <p>Đăng nhập</p>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Phân loại sản phẩm</p>
        <div class="input-group mb-3">
            <input type="email" v-model="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
        </div>
        <div v-if="errors.email" class="text-danger mb-2">@{{errors.email}}</div>
         {{-- =============Password --}}
        <div class="input-group mb-3">
            <input type="password" v-model="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
        </div>
        <div v-if="errors.password" class="text-danger mb-2">@{{errors.password}}</div>
            {{-- =============Password --}}
        <div class="row">
          <div class="col-12">
            <button @click="handleLogin" class="btn btn-primary btn-block">Login</button>
          </div>
        </div>
      <a href="/register" class="text-center mt1" >Đăng kí</a>
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
      delimiters: ['@{{', '}}'],
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
          const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s]).{8,}$/;
          if (!this.password) {
            this.errors.password = 'Vui lòng nhập mật khẩu';
          }
          else if(!passwordRegex.test(this.password)){
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
          try {
            const res = await axios.post('/login', {
                email: this.email.trim(),
                password: this.password.trim()
            });
            if(res.data.code==200){
                window.location.href = '/';
            }
            else if(res.data.code==401){
                this.errors.email = "email hoặc mật khẩu không đúng";
            }
            } catch (err) {
            if (err.response && err.response.status === 422) {
                this.errors = err.response.data.errors;
            } else if (err.response && err.response.status === 401) {
                alert("Đăng nhập thất bại: Thông tin không đúng");
            } else {
                console.error(err);
            }
            }
        }
      }
    });
    </script>
</body>
</html>
