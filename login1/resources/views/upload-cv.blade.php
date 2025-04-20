<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CV</title>
    <link rel="stylesheet" href="{{ asset('css/upload.css') }}">

</head>
<body style="background: url('{{ asset('images/logos/upload.jpg') }}') no-repeat center center fixed; background-size: cover; margin: 0; padding: 0;">
<div class="container">
        <h1>Upload Your CV</h1>

        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/upload-cv" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="cv">Select Your CV:</label>
                <input type="file" id="cv" name="cv" required>
            </div>
            <button type="submit">Upload</button>
        </form>
    </div>
</body>
</html>