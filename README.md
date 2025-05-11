Role dan Fitur-fiturnya

 1. Admin
-  Kelola data pengguna: Melihat, menambah, mengedit, dan menghapus pengguna (customer/seller).
-  Kelola data produk: Mengedit atau menghapus produk milik seller.
-  Kelola transaksi: Melihat semua transaksi yang dilakukan oleh customer, lengkap dengan status dan detail.
  
 2. Seller
-  Tambah produk: Menambahkan produk dengan nama, harga, stok, deskripsi, dan kategori.
-  Melihat daftar produk milik sendiri: Produk yang dibuat sendiri (filter berdasarkan seller_id).
-  Melihat transaksi masuk: Daftar transaksi yang berkaitan dengan produk milik seller.

 3. Customer
-  Melihat produk: Menelusuri semua produk yang tersedia.
-  Membeli produk: Memilih produk dan checkout (masuk ke tabel transaksi dan detail_transaksi).
-  Melihat status pesanan: Mengetahui status "pending", "completed", dll.

Tabel-tabel database beserta field dan tipe datanya

 1. `users` (Users)
| Nama Field | Tipe Data                            | Keterangan            |
|------------|--------------------------------------|------------------------|
| id         | BigIncrements                        | Primary Key           |
| name       | String                               | Nama pengguna         |
| email      | String (unique)                      | Email unik            |
| password   | String                               | Password terenkripsi  |
| role       | Enum('admin', 'seller', 'customer')  | Peran pengguna        |
| timestamps | Timestamps                           | Otomatis dibuat/diperbarui |


 2. `profil`
| Nama Field  | Tipe Data     | Keterangan                        |
|-------------|---------------|------------------------------------|
| id          | BigIncrements | Primary Key                        |
| users_id | ForeignId     | One-to-One ke `pengguna`          |
| alamat      | String        | Alamat pengguna                   |
| no_hp       | String        | Nomor HP                          |
| timestamps  | Timestamps    |                                    |

 3. `kategori`
| Nama Field | Tipe Data     | Keterangan        |
|------------|---------------|-------------------|
| id         | BigIncrements | Primary Key       |
| name       | String        | Nama kategori     |
| timestamps | Timestamps    |                   |

 4. `produk`
| Nama Field  | Tipe Data       | Keterangan                          |
|-------------|-----------------|--------------------------------------|
| id          | BigIncrements   | Primary Key                          |
| name        | String          | Nama produk                          |
| price       | Decimal(10,2)   | Harga produk                         |
| stok        | Integer         | Stok produk                          |
| deskripsi   | Text (nullable) | Deskripsi produk                     |
| kategori_id | ForeignId       | FK ke `kategori`                     |
| seller_id   | ForeignId       | FK ke `pengguna` (role: seller)      |
| timestamps  | Timestamps      |                                      |


 5. `transaksi`
| Nama Field     | Tipe Data                        | Keterangan                         |
|----------------|----------------------------------|-------------------------------------|
| id             | BigIncrements                   | Primary Key                        |
| customer_id    | ForeignId                       | FK ke `pengguna` (role: customer)  |
| total_price    | Decimal(10,2)                   | Total harga semua produk           |
| status         | Enum('pending', 'completed')    | Status transaksi                   |
| payment_method | String (default: cod)           | Metode pembayaran (COD)            |
| lokasi_temu    | String (nullable)               | Lokasi temu antara customer & seller |
| timestamps     | Timestamps                      |                                    |


 6. `detail_transaksi`
| Nama Field    | Tipe Data     | Keterangan                           |
|---------------|---------------|---------------------------------------|
| id            | BigIncrements | Primary Key                           |
| transaksi_id  | ForeignId     | FK ke `transaksi`                     |
| produk_id     | ForeignId     | FK ke `produk`                        |
| quantity      | Integer       | Jumlah beli                           |
| subtotal      | Decimal(10,2) | Harga satuan * quantity               |
| timestamps    | Timestamps    |                                       |


Jenis relasi dan tabel yang berelasi

| Tabel Asal  | Tabel Tujuan      | Relasi       | Keterangan                            |
|-------------|-------------------|--------------|----------------------------------------|
| users       | produk            | One-to-Many  | Seller bisa punya banyak produk        |
| users       | transaksi         | One-to-Many  | Customer bisa lakukan banyak transaksi |
| users       | profil            | One-to-One   | 1 user punya 1 profil                  |
| kategori    | produk            | One-to-Many  | 1 kategori punya banyak produk         |
| produk      | detail_transaksi  | One-to-Many  | Produk bisa masuk ke banyak transaksi |
| transaksi   | detail_transaksi  | One-to-Many  | 1 transaksi berisi banyak produk       |

