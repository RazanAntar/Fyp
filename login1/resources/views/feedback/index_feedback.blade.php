<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Feedback</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #e6e6ff, #f2e6ff);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 30px;
    }

    .card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      padding: 40px;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .card h2 {
      font-size: 2rem;
      margin-bottom: 10px;
      color: #4b0082;
      text-align: center;
    }

    .card p {
      text-align: center;
      margin-bottom: 30px;
      font-size: 1rem;
      color: #555;
    }

    .form-group {
      position: relative;
      margin-bottom: 25px;
    }

    .form-group input,
    .form-group textarea {
      width: 100%;
      border: none;
      border-bottom: 2px solid #bbb;
      background: transparent;
      padding: 10px 0;
      font-size: 1rem;
      color: #4b0082;
      outline: none;
      transition: border-color 0.3s;
    }

    .form-group input:focus,
    .form-group textarea:focus {
      border-color: #6b21a8;
    }

    .form-group label {
      position: absolute;
      top: 10px;
      left: 0;
      font-size: 0.95rem;
      color: #888;
      pointer-events: none;
      transition: 0.3s;
    }

    .form-group input:focus + label,
    .form-group input:not(:placeholder-shown) + label,
    .form-group textarea:focus + label,
    .form-group textarea:not(:placeholder-shown) + label {
      top: -14px;
      font-size: 0.75rem;
      color: #6b21a8;
    }

    .form-group textarea {
      resize: none;
      height: 100px;
    }

    .submit-btn {
      width: 100%;
      background: #6b21a8;
      color: #fff;
      border: none;
      padding: 14px;
      font-size: 1rem;
      font-weight: bold;
      border-radius: 10px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
      background: #4b0082;
    }

    #notification {
      display: none;
      margin-top: 20px;
      padding: 12px;
      border-radius: 8px;
      background-color: #ede9fe;
      color: #4b0082;
      font-size: 0.95rem;
      text-align: center;
      border-left: 5px solid #9333ea;
    }

    .card-footer {
      display: flex;
      justify-content: flex-start;
      margin-top: 30px;
    }

    .back-btn {
      text-decoration: none;
      font-size: 0.95rem;
      color: #6b21a8;
      background-color: transparent;
      padding: 8px 16px;
      border: 1px solid #6b21a8;
      border-radius: 10px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .back-btn:hover {
      background-color: #6b21a8;
      color: white;
    }

    @media (max-width: 600px) {
      .card {
        padding: 25px;
      }
    }
  </style>
</head>
<body>

  <div class="card">
    <h2>We Value Your Feedback 💬</h2>
    <p>Let us know how we can improve your experience.</p>

    <form id="feedbackForm" onsubmit="submitFeedback(event)">
      <div class="form-group">
        <input type="text" id="name" name="name" placeholder=" " required />
        <label for="name">Name</label>
      </div>

      <div class="form-group">
        <input type="email" id="email" name="email" placeholder=" " required />
        <label for="email">Email</label>
      </div>

      <div class="form-group">
        <textarea id="message" name="message" placeholder=" " required></textarea>
        <label for="message">Feedback</label>
      </div>

      <button type="submit" class="submit-btn">Submit Feedback</button>
    </form>

    <div id="notification">✅ Thank you! Your feedback has been sent.</div>

    <div class="card-footer">
      <a href="/alumni/dashboard" class="back-btn">← Back to Dashboard</a>
    </div>
  </div>

  <script>
    function submitFeedback(event) {
      event.preventDefault();
      document.getElementById("notification").style.display = "block";
      setTimeout(() => {
        document.getElementById("notification").style.display = "none";
      }, 3000);
      document.getElementById("feedbackForm").reset();
    }
  </script>

</body>
</html>