-- Buat database
CREATE DATABASE IF NOT EXISTS sitta_ut;
USE sitta_ut;

-- Tabel untuk tracking pengiriman
CREATE TABLE IF NOT EXISTS tracking_pengiriman (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor_do VARCHAR(50) UNIQUE NOT NULL,
    nama_mahasiswa VARCHAR(100) NOT NULL,
    nim VARCHAR(20),
    alamat TEXT,
    kota VARCHAR(100),
    kode_pos VARCHAR(10),
    no_telepon VARCHAR(20),
    ekspedisi VARCHAR(50),
    no_resi VARCHAR(100),
    status ENUM('Proses', 'Dikirim', 'Dalam Perjalanan', 'Terkirim') DEFAULT 'Proses',
    progress INT DEFAULT 0,
    tanggal_order DATETIME DEFAULT CURRENT_TIMESTAMP,
    tanggal_kirim DATETIME,
    tanggal_terima DATETIME,
    keterangan TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel untuk detail barang dalam pengiriman
CREATE TABLE IF NOT EXISTS tracking_detail (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor_do VARCHAR(50),
    kode_matakuliah VARCHAR(20),
    nama_matakuliah VARCHAR(200),
    jumlah INT,
    FOREIGN KEY (nomor_do) REFERENCES tracking_pengiriman(nomor_do) ON DELETE CASCADE
);

-- Insert data dummy untuk testing
INSERT INTO tracking_pengiriman (nomor_do, nama_mahasiswa, nim, alamat, kota, ekspedisi, no_resi, status, progress) VALUES
('DO-2024-001', 'Ahmad Fauzi', '530012345', 'Jl. Merdeka No. 123', 'Bandung', 'JNE', 'JNE1234567890', 'Terkirim', 100),
('DO-2024-002', 'Siti Nurhaliza', '530012346', 'Jl. Sudirman No. 45', 'Jakarta', 'JNT', 'JT9876543210', 'Dalam Perjalanan', 75),
('DO-2024-003', 'Budi Santoso', '530012347', 'Jl. Gatot Subroto No. 78', 'Surabaya', 'SiCepat', 'SC5555666677', 'Dikirim', 50),
('DO-2024-004', 'Dewi Lestari', '530012348', 'Jl. Ahmad Yani No. 90', 'Medan', 'Anteraja', 'ANT1231231234', 'Proses', 25);

INSERT INTO tracking_detail (nomor_do, kode_matakuliah, nama_matakuliah, jumlah) VALUES
('DO-2024-001', 'MKDU4110', 'Bahasa Indonesia', 1),
('DO-2024-001', 'MKDU4111', 'Pendidikan Kewarganegaraan', 1),
('DO-2024-002', 'PEMA4210', 'Statistika Pendidikan', 1),
('DO-2024-003', 'MKDU4110', 'Bahasa Indonesia', 1),
('DO-2024-004', 'PEMA4210', 'Statistika Pendidikan', 1),
('DO-2024-004', 'MKDU4111', 'Pendidikan Kewarganegaraan', 1);