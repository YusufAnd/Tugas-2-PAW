CREATE DATABASE Tugas2PAW;
USE Tugas2PAW;

CREATE TABLE mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20),
    nama VARCHAR(100)
);

INSERT INTO mahasiswa (nim, nama) VALUES
('123456', 'Yusuf'),
('789123', 'Ananda');