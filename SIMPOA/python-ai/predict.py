import sys
import json
import os
import pickle
import pandas as pd

# =========================
# LOAD MODEL
# =========================
BASE_DIR = os.path.dirname(__file__)

with open(os.path.join(BASE_DIR, 'model.pkl'), 'rb') as f:
    model = pickle.load(f)

# =========================
# AMBIL DATA DARI LARAVEL
# =========================
input_data = json.loads(sys.argv[1])

# =========================
# UBAH KE DATAFRAME
# =========================
data = pd.DataFrame([input_data])

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

output = {
    "result": result,
    "probability": round(probability, 2)
}

print(json.dumps(output))