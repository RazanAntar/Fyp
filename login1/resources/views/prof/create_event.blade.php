<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Create Event</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    :root {
  --soft-blue: #dde7f4;
  --text-dark: #3a4e6d; /* updated font color */
  --card-bg: #ffffff;
  --accent-border: #bdd1e9;
}

body {
  background-color: var(--soft-blue);
  font-family: 'Segoe UI', sans-serif;
  color: var(--text-dark); /* new font color applied globally */
}

.container {
  max-width: 700px;
  margin: 60px auto;
  background-color: var(--card-bg);
  border-radius: 16px;
  padding: 40px;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
  border: 1px solid var(--accent-border);
  color: var(--text-dark); /* inherit color in form box */
}


h2, label, .form-control, select, textarea {
  color: var(--text-dark);
}
    .logo {
      width: 80px;
      display: block;
      margin: 0 auto 20px auto;
    }

    h2 {
      text-align: center;
      font-weight: 700;
      margin-bottom: 30px;
    }

    label {
      font-weight: 600;
      
    }

    .form-control {
      border-radius: 10px;
      border: 1px solid #ced4da;
      transition: all 0.2s;
    }

    .form-control:focus {
      border-color: var(--accent-border);
      box-shadow: 0 0 0 0.15rem rgba(189, 209, 233, 0.4);
    }

    .btn-submit {
      background-color: var(--soft-blue);
      color: #000;
      font-weight: bold;
      border: none;
      border-radius: 8px;
      padding: 10px 20px;
      width: 100%;
      margin-top: 20px;
      transition: 0.3s ease;
    }

    .btn-submit:hover {
      background-color: #cdd9ed;
    }

    .error {
      color: red;
      font-size: 0.9rem;
      margin-top: 5px;
    }

    .hidden {
      display: none;
    }
  </style>
</head>
<body>

<div class="container">
  <img src="\images\logos\rhulogo-removebg-preview.png" alt="University Logo" class="logo"/>
  <h2>Create a New Event</h2>

  <form id="eventForm" action="{{ route('events.store') }}" method="POST">
    @csrf

    <div class="form-group">
      <label for="title">Event Title</label>
      <input type="text" class="form-control" id="title" name="title" required>
      <div class="error" id="titleError"></div>
    </div>

    <div class="form-group">
      <label for="description">Description</label>
      <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
      <div class="error" id="descriptionError"></div>
    </div>

    <div class="form-group">
      <label for="date_time">Date and Time</label>
      <input type="datetime-local" class="form-control" id="date_time" name="date_time" required>
      <div class="error" id="dateTimeError"></div>
    </div>

    <div class="form-group">
      <label for="venue">Venue</label>
      <input type="text" class="form-control" id="venue" name="venue" required>
      <div class="error" id="venueError"></div>
    </div>

    <div class="form-group">
      <label for="type">Event Type</label>
      <select class="form-control" id="type" name="type" required>
        <option value="physical">Physical</option>
        <option value="virtual">Virtual</option>
      </select>
      <div class="error" id="typeError"></div>
    </div>

    <div class="form-group">
      <label for="category">Category</label>
      <input type="text" class="form-control" id="category" name="category" required>
      <div class="error" id="categoryError"></div>
    </div>

    <div class="form-group">
      <label for="is_paid">Is the Event Paid?</label>
      <select class="form-control" id="is_paid" name="is_paid" onchange="togglePriceInput();" required>
        <option value="0">No</option>
        <option value="1">Yes</option>
      </select>
      <div class="error" id="isPaidError"></div>
    </div>

    <div class="form-group hidden" id="priceContainer">
      <label for="price">Price ($)</label>
      <input type="number" class="form-control" id="price" name="price" step="0.01" placeholder="Enter price if paid">
      <div class="error" id="priceError"></div>
    </div>

    <div class="form-group">
      <label for="max_participants">Maximum Participants</label>
      <input type="number" class="form-control" id="max_participants" name="max_participants" placeholder="Leave blank if unlimited">
      <div class="error" id="maxParticipantsError"></div>
    </div>

    <button type="submit" class="btn-submit">Create Event</button>
  </form>
</div>

<script>
  function togglePriceInput() {
    var isPaid = document.getElementById('is_paid').value;
    var priceContainer = document.getElementById('priceContainer');
    if (isPaid === '1') {
      priceContainer.classList.remove('hidden');
    } else {
      priceContainer.classList.add('hidden');
      document.getElementById('price').value = '';
      document.getElementById('priceError').textContent = '';
    }
  }

  document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('eventForm').addEventListener('submit', function (event) {
      let isValid = true;

      function validateField(id, errorMessage, isNumeric = false) {
        const element = document.getElementById(id);
        const errorElement = document.getElementById(id + 'Error');
        if (isNumeric && element.value && isNaN(element.value)) {
          errorElement.textContent = errorMessage;
          isValid = false;
        } else if (!element.value.trim()) {
          errorElement.textContent = errorMessage;
          isValid = false;
        }
      }

      document.querySelectorAll('.error').forEach(el => el.textContent = '');
      validateField('title', 'Event title is required.');
      validateField('description', 'Description is required.');
      validateField('date_time', 'Date and time are required.');
      validateField('venue', 'Venue is required.');
      validateField('category', 'Category is required.');
      if (document.getElementById('is_paid').value === '1') {
        validateField('price', 'Price is required for paid events.', true);
      }
      validateField('max_participants', 'Maximum participants must be a number.', true);

      if (!isValid) event.preventDefault();
    });
  });
</script>
</body>
</html>
