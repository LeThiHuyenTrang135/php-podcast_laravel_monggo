<!DOCTYPE html>
<html lang="en">
<head>
  <title>Verify Email — Podcast</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  @include('partials.styles')
</head>
<body>
<div class="site-wrap">
  @include('partials.header')

  <div class="site-section">
    <div class="container" data-aos="fade-up">
      <div class="row justify-content-center">
        <div class="col-md-5 mb-5">
          <h3 class="mb-5">Verify Your Email Address</h3>

          @if (session('status') === 'verification-link-sent')
            <div class="alert alert-success" role="alert">
              A new verification link has been sent to your email address.
            </div>
          @endif

          <p>
            Before proceeding, please check your email for a verification link.
            If you did not receive the email,
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
              @csrf
              <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                click here to request another
              </button>.
            </form>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

@include('partials.scripts')
<script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
