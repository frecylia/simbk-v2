<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Formulir Tes Peminatan Kejuruan MAN 1</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }
        form#peminatan-form {
            background-color: white;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            max-width: 700px;
            width: 100%;
            box-sizing: border-box;
        }
        h1, h2, h3 {
            color: #005792;
            margin-top: 0;
        }
        h1 {
            text-align: center;
            border-bottom: 2px solid #005792;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        h2 {
            margin-top: 30px;
            padding-bottom: 5px;
            border-bottom: 1px solid #ddd;
        }
        .form-group {
            display: grid;
            grid-template-columns: 220px 1fr;
            align-items: center;
            margin-bottom: 15px;
            gap: 10px;
        }
        .form-group label {
            margin: 0;
            font-weight: bold;
            white-space: nowrap;
        }
        .form-group textarea {
            grid-column: 2 / 3;
            width: 100%;
            min-height: 150px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: vertical;
            box-sizing: border-box;
        }
        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="tel"],
        textarea {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            width: 100%;
        }
        .jurusan-rank {
            display: grid;
            grid-template-columns: 220px 100px;
            align-items: center;
            margin-bottom: 12px;
            gap: 10px;
        }
        .jurusan-rank label {
            margin: 0;
            font-weight: bold;
            white-space: nowrap;
        }
        .jurusan-rank input[type="number"] {
            width: 100%;
            padding: 6px 8px;
            box-sizing: border-box;
        }
        .radio-group, .checkbox-group {
            margin-bottom: 10px;
        }
        .radio-group label, .checkbox-group label {
            font-weight: normal;
            display: flex;
            align-items: center;
            margin: 4px 0;
        }
        .radio-group input, .checkbox-group input {
            margin-right: 10px;
        }
        .peminatan-section {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            background-color: #fff;
        }
        .question {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f5f5f5;
            border-radius: 4px;
        }
        .option {
            margin: 5px 0 5px 20px;
        }
        .submit-btn {
            background-color: #005792;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            display: block;
            width: 100%;
            max-width: 200px;
            margin-left: auto;
            margin-right: auto;
        }
        .submit-btn:hover {
            background-color: #003d66;
        }
        .signature-container {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            gap: 20px;
        }
        .signature-box {
            border-top: 1px solid #000;
            width: 200px;
            margin-top: 70px;
            display: inline-block;
        }
        .signature-label {
            text-align: center;
            font-size: 14px;
            margin-top: 5px;
        }
        .admin-section {
            margin-top: 50px;
            border-top: 2px dashed #aaa;
            padding-top: 20px;
        }
        @media print {
            body {
                background-color: white;
                padding: 0;
                margin: 0;
            }
            .submit-btn {
                display: none;
            }
            @page {
                margin: 1.5cm;
            }
        }
        @media (max-width: 600px) {
            .form-group, .jurusan-rank {
                grid-template-columns: 1fr;
            }
            .form-group label, .jurusan-rank label {
                white-space: normal;
                margin-bottom: 5px;
            }
            .signature-container {
                flex-direction: column;
                gap: 30px;
            }
            .signature-box {
                width: 100%;
                margin-top: 40px;
            }
        }
    </style>
</head>
<body>
    <form id="peminatan-form">
        <h1>FORMULIR TES PEMINATAN KEJURUAN MAN 1 Bandung</h1>
        <p style="text-align: center; font-weight: bold;">Tahun Ajaran 2025/2026</p>
        
        <h2>DATA PRIBADI</h2>
        <div class="form-group">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama" required />
        </div>
        
        <div class="form-group">
            <label for="nis">Nomor Induk Siswa:</label>
            <input type="text" id="nis" name="nis" required />
        </div>
        
        <div class="form-group">
            <label for="ttl">Tempat, Tanggal Lahir:</label>
            <input type="text" id="ttl" name="ttl" required />
        </div>
        
        <div class="form-group">
            <label>Jenis Kelamin:</label>
            <div class="radio-group">
                <label><input type="radio" name="gender" value="laki-laki" required /> Laki-laki</label>
                <label><input type="radio" name="gender" value="perempuan" /> Perempuan</label>
            </div>
        </div>
        
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" required />
        </div>
        
        <div class="form-group">
            <label for="telepon">No. Telepon/HP:</label>
            <input type="tel" id="telepon" name="telepon" required />
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required />
        </div>
        
        <div class="form-group">
            <label for="prestasi">Prestasi Akademik/Non-Akademik:</label>
            <textarea id="prestasi" name="prestasi"></textarea>
        </div>
        
        <h2>PEMINATAN JURUSAN</h2>
        <p><em>Urutkan pilihan jurusan dari 1-3 sesuai minat Anda (1 = pilihan tertinggi)</em></p>
        
        <div class="jurusan-rank">
            <label for="rank-ipa">IPA (Ilmu Pengetahuan Alam)</label>
            <input type="number" id="rank-ipa" name="rank-ipa" min="1" max="3" required />
        </div>
        
        <div class="jurusan-rank">
            <label for="rank-ips">IPS (Ilmu Pengetahuan Sosial)</label>
            <input type="number" id="rank-ips" name="rank-ips" min="1" max="3" required />
        </div>
        
        <div class="jurusan-rank">
            <label for="rank-bahasa">Bahasa</label>
            <input type="number" id="rank-bahasa" name="rank-bahasa" min="1" max="3" required />
        </div>
        
        <h2>BAGIAN A: TES MINAT DAN BAKAT</h2>
        <p><strong>Petunjuk</strong>: Beri tanda centang pada pernyataan yang paling menggambarkan diri Anda.</p>
        
        <div class="peminatan-section">
            <h3>Peminatan IPA</h3>
            <div class="checkbox-group">
                <label><input type="checkbox" name="minat-ipa-1" /> Saya tertarik melakukan eksperimen dan percobaan ilmiah</label>
                <label><input type="checkbox" name="minat-ipa-2" /> Saya senang mempelajari struktur dan fungsi makhluk hidup</label>
                <label><input type="checkbox" name="minat-ipa-3" /> Saya tertarik menyelesaikan soal-soal matematika</label>
                <label><input type="checkbox" name="minat-ipa-4" /> Saya senang mengamati fenomena alam dan mencari penjelasannya</label>
                <label><input type="checkbox" name="minat-ipa-5" /> Saya tertarik dengan teknologi dan cara kerjanya</label>
            </div>
        </div>
        
        <div class="peminatan-section">
            <h3>Peminatan IPS</h3>
            <div class="checkbox-group">
                <label><input type="checkbox" name="minat-ips-1" /> Saya tertarik mempelajari perilaku manusia dan interaksi sosial</label>
                <label><input type="checkbox" name="minat-ips-2" /> Saya senang mengikuti perkembangan ekonomi dan bisnis</label>
                <label><input type="checkbox" name="minat-ips-3" /> Saya tertarik dengan sejarah dan peristiwa-peristiwa masa lalu</label>
                <label><input type="checkbox" name="minat-ips-4" /> Saya menikmati diskusi tentang isu-isu sosial dan politik</label>
                <label><input type="checkbox" name="minat-ips-5" /> Saya senang menganalisis pola pikir dan tingkah laku masyarakat</label>
            </div>
        </div>
        
        <div class="peminatan-section">
            <h3>Peminatan Bahasa</h3>
            <div class="checkbox-group">
                <label><input type="checkbox" name="minat-bahasa-1" /> Saya senang mempelajari berbagai bahasa</label>
                <label><input type="checkbox" name="minat-bahasa-2" /> Saya tertarik dengan sastra dan karya-karya tulis</label>
                <label><input type="checkbox" name="minat-bahasa-3" /> Saya menikmati menganalisis makna di balik teks</label>
                <label><input type="checkbox" name="minat-bahasa-4" /> Saya tertarik dengan budaya dari berbagai negara</label>
                <label><input type="checkbox" name="minat-bahasa-5" /> Saya senang menulis cerita atau puisi</label>
            </div>
        </div>
        
        <h2>BAGIAN B: TES KEMAMPUAN DASAR</h2>
        
        <div class="peminatan-section">
            <h3>Matematika (untuk semua peminatan)</h3>
            
            <div class="question">
                <p>1. Hasil dari 3x² + 5x - 2 = 0 adalah...</p>
                <div class="radio-group">
                    <label class="option"><input type="radio" name="math-1" value="a" required /> a. x = -2 dan x = 1/3</label>
                    <label class="option"><input type="radio" name="math-1" value="b" /> b. x = 2 dan x = -1/3</label>
                    <label class="option"><input type="radio" name="math-1" value="c" /> c. x = -2 dan x = -1/3</label>
                    <label class="option"><input type="radio" name="math-1" value="d" /> d. x = 2 dan x = 1/3</label>
                </div>
            </div>
            
            <div class="question">
                <p>2. Jika 2 log 8 = a, maka nilai dari 2 log 4 adalah...</p>
                <div class="radio-group">
                    <label class="option"><input type="radio" name="math-2" value="a" required /> a. a/2</label>
                    <label class="option"><input type="radio" name="math-2" value="b" /> b. a/3</label>
                    <label class="option"><input type="radio" name="math-2" value="c" /> c. 2a/3</label>
                    <label class="option"><input type="radio" name="math-2" value="d" /> d. 3a/2</label>
                </div>
            </div>
        </div>
        
        <div class="peminatan-section">
            <h3>Ilmu Pengetahuan Alam</h3>
            
            <div class="question">
                <p>1. Proses pembuatan makanan pada tumbuhan disebut...</p>
                <div class="radio-group">
                    <label class="option"><input type="radio" name="ipa-1" value="a" required /> a. Fotosintesis</label>
                    <label class="option"><input type="radio" name="ipa-1" value="b" /> b. Respirasi</label>
                    <label class="option"><input type="radio" name="ipa-1" value="c" /> c. Transpirasi</label>
                    <label class="option"><input type="radio" name="ipa-1" value="d" /> d. Reproduksi</label>
                </div>
            </div>
            
            <div class="question">
                <p>2. Gaya yang bekerja pada benda bermassa 5 kg sehingga mengalami percepatan 4 m/s² adalah...</p>
                <div class="radio-group">
                    <label class="option"><input type="radio" name="ipa-2" value="a" required /> a. 9,8 N</label>
                    <label class="option"><input type="radio" name="ipa-2" value="b" /> b. 20 N</label>
                    <label class="option"><input type="radio" name="ipa-2" value="c" /> c. 1,25 N</label>
                    <label class="option"><input type="radio" name="ipa-2" value="d" /> d. 125 N</label>
                </div>
            </div>
        </div>
        
        <div class="peminatan-section">
            <h3>Ilmu Pengetahuan Sosial</h3>
            
            <div class="question">
                <p>1. Berikut yang termasuk faktor-faktor produksi adalah...</p>
                <div class="radio-group">
                    <label class="option"><input type="radio" name="ips-1" value="a" required /> a. Modal, laba, dan tanah</label>
                    <label class="option"><input type="radio" name="ips-1" value="b" /> b. Tanah, tenaga kerja, dan bunga</label>
                    <label class="option"><input type="radio" name="ips-1" value="c" /> c. Modal, tanah, dan tenaga kerja</label>
                    <label class="option"><input type="radio" name="ips-1" value="d" /> d. Laba, bunga, dan sewa</label>
                </div>
            </div>
            
            <div class="question">
                <p>2. Peristiwa Proklamasi Kemerdekaan Indonesia terjadi pada tanggal...</p>
                <div class="radio-group">
                    <label class="option"><input type="radio" name="ips-2" value="a" required /> a. 17 Agustus 1944</label>
                    <label class="option"><input type="radio" name="ips-2" value="b" /> b. 17 Agustus 1945</label>
                    <label class="option"><input type="radio" name="ips-2" value="c" /> c. 18 Agustus 1945</label>
                    <label class="option"><input type="radio" name="ips-2" value="d" /> d. 1 Juni 1945</label>
                </div>
            </div>
        </div>
        
        <div class="peminatan-section">
            <h3>Bahasa</h3>
            
            <div class="question">
                <p>1. Kalimat berikut yang menggunakan majas personifikasi adalah...</p>
                <div class="radio-group">
                    <label class="option"><input type="radio" name="bahasa-1" value="a" required /> a. Dia secantik bidadari</label>
                    <label class="option"><input type="radio" name="bahasa-1" value="b" /> b. Angin berbisik di telingaku</label>
                    <label class="option"><input type="radio" name="bahasa-1" value="c" /> c. Dia bekerja seperti kuda</label>
                   
