import pandas as pd
import pickle

from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestClassifier
from sklearn.impute import SimpleImputer
from sklearn.preprocessing import MinMaxScaler

from sklearn.metrics import (
    accuracy_score,
    classification_report,
    confusion_matrix
)

# =====================================================
# 1. LOAD DATASET
# =====================================================
print("=================================================")
print("      SISTEM PREDIKSI KELAYAKAN AIR SIMPOA")
print("=================================================")

df = pd.read_csv('dataset_simpoa.csv')
print(f"\nDataset berhasil dibaca. Jumlah total: {len(df)} data")

# =====================================================
# 2. RULE-BASED WATER QUALITY SCORE
# =====================================================
def calculate_score(row):
    score = 0
    if 6.5 <= row.get('ph', 0) <= 8.5: score += 1
    if row.get('Hardness', 0) <= 500: score += 1
    if row.get('Solids', 0) <= 500: score += 1
    if 0.2 <= row.get('Chloramines', 0) <= 4: score += 1
    if row.get('Sulfate', 0) <= 250: score += 1
    if 50 <= row.get('Conductivity', 0) <= 400: score += 1
    if row.get('Organic_carbon', 0) <= 2: score += 1
    if row.get('Trihalomethanes', 0) <= 80: score += 1
    if row.get('Turbidity', 0) <= 5: score += 1
    return score

df['Water_Quality_Score'] = df.apply(calculate_score, axis=1)

# =====================================================
# 3. BUAT TARGET POTABILITY (ANTI-ERROR)
# =====================================================
if 'Potability' not in df.columns:
    if 'Skor_SAW' in df.columns:
        median_score = df['Skor_SAW'].median()
        df['Potability'] = (df['Skor_SAW'] >= median_score).astype(int)
    else:
        df['Potability'] = (df['Water_Quality_Score'] >= 5).astype(int)

# =====================================================
# 4. MEMISAHKAN FEATURE DAN TARGET
# =====================================================
kolom_dihapus = ['Potability', 'ActivityIdentifier', 'Skor_SAW', 'Peringkat']
kolom_yg_dihapus_valid = [col for col in kolom_dihapus if col in df.columns]

X = df.drop(columns=kolom_yg_dihapus_valid)
y = df['Potability']

# =====================================================
# 5. SPLIT DATA
# =====================================================
X_train, X_test, y_train, y_test = train_test_split(
    X, y, test_size=0.2, random_state=42
)

# =====================================================
# 6. PREPROCESSING: IMPUTASI & NORMALISASI
# =====================================================
# A. Mengisi data kosong
imputer = SimpleImputer(strategy='mean')
X_train = imputer.fit_transform(X_train)
X_test = imputer.transform(X_test)

# B. Normalisasi Data (MinMaxScaler) -> Inovasi Baru
scaler = MinMaxScaler()
X_train = scaler.fit_transform(X_train)
X_test = scaler.transform(X_test)

print("\nProses Imputasi dan Normalisasi (MinMaxScaler) selesai.")

# =====================================================
# 7. MEMBUAT & TRAINING MODEL RANDOM FOREST
# =====================================================
model = RandomForestClassifier(
    n_estimators=100, max_depth=10, random_state=42
)

print("\nModel sedang mempelajari pola kualitas air...")
model.fit(X_train, y_train)
print("Training selesai")

# =====================================================
# 8. EVALUASI MODEL
# =====================================================
y_pred = model.predict(X_test)
accuracy = accuracy_score(y_test, y_pred)
print(f"\nAkurasi Model: {accuracy * 100:.2f}%")

# =====================================================
# 9. SIMPAN MODEL + IMPUTER + SCALER
# =====================================================
with open('model.pkl', 'wb') as f:
    pickle.dump({
        'model': model,
        'imputer': imputer,
        'scaler': scaler  # Scaler ikut disimpan
    }, f)

print("\nModel, Imputer, dan Scaler berhasil disimpan ke model.pkl")