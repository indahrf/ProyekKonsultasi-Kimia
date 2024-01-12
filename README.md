# Website-Kimia

Struktur Dasar Laravel

### Controller

Controller dalam Laravel bertanggung jawab untuk mengelola logika aplikasi. Mereka menerima input dari pengguna melalui permintaan HTTP, memprosesnya, dan memberikan respons. Controller umumnya disimpan di dalam direktori `app/Http/Controllers`.

### Model

Model dalam Laravel merepresentasikan entitas atau objek dalam basis data. Mereka berinteraksi dengan basis data untuk menyimpan dan mengambil data. Model umumnya disimpan di dalam direktori `app/Models`.

### View

View dalam Laravel bertanggung jawab untuk menampilkan data ke pengguna. Mereka dapat berisi HTML, CSS, dan PHP untuk menampilkan informasi yang diperlukan. File view umumnya disimpan di dalam direktori `resources/views`.


## Alur Kerja Dasar

1. Route Definition:
   - Pengguna membuat permintaan HTTP (seperti mengakses halaman web).
   - Route dalam file `routes/web.php` atau `routes/api.php` mengarahkan permintaan ke Controller.

2. Controller Handling:
   - Controller menangani permintaan, memproses logika aplikasi yang diperlukan, dan mengembalikan respons.

3. Model Interaction:
   - Controller dapat berinteraksi dengan Model untuk menyimpan atau mengambil data dari basis data.

4. View Rendering:
   - Controller dapat merender View, yang kemudian dikirim sebagai respons ke pengguna.
