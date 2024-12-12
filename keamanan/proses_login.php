<?php
include 'koneksi.php';


function checkpenggunahType($username)
{
    global $koneksi;
    $query_admin = "SELECT * FROM admin WHERE username = '$username'";
    $query_kepala_desa = "SELECT * FROM kepala_desa WHERE username = '$username'";
    $query_sekretaris = "SELECT * FROM sekretaris WHERE username = '$username'";
    $query_masyarakat = "SELECT * FROM masyarakat WHERE username = '$username'";
    $query_oprator_musdous = "SELECT * FROM oprator_musdous WHERE username = '$username'";

    $result_admin = mysqli_query($koneksi, $query_admin);
    $result_kepala_desa = mysqli_query($koneksi, $query_kepala_desa);
    $result_sekretaris = mysqli_query($koneksi, $query_sekretaris);
    $result_masyarakat = mysqli_query($koneksi, $query_masyarakat);
    $result_oprator_musdous = mysqli_query($koneksi, $query_oprator_musdous);

    if (mysqli_num_rows($result_admin) > 0) {
        return "admin";
    } elseif (mysqli_num_rows($result_kepala_desa) > 0) {
        return "kepala_desa";
    } elseif (mysqli_num_rows($result_sekretaris) > 0) {
        return "sekretaris";
    } elseif (mysqli_num_rows($result_masyarakat) > 0) {
        return "masyarakat";
    } elseif (mysqli_num_rows($result_oprator_musdous) > 0) {
        return "oprator_musdous";
    } else {
        return "not_found";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lakukan validasi data
    if (empty($username) && empty($password)) {
        echo "tidak_ada_data";
        exit();
    }
    if (empty($username)) {
        echo "username_tidak_ada";
        exit();
    }

    if (empty($password)) {
        echo "password_tidak_ada";
        exit();
    }


    $penggunahType = checkpenggunahType($username);
    if ($penggunahType !== "not_found") {
        $query_penggunah = "SELECT * FROM $penggunahType WHERE username = '$username'";
        $result_penggunah = mysqli_query($koneksi, $query_penggunah);

        if (mysqli_num_rows($result_penggunah) > 0) {
            $row = mysqli_fetch_assoc($result_penggunah);
            $hashed_password = $row['password'];

            if ($password === $hashed_password) {

                // Process login for other penggunah types
                session_start();
                $_SESSION['username'] = $username;

                switch ($penggunahType) {
                    case "admin":
                        $_SESSION['id_admin'] = $row['id_admin'];
                        break;
                    case "kepala_desa":
                        $_SESSION['id_kepala_desa'] = $row['id_kepala_desa'];
                        $id_kepala_desa = $row['id_kepala_desa'];
                        break;
                    case "sekretaris":
                        $_SESSION['id_sekretaris'] = $row['id_sekretaris'];
                        break;
                    case "masyarakat":
                        $_SESSION['id_masyarakat'] = $row['id_masyarakat'];
                        break;
                    case "oprator_musdous":
                        $_SESSION['id_oprator_musdous'] = $row['id_oprator_musdous'];
                        break;
                    default:
                        break;
                }

                // Success response
                switch ($penggunahType) {
                    case "admin":
                        echo "success:" . $username . ":" . $penggunahType . ":" . "../pengguna/admin/";
                        break;
                    case "kepala_desa":
                        echo "success:" . $username . ":" . $penggunahType . ":" . "../pengguna/kepala_desa/";
                        break;
                    case "sekretaris":
                        echo "success:" . $username . ":" . $penggunahType . ":" . "../pengguna/sekretaris/";
                        break;
                    case "masyarakat":
                        echo "success:" . $username . ":" . $penggunahType . ":" . "../pengguna/masyarakat/";
                        break;
                    case "oprator_musdous":
                        echo "success:" . $username . ":" . $penggunahType . ":" . "../pengguna/oprator_musdous/";
                        break;
                    default:
                        echo "success:" . $username . ":" . $penggunahType . ":" . "../berlangganan/login_pegunah";
                        break;
                }
            } else {
                echo "error_password";
            }
        } else {
            echo "error_username";
        }
    } else {
        echo "error_username";
    }
}