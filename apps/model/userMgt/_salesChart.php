<?php

use function PHPSTORM_META\type;

require_once '../../control/config.php';
$template = new template();
$final = array();
// get days in the past 7 days
$this_week_ed = date("Y-m-d");
$minusSeven = date_sub(date_create($this_week_ed), date_interval_create_from_date_string("06 days"));
$this_week_sd = date_format($minusSeven, "Y-m-d");



// echo "Current week range from $this_week_sd to $this_week_ed " . gettype($this_week_ed);

// if a bar chart
// show the total number of drugs sold in past seven days
if (isset($_POST['bar']) || isset($_POST['startdate']) && isset($_POST['enddate'])) {
    // echo $_POST['type'];
    $bar = array();
    $this_week_ed = date_add(date_create($this_week_ed), date_interval_create_from_date_string("01 days"));
    $this_week_ed = date_format($this_week_ed, 'Y-m-d');

    if (isset($_POST['startdate']) && isset($_POST['enddate'])) {
        
        $this_week_sd = $_POST['startdate'];
        $this_week_ed = $_POST['enddate'];
        if ($this_week_sd == $this_week_ed) {
            $this_week_sd_plusOne = date_add(date_create($this_week_sd), date_interval_create_from_date_string("01 days"));
            $this_week_sd_plusOne = date_format($this_week_sd_plusOne, "Y-m-d");
            $sql = "SELECT SUM(tbl_sales.sales_quantity) AS tot_qty, sales_date, drug_name, drug_id, sales_drugId FROM tbl_sales, tbl_drug WHERE (tbl_sales.sales_date BETWEEN :start_date AND :end_date) AND tbl_sales.sales_drugId = tbl_drug.drug_id";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                'start_date' => $this_week_sd,
                'end_date' => $this_week_sd_plusOne,
            ));
            $qty = $stmt->fetch(PDO::FETCH_ASSOC);
            // echo "    start: " . $this_week_sd . "---  plus1: ". $this_week_sd_plusOne . '--- star ed: '. $this_week_ed. '--- qty: '.$qty['tot_qty'];
            if ($qty['tot_qty'] != NULL) {
                $bar[] = intval($qty['tot_qty']);
            } else {
                $bar[] = 0;
            }
        }
        $this_week_ed = date_add(date_create($this_week_ed), date_interval_create_from_date_string("01 days"));
        $this_week_ed = date_format($this_week_ed, 'Y-m-d');
        // echo " BAR-->   start: " . $this_week_sd . ' ED: ' . $this_week_ed;
    }

    while ($this_week_sd != $this_week_ed) {
        $this_week_sd_plusOne = date_add(date_create($this_week_sd), date_interval_create_from_date_string("01 days"));
        $this_week_sd_plusOne = date_format($this_week_sd_plusOne, "Y-m-d");
        $sql = "SELECT SUM(tbl_sales.sales_quantity) AS tot_qty, tbl_sales.sales_date, tbl_drug.drug_name, tbl_drug.drug_id, tbl_sales.sales_drugId FROM tbl_sales, tbl_drug WHERE (sales_date BETWEEN :start_date AND :end_date) AND tbl_sales.sales_drugId = tbl_drug.drug_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            'start_date' => $this_week_sd,
            'end_date' => $this_week_sd_plusOne,
        ));
        $qty = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($qty['tot_qty'] != NULL) {
            $bar[] = intval($qty['tot_qty']);
        } else {
            $bar[] = 0;
        }
        $this_week_sd = date_add(date_create($this_week_sd), date_interval_create_from_date_string("01 days"));
        $this_week_sd = date_format($this_week_sd, 'Y-m-d');
    }
    $final['bar'] = $bar;
    // $final['pie'] = $pie; 
}

// pie chart section
if (isset($_POST['pie'])) {
    $pie = array();
    $colour = array();
    $this_week_pie_ed = date("Y-m-d");
    $minusSeven = date_sub(date_create($this_week_pie_ed), date_interval_create_from_date_string("06 days"));
    $this_week_pie_sd = date_format($minusSeven, "Y-m-d");

    $this_week_pie_ed = date_add(date_create($this_week_pie_ed), date_interval_create_from_date_string("01 days"));
    $this_week_pie_ed = date_format($this_week_pie_ed, 'Y-m-d');

    if (isset($_POST['startdate']) && isset($_POST['enddate'])) {
        $this_week_pie_sd = $_POST['startdate'];
        $this_week_pie_ed = $_POST['enddate'];
        $this_week_pie_ed = date_add(date_create($this_week_pie_ed), date_interval_create_from_date_string("01 days"));
        $this_week_pie_ed = date_format($this_week_pie_ed, 'Y-m-d');
    }

    // echo " PIE--->   start: " . $this_week_pie_sd .  'ED---- ' . $this_week_pie_ed;
    $sql_pie = "SELECT SUM(s.sales_quantity) AS sales_tot, d.drug_name FROM tbl_drug  AS d, tbl_sales AS s WHERE s.sales_date BETWEEN :start_date AND :end_date AND s.sales_drugId =d.drug_id GROUP BY d.drug_name";
    $stmt_pie = $conn->prepare($sql_pie);
    $stmt_pie->execute(array(
        'start_date' => $this_week_pie_sd,
        'end_date' => $this_week_pie_ed,
    ));
    while ($qty_pie = $stmt_pie->fetch(PDO::FETCH_ASSOC)) {
        if ($qty_pie['sales_tot'] != null) {
            $pie['qty'][] = intval($qty_pie['sales_tot']);
        } else {
            $pie['qty'][] = 0;
        }
        $pie['name'][] = $qty_pie['drug_name'];
        $pie['colour'][] =  'rgb('. rand(75, 255). ','. rand(0,250). ','. rand(15, 255). ')';
    }
    // $pie['colour'][] = $colour;
    $final['pie'] = $pie;
}


// echo "<pre>";
// print_r($final);
echo json_encode($final);
// echo "</pre>";
// total sales quantity
// sales date