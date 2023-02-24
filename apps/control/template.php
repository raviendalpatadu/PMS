<?php
class template
{

    public function getHead()
    {
        if (!isset($_SESSION['login_type'])) {
            header('location:' . BASE_URL . 'index.php');
        }

        echo '<head>
        <title>' . SITE_TITLE . '</title>
        <link rel="stylesheet" href="' . BASE_URL . 'lib/css/bootstrap.min.css" />
        <link rel="stylesheet" href="' . BASE_URL . 'lib/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="' . BASE_URL . 'lib/css/jquery.gritter.css">
        <link rel="stylesheet" href="' . BASE_URL . 'lib/css/uniform.css" />
        <link rel="stylesheet" href="' . BASE_URL . 'lib/css/select2.css" />
        <link rel="stylesheet" href="' . BASE_URL . 'lib/css/matrix-style.css" />
        <link rel="stylesheet" href="' . BASE_URL . 'lib/css/matrix-media.css" />
        <link href="' . BASE_URL . 'lib/css/font-awesome/css/font-awesome.css" rel="stylesheet">
        </head>

        <style>
            .loader {
                
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                position: absolute;
                background-color: #2e363f;
                z-index: 21;
                            
            }

            .loader:before,
            .loader:after {
                content: "";
                width: 100px;
                height: 100px;
                border-radius: 50%;
                border: solid 8px transparent;
                position: absolute;
                -webkit-animation: loading-1 1.4s ease infinite;
                animation: loading-1 1.4s ease infinite;
            }

            .loader:before {
                border-top-color: #da542e;
                border-bottom-color: #ffffff;
            }

            .loader:after {
                border-left-color: #ffb848;
                border-right-color: #28b779;
                -webkit-animation-delay: 0.7s;
                animation-delay: 0.7s;
            }

            @-webkit-keyframes loading-1 {
                0% {
                    -webkit-transform: rotate(0deg) scale(1);
                    transform: rotate(0deg) scale(1);
                }

                50% {
                    -webkit-transform: rotate(180deg) scale(0.5);
                    transform: rotate(180deg) scale(0.5);
                }

                100% {
                    -webkit-transform: rotate(360deg) scale(1);
                    transform: rotate(360deg) scale(1);
                }
            }

            @keyframes loading-1 {
                0% {
                    -webkit-transform: rotate(0deg) scale(1);
                    transform: rotate(0deg) scale(1);
                }

                50% {
                    -webkit-transform: rotate(180deg) scale(0.5);
                    transform: rotate(180deg) scale(0.5);
                }

                100% {
                    -webkit-transform: rotate(360deg) scale(1);
                    transform: rotate(360deg) scale(1);
                }
            }
        </style>

        ';
    }
    public function getHeader()
    {

        echo '
        <!--Header-part-->
        <div id="header">
            <h1><a href="dashboard.html">Matrix Admin</a></h1>
        </div>
        <!--close-Header-part--> 

        <!--top-Header-menu-->
        <div id="user-nav" class="navbar navbar-inverse">
            <ul class="nav">
                <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Welcome ' . ucfirst($_SESSION['user_fname']) . '</span><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="icon-user"></i> My Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="icon-check"></i> My Tasks</a></li>
                        <li class="divider"></li>
                        <li><a href="' . BASE_URL . 'apps/model/userMgt/logout.php"><i class="icon-key"></i> Log Out</a></li>
                    </ul>
                </li>
                <li class=""><a title=""href="' . BASE_URL . 'apps/view/userMgt/calendar.php"><i class="icon-calendar"></i> <span class="text">Calendar</span></a></li>';
        if (isset($_SESSION['login_type']) && $_SESSION['login_type'] == "User") {
            echo '
                    <li id="cart"><a title=""href="' . BASE_URL . 'apps/view/userMgt/cart.php"><i class="icon-shopping-cart"></i> <span class="text">Cart &nbsp</span><span class="label label-important" id="cart_qty">';
            if (isset($_SESSION["User"]["Cart_" . $_SESSION["login_id"]]) && $_SESSION["login_type"] == "User") {
                echo count($_SESSION["User"]["Cart_" . $_SESSION["login_id"]]);
            } else {
                echo 0;
            }
            echo '</span></a></li>';
        }

        echo '
                <li class="" onclick="logout()"><a href="#"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
            </ul></div>
        
        
            <script>
                function logout() {
                    if(confirm(\'Are you Sure you want to logout\')){
                        window.location.href="' . BASE_URL . 'apps/model/userMgt/logout.php";
                    } 
                }
            </script>

            ';
    }

    public function getSidebar()
    {

        echo '
        <div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-fullscreen"></i>Full width</a>
            <ul>
                <li class=""><a href="main.php" id="template"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>';
        if ($_SESSION['login_type'] != 'User') {
            echo ' <li class=""><a href="billing.php" id="billing"><i class="icon icon-barcode"></i> <span>Billing</span></a> </li>
                    <li class=""><a href="drugs.php" id="drugs"><i class="icon icon-inbox"></i> <span>Drugs</span></a> </li>
                    <li class=""><a href="orders.php" id="orders"><i class="icon icon-inbox"></i> <span>Orders</span></a> </li>
                    <li class=""><a href="userRegistration_V.php" id="userRegistration_V"><i class="icon icon-signal"></i> <span>Users</span></a> </li>
                    <li class=""><a href="customer.php" id="customer"><i class="icon icon-th"></i> <span>Customer</span></a></li>
                    <li class=""><a href="sales.php" id="sales"><i class="icon icon-fullscreen"></i> <span>Sales</span></a></li>
                    <li><a href="inventory.php"><i class="icon icon-tint"></i> <span> Inventory</span></a></li>
                    <li class="submenu"> <a href="#"><i class="icon icon-list"></i> <span>Registrations</span> <span class="label label-important">3</span></a>
                        <ul>
                            <li><a href="userRegistration.php" id="userRegistration">User Registration</a></li>
                            <li><a href="#">Client Registration</a></li>
                            <li><a href="drugRegistration.php" id="drugRegistration">Durg Registration</a></li>
                        </ul>
                    </li>
                
                ';
        }
        if ($_SESSION['login_type'] == 'User') {
            echo '
                <li class=""><a href="drugs_user.php" id="drugs_user"><i class="icon icon-inbox"></i> <span>Drugs</span></a> </li>
                <li class=""><a href="orders_user.php" id="drugs_user"><i class="icon icon-inbox"></i> <span>Your Orders</span></a> </li>';
        }
        echo '
                <li><a href="#"><i class="icon icon-pencil"></i> <span>Eelements</span></a></li>
                <li class="submenu"> <a href="#"><i class="icon icon-file"></i> <span>Addons</span> <span class="label label-important">5</span></a>
                    <ul>
                        <li><a href="#">Dashboard2</a></li>
                        <li><a href="#">Gallery</a></li>
                        <li><a href="#">Calendar</a></li>
                        <li><a href="#">Invoice</a></li>
                        <li><a href="#">Chat option</a></li>
                    </ul>
                </li>
                <li class="submenu"> <a href="#"><i class="icon icon-info-sign"></i> <span>Error</span> <span class="label label-important">4</span></a>
                    <ul>
                        <li><a href="#">Error 403</a></li>
                        <li><a href="#">Error 404</a></li>
                        <li><a href="#">Error 405</a></li>
                        <li><a href="#">Error 500</a></li>
                    </ul>
                </li>
                <li class="content"> <span>Monthly Bandwidth Transfer</span>
                <div class="progress progress-mini progress-danger active progress-striped">
                    <div style="width: 77%;" class="bar"></div>
                </div>
                <span class="percent">77%</span>
                <div class="stat">21419.94 / 14000 MB</div>
                </li>
                <li class="content"> <span>Disk Space Usage</span>
                <div class="progress progress-mini active progress-striped">
                    <div style="width: 87%;" class="bar"></div>
                </div>
                <span class="percent">87%</span>
                <div class="stat">604.44 / 4000 MB</div>
                </li>
            </ul>
        </div>';
    }

    public function getFooter()
    {

        echo '
        <div class="row-fluid">
            <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
        </div>
        ';
    }

    public function getScript()
    {
        echo '
        <script src="' . BASE_URL . 'lib/js/jquery.min.js"></script>
        <script src="' . BASE_URL . 'lib/js/jquery.ui.custom.js"></script> 
        <script src="' . BASE_URL . 'lib/js/bootstrap.min.js"></script> 
        <script src="' . BASE_URL . 'lib/js/moment.min.js"></script> 
        <script src="' . BASE_URL . 'lib/js/jquery.gritter.min.js"></script>
        <script src="' . BASE_URL . 'lib/js/jquery.uniform.js"></script> 
        <script src="' . BASE_URL . 'lib/js/select2.min.js"></script> 
        <script src="' . BASE_URL . 'lib/js/jquery.validate.js"></script> 
        <script src="' . BASE_URL . 'lib/js/matrix.js"></script> 
        <script src="' . BASE_URL . 'lib/js/matrix.form_validation.js"></script>
        <script>
            $(window).on(\'load\', function() {
                $(\'.loader\').fadeOut(100);
            });
        </script>
        <script>
                var path = window.location.pathname.split("/").pop();
                
                if (path == \'\') {
                    path = \'main.php\';
                }
            
                var target = $(\'#sidebar > ul > li > a[href="\'+path+\'"], #sidebar > ul > li.submenu > ul > li > a[href="\'+path+\'"] \').closest("li");
                target.addClass(\'active\');
            
                
        // This function is called from the pop-up menus to transfer to
        // a different page. Ignore if the value returned is a null string:
        function goPage (newURL) {

            // if url is empty, skip the menu dividers and reset the menu selection to default
            if (newURL != "") {

                // if url is "-", it is this page -- reset the menu:
                if (newURL == "-" ) {
                    resetMenu();            
                } 
                // else, send page to designated URL            
                else {  
                    document.location.href = newURL;
                }
            }
        }

        // resets the menu selection upon entry to this page:
            function resetMenu() {
                document.gomenu.selector.selectedIndex = 2;
            }
        </script>
        ';
    }

    public function getDataTables()
    {
        echo '
            <script src="' . BASE_URL . 'lib/js/jquery.dataTables.min.js"></script> 
            <script src="' . BASE_URL . 'lib/js/matrix.tables.js"></script> 
            
        ';
    }

    public function getCharts()
    {
        echo '
        <script src="' . BASE_URL . 'lib/js/chart.js"></script>
        ';
    }

    public function showMessage()
    {
        if (isset($_SESSION['SUCCESS'])) {
            foreach ((array) $_SESSION['SUCCESS'] as $info) {
                echo '<div class="alert alert-success" role="alert">' . $info . '</div>';
                unset($_SESSION['SUCCESS']);
            }
        }

        if (isset($_SESSION['ERROR'])) {
            foreach ((array) $_SESSION['ERROR'] as $error) {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                unset($_SESSION['ERROR']);
            }
        }

        if (isset($_SESSION['info'])) {
            foreach ((array) $_SESSION['info'] as $info) {
                echo '<div class="alert alert-success" role="alert">' . $info . '</div>';
                unset($_SESSION['info']);
            }
        }
    }

    public function alertDate($user_type = 'User')
    {
        if ($user_type == 'Admin' || $user_type == 'Staff') {
            global $conn;
            $sql = 'SELECT drug_id, drug_expDate from tbl_drug';
            $stmt = $conn->prepare($sql);
            $stmt->execute(array());
            $c = 0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $currentDate = date_create(date('Y-m-d'));
                $expDate = date_create($row['drug_expDate']);
                $diff = date_diff($currentDate, $expDate);
                $diffrence = $diff->format("%R%a");
                // echo $diffrence. "<br>";
                if ($diffrence <= 0) {
                    $c++;
                }
            }
            if ($c > 0) {
                echo ' 
                    <script>
                        $.gritter.add({
                            title: \'Drugs Expired\',
                            text: \'<a href="' . BASE_URL . 'apps/view/userMGT/drugs.php" style="color:#ffffff; font-size:small;">You have ' . $c . ' expired drugs.</u>\',
                            image: \'' . BASE_URL . 'lib/img/demo/envelope.png\',
                            sticky: false
                        });
                    </script>
                    ';
            }
        }
    }

    public function check_required_fields($req_field)
    {
        $errors = array();

        foreach ($req_field as $field) {
            $trimVal = trim($_POST[$field]);
            if (empty($trimVal)) {
                $_SESSION['ERROR'][] = $field . " is required";
            }
        }
        return $errors;
    }

    public function random_string($length)
    {
        $arr = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
        $text = '';
        for ($i = 0; $i < $length; $i++) {
            $random = rand(0, 61);
            $text .= $arr[$random];
        }

        return $text;
    }
}
