@extends('theme.layout.layout')

@section('content')

<!-- Register Section Begin -->
<div class="register-login-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="register-form">
                    <h2>Register</h2>
                    <form action="register" method="POST">
                        @csrf
                        <div class="group-input">
                            <label for="username">Username *</label>
                            <input type="text" name="name" id="username" required>
                        </div>
                        <div class="group-input">
                            <label for="pass">email address *</label>
                            <input type="text" name="email" id="pass" required>
                        </div>
                        <div class="group-input">
                            <label for="con-pass">Password *</label>
                            <input type="password" name="password" id="con-pass" required>
                        </div>
                        <button type="submit" class="site-btn register-btn">REGISTER</button>
                    </form>
                    <div class="switch-login">
                        <a href="./login" class="or-login">Or Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Register Form Section End -->
@endsection
