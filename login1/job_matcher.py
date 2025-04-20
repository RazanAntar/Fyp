import pandas as pd
import json
import sys
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity

def match_jobs(user_input, job_df, top_n=5):
    job_df['combined'] = job_df['title'].fillna('') + ' ' + \
                         job_df['major'].fillna('') + ' ' + \
                         job_df['requirements'].fillna('')

    data = [user_input] + job_df['combined'].tolist()
    tfidf = TfidfVectorizer(stop_words='english')
    tfidf_matrix = tfidf.fit_transform(data)
    similarity_scores = cosine_similarity(tfidf_matrix[0:1], tfidf_matrix[1:]).flatten()

    top_indices = similarity_scores.argsort()[::-1][:top_n]
    matches = job_df.iloc[top_indices].copy()
    matches['score'] = similarity_scores[top_indices]

    return matches[['id', 'title', 'company', 'score']].to_dict(orient='records')

def main():
    if len(sys.argv) < 3:
        print(json.dumps({"error": "Usage: python job_matcher.py <input_string> <csv_file>"}))
        sys.exit(1)

    input_text = sys.argv[1]
    csv_file = sys.argv[2]
    
    try:
        job_df = pd.read_csv(csv_file)
        matches = match_jobs(input_text, job_df)
        print(json.dumps(matches))
    except Exception as e:
        print(json.dumps({"error": str(e)}))
        sys.exit(1)

if __name__ == "__main__":
    main()
