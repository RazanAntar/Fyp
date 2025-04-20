import pymysql
import pandas as pd
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity

# === 1. Connect to MySQL ===
connection = pymysql.connect(
    host="127.0.0.1",
    user="root",
    password="",
    database="login",
    charset='utf8mb4',
    cursorclass=pymysql.cursors.DictCursor
)

# === 2. Fetch job data ===
query = """
SELECT id, title, description, company, major
FROM job_posting
WHERE status = 'active'
"""


df = pd.read_sql(query, connection)


connection.close()
print("\n🧾 Raw job data from database:")
print(df.head(10))
# === 3. Remove rows that are just column headers or junk ===
df = df[
    (df['title'].str.lower().str.strip() != 'title') &
    (df['description'].str.lower().str.strip() != 'description') &
    (df['company'].str.lower().str.strip() != 'company') &
    (df['major'].str.lower().str.strip() != 'major')
]
df = df.fillna('')
df['text'] = df['title'] + ' ' + df['description']
df = df[df['text'].str.strip() != '']
 # drop rows with empty combined text

# === 5. Simulated student profile ===
student_profile = "Computer Science Python Machine Learning Data Analysis"
print("\n📊 Cleaned job data:")
print(df[['title', 'description', 'text']].head(10))
print("Total jobs after filtering:", len(df))
if df.empty:
    print("⚠️ No jobs available after cleaning. Please check your database content.")
    exit(1)

if df['text'].str.strip().eq('').all():
    print("⚠️ All job texts are empty or invalid after processing.")
    print(df[['title', 'description']].head(5))
    exit(1)


# === 6. Run TF-IDF ===
vectorizer = TfidfVectorizer(stop_words='english')
try:
    tfidf_matrix = vectorizer.fit_transform(df['text'])
    student_vector = vectorizer.transform([student_profile])
except ValueError as e:
    print("❌ TF-IDF Error:", str(e))
    exit(2)

# === 7. Compute similarity and rank ===
df['match_score'] = cosine_similarity(student_vector, tfidf_matrix).flatten()
top_matches = df.sort_values(by='match_score', ascending=False).head(10)

# === 8. Print results ===
print("\n📌 Top Matching Jobs for Student Profile:\n")
for _, row in top_matches.iterrows():
    print(f"🧠 {row.get('title', '[No Title]')} at {row.get('company', '[No Company]')} (Score: {row['match_score']:.2f})")
    print(f"   Major: {row.get('major', 'N/A')}")
    print(f"   Description: {row.get('description', '')[:120]}...")
    print("—" * 60)
