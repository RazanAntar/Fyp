<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Post a Job</title>

  <!-- Bootstrap & Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

  <style>
    body {
      background-color: #dde7f4;
      font-family: 'Segoe UI', sans-serif;
    }

    .container {
      background-color: #ffffff;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      padding: 40px;
      margin: 50px auto;
      max-width: 850px;
    }

    h2 {
      text-align: center;
      color: #3a4e6d;
      font-weight: 700;
      margin-bottom: 30px;
    }

    label.form-label {
      font-weight: 600;
      color: #3a4e6d;
    }

    .form-control,
    .select2-container--default .select2-selection--multiple {
      border-radius: 10px !important;
      border: 1px solid #ccc;
      transition: 0.3s;
    }

    .form-control:focus {
      border-color: #a8c0dd;
      box-shadow: 0 0 5px rgba(112, 144, 176, 0.3);
    }

    .btn-primary {
      background-color: #3a4e6d;
      border-color: #3a4e6d;
      border-radius: 10px;
      font-weight: 600;
      padding: 12px;
      font-size: 1.1rem;
      width: 100%;
      transition: 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #2f3f58;
      border-color: #2f3f58;
    }

    .select2-container--default .select2-selection--multiple {
      min-height: 50px;
      padding: 8px;
      border-color: #ced4da;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
      background-color: #3a4e6d;
      border: none;
      color: #fff;
      font-size: 0.9rem;
      padding: 4px 8px;
      margin-top: 6px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Post a Job</h2>
  <form action="{{ route('professional.post_job') }}" method="post" onsubmit="return validateForm()">
    @csrf
    <div class="mb-3">
      <label for="title" class="form-label">Job Title</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Enter job title" required>
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Job Description</label>
      <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter job description" required></textarea>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="salary" class="form-label">Salary</label>
        <input type="text" class="form-control" id="salary" name="salary" placeholder="Enter salary">
      </div>
      <div class="col-md-6 mb-3">
        <label for="location" class="form-label">Location</label>
        <input type="text" class="form-control" id="location" name="location" placeholder="Enter location">
      </div>
    </div>

    <div class="mb-3">
      <label for="company" class="form-label">Company</label>
      <input type="text" class="form-control" id="company" name="company" placeholder="Enter company name">
    </div>

    <div class="mb-3">
      <label for="type" class="form-label">Job Type</label>
      <input type="text" class="form-control" id="type" name="type" placeholder="e.g., Full-time, Part-time">
    </div>

    <div class="mb-3">
      <label for="experience_level" class="form-label">Experience Level</label>
      <input type="text" class="form-control" id="experience_level" name="experience_level" placeholder="e.g., Entry, Mid, Senior">
    </div>

    <div class="mb-3">
      <label for="major" class="form-label">Major</label>
      <input type="text" class="form-control" id="major" name="major" placeholder="Enter related major">
    </div>

    <div class="mb-3">
      <label for="requirements" class="form-label">Requirements</label>
      <textarea class="form-control" id="requirements" name="requirements" rows="4" placeholder="List requirements here..."></textarea>
    </div>

    <div class="mb-3">
      <label for="skills" class="form-label">Skills</label>
      <select multiple class="form-control" id="skills" name="skills[]">
        @foreach ($skills as $skill)
          <option value="{{ $skill->id }}">{{ $skill->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="remote" class="form-label">Remote</label>
      <select class="form-control" id="remote" name="remote">
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="deadline" class="form-label">Application Deadline</label>
      <input type="date" class="form-control" id="deadline" name="deadline">
    </div>

    <button type="submit" class="btn btn-primary">Post Job</button>
  </form>
</div>

@if ($errors->any())
  <div class="container mt-4">
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  </div>
@endif

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  $(document).ready(function () {
    $('#skills').select2({
      placeholder: "Select required skills",
      allowClear: true
    });
  });

  function validateForm() {
    const requiredFields = ['title', 'description', 'location', 'company', 'type', 'experience_level', 'major', 'requirements', 'remote'];
    let isValid = true;
    for (let id of requiredFields) {
      let el = document.getElementById(id);
      if (!el.value.trim()) {
        alert("Please fill out the " + id.replace("_", " ") + " field.");
        isValid = false;
        break;
      }
    }
    return isValid;
  }
</script>

</body>
</html>
