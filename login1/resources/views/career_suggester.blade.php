@extends('layouts.app')

@section('content')
<div class="container py-5" style="font-family: 'Poppins', sans-serif;">
    <!-- Title -->
    <div class="text-center mb-5">
        <h1 class="fw-bold text-dark" style="font-size: 2.5rem;">
            🔍 Find the Right Career Path
        </h1>
        <p class="text-muted fs-5">Tell us your top skills, and we’ll suggest careers that match your strengths.</p>
    </div>

    <!-- Form Section -->
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <form id="skillForm" class="p-4 bg-light shadow-sm rounded-4 border border-primary-subtle">
                <div class="mb-4">
                    <label for="skills" class="form-label fw-semibold text-dark fs-5">
                        🧠 Enter your skills below
                    </label>
                    <textarea
                        id="skills"
                        class="form-control p-3"
                        rows="4"
                        placeholder="E.g. Python, communication, public speaking"
                        style="border-radius: 1rem; font-size: 1rem;"
                    ></textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill fw-semibold shadow">
                        <i class="fas fa-lightbulb me-2"></i> Get Suggestions
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Results Section -->
    <div id="resultContainer" class="mt-5" style="display: none;">
        <div class="text-center mb-4">
            <h3 class="text-success fw-bold">🚀 Careers Matched for You</h3>
            <p class="text-muted">Based on your skills, here are some potential career paths:</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <ul id="careerList" class="list-group rounded-4 shadow-sm"></ul>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript (unchanged) -->
<script>
document.getElementById('skillForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const rawSkills = document.getElementById('skills').value;
    const skills = rawSkills.split(',').map(skill => skill.trim()).filter(skill => skill.length > 0);

    fetch('http://127.0.0.1:5000/predict', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ skills }),
    })
    .then(response => response.json())
    .then(data => {
        const list = document.getElementById('careerList');
        list.innerHTML = '';

        Object.entries(data).forEach(([skill, career]) => {
            const item = document.createElement('li');
            item.className = 'list-group-item d-flex justify-content-between align-items-center px-4 py-3';
            item.innerHTML = `
                <div>
                    <strong class="text-primary">${skill}</strong>
                    <span class="mx-2 text-muted">→</span>
                    <span class="fw-semibold">${career}</span>
                </div>
                <span class="badge bg-light text-success border border-success rounded-pill px-3">Matched</span>
            `;
            list.appendChild(item);
        });

        document.getElementById('resultContainer').style.display = 'block';
    })
    .catch(error => {
        console.error('Prediction error:', error);
        alert('Could not connect to the career suggestion engine.');
    });
});
</script>
@endsection
