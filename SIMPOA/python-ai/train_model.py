import pandas as pd
import pickle

from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestClassifier
from sklearn.impute import SimpleImputer
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

# Membaca dataset
df = pd.read_csv('dataset_simpoa.csv')

print(f"\nDataset berhasil dibaca. Jumlah total: {len(df)} data")

# =====================================================
# 2. RULE-BASED WATER QUALITY SCORE
# =====================================================

def calculate_score(row):
    score = 0
    # Menggunakan .get() agar aman jika ada kolom yang sedikit berbeda penamaannya
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

# Tambahkan feature baru
df['Water_Quality_Score'] = df.apply(calculate_score, axis=1)

print("Water Quality Score berhasil ditambahkan")

# =====================================================
# 3. BUAT TARGET POTABILITY (ANTI-ERROR)
# =====================================================

# Jika tidak ada label Potability dari awal, kita buatkan otomatis
if 'Potability' not in df.columns:
    if 'Skor_SAW' in df.columns:
        # Jika ada data SAW, gunakan median skor SAW
        median_score = df['Skor_SAW'].median()
        df['Potability'] = (df['Skor_SAW'] >= median_score).astype(int)
        print("Kolom 'Potability' otomatis dibuat berdasarkan median Skor_SAW.")
    else:
        # Jika tidak ada SAW, gunakan Water Quality Score (Minimal skor 5 dianggap layak)
        df['Potability'] = (df['Water_Quality_Score'] >= 5).astype(int)
        print("Kolom 'Potability' otomatis dibuat berdasarkan Water Quality Score.")

# =====================================================
# 4. CEK DATA KOSONG
# =====================================================

print("\n=================================================")
print("PENGECEKAN DATA KOSONG")
print("=================================================")

missing = df.isnull().sum()
print(missing)

# =====================================================
# 5. MEMISAHKAN FEATURE DAN TARGET
# =====================================================

# Daftar kolom yang dilarang masuk sebagai fitur (agar tidak bocor ke model)
kolom_dihapus = ['Potability', 'ActivityIdentifier', 'Skor_SAW', 'Peringkat']

# Filter cerdas: Hanya menghapus kolom yang benar-benar ada di dataframe
kolom_yg_dihapus_valid = [col for col in kolom_dihapus if col in df.columns]

X = df.drop(columns=kolom_yg_dihapus_valid)
y = df['Potability']

print("\n=================================================")
print("PEMISAHAN DATA")
print("=================================================")

print("Feature  : Data kondisi kualitas air")
print("Target   : Status kelayakan air minum")

# =====================================================
# 6. SPLIT DATA
# =====================================================

X_train, X_test, y_train, y_test = train_test_split(
    X,
    y,
    test_size=0.2,
    random_state=42
)

print("\n=================================================")
print("PEMBAGIAN DATA")
print("=================================================")

print(f"Data training : {len(X_train)} data")
print(f"Data testing  : {len(X_test)} data")

# =====================================================
# 7. HANDLE MISSING VALUE
# =====================================================

imputer = SimpleImputer(strategy='mean')

X_train = imputer.fit_transform(X_train)
X_test = imputer.transform(X_test)

print("\nProses pengisian data kosong selesai.")

# =====================================================
# 8. MEMBUAT & TRAINING MODEL RANDOM FOREST
# =====================================================

model = RandomForestClassifier(
    n_estimators=100,
    max_depth=10,
    random_state=42
)

print("\n=================================================")
print("PROSES TRAINING MODEL")
print("=================================================")

print("Model sedang mempelajari pola kualitas air...")
model.fit(X_train, y_train)
print("Training selesai")

# =====================================================
# 9. EVALUASI MODEL
# =====================================================

y_pred = model.predict(X_test)
accuracy = accuracy_score(y_test, y_pred)

print("\n=================================================")
print("HASIL EVALUASI MODEL")
print("=================================================")
print(f"Akurasi Model: {accuracy * 100:.2f}%")

# =====================================================
# 10. CLASSIFICATION REPORT & CONFUSION MATRIX
# =====================================================

print("\n=================================================")
print("CLASSIFICATION REPORT")
print("=================================================")
print(classification_report(y_test, y_pred))

# =====================================================
# 11. FITUR PALING BERPENGARUH
# =====================================================

print("\n=================================================")
print("FITUR PALING BERPENGARUH")
print("=================================================")

importance = model.feature_importances_
for feature, score in zip(X.columns, importance):
    print(f"{feature} : {score:.4f}")

# =====================================================
# 12. SIMPAN MODEL + IMPUTER
# =====================================================

with open('model.pkl', 'wb') as f:
    pickle.dump({
        'model': model,
        'imputer': imputer
    }, f)

print("\n=================================================")
print("PENYIMPANAN MODEL SELESAI")
print("=================================================")
print("Model & imputer berhasil disimpan ke model.pkl")