import sys
import json
import os
import pickle
import pandas as pd

# =========================
# LOAD MODEL + IMPUTER
# =========================

BASE_DIR = os.path.dirname(__file__)

with open(
    os.path.join(BASE_DIR,'model.pkl'),
    'rb'
) as f:

    saved_data = pickle.load(f)

    model = saved_data['model']

    imputer = saved_data['imputer']

    features = saved_data['features']


# =========================
# AMBIL DATA DARI LARAVEL
# =========================

input_data = json.loads(
    sys.argv[1]
)


# =========================
# UBAH KE DATAFRAME
# =========================

data = pd.DataFrame(
    [input_data]
)


# =========================
# PASTIKAN URUTAN FEATURE SAMA
# =========================

data = data[
    features
]


# =========================
# PREPROCESSING
# =========================

data = imputer.transform(
    data
)


# =========================
# PREDIKSI
# =========================

prediction = model.predict(
    data
)[0]


# =========================
# CONFIDENCE
# =========================

probability = model.predict_proba(
    data
)[0][prediction] * 100


# =========================
# HASIL
# =========================

result = (
    "LAYAK"
    if prediction == 1
    else "TIDAK"
)


# =========================
# OUTPUT
# =========================

output = {

    "result":result,

    "probability":round(
        probability,
        2
    )

}


print(
    json.dumps(output)
)