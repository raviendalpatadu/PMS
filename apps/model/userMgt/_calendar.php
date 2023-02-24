<?php
require_once '../../control/config.php';
$template = new template();
try {
    $sql = 'SELECT drug_id, drug_expDate, drug_name from tbl_drug';
    $stmt = $conn->prepare($sql);
    $stmt->execute(array());
    $rows = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $rows[] = $row;
    }
    // echo "<pre>";
    // print_r($rows);
    // echo "</pre>";
    foreach ($rows as $d) {
    
        $expDate = date_create($d['drug_expDate']);
        $currentDate = date_create(date('Y-m-d'));
        $diff = date_diff($currentDate, $expDate);
        $diffrence = $diff->format("%R%a");
        // echo $diffrence;
        // not expired
        if ($diffrence > 10) {
            $color = '#00ff00';// green
        }
        // expire's today
        elseif ($diffrence == 0) {
            $color = '#eb6b34'; //orange
            
        }
        // expire's in 10 days
        elseif ($diffrence > 0 && $diffrence <= 10) {
            $color = '#ebc034';//yellow
        }
        // already expired
        elseif ($diffrence < 0) {
            $color = '#ff0000';//red
        }
        $title = $d['drug_name'];
        $data[] = array(
            'allDay' => true,
            'title' => $title,
            'start' => $d['drug_expDate'],
            'end' => $d['drug_expDate'],
            'description' => $d['drug_name'],
            'color' => $color,
            'clientId' => $d['drug_id']
        );
    }

    echo json_encode($data);
} catch (\Throwable $th) {
    $_SESSION['error'][] = $ex->getMessage();
    echo $ex->getMessage();
}
