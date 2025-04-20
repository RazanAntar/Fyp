<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <style>
    :root {
      --primary: #dde7f4;
      --text: #2f3f58;
      --card-bg: #fff;
      --hover-bg: #cfdcf1;
    }

    body {
      background-color: var(--primary);
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    .login-card {
      background: var(--card-bg);
      padding: 40px 35px;
      border-radius: 20px;
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
      max-width: 420px;
      width: 100%;
      transition: 0.3s ease;
    }

    .login-card:hover {
      box-shadow: 0 16px 48px rgba(0, 0, 0, 0.15);
    }

    .login-logo {
      width: 100px;
      display: block;
      margin: 0 auto 25px auto;
    }

    h3 {
      text-align: center;
      font-weight: 700;
      color: var(--text);
      margin-bottom: 25px;
    }

    .form-control {
      border-radius: 10px;
      border: 1px solid #ced4da;
      padding: 12px;
      margin-bottom: 15px;
      transition: all 0.3s;
    }

    .form-control:focus {
      border-color: #aac1dd;
      box-shadow: 0 0 0 0.15rem rgba(170, 193, 221, 0.4);
    }

    .login-button {
      background-color: var(--text);
      color: white;
      font-weight: 600;
      font-size: 1rem;
      border: none;
      border-radius: 10px;
      padding: 12px;
      width: 100%;
      transition: 0.3s ease;
    }

    .login-button:hover {
      background-color: #1f2e43;
    }

    .login-link {
      display: block;
      text-align: center;
      margin-top: 15px;
      font-weight: 500;
      color: var(--text);
      text-decoration: none;
      transition: 0.2s;
    }

    .login-link:hover {
      color: #000;
      text-decoration: underline;
    }

    .alert {
      margin-top: 15px;
      font-size: 0.9rem;
      text-align: center;
    }

    @media (max-width: 576px) {
      .login-card {
        padding: 30px 20px;
      }

      .login-logo {
        width: 80px;
      }
    }
  </style>
</head>
<body>

<div class="login-card">
  <!-- University Logo -->
  <img src="/images/logos/rhulogo-removebg-preview.png" alt="University Logo" class="login-logo"/>

  <h3>Login</h3>

  <form action="{{ route('professional.login') }}" method="POST">
    @csrf

    <input type="email" name="email" class="form-control" placeholder="Email" required>
    <input type="password" name="password" class="form-control" placeholder="Password" required>

    <button type="submit" class="btn login-button">Log In</button>

    <a href="/register-professional" class="login-link">Create Account</a>


    @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if (session('activation_error'))
<!-- Modal for Account Inactive -->
<div class="modal fade" id="activationModal" tabindex="-1" aria-labelledby="activationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title w-100" id="activationModalLabel">⚠️ Account Not Yet Activated</h5>
            </div>
            <div class="modal-body">
                <p>Your account is currently <strong>inactive</strong> and cannot be accessed yet.</p>
                <p>Please check your email for an activation message from the admin. Once your account is approved, you’ll be able to log in.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = () => {
        const modal = new bootstrap.Modal(document.getElementById('activationModal'));
        modal.show();
    };
</script>
@endif


    
  </form>
</div>
@if(session('success_message'))
<!-- Modal HTML for Success Message -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title w-100" id="successModalLabel">🎉 Registration Successful</h5>
      </div>
      <div class="modal-body">
        {{ session('success_message') }}<br>
        Redirecting to login...
      </div>
    </div>
  </div>
</div>

<script>
  window.onload = () => {
    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
    successModal.show();

    setTimeout(() => {
      window.location.href = "/professional/login";
    }, 5000);
  };
</script>
@endif

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
