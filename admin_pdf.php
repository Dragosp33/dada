<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once "Includes/connect.php";
require "Includes/views.php";

session_start();

$total = total_views($conn);
$index = total_views($conn, 1);
$signup = total_views($conn, 2);
$login = total_views($conn, 3);
$profile = total_views($conn, 4);
$upload = total_views($conn, 5);

$mpdf = new \Mpdf\Mpdf();
$time = date("Y-m-d");
$data = '';
$data .= '<strong> report cerut de ' . $_SESSION['useruid'] . ' la data de </strong>'. $time = date("Y-m-d") .' <br/>';
$data .= '<strong>nr total viewuri: <strong>' . $total . '<br/>';
$data .= '<h1> Numar viewuri fiecare pagina: </h1> <br/>';
$data .= '<strong>nr viewuri index: <strong>' . $index . '<br/>';
$data .= '<strong>nr  viewuri signup: <strong>' . $signup . '<br/>';
$data .= '<strong>nr viewuri login: <strong>' . $login . '<br/>';
$data .= '<strong>nr viewuri profile: <strong>' . $profile . '<br/>';
$data .= '<strong>nr viewuri upload: <strong>' . $upload . '<br/>';


$data .= '<h1> Log detaliat (ultimele 40 accesari): </h1> <br/>';
$data .= "<h3> Atentie! sunt luate in considerare doar accesarile de pe un ip diferit sau catre o pagina diferita! </h3><br/>";
$data .= "<table>
        <tr>
          <th> IP </th>
          <th> PAGINA VIZITATA </th>
          <th>DATA</th>
          <th> browser </th>
        </tr>";

$sql2 = 'SELECT * FROM page_views ORDER BY time DESC LIMIT 40';
    if(!empty($sql2)){
    $result = mysqli_query($conn,$sql2, MYSQLI_USE_RESULT);
    while($row = $result->fetch_row()){
        $ip = $row[0];
        $page = $row[1];
        if($page == 1) {
            $page = 'index.php';

        }
        elseif($page == 2) {
            $page = 'signup.php';
        }
        elseif($page == 3) {
            $page = 'login.php';
        }
        elseif($page == 4) {
            $page = 'profile.php';
        }
        elseif($page == 5) {
            $page = 'upload.php';
        }
        $time = substr($row[3], 0, 16);
        $browser = substr($row[2], 0, 10);
        
        $data .= "<tr>
        <td>" . $ip . "</td>
        <td>" .$page . "</td>
        <td>" . $time . "</td>
        <td>" . $browser. "</td>
      </tr>";
    }
    }
    $data .= "</table> <br />";

    $mpdf->WriteHTML($data);
    $time = date("Y-m-d");
    $mpdf->output("report ".$time. "-" . $_SESSION['useruid'] .".pdf", 'D');
?>

