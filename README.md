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
1. users (Users)
| Nama Field | Tipe Data                            | Keterangan            |
|------------|--------------------------------------|------------------------|
| id         | BigIncrements                        | Primary Key           |
| name       | String                               | Nama pengguna         |
| email      | String (unique)                      | Email unik            |
| password   | String                               | Password terenkripsi  |
| role       | Enum('admin', 'seller', 'customer')  | Peran pengguna        |
| timestamps | Timestamps                           | Otomatis dibuat/diperbarui |




Jenis relasi dan tabel yang berelasi

| Tabel Asal  | Tabel Tujuan      | Relasi       | Keterangan                            |
|-------------|-------------------|--------------|----------------------------------------|
| users       | produk            | One-to-Many  | Seller bisa punya banyak produk        |
| users       | transaksi         | One-to-Many  | Customer bisa lakukan banyak transaksi |
| users       | profil            | One-to-One   | 1 user punya 1 profil                  |
| kategori    | produk            | One-to-Many  | 1 kategori punya banyak produk         |
| produk      | detail_transaksi  | One-to-Many  | Produk bisa masuk ke banyak transaksi |
| transaksi   | detail_transaksi  | One-to-Many  | 1 transaksi berisi banyak produk       |

