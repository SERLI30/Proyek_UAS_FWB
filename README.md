Role dan Fitur-fiturnya

 1. Admin
-  Kelola data pengguna: Melihat dan menghapus pengguna (customer/seller).
-  Kelola data produk: menghapus produk milik seller.
-  Kelola transaksi: Melihat semua transaksi yang dilakukan oleh customer, lengkap dengan status dan detail.
  
 2. Seller
-  Tambah produk: Menambahkan produk dengan nama, harga, stok, deskripsi, dan kategori.
-  Melihat daftar produk milik sendiri: Produk yang dibuat sendiri (filter berdasarkan seller_id).
-  Melihat transaksi masuk: Daftar transaksi yang berkaitan dengan produk milik seller.

 3. Customer
-  Melihat produk: Menelusuri semua produk yang tersedia.
-  Membeli produk: Memilih produk dan checkout (masuk ke tabel transaksi dan detail_transaksi).
-  Melihat status pesanan: Mengetahui status "pending".

Tabel-tabel database beserta field dan tipe datanya
Struktur Tabel Database

1. users

| Nama Field | Tipe Data                            | Keterangan              |
|------------|--------------------------------------|--------------------------|
| id         | BigIncrements                        | Primary Key             |
| name       | String                               | Nama pengguna           |
| email      | String (unique)                      | Email unik              |
| password   | String                               | Password terenkripsi    |
| role       | Enum('admin', 'seller', 'customer')  | Peran pengguna          |
| timestamps | Timestamps                           | Otomatis dibuat/diperbarui |

2. profil

| Kolom       | Tipe Data     | Keterangan                                      |
|-------------|---------------|-------------------------------------------------|
| `id`        | BIGINT (PK)   | Primary key, auto increment                     |
| `users_id`  | BIGINT (FK)   | Relasi ke tabel `users` (unik, satu-satu)       |
| `nama`      | VARCHAR       | Opsional, menyimpan nama panggilan atau lengkap |
| `alamat`    | VARCHAR       | Alamat lengkap user                             |
| `no_hp`     | VARCHAR       | Nomor handphone                                |
| `foto`      | VARCHAR       | Path atau nama file foto profil                 |
| `timestamps`| TIMESTAMP     | Kolom `created_at` dan `updated_at` otomatis    |

3. kategori

| Nama Field | Tipe Data     | Keterangan        |
|------------|---------------|-------------------|
| id         | BigIncrements | Primary Key       |
| name       | String        | Nama kategori     |
| timestamps | Timestamps    |       Otomatis dibuat/diperbarui            |

4. produk

| Nama Field  | Tipe Data       | Keterangan                          |
|-------------|-----------------|--------------------------------------|
| id          | BigIncrements   | Primary Key                          |
| name        | String          | Nama produk                          |
| price       | Decimal(10,2)   | Harga produk                         |
| stok        | Integer         | Stok produk                          |
| deskripsi   | Text (nullable) | Deskripsi produk                     |
| kategori_id | ForeignId       | FK ke `kategori`                     |
| seller_id   | ForeignId       | FK ke `users` (role: seller)         |
| timestamps  | Timestamps      | Otomatis dibuat/diperbarui           |

5. transaksi

| Nama Field     | Tipe Data                        | Keterangan                          |
|----------------|----------------------------------|--------------------------------------|
| id             | BigIncrements                   | Primary Key                         |
| customer_id    | ForeignId                       | FK ke `users` (role: customer)       |
| total_price    | Decimal(10,2)                   | Total harga semua produk             |
| status         | Enum('pending', 'completed')    | Status transaksi                     |
| payment_method | String (default: 'cod')         | Metode pembayaran (COD)             |
| lokasi_temu    | String (nullable)               | Lokasi temu antara customer & seller |
| timestamps     | Timestamps                      | Otomatis dibuat/diperbarui          |

6. detail_transaksi

| Nama Field    | Tipe Data     | Keterangan                       |
|---------------|---------------|-----------------------------------|
| id            | BigIncrements | Primary Key                      |
| transaksi_id  | ForeignId     | FK ke `transaksi`                |
| produk_id     | ForeignId     | FK ke `produk`                   |
| quantity      | Integer       | Jumlah beli                      |
| subtotal      | Decimal(10,2) | Harga satuan × quantity          |
| timestamps    | Timestamps    | Otomatis dibuat/diperbarui       |


Jenis relasi dan tabel yang berelasi

| Tabel Asal        | Tabel Tujuan         | Relasi         | Keterangan                                                                 |
|------------------|----------------------|----------------|----------------------------------------------------------------------------|
| `users`          | `produk`             | One-to-Many    | Seorang **seller** (user) bisa memiliki banyak produk                      |
| `users`          | `transaksi`          | One-to-Many    | Seorang **customer** (user) bisa melakukan banyak transaksi                |
| `users`          | `profil`             | One-to-One     | Setiap user memiliki 1 profil (disimpan di tabel `profil`)                 |
| `kategori`       | `produk`             | One-to-Many    | Satu kategori bisa memiliki banyak produk                                  |
| `produk`         | `detail_transaksi`   | One-to-Many    | Satu produk bisa muncul di banyak detail transaksi                         |
| `transaksi`      | `detail_transaksi`   | One-to-Many    | Satu transaksi bisa memiliki banyak detail transaksi (produk + quantity)   |
| `produk`         | `transaksi`          | Many-to-Many   | Produk dan transaksi dihubungkan oleh tabel pivot `detail_transaksi`      |
| `transaksi`      | `produk`             | Many-to-Many   | Transaksi bisa berisi banyak produk melalui pivot `detail_transaksi`      |
| `detail_transaksi` | `produk`           | Many-to-One    | Setiap detail transaksi mengacu ke satu produk                             |
| `detail_transaksi` | `transaksi`        | Many-to-One    | Setiap detail transaksi mengacu ke satu transaksi                          |
| `profil`         | `users`              | Many-to-One    | Setiap profil dimiliki oleh satu user                                      |

---
