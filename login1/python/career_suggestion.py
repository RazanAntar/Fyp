from flask import Flask, request, jsonify
from flask_cors import CORS  # ✅ Import CORS support
from sklearn.pipeline import Pipeline
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.linear_model import LogisticRegression
import pandas as pd
from sklearn.model_selection import train_test_split

# ✅ Load the dataset
data = pd.read_csv(r'C:\Users\User\Desktop\Final Year Project\Fyp\login1\skills_to_careers[2].csv', encoding='latin1')
data = data.dropna(subset=['Skills', 'Careers'])

# Prepare the data
X = data['Skills']
y = data['Careers']

# Split into train/test sets
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Create and train the model pipeline
pipeline = Pipeline([
    ('vect', CountVectorizer()),
    ('clf', LogisticRegression())
])
pipeline.fit(X_train, y_train)

# ✅ Set up Flask app and enable CORS
app = Flask(__name__)
CORS(app)  # <- This enables cross-origin requests (like from Laravel)

@app.route('/predict', methods=['POST'])
def predict():
    json_data = request.get_json()
    skills = json_data['skills']
    predictions = {skill: pipeline.predict([skill])[0] for skill in skills}
    return jsonify(predictions)

if __name__ == '__main__':
    print("🚀 Career suggestion engine is running at http://127.0.0.1:5000")
    app.run(debug=True, port=5000)
