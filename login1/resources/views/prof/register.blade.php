<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register as a Professional</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        body {
            background: linear-gradient(135deg, #dde7f4, #f6f9ff);
            font-family: 'Poppins', sans-serif;
        }
        .form-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            padding: 40px;
            max-width: 600px;
            margin: 80px auto;
        }
        h2 {
            text-align: center;
            font-weight: 600;
            color: #2c2c54;
            margin-bottom: 30px;
        }
        .form-label { font-weight: 500; color: #4a4a4a; }
        .form-control {
            border-radius: 8px;
            border: 1px solid #ccd4e0;
        }
        .form-control:focus {
            border-color: #5a68c7;
            box-shadow: 0 0 0 0.2rem rgba(90, 104, 199, 0.25);
        }
        .btn-primary {
            background: #5a68c7;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 500;
            transition: 0.3s;
        }
        .btn-primary:hover { background: #4756a7; }
        .alert-danger { max-width: 600px; margin: 20px auto; }
    </style>
</head>
<body>

<div class="form-card">
    <h2>Register as a Professional</h2>
    <form action="{{ route('prof.register') }}" method="POST" onsubmit="redirectAfterSubmit()">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}">
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}">
            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password (min 10 characters)</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
            @error('password')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <div class="input-group">
                <select name="country_code" class="form-select" style="max-width: 120px;">
                    <option value="">+Code</option>
                    <optgroup label="🌍 Middle East & North Africa">
                        <option value="+961">🇱🇧 +961</option>
                        <option value="+962">🇯🇴 +962</option>
                        <option value="+963">🇸🇾 +963</option>
                        <option value="+20">🇪🇬 +20</option>
                        <option value="+966">🇸🇦 +966</option>
                        <option value="+971">🇦🇪 +971</option>
                        <option value="+212">🇲🇦 +212</option>
                        <option value="+213">🇩🇿 +213</option>
                    </optgroup>
                    <optgroup label="🌎 Americas">
                        <option value="+1">🇺🇸 +1</option>
                        <option value="+52">🇲🇽 +52</option>
                        <option value="+55">🇧🇷 +55</option>
                        <option value="+54">🇦🇷 +54</option>
                        <option value="+507">🇵🇦 +507</option>
                    </optgroup>
                    <optgroup label="🌍 Africa">
                        <option value="+234">🇳🇬 +234</option>
                        <option value="+254">🇰🇪 +254</option>
                        <option value="+27">🇿🇦 +27</option>
                        <option value="+256">🇺🇬 +256</option>
                    </optgroup>
                    <optgroup label="🌏 Asia & Oceania">
                        <option value="+91">🇮🇳 +91</option>
                        <option value="+92">🇵🇰 +92</option>
                        <option value="+81">🇯🇵 +81</option>
                        <option value="+82">🇰🇷 +82</option>
                        <option value="+63">🇵🇭 +63</option>
                        <option value="+61">🇦🇺 +61</option>
                    </optgroup>
                    <optgroup label="🇪🇺 Europe">
                        <option value="+44">🇬🇧 +44</option>
                        <option value="+33">🇫🇷 +33</option>
                        <option value="+49">🇩🇪 +49</option>
                        <option value="+34">🇪🇸 +34</option>
                        <option value="+39">🇮🇹 +39</option>
                        <option value="+31">🇳🇱 +31</option>
                    </optgroup>
                </select>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone') }}">
            </div>
            @error('phone')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="company" class="form-label">Company Name</label>
            <input type="text" class="form-control @error('company') is-invalid @enderror" name="company" id="company" value="{{ old('company') }}">
            @error('company')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4">
            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
            @error('g-recaptcha-response')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>
</div>

<!-- ✅ Modal for Existing Email -->
@if(session('error_exists'))
    <div class="modal fade" id="emailExistsModal" tabindex="-1" aria-labelledby="emailExistsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <h5 class="modal-title w-100" id="emailExistsModalLabel">Account Already Exists</h5>
                </div>
                <div class="modal-body">
                    The email you entered is already registered. <br>
                    Would you like to login instead?
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="/professional/login" class="btn btn-primary">Go to Login</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = () => {
            const modal = new bootstrap.Modal(document.getElementById('emailExistsModal'));
            modal.show();
        };
    </script>
@endif

<!-- ✅ Modal if Registration Was Successful -->
@if(session('success_message'))
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title w-100" id="successModalLabel">🎉 Registration Successful</h5>
                </div>
                <div class="modal-body">
                    {{ session('success_message') }}<br>
                    Redirecting to login page...
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="/professional/login" class="btn btn-success">Go to Login Now</a>
                </div>
            </div>
        </div>
    </div>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    window.onload = () => {
        @if(session('error_exists'))
            new bootstrap.Modal(document.getElementById('emailExistsModal')).show();
        @endif

        @if(session('success_message'))
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();

            setTimeout(() => {
                window.location.href = "/professional/login";
            }, 6000); // Delay 6 seconds
        @endif
    };
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
