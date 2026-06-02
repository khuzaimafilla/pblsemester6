import sys
import json
import os
import pickle
import pandas as pd

# =========================
# LOAD MODEL + IMPUTER
# =========================

BASE_DIR = os.path.dirname(__file__)

with open(os.path.join(BASE_DIR, 'model.pkl'), 'rb') as f:

    saved_data = pickle.load(f)

    model = saved_data['model']

    imputer = saved_data['imputer']

# =========================
# AMBIL DATA DARI LARAVEL
# =========================

input_data = json.loads(sys.argv[1])

# =========================
# WATER QUALITY SCORE
# =========================

score = 0

# pH
if 6.5 <= input_data['ph'] <= 8.5:
    score += 1

# Hardness
if input_data['Hardness'] <= 500:
    score += 1

# TDS / Solids
if input_data['Solids'] <= 500:
    score += 1

# Chloramines
if 0.2 <= input_data['Chloramines'] <= 4:
    score += 1

# Sulfate
if input_data['Sulfate'] <= 250:
    score += 1

# Conductivity
if 50 <= input_data['Conductivity'] <= 400:
    score += 1

# Organic Carbon
if input_data['Organic_carbon'] <= 2:
    score += 1

# Trihalomethanes
if input_data['Trihalomethanes'] <= 80:
    score += 1

# Turbidity
if input_data['Turbidity'] <= 5:
    score += 1

# =========================
# UBAH KE DATAFRAME
# =========================

data = pd.DataFrame([input_data])

# TAMBAH FEATURE BARU
data['Water_Quality_Score'] = score

# =========================
# PREPROCESSING
# =========================

data = imputer.transform(data)

# =========================
# PREDICT
# =========================

prediction = model.predict(data)[0]

# =========================
# PROBABILITY
# =========================

probability = model.predict_proba(data)[0][prediction] * 100

# =========================
# HASIL
# =========================

result = "LAYAK" if prediction == 1 else "TIDAK"

# =========================
# OUTPUT JSON
# =========================

output = {
    "result": result,
    "probability": round(probability, 2),
    "score": score
}

print(json.dumps(output))