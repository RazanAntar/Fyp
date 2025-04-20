import pandas as pd
import json
import sys
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity

def match_jobs(user_input, job_df, top_n=5):
    # Combine text fields to represent each job
    job_df['combined'] = job_df['title'].fillna('') + ' ' + \
                         job_df['major'].fillna('') + ' ' + \
                         job_df['requirements'].fillna('')

    # Add user input as a new row to vectorize together
    documents = [user_input] + job_df['combined'].tolist()

    # Vectorize using TF-IDF
    tfidf = TfidfVectorizer(stop_words='english')
    tfidf_matrix = tfidf.fit_transform(documents)

    # Compute cosine similarity
    similarity_scores = cosine_similarity(tfidf_matrix[0:1], tfidf_matrix[1:]).flatten()

    # Get top N matches
    top_indices = similarity_scores.argsort()[::-1][:top_n]
    matches = job_df.iloc[top_indices].copy()
    matches['score'] = similarity_scores[top_indices]

    # Prepare output
    return matches[['title', 'company', 'score']].to_dict(orient='records')

def load_job_data(filepath):
    try:
        return pd.read_csv(filepath)
    except Exception as e:
        print(json.dumps({"error": f"Failed to load job data: {str(e)}"}))
        sys.exit(1)

def main():
    if len(sys.argv) < 3:
        print(json.dumps({"error": "Usage: python job_matcher.py <input_string> <csv_file>"}))
        sys.exit(1)

    user_input = sys.argv[1]
    csv_file = sys.argv[2]

    job_df = load_job_data(csv_file)
    results = match_jobs(user_input, job_df)
    print(json.dumps(results, indent=2))

if __name__ == "__main__":
    main()
