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
print("      SISTEM PREDIKSI KELAYAKAN AIR MINUM")
print("=================================================")

# Membaca dataset
df = pd.read_csv('dataset_simpoa.csv')

print("\nDataset berhasil dibaca")

# =====================================================
# 2. RULE-BASED WATER QUALITY SCORE
# =====================================================

def calculate_score(row):

    score = 0

    # pH
    if 6.5 <= row['ph'] <= 8.5:
        score += 1

    # Hardness
    if row['Hardness'] <= 500:
        score += 1

    # TDS / Solids
    if row['Solids'] <= 500:
        score += 1

    # Chloramines
    if 0.2 <= row['Chloramines'] <= 4:
        score += 1

    # Sulfate
    if row['Sulfate'] <= 250:
        score += 1

    # Conductivity
    if 50 <= row['Conductivity'] <= 400:
        score += 1

    # Organic Carbon
    if row['Organic_carbon'] <= 2:
        score += 1

    # Trihalomethanes
    if row['Trihalomethanes'] <= 80:
        score += 1

    # Turbidity
    if row['Turbidity'] <= 5:
        score += 1

    return score

# Tambahkan feature baru
df['Water_Quality_Score'] = df.apply(calculate_score, axis=1)

print("\nWater Quality Score berhasil ditambahkan")

# =====================================================
# 3. MENAMPILKAN JUMLAH DATA
# =====================================================

print(f"\nJumlah seluruh data: {len(df)} data")

# =====================================================
# 4. CEK DATA KOSONG
# =====================================================

print("\n=================================================")
print("PENGECEKAN DATA KOSONG")
print("=================================================")

missing = df.isnull().sum()

print(missing)

print("\nPenjelasan:")
print("Data kosong ditemukan pada beberapa kolom.")
print("Data kosong akan diisi menggunakan nilai rata-rata.")
print("Tujuannya agar model tetap dapat melakukan proses training.")

# =====================================================
# 5. MEMISAHKAN FEATURE DAN TARGET
# =====================================================

X = df.drop('Potability', axis=1)
y = df['Potability']

print("\n=================================================")
print("PEMISAHAN DATA")
print("=================================================")

print("Feature  : Data kondisi kualitas air")
print("Tambahan : Water Quality Score berbasis WHO")
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

print("\nPenjelasan:")
print("80% data digunakan untuk belajar")
print("20% data digunakan untuk pengujian model")

# =====================================================
# 7. HANDLE MISSING VALUE
# =====================================================

imputer = SimpleImputer(strategy='mean')

X_train = imputer.fit_transform(X_train)
X_test = imputer.transform(X_test)

print("\n=================================================")
print("PROSES MENGISI DATA KOSONG")
print("=================================================")

print("Data kosong berhasil diisi menggunakan nilai rata-rata.")

# =====================================================
# 8. MEMBUAT MODEL RANDOM FOREST
# =====================================================

model = RandomForestClassifier(
    n_estimators=100,
    max_depth=10,
    random_state=42
)

print("\n=================================================")
print("PEMBUATAN MODEL MACHINE LEARNING")
print("=================================================")

print("Model yang digunakan: Random Forest")
print("Jumlah pohon keputusan: 100")

# =====================================================
# 9. TRAINING MODEL
# =====================================================

print("\n=================================================")
print("PROSES TRAINING MODEL")
print("=================================================")

print("Model sedang mempelajari pola kualitas air...")

model.fit(X_train, y_train)

print("Training selesai")

# =====================================================
# 10. PREDIKSI
# =====================================================

y_pred = model.predict(X_test)

print("\n=================================================")
print("PROSES PREDIKSI")
print("=================================================")

print("Model sedang memprediksi kelayakan air minum...")

# =====================================================
# 11. EVALUASI MODEL
# =====================================================

accuracy = accuracy_score(y_test, y_pred)

print("\n=================================================")
print("HASIL EVALUASI MODEL")
print("=================================================")

print(f"\nAkurasi Model: {accuracy * 100:.2f}%")

# =====================================================
# PENJELASAN AKURASI
# =====================================================

print("\nPenjelasan Akurasi:")

if accuracy >= 0.80:
    print("Model memiliki performa sangat baik.")
elif accuracy >= 0.70:
    print("Model memiliki performa baik.")
elif accuracy >= 0.60:
    print("Model memiliki performa cukup baik.")
else:
    print("Model masih perlu ditingkatkan.")

# =====================================================
# 12. CONFUSION MATRIX
# =====================================================

cm = confusion_matrix(y_test, y_pred)

print("\n=================================================")
print("CONFUSION MATRIX")
print("=================================================")

print(cm)

print("\nPenjelasan:")
print("Confusion Matrix menunjukkan jumlah prediksi benar")
print("dan prediksi salah yang dilakukan model.")

# =====================================================
# 13. CLASSIFICATION REPORT
# =====================================================

print("\n=================================================")
print("CLASSIFICATION REPORT")
print("=================================================")

print(classification_report(y_test, y_pred))

print("Penjelasan:")
print("- Precision  : Ketepatan prediksi model")
print("- Recall     : Kemampuan model menemukan data yang benar")
print("- F1-Score   : Gabungan precision dan recall")

# =====================================================
# 14. FEATURE IMPORTANCE
# =====================================================

print("\n=================================================")
print("FITUR PALING BERPENGARUH")
print("=================================================")

importance = model.feature_importances_

for feature, score in zip(X.columns, importance):
    print(f"{feature} : {score:.4f}")

print("\nPenjelasan:")
print("Nilai yang lebih besar berarti fitur tersebut")
print("lebih berpengaruh terhadap prediksi kualitas air.")

# =====================================================
# 15. SIMPAN MODEL + IMPUTER
# =====================================================

with open('model.pkl', 'wb') as f:

    pickle.dump({
        'model': model,
        'imputer': imputer
    }, f)

print("\n=================================================")
print("PENYIMPANAN MODEL")
print("=================================================")

print("Model & imputer berhasil disimpan ke model.pkl")

# =====================================================
# 16. KESIMPULAN
# =====================================================

print("\n=================================================")
print("KESIMPULAN")
print("=================================================")

print("Model machine learning berhasil dibuat.")
print("Model dapat digunakan untuk memprediksi")
print("apakah air layak diminum atau tidak.")
print("Semakin tinggi akurasi model,")
print("semakin baik kemampuan prediksi model.")