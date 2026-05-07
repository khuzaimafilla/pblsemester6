import pandas as pd
import pickle

from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestClassifier
from sklearn.metrics import accuracy_score

# =========================
# LOAD DATASET
# =========================
df = pd.read_csv('dataset_simpoa.csv')

# =========================
# HANDLE NULL VALUE
# =========================
df.fillna(df.mean(), inplace=True)

# =========================
# FEATURE & TARGET
# =========================
X = df.drop('Potability', axis=1)
y = df['Potability']

# =========================
# SPLIT DATA
# =========================
X_train, X_test, y_train, y_test = train_test_split(
    X,
    y,
    test_size=0.2,
    random_state=42
)

# =========================
# TRAIN MODEL
# =========================
model = RandomForestClassifier()

model.fit(X_train, y_train)

# =========================
# EVALUASI
# =========================
y_pred = model.predict(X_test)

accuracy = accuracy_score(y_test, y_pred)

print(f"Akurasi Model: {accuracy * 100:.2f}%")

# =========================
# SIMPAN MODEL
# =========================
with open('model.pkl', 'wb') as f:
    pickle.dump(model, f)

print("Model berhasil disimpan sebagai model.pkl")