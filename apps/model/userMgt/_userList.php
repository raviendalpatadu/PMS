<?php
require_once '../../control/config.php';
$template = new template();


$sql = 'SELECT * from tbl_user ';
$stmt = $conn->prepare($sql);
$stmt->execute(array());
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
    <tr class="gradeX" id="<?php echo $row['user_id']; ?>">
        <td data-target="user_id"><?php echo $row['user_id']; ?></td>
        <td data-target="user_fname"><?php echo $row['user_fname']; ?></td>
        <td data-target="user_lname"><?php echo $row['user_lname']; ?></td>
        <td data-target="user_mobile"><?php echo $row['user_mobile']; ?></td>
        <td class="hidden" data-target="user_address"><?php echo $row['user_address']; ?></td>
        <td class="hidden" data-target="user_email"><?php echo $row['user_email']; ?></td>
        <!-- <td class="hidden" data-target="user_type"><?php //echo $row['login_type']; ?></td> -->
        <td><a href="#" data-role="update" data-id="<?php echo $row['user_id']; ?>" class="btn btn-success" data-toggle="modal" data-target="#myModal">Edit</a></td>
    </tr>
<?php
}
?>