<?php
//Kết nối với database
function pdo_get_connection()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_btl_ptud_web";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}
//Hàm thêm, sửa, xóa
// Hàm thêm, sửa, xóa
function pdo_execute($sql, $params = [])
{
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    } catch (PDOException $e) {
        error_log("Execution failed: " . $e->getMessage());
        return null;
    }
}


// Hàm truy vấn nhiều dữ liệu
function pdo_query($sql, $params = [])
{
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll();
        return $rows;
    } catch (PDOException $e) {
        error_log("Query failed: " . $e->getMessage());
    } finally {
        if ($conn) {
            unset($conn);
        }
    }
}

// Hàm truy vấn 1 dữ liệu
function pdo_query_one($sql, $params = [])
{
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        error_log("Query failed: " . $e->getMessage());
    } finally {
        if ($conn) {
            unset($conn);
        }
    }
}
pdo_get_connection();
