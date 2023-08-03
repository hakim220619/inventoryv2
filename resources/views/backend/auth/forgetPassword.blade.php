@include('backend.layout.headerFront')
@include('sweetalert::alert')

<h3 class="text-center mt-5 mb-4">
    <a href="index.html" class="d-block auth-logo">
        <img src="{{ asset('assets/images/logo-dark.png')}}" alt="" height="30" class="auth-logo-dark">
        <img src="{{ asset('assets/images/logo-light.png')}}" alt="" height="30" class="auth-logo-light">
    </a>
</h3>
<div class="p-3">
    <h4 class="text-muted font-size-18 mb-3 text-center">Reset Password</h4>
    <div class="alert alert-info" role="alert">
        Enter your Email and we will sent to your Whatsapp!
    </div>
    <form class="form-horizontal mt-4" id="formAuthentication" class="mb-3" action="/forgetPassword/action"
        method="POST">
        @csrf
        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
        </div>

        <div class="mb-3 row">
            <div class="col-12 text-end">
                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset</button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
<div class="mt-5 text-center">
    <p>Already have an account ? <a href="login" class="text-primary"> Login
        </a></p>
    ©
    <script>
        document.write(new Date().getFullYear())
    </script> Lexa <span class="d-none d-sm-inline-block"> - Crafted with <i
            class="mdi mdi-heart text-danger"></i> by Themesbrand.</span>
</div>
@include('backend.layout.footerFront')
