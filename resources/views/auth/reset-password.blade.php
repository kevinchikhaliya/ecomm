<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Reset-password</title>
</head>
<body>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
               <div class="card">
                    <div class="card-header">Reset Password</div>
                         <div class="card-body">
                             <form method="POST" action="/reset-password">
                              @csrf
                              <input type="hidden" name="token" value="{{ $token }}">
                           <div class="form-group row">
                               <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                             <div class="col-md-6">
                                   <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus>
   
                                   @error('email')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                               </div>
                           </div>
       
                           <div class="form-group row">
                               <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                               <div class="col-md-6">
                                   <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
   
                                   @error('password')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                               </div>
   
                           </div>
   
                         <div class="form-group row">
                               <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                               <div class="col-md-6">
                                   <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                               </div>
                           </div>
   
                        <div class="form-group row mb-0">
                              <div class="col-md-6 offset-md-4">
                                   <button type="submit" class="btn btn-primary">
                                       Reset Password
                                   </button>
                               </div>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
   integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
   integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
   integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
</body>
</html>