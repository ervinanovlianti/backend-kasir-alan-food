# DOKUMENTASI BACKEND APLIKASI FOOD ALAN

Dokumentasi API Backend
Selamat datang di dokumentasi API backend aplikasi Alan Food. Dokumen ini memberikan informasi tentang cara berinteraksi dengan layanan backend melalui API.

## Tech Stack
- Framework Backend: Laravel 8
- Database: MySQL 5.7
- Server: Apache 2.4
- Bahasa Pemrograman: PHP 7.4

## Daftar Endpoint Utama
- GET /api/menus
- POST /api/menu
- POST /api/orders
- PUT /api/menu/:id
- DELETE /api/menu/:id
  
## 1. GET /api/menus
Endpoint ini digunakan untuk mengambil daftar menu makanan yang tersedia.

- Metode: GET
- Permintaan:
  - Tidak memerlukan data permintaan tambahan.
- Respon:
  - Daftar menu makanan dengan detail seperti gambar, nama, dan harga.
    
## 2. POST /api/menus
Endpoint ini digunakan untuk menyimpan data menu baru.

- Metode: POST
- Permintaan:
  - Header Content-Type: application/json
  - Body JSON yang mencakup:
    - name: Nama menu baru
    - price: Harga menu baru
    - image: Upload gambar menu baru
- Respon:
  - Data Menu, termasuk nama, harga, dan gambar.

## 3. POST /api/orders
Endpoint ini digunakan untuk membuat pesanan baru.

### Metode: POST
- Permintaan:
  - Header Content-Type: application/json
  - Body JSON yang mencakup:
    - total: Total biaya pesanan
    - uang_pembeli: Jumlah uang yang dibayarkan oleh pelanggan
    - kembalian: Kembalian yang diberikan kepada pelanggan
    - order_items: Array objek yang berisi detail pesanan
    ```
    {
      "total": 150000,
      "uang_pembeli": 200000,
      "kembalian": 50000,
      "order_items": [
        {
          "menu_id": 1,
          "quantity": 2
        },
        {
          "menu_id": 3,
          "quantity": 1
        }
      ]
    }
    ```

- Respon:
  - Data pesanan yang telah dibuat dengan ID pesanan beserta detail order items.
  
