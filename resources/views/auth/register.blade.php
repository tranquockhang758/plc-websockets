<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <style>
  [v-cloak] {
    display: none;
  }
</style>
</head>
<body class="hold-transition register-page">
<div class="register-box"  id="app">
  <div class="register-logo">
    <p>Đăng kí</p>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
        {{-- =============fullname --}}
        <div class="input-group mb-3">
            <input type="text" v-model="fullname" class="form-control" placeholder="Full name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
        </div>
        <div v-if="errors.fullname" class="text-danger mb-2">@{{errors.fullname}}</div>
        {{-- =============fullname --}}
        {{-- =============email --}}
        <div class="input-group mb-3">
            <input type="email" v-model="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
        <div v-if="errors.email" class="text-danger mb-2">@{{errors.email}}</div>
        {{-- =============email --}}
        {{-- =============Password --}}
        <div class="input-group mb-3">
            <input v-model="password" type="password" class="form-control" placeholder="Password">
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
            <button type="submit" @click="handleRegister" class="btn btn-primary btn-block">Đăng kí</button>
        </div>

        </div>

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
        fullname: '',
        errors: {
          fullname: "",
          password: "",
          email: ""
        }
      },
      methods: {
        async handleRegister() {
          this.errors = {};
          if (!this.fullname) {
            this.errors.fullname = 'Vui lòng nhập đầy đủ họ và tên';
          }
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
          const response = await axios.post('/create', {
            email: this.email,
            password: this.password,
            fullname: this.fullname
          });
          console.log(response);
          if(response.data.code==200){
            window.location.href = '/login'; // hoặc route nào bạn muốn chuyển tới
          }
          else if(response.data.code==401){
                this.errors.email = res.data.message;
            }
        }
      }
    });
    </script>
</body>
</html>
