<?php
require_once '../../control/config.php';
$template = new template();

// when value is changed in the cart.php
if (isset($_POST['act']) && $_POST['act'] == 'focusout') {
    $id = $_POST['drug_id'];
    $qty = $_POST['qty'];

    $_SESSION[$_SESSION['login_type']]['Cart_' . $_SESSION['login_id']][$id] = $qty;

    echo $_SESSION[$_SESSION['login_type']]['Cart_' . $_SESSION['login_id']][$id];
}


// when remove button is clicked the drug id in the SESSION['Cart] is unsset
if (isset($_POST['drug_id']) && $_POST['act'] == 'remove') {
    $id = $_POST['drug_id'];

    unset($_SESSION[$_SESSION['login_type']]['Cart_' . $_SESSION['login_id']][$id]);
    $count = count($_SESSION[$_SESSION['login_type']]['Cart_' . $_SESSION['login_id']]);
    echo $count;
}


// when the modal is loaded to display the invoice
if (isset($_POST['act']) && $_POST['act'] == 'loadToCheckout') {
    $data = array();
    $sum = null;
    if (isset($_SESSION[$_SESSION['login_type']]['Cart_' . $_SESSION['login_id']])) :
        $rows ='';
        foreach ($_SESSION[$_SESSION['login_type']]['Cart_' . $_SESSION['login_id']] as $id => $qty) :
            $sql = 'SELECT * from tbl_drug where drug_id = :id limit 1';
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                'id' => $id
            ));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $sum +=  $row['drug_price'] * $qty;
            $rows .= "<tr>
                    <td>" . $row['drug_name'] . " </td>
                    <td>" . $row['drug_description'] . " </td>
                    <td class='right0'>" . $qty . " </td>
                    <td class='right'>" . $row['drug_price'] . "</td>
                    <td class='right'><strong> Rs." . $row['drug_price'] * $qty . " </strong></td>
                    <input type='hidden name='drug_id' value='" . $row['drug_id']."'>
                </tr>";
        endforeach;
        $data['tr'] = $rows; 

        $data['tfoot'] = '<tr>
                            <th style="text-align:left;" colspan="4"> Total</th>
                            <th style="text-align:left;">Rs.'.$sum.'</th>
                        </tr>
        ';
        
    endif;

    echo json_encode($data);
}
