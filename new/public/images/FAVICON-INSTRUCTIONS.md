# Favicon Instructions

## Cara Membuat Favicon dari Logo KSMIF

Setelah menempatkan `logo-ksmif.png` di folder ini, ikuti langkah berikut untuk membuat favicon:

### Opsi 1: Menggunakan Online Tool (Termudah)
1. Buka https://realfavicongenerator.net/
2. Upload file `logo-ksmif.png`
3. Customize settings (biarkan default jika tidak yakin)
4. Download favicon package
5. Extract dan copy semua file ke `/public/`

### Opsi 2: Menggunakan ImageMagick (Command Line)
```bash
# Install ImageMagick jika belum ada
sudo apt-get install imagemagick

# Convert logo ke favicon.ico
cd /workspace/new/public/images
convert logo-ksmif.png -resize 256x256 -define icon:auto-resize=256,128,96,64,48,32,16 ../favicon.ico

# Buat apple-touch-icon.png
convert logo-ksmif.png -resize 180x180 ../apple-touch-icon.png

# Buat android-chrome icon
convert logo-ksmif.png -resize 192x192 ../android-chrome-192x192.png
convert logo-ksmif.png -resize 512x512 ../android-chrome-512x512.png
```

### Opsi 3: Manual dengan GIMP/Photoshop
1. Buka `logo-ksmif.png` di editor
2. Resize ke 32x32 pixels (atau 64x64 untuk retina)
3. Export sebagai .ico format
4. Simpan di `/public/favicon.ico`

## Files yang Perlu Dibuat
- `favicon.ico` (32x32 atau 64x64)
- `apple-touch-icon.png` (180x180)
- `android-chrome-192x192.png` (192x192)
- `android-chrome-512x512.png` (512x512)

## Sudah Terkonfigurasi di HTML
Head section di `components/layouts/retro.blade.php` sudah siap menerima favicon baru.
Tidak perlu update kode HTML lagi!

---

**Note:** Favicon akan otomatis ter-load setelah file ditempatkan di folder `/public/`.
Browser mungkin perlu di-refresh dengan Ctrl+F5 untuk melihat perubahan.
