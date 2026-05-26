import pandas as pd
import pickle
import numpy as np

from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestClassifier
from sklearn.impute import SimpleImputer

from sklearn.metrics import (
    accuracy_score,
    classification_report,
    confusion_matrix,
    precision_score,
    recall_score,
    f1_score
)

# =====================================================
# HEADER
# =====================================================

print("=================================================")
print("      SISTEM PREDIKSI KELAYAKAN AIR SIMPOA")
print("=================================================")


# =====================================================
# LOAD DATASET
# =====================================================

df = pd.read_csv('dataset_simpoa.csv')

print("\nDataset berhasil dibaca")
print(f"Jumlah data : {len(df)}")


# =====================================================
# CEK DATA KOSONG
# =====================================================

print("\n=================================================")
print("PENGECEKAN DATA KOSONG")
print("=================================================")

print(df.isnull().sum())


# =====================================================
# MEMISAHKAN FITUR DAN TARGET
# =====================================================

X = df.drop('Potability', axis=1)
y = df['Potability']

print("\n=================================================")
print("PEMISAHAN DATA")
print("=================================================")

print(f"Jumlah fitur : {len(X.columns)}")

print("\nFitur:")

for i in X.columns:
    print("-",i)


# =====================================================
# SPLIT DATA
# =====================================================

X_train, X_test, y_train, y_test = train_test_split(

    X,
    y,

    test_size=0.2,

    random_state=42,

    stratify=y

)

print("\n=================================================")
print("PEMBAGIAN DATA")
print("=================================================")

print(f"Training : {len(X_train)}")
print(f"Testing  : {len(X_test)}")


# =====================================================
# HANDLE MISSING VALUE
# =====================================================

imputer = SimpleImputer(
    strategy='median'
)

X_train = imputer.fit_transform(
    X_train
)

X_test = imputer.transform(
    X_test
)

print("\nData kosong berhasil ditangani")


# =====================================================
# MODEL RANDOM FOREST
# =====================================================

print("\n=================================================")
print("PEMBUATAN MODEL")
print("=================================================")

model = RandomForestClassifier(

    n_estimators=1000,

    max_depth=20,

    min_samples_split=5,

    min_samples_leaf=2,

    max_features='sqrt',

    random_state=42,

    class_weight='balanced',

    n_jobs=-1
)

print("Model : Random Forest")


# =====================================================
# TRAINING
# =====================================================

print("\n=================================================")
print("TRAINING")
print("=================================================")

model.fit(
    X_train,
    y_train
)

print("Training selesai")


# =====================================================
# PREDIKSI
# =====================================================

y_pred = model.predict(
    X_test
)

y_prob = model.predict_proba(
    X_test
)

confidence = np.max(
    y_prob,
    axis=1
)

print("\n========== Confidence Analysis ==========")

low = sum(confidence < 0.6)

medium = sum(
    (confidence >=0.6)
    &
    (confidence <0.8)
)

high = sum(
    confidence >=0.8
)

print(
f"Rendah : {low}"
)

print(
f"Sedang : {medium}"
)

print(
f"Tinggi : {high}"
)


# =====================================================
# EVALUASI
# =====================================================

accuracy = accuracy_score(
    y_test,
    y_pred
)

precision = precision_score(
    y_test,
    y_pred
)

recall = recall_score(
    y_test,
    y_pred
)

f1 = f1_score(
    y_test,
    y_pred
)


print("\n=================================================")
print("HASIL EVALUASI")
print("=================================================")

print(
f"Accuracy : {accuracy*100:.2f}%"
)

print(
f"Precision : {precision*100:.2f}%"
)

print(
f"Recall : {recall*100:.2f}%"
)

print(
f"F1 Score : {f1*100:.2f}%"
)

print(
f"Confidence rata-rata : {confidence.mean()*100:.2f}%"
)


# =====================================================
# CONFUSION MATRIX
# =====================================================

print("\n=================================================")
print("CONFUSION MATRIX")
print("=================================================")

cm = confusion_matrix(
    y_test,
    y_pred
)

print(cm)


# =====================================================
# CLASSIFICATION REPORT
# =====================================================

print("\n=================================================")
print("CLASSIFICATION REPORT")
print("=================================================")

print(

classification_report(
    y_test,
    y_pred
)

)


# =====================================================
# FEATURE IMPORTANCE
# =====================================================

print("\n=================================================")
print("FITUR PALING BERPENGARUH")
print("=================================================")

importance = model.feature_importances_

for feature,score in zip(

    X.columns,
    importance

):

    print(

    f"{feature}: {score:.4f}"

    )


# =====================================================
# SIMPAN MODEL
# =====================================================

with open(
    'model.pkl',
    'wb'
) as f:

    pickle.dump({

        'model':model,

        'imputer':imputer,

        'features':list(
            X.columns
        )

    },f)


print("\n=================================================")
print("MODEL BERHASIL DISIMPAN")
print("=================================================")

print("model.pkl berhasil dibuat")


# =====================================================
# KESIMPULAN
# =====================================================

print("\n=================================================")
print("KESIMPULAN")
print("=================================================")

if accuracy>=0.90:

    print(
    "Model memiliki performa sangat baik"
    )

elif accuracy>=0.80:

    print(
    "Model memiliki performa baik"
    )

elif accuracy>=0.70:

    print(
    "Model memiliki performa cukup baik"
    )

else:

    print(
    "Model perlu ditingkatkan"
    )

print(
"\nModel siap digunakan pada SIMPOA"
)