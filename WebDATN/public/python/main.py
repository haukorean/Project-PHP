import numpy as np
import pandas as pd # type: ignore
from sklearn.feature_extraction.text import CountVectorizer # type: ignore
import pickle
import sys
import base64

# Đường dẫn tới tệp vector dữ liệu và mô hình
user_input = sys.argv[1]

data = pd.read_csv("D:\WebDATN\WebDATN\public\python\DatasetDT.csv", encoding='utf-8')


data['tags'] = data['TrieuChung']
# Replace np.nan values with an empty string
data['tags'] = data['tags'].fillna('')

new_df = data[['TrieuChung', 'ChuanDoan', 'ChuyenKhoa', 'LoiKhuyen', 'tags']]


cv = CountVectorizer()
vectors = cv.fit_transform(new_df['tags']).toarray()


def ChuanDoan(trch):
    # Tiền xử lý triệu chứng nhập vào
    trch = trch.lower().strip().replace(",", "").replace(".", "")

    # Biểu diễn vector cho triệu chứng nhập vào
    trch_vector = np.zeros(vectors.shape[1])
    unique_words = set(trch.split())

    for word in unique_words:
        if word in cv.vocabulary_:
            index = cv.vocabulary_[word]
            trch_vector[index] = 1

    # Tính toán sự tương đồng với các triệu chứng trong tập dữ liệu
    similarities = np.dot(vectors, trch_vector)


    # Xác định chỉ số bệnh gần nhất
    most_similar_index = np.argmax(similarities)

    if similarities[most_similar_index] == 0:
         nodt = "No"
         noData = base64.b64encode(nodt.encode('utf-8')).decode('utf-8')
         print(noData)
         return None
    # Trả về chuẩn đoán, lời khuyên và chuyên khoa
    diagnosis = new_df.iloc[most_similar_index]['ChuanDoan']
    advice = new_df.iloc[most_similar_index]['LoiKhuyen']
    specialty = new_df.iloc[most_similar_index]['ChuyenKhoa']

    if specialty == "TuVan":
       noAdvide = base64.b64encode(advice.encode('utf-8')).decode('utf-8')
       print(noAdvide)
       return None

    return diagnosis, advice, specialty

KetQua = ChuanDoan(user_input)

if KetQua is not None:
  chuan_doan, loi_khuyen, Chuyen_khoa  = KetQua
      # chuan_doan, loi_khuyen, Chuyen_khoa = ChuanDoan(user_input)
  repdata = "Dựa vào triệu chứng trên này, Rất có thể bạn đang bị {} \nLời Khuyên: {}\nBạn nên đi khám tại các bác sĩ chuyên khoa {}".format(chuan_doan, loi_khuyen,Chuyen_khoa)

  chdoan = base64.b64encode(repdata.encode('utf-8')).decode('utf-8')

  print(chdoan)



