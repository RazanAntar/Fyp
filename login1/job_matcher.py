import sys
import json
import pymysql
import pandas as pd
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity

def fetch_jobs_from_db():
    try:
        connection = pymysql.connect(
            host="127.0.0.1",
            user="root",
            password="",
            database="login",
            charset='utf8mb4',
            cursorclass=pymysql.cursors.DictCursor
        )
        query = """
        SELECT id, title, description, company, major
        FROM job_posting
        WHERE status = 'active'
        """
        from sqlalchemy import create_engine
        engine = create_engine("mysql+pymysql://root:@127.0.0.1/login")
        df = pd.read_sql(query, engine)

        connection.close()
        return df
    except Exception as e:
        raise Exception(f"Database connection failed: {e}")

def match_jobs(student_profile, job_df, top_n=5):
    # Clean and prepare text
    job_df = job_df.fillna('')
    job_df = job_df[
        (job_df['title'].str.lower().str.strip() != 'title') &
        (job_df['description'].str.lower().str.strip() != 'description') &
        (job_df['company'].str.lower().str.strip() != 'company') &
        (job_df['major'].str.lower().str.strip() != 'major')
    ]
    job_df['text'] = job_df['title'] + ' ' + job_df['description']
    job_df = job_df[job_df['text'].str.strip() != '']

    if job_df.empty:
        return []

    # TF-IDF similarity
    vectorizer = TfidfVectorizer(stop_words='english')
    tfidf_matrix = vectorizer.fit_transform(job_df['text'])
    student_vector = vectorizer.transform([student_profile])

    job_df['score'] = cosine_similarity(student_vector, tfidf_matrix).flatten()
    top_matches = job_df.sort_values(by='score', ascending=False).head(top_n)

    return top_matches[['id', 'title', 'company', 'major', 'score']].to_dict(orient='records')

def main():
    if len(sys.argv) < 2:
        print(json.dumps({"error": "Missing student profile input"}))
        sys.exit(1)

    student_profile = sys.argv[1]

    try:
        job_df = fetch_jobs_from_db()
        matches = match_jobs(student_profile, job_df)
        print(json.dumps(matches))
    except Exception as e:
        print(json.dumps({"error": str(e)}))
        sys.exit(1)

if __name__ == "__main__":
    main()
