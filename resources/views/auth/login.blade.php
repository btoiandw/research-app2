@section('title', 'Login')
@include('main')
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="contact-form">
    <div class="d-grid d-md-flex justify-content-md-center">
        <img alt="" class="avatar" src="{{ asset('img/logo-kpru.png') }}">
        <h5>Research and Development Institute</h5>
    </div>
    @if ($message = Session::get('error'))
        <script>
            Swal.fire({
                icon: 'error',
                /* title: 'Oops...', */
                text: 'Username or Password Incorrect!',
                /*  footer: '<a href="">Why do I have this issue?</a>' */
            });
        </script>
    @endif
    @if (count($errors) > 0)
        {{-- <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>Username or Password Incorrect</li>
                @endforeach
            </ul>
        </div> --}}
    @endif

    <form id="form-validation" name="form-validation" method="POST" action="{{ route('login') }}">
        @csrf
        <label class="form-label">Username</label>
        <input id="validation-email" placeholder="Enter Username" name="email" type="email"
            data-validation="[NOTEMPTY]">
        <label class="form-label">Password</label>
        <input id="validation-password" name="password" type="password" data-validation="[L>=6]"
            data-validation-message="$ must be at least 6 characters" placeholder="Enter Password">
        <div class="d-grid d-md-flex justify-content-md-center">
            <button type="submit" value="Sign in" name="login">
                {{ __('Login') }}
            </button>
        </div>
    </form>
</div>
<!-- END: pages/login-alpha -->

<!-- START: page scripts -->
<script>
    $(function() {

        // Form Validation
        $('#form-validation').validate({
            submit: {
                settings: {
                    inputContainer: '.form-group',
                    errorListClass: 'form-control-error',
                    errorClass: 'has-danger'
                }
            }
        });

    });
</script>
<!-- END: page scripts -->
