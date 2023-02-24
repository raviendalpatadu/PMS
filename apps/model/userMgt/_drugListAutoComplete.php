<?php
require_once '../../control/config.php';
$template = new template();

$name = $_POST['name'];
if (isset( $_POST['alreadyInList'])) {
    $count_names = count($_POST['alreadyInList']);
    $listNames =$_POST['alreadyInList'];
    $alInNames = '';
    $i = 0;
    while ($i != $count_names) {
        if ($count_names == 1) {
            if ($i == 0) {
                $alInNames .= $listNames[$i];
            }elseif ($i == $count_names - 1) {
                $alInNames .=  $listNames[$i];
            }elseif ($i > 0 && $i < $count_names) {
                $alInNames .=  $listNames[$i] . ',';
            }
        } else{
            if ($i == 0) {
                $alInNames .= $listNames[$i] . ",";
            }elseif ($i == $count_names - 1) {
                $alInNames .=  $listNames[$i];
            }elseif ($i > 0 && $i < $count_names) {
                $alInNames .=  $listNames[$i] . ',';
            }
        }
        $i++;
    } 
    $sql = 'SELECT * FROM tbl_drug WHERE drug_stock > 0 AND drug_name LIKE "%' . $name . '%" AND drug_id NOT IN('. $alInNames .')  ORDER BY drug_name  ASC';
} else{
    $sql = 'SELECT * FROM tbl_drug WHERE drug_stock > 0 AND drug_name LIKE "%' . $name . '%" ORDER BY drug_name  ASC';
}
$stmt = $conn->prepare($sql);
$stmt->execute(array());
$result = $stmt->rowCount();

$user_nic = '<ul class="recent-posts">';
if ($result > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $user_nic .= "<li id=\"drug_ida\" data-drugid=\"".$row['drug_id']."\" data-drugprice=\"".$row['drug_price']."\" data-drugstock=\"".$row['drug_stock']."\">".$row['drug_name']."</li>"; 

    }
}else{
    $user_nic .= "No Drug Found";
}
$user_nic .= '</ul>';
echo $user_nic;
?>