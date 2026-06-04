import sys
import json
import os
import pickle
import pandas as pd

# =========================
# LOAD MODEL + IMPUTER + SCALER
# =========================
BASE_DIR = os.path.dirname(__file__)

with open(os.path.join(BASE_DIR, 'model.pkl'), 'rb') as f:
    saved_data = pickle.load(f)
    model = saved_data['model']
    imputer = saved_data['imputer']
    scaler = saved_data['scaler']  # Load scaler yang baru

# =========================
# AMBIL DATA DARI LARAVEL
# =========================
try:
    input_data = json.loads(sys.argv[1])
except Exception as e:
    print(json.dumps({"error": "Gagal membaca input dari Laravel"}))
    sys.exit(1)

# =========================
# WATER QUALITY SCORE
# =========================
score = 0
if 6.5 <= input_data.get('ph', 0) <= 8.5: score += 1
if input_data.get('Hardness', 0) <= 500: score += 1
if input_data.get('Solids', 0) <= 500: score += 1
if 0.2 <= input_data.get('Chloramines', 0) <= 4: score += 1
if input_data.get('Sulfate', 0) <= 250: score += 1
if 50 <= input_data.get('Conductivity', 0) <= 400: score += 1
if input_data.get('Organic_carbon', 0) <= 2: score += 1
if input_data.get('Trihalomethanes', 0) <= 80: score += 1
if input_data.get('Turbidity', 0) <= 5: score += 1

# =========================
# UBAH KE DATAFRAME
# =========================
expected_columns = [
    'ph', 'Hardness', 'Solids', 'Chloramines', 'Sulfate', 
    'Conductivity', 'Organic_carbon', 'Trihalomethanes', 'Turbidity'
]

# Susun dataframe agar urutannya pasti sama dengan saat training
data_dict = {col: input_data.get(col, 0) for col in expected_columns}
data_dict['Water_Quality_Score'] = score

data = pd.DataFrame([data_dict])

# =========================
# PREPROCESSING (IMPUTASI & NORMALISASI)
# =========================
# 1. Imputasi (jaga-jaga jika ada data kosong)
data_processed = imputer.transform(data)

# 2. Normalisasi (Wajib karena saat training pakai scaler)
data_processed = scaler.transform(data_processed)

# =========================
# PREDICT
# =========================
prediction = model.predict(data_processed)[0]
probability_array = model.predict_proba(data_processed)[0]
probability = probability_array[prediction] * 100

# =========================
# FORMAT OUTPUT KE LARAVEL
# =========================
result_text = "LAYAK" if prediction == 1 else "TIDAK"

output = {
    "result": result_text,
    "probability": round(probability, 2)
}

print(json.dumps(output))