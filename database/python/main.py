import pandas as pd

# Baca file CSV
df = pd.read_csv('jobdesk_harian_dengan_tanggal_YYYYMMDD.csv')

# Cek nama kolom biar yakin
print(df.columns)

# Ubah user_id 13 jadi 1
df['user_id'] = df['user_id'].replace(13, 1)

# Simpan ke file baru
df.to_csv('jobdesk_harian_baru.csv', index=False)
