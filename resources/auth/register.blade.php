{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>
            <div class="mt-4">
                <x-label for="password" value="Role" />
               <select value="" name="role" class="form-control shadow-sm">
                <option value="admin">Admin</option>
                <option value="user">User</option>
               </select>
            </div>
            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
     <!-- Font Awesome -->
<link
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
rel="stylesheet"
/>
<!-- Google Fonts -->
<link
href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
rel="stylesheet"
/>
<!-- bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<style>
   body{
        background-image: url('/img/reg.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        color: rgb(255, 255, 255) !important;

     }
 .card{
    background: transparent;
 }
 .form-control{
  color: rgb(255, 255, 255);
}

 .form-control:focus{
  color: rgb(255, 255, 255);
}

#tran{
    background: transparent;
}
label {
    color: white;
}
option{
    background: transparent;
    color: black;
}
</style>
</head>
<body>

<div class="col-6 offset-3">
    <div class="card">
        <div class="card-body py-5 px-md-5 ">
          <form action="{{ route('register') }}" method="POST">
              @csrf
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="tran" name="name" placeholder="name@example.com" >
              <label for="floatingInput">Your Name</label>
              @error('name')
              <p class="text-info">*{{ $message }}*</p>
          @enderror
            </div>
            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="tran" name="email" placeholder="name@example.com" >
              <label for="floatingInput">Email address</label>
              @error('email')
              <p class="text-info">*{{ $message }}*</p>
          @enderror
            </div>
            <div class="form-floating mb-3">
                <select class="form-control" style="background: transparent" name="role" aria-label="Default select example">
                     <option value="admin">Admin</option>
                    <option value="user">User</option>

                  </select>

              </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="tran" name="password" placeholder="Password" >
              <label for="floatingPassword">Password</label>
              @error('password')
              <p class="text-info">*{{ $message }}*</p>
          @enderror
            </div>
            <div class="form-floating">
              <input type="password" class="form-control" id="tran" name="password_confirmation" placeholder="Password" >
              <label for="floatingPassword">Confirm Password</label>
              @error('password')
              <p class="text-info">*{{ $message }}*</p>
          @enderror
            </div>
            <!-- Checkbox -->
            <div class="form-check d-flex justify-content-center mb-2 mt-2">
              <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
              <label class="form-check-label text-white" for="form2Example33">
                Subscribe to our newsletter
              </label>
            </div>



            <!-- Submit button -->
         <div class="text-center">
          <input type="submit" value="Register" class="rounded btn btn-outline-info fs-5" style="width: 100%; font-weight: 600;">
         </div>
              {{-- Login --}}

              <div class="text-center text-white mb-3 mt-2">
                Already have an account?

                  <div class="mt-2">
                     <a href="{{ route('login') }}">
                      <button type="button" class="btn btn-outline-info btn-rounded fs-5" style="width: 34%; font-weight: 600;" >Login Here</button>
                     </a>
                    </div>

              </div>
            <!-- Register buttons -->
            <div class="text-center  text-white">
              <p>or sign up with:</p>
              <button type="button" class="btn btn-outline-info btn-floating  mx-3  fs-4" style="width: 50px">
                <i class="fab fa-facebook-f"></i>
              </button>

              <button type="button" class="btn btn-outline-info btn-floating  mx-3  fs-4" style="width: 50px">
                <i class="fab fa-google"></i>
              </button>

              <button type="button" class="btn btn-outline-info btn-floating  mx-3  fs-4" style="width: 50px">
                <i class="fab fa-twitter"></i>
              </button>

              <button type="button" class="btn btn-outline-info btn-floating  mx-3  fs-4" style="width: 50px">
                <i class="fab fa-github"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
</div>
        </body>
        <!-- bootstrap -->
        <script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        </script>
        </html>
