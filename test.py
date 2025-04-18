# import gzip
# import pandas as pd
# import matplotlib.pyplot as plt
# from datetime import datetime

# # Ganti path ke file log kamu
# LOG_FILE = 'loggss/13.log.gz'

# # Parsing logs
# logs = []
# with gzip.open(LOG_FILE, 'rt') as f:
#     for line in f:
#         parts = line.strip().split(' ')
#         if len(parts) > 13:
#             log_entry = {
#                 'type': parts[0],
#                 'timestamp': parts[1],
#                 'elb': parts[2],
#                 'client_ip': parts[3].split(':')[0],
#                 'target_ip': parts[4].split(':')[0],
#                 'request_processing_time': float(parts[5]),
#                 'target_processing_time': float(parts[6]),
#                 'response_processing_time': float(parts[7]),
#                 'elb_status_code': parts[8],
#                 'target_status_code': parts[9],
#                 'received_bytes': int(parts[10]),
#                 'sent_bytes': int(parts[11]),
#                 'request': parts[12] + ' ' + parts[13] + ' ' + parts[14],
#             }
#             logs.append(log_entry)

# # Convert ke DataFrame
# df = pd.DataFrame(logs)
# df['timestamp'] = pd.to_datetime(df['timestamp'])

# # Top target EC2
# print("=== Top Target IP ===")
# print(df['target_ip'].value_counts())

# # URL paling sering diakses
# df['method_url'] = df['request'].apply(lambda r: r.split(' ')[1] if ' ' in r else '')
# print("\n=== Top URL ===")
# print(df['method_url'].value_counts().head(10))

# # Status code stats
# print("\n=== Status Code ===")
# print(df['elb_status_code'].value_counts())

# # Rata-rata response time
# df['total_time'] = df['request_processing_time'] + df['target_processing_time'] + df['response_processing_time']
# print("\n=== Rata-rata Response Time (detik) ===")
# print(df['total_time'].mean())

# # (Opsional) Plot timeline traffic
# df.set_index('timestamp', inplace=True)
# df.resample('1Min').size().plot(title="Requests per Minute", figsize=(10, 4))
# plt.xlabel("Waktu")
# plt.ylabel("Jumlah Request")
# plt.tight_layout()
# plt.show()


import gzip
import pandas as pd
import matplotlib.pyplot as plt

# Ganti dengan nama file log kamu
file_path = 'loggss/13.log.gz'

# Load log file
with gzip.open(file_path, 'rt') as f:
    lines = f.readlines()

# Hapus baris komentar (#) dan split field
log_data = [line.strip().split(' ') for line in lines if not line.startswith('#')]

# Contoh kolom sesuai struktur ALB log
columns = [
    'type', 'timestamp', 'elb', 'client_ip_port', 'target_ip_port',
    'request_processing_time', 'target_processing_time', 'response_processing_time',
    'elb_status_code', 'target_status_code', 'received_bytes', 'sent_bytes',
    'request', 'user_agent', 'ssl_cipher', 'ssl_protocol'
]

# Konversi ke DataFrame
df = pd.DataFrame(log_data, columns=columns)

# Pisahkan IP dari client
df['client_ip'] = df['client_ip_port'].str.split(':').str[0]
df['target_ip'] = df['target_ip_port'].str.split(':').str[0]
df['timestamp'] = pd.to_datetime(df['timestamp'], format='%Y-%m-%dT%H:%M:%S.%fZ')

# Hitung jumlah request per target IP
traffic_per_target = df['target_ip'].value_counts()

# Tampilkan summary
print("Jumlah request per EC2 (target IP):")
print(traffic_per_target)

# Visualisasi
traffic_per_target.plot(kind='bar', title='Traffic per EC2 Target (IP)', xlabel='Target IP', ylabel='Jumlah Request')
plt.tight_layout()
plt.show()
