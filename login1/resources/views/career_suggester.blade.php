@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-primary">🔍 Career Suggester Based on Your Skills</h2>

    <form id="skillForm">
        <div class="form-group">
            <label for="skills">Enter your skills (comma-separated):</label>
            <textarea id="skills" class="form-control" rows="4" placeholder="e.g. Python, communication, team leadership"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">
            <i class="fas fa-magic mr-1"></i>Suggest Careers
        </button>
    </form>

    <div id="resultContainer" class="mt-5" style="display: none;">
        <h4 class="text-success">🎯 Suggested Careers:</h4>
        <ul id="careerList" class="list-group mt-3"></ul>
    </div>
</div>

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
            item.className = 'list-group-item';
            item.textContent = `${skill} → ${career}`;
            list.appendChild(item);
        });

        document.getElementById('resultContainer').style.display = 'block';
    })
    .catch(error => {
        console.error('Prediction error:', error);
        alert('Could not connect to career suggestion engine.');
    });
});
</script>
@endsection
