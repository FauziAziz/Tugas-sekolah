<?php
header('Content-Type: application/json');
require_once 'config.php';

$method = $_SERVER['REQUEST_METHOD'];
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Fungsi untuk mendapatkan data tracking
function getTracking($conn, $nomor_do = null) {
    if ($nomor_do) {
        $stmt = $conn->prepare("SELECT * FROM tracking_pengiriman WHERE nomor_do = ?");
        $stmt->bind_param("s", $nomor_do);
    } else {
        $stmt = $conn->prepare("SELECT * FROM tracking_pengiriman ORDER BY created_at DESC");
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($nomor_do) {
        $data = $result->fetch_assoc();
        if ($data) {
            // Ambil detail barang
            $stmt2 = $conn->prepare("SELECT * FROM tracking_detail WHERE nomor_do = ?");
            $stmt2->bind_param("s", $nomor_do);
            $stmt2->execute();
            $detail = $stmt2->get_result()->fetch_all(MYSQLI_ASSOC);
            $data['detail_barang'] = $detail;
            $stmt2->close();
        }
        return $data;
    } else {
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

// Fungsi untuk menambah data tracking
function addTracking($conn, $data) {
    $stmt = $conn->prepare("INSERT INTO tracking_pengiriman (nomor_do, nama_mahasiswa, nim, alamat, kota, kode_pos, no_telepon, ekspedisi, no_resi, status, progress, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("ssssssssssss", 
        $data['nomor_do'],
        $data['nama_mahasiswa'],
        $data['nim'],
        $data['alamat'],
        $data['kota'],
        $data['kode_pos'],
        $data['no_telepon'],
        $data['ekspedisi'],
        $data['no_resi'],
        $data['status'],
        $data['progress'],
        $data['keterangan']
    );
    
    if ($stmt->execute()) {
        // Insert detail barang jika ada
        if (isset($data['detail_barang']) && is_array($data['detail_barang'])) {
            $stmt2 = $conn->prepare("INSERT INTO tracking_detail (nomor_do, kode_matakuliah, nama_matakuliah, jumlah) VALUES (?, ?, ?, ?)");
            foreach ($data['detail_barang'] as $detail) {
                $stmt2->bind_param("sssi", 
                    $data['nomor_do'],
                    $detail['kode_matakuliah'],
                    $detail['nama_matakuliah'],
                    $detail['jumlah']
                );
                $stmt2->execute();
            }
            $stmt2->close();
        }
        return true;
    }
    return false;
}

// Fungsi untuk update data tracking
function updateTracking($conn, $nomor_do, $data) {
    $fields = [];
    $values = [];
    $types = "";
    
    foreach ($data as $key => $value) {
        if ($key != 'nomor_do' && $key != 'detail_barang') {
            $fields[] = "$key = ?";
            $values[] = $value;
            $types .= "s";
        }
    }
    
    $values[] = $nomor_do;
    $types .= "s";
    
    $sql = "UPDATE tracking_pengiriman SET " . implode(", ", $fields) . " WHERE nomor_do = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$values);
    
    return $stmt->execute();
}

// Fungsi untuk delete data tracking
function deleteTracking($conn, $nomor_do) {
    $stmt = $conn->prepare("DELETE FROM tracking_pengiriman WHERE nomor_do = ?");
    $stmt->bind_param("s", $nomor_do);
    return $stmt->execute();
}

// Handle request
try {
    switch ($method) {
        case 'GET':
            if ($action == 'search' && isset($_GET['nomor_do'])) {
                $data = getTracking($conn, $_GET['nomor_do']);
                if ($data) {
                    echo json_encode(['success' => true, 'data' => $data]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan']);
                }
            } else {
                $data = getTracking($conn);
                echo json_encode(['success' => true, 'data' => $data]);
            }
            break;
            
        case 'POST':
            $input = json_decode(file_get_contents('php://input'), true);
            if (addTracking($conn, $input)) {
                echo json_encode(['success' => true, 'message' => 'Data berhasil ditambahkan']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal menambahkan data: ' . $conn->error]);
            }
            break;
            
        case 'PUT':
            $input = json_decode(file_get_contents('php://input'), true);
            if (isset($input['nomor_do'])) {
                if (updateTracking($conn, $input['nomor_do'], $input)) {
                    echo json_encode(['success' => true, 'message' => 'Data berhasil diupdate']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Gagal update data']);
                }
            }
            break;
            
        case 'DELETE':
            if (isset($_GET['nomor_do'])) {
                if (deleteTracking($conn, $_GET['nomor_do'])) {
                    echo json_encode(['success' => true, 'message' => 'Data berhasil dihapus']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Gagal menghapus data']);
                }
            }
            break;
            
        default:
            echo json_encode(['success' => false, 'message' => 'Method tidak dikenali']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conn->close();
?>