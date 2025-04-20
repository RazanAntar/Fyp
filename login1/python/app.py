from flask import Flask, request, jsonify
from flask_cors import CORS

app = Flask(__name__)
CORS(app, resources={r"/evaluate_job": {"methods": ["POST", "OPTIONS"]}})

def evaluate_job_posting(major, salary, location, requirements):
    if not isinstance(salary, str):
        salary = str(salary)
    
    try:
        cleaned_salary = ''.join(c for c in salary if c.isdigit() or c == '.')
        salary = float(cleaned_salary)
    except ValueError:
        return {'error': 'Invalid salary format'}
    
    evaluation_results = {}

    # Major Evaluation
    accepted_majors = [
        "mechatronics engineering", "mechanical engineering", "electrical engineering",
        "biomedical engineering", "civil engineering", "computer and communication engineering",
        "computer science", "graphic design", "healthcare and information system",
        "marketing", "business management", "banking and finance",
        "business information system management", "accounting", "human resources"
    ]
    evaluation_results['major_accepted'] = major.lower() in accepted_majors

    # Salary Evaluation
    salary = float(salary)  # Re-convert to float to ensure no type issues
    if salary < 500:
        evaluation_results['salary_evaluation'] = "Bad"
    elif salary < 1000:
        evaluation_results['salary_evaluation'] = "Good"
    else:
        evaluation_results['salary_evaluation'] = "Excellent"

    # Location Evaluation
    location = location.lower()  # Normalize input
    if location == "on site":
        evaluation_results['location_evaluation'] = "Good for alumni"
    elif location == "remote":
        evaluation_results['location_evaluation'] = "Good for current students"
    else:
        evaluation_results['location_evaluation'] = "Location not specified"

    # Requirements Evaluation
    requirements = requirements.lower()  # Normalize input
    if "no experience" in requirements:
        evaluation_results['requirements_evaluation'] = "Perfect for current students"
    elif "experience" in requirements:
        evaluation_results['requirements_evaluation'] = "Great for alumni"
    elif "none" in requirements:
        evaluation_results['requirements_evaluation'] = "Acceptable for entry-level positions"
    else:
        evaluation_results['requirements_evaluation'] = "Requirements not specified"

    return evaluation_results


@app.route('/evaluate_job', methods=['POST'])
def evaluate_job():
    try:
        data = request.get_json(force=True)
        if not data:
            raise ValueError("No data provided")

        major = data.get('major', '')
        salary = data.get('salary', None)
        location = data.get('location', '')
        requirements = data.get('requirements', '')

        salary = str(salary) if salary is not None else ''
        evaluation = evaluate_job_posting(major, salary, location, requirements)
        return jsonify(evaluation)  # Return the evaluation results
    except Exception as e:
        return jsonify({'error': str(e)}), 400  # Return the error message as JSON
if __name__ == '__main__':
    app.run(debug=True, host='127.0.0.1', port=8000)
