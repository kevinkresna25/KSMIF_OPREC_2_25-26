# Perbaikan CSS Tidak Ter-Render di Docker

## Masalah
CSS tidak ter-render saat aplikasi dijalankan di Docker, meskipun aplikasi berjalan normal.

## Penyebab
1. **Volume Mounting yang Salah**: Volume `oprec-data` di-mount ke container nginx, yang meng-override file build assets (CSS/JS) yang sudah di-compile oleh Vite
2. **Build Assets Hilang**: Folder `public/build/` yang berisi CSS dan JS hasil compile Vite tertimpa oleh volume kosong

## Solusi yang Diterapkan

### 1. Update Dockerfile
- Memastikan manifest Vite (.vite) juga di-copy ke container
- Build assets dari Vite sekarang tersimpan dengan benar di image

### 2. Update docker-compose.yml
- **Sebelum**: Volume `oprec-data` di-mount ke seluruh `/var/www/html` (meng-override build assets)
- **Sesudah**: Hanya mount volume yang diperlukan:
  - `oprec-storage` untuk `/var/www/html/storage`
  - `oprec-bootstrap-cache` untuk `/var/www/html/bootstrap/cache`
  - Direktori `public/images` dan `storage/app/public` tetap di-mount untuk file upload
- Build assets tetap ada di image tanpa di-override oleh volume

## Cara Menerapkan Perbaikan

### 1. Stop Container yang Sedang Berjalan
```bash
cd new
./docker/helper.sh down
```

### 2. Hapus Volume Lama (Opsional tapi Direkomendasikan)
```bash
docker volume rm oprec-data 2>/dev/null || true
```

### 3. Rebuild Docker Image
```bash
./docker/helper.sh rebuild
```

Atau secara manual:
```bash
docker compose build --no-cache
docker compose up -d
```

### 4. Verifikasi
Buka browser dan akses `http://localhost:8080` - CSS seharusnya sudah ter-render dengan benar.

## Pengecekan Build Assets

Untuk memastikan build assets ada di container:

```bash
# Cek di container nginx
docker exec oprec-nginx ls -la /var/www/html/public/build

# Cek di container PHP
docker exec oprec-php ls -la /var/www/html/public/build
```

Seharusnya ada file-file seperti:
- `app-[hash].css`
- `app-[hash].js`
- `manifest.json`

## Catatan Teknis

### Vite Build Process
1. Vite membaca `resources/css/app.css` dan `resources/js/app.js`
2. Compile dengan Tailwind CSS dan optimisasi
3. Output ke `public/build/` dengan hash untuk cache busting
4. Generate manifest untuk Laravel

### Laravel Blade Directive
```php
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

Directive ini akan:
1. Membaca manifest dari `public/build/manifest.json`
2. Generate tag `<link>` dan `<script>` dengan path yang benar
3. Include file dengan hash untuk cache busting

### Volume Strategy
- **Tidak Di-mount**: `/var/www/html/public/build` (build assets dari image)
- **Di-mount**: 
  - Storage untuk logs, cache, uploaded files
  - Bootstrap cache untuk Laravel
  - Public images untuk asset statis user

## Troubleshooting

### CSS Masih Tidak Muncul
1. Clear browser cache (Ctrl+Shift+R atau Cmd+Shift+R)
2. Cek browser console untuk error 404 pada file CSS/JS
3. Verifikasi file build ada di container (lihat "Pengecekan Build Assets")

### Error 404 pada Build Assets
```bash
# Rebuild tanpa cache
docker compose build --no-cache
docker compose up -d
```

### Perubahan CSS Tidak Ter-update
Untuk development, gunakan Vite dev server:
```bash
npm run dev
```

Untuk production, rebuild image setiap kali ada perubahan CSS/JS.
