@include('backend.layout.headerFront')
@include('sweetalert::alert')

<h3 class="text-center mt-5 mb-4">
    <a href="index.html" class="d-block auth-logo">
        <img src="assets/images/logo-dark.png" alt="" height="30" class="auth-logo-dark">
        <img src="assets/images/logo-light.png" alt="" height="30" class="auth-logo-light">
    </a>
</h3>
<div class="p-3">
    <h4 class="text-muted font-size-18 mb-1 text-center">Reset Password 🔒</h4>
    {{-- <p class="text-muted text-center">Change your password </p> --}}

    <form class="form-horizontal mt-4" id="formAuthentication" class="mb-3" action="/resetPassword/action"
        method="POST">
        @csrf
        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $resetpassword->email }}"
                placeholder="Enter email" readonly>
        </div>

        <div class="mb-3">
            <label for="userpassword">Password</label>
            <input type="password" class="form-control" id="userpassword" name="password" placeholder="Enter password">
        </div>

        <div class="mb-3 row mt-4">
            <div class="col-12 text-end">
                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Submit</button>
            </div>
        </div>

        <div class="mb-0 row">
            <div class="col-12 mt-4">
                <p class="text-muted mb-0 font-size-14">By registering you agree to the Lexa <a href="#"
                        class="text-primary">Terms of Use</a></p>
            </div>
        </div>
    </form>
</div>
@include('backend.layout.footerFront')
