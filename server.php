<?php 

include "db_conn.php";

date_default_timezone_set('Asia/Manila');


// =============================================================================== ADMIN ===============================================================================


//  =============================== DEACTIVATE USER ===============================
if(isset($_POST['deactTrig']) == true){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $stmt = mysqli_query($conn, "UPDATE users SET status = 'Deactivated' WHERE user_id = '$id'");
        if($stmt){
            echo json_encode(array('statusCode' => 'deactivated'));
        }
    }
}

//  =============================== REACTIVATE USER ===============================
if(isset($_POST['reactivTrig']) == true){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $stmt = mysqli_query($conn, "UPDATE users SET status = 'Active' WHERE user_id = '$id'");
        if($stmt){
            echo json_encode(array('statusCode' => 'reactivated'));
        }
    }
}

//  =============================== DELETE USER ===============================
if(isset($_POST['delTrig']) == true){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $stmt = mysqli_query($conn, "DELETE FROM users WHERE user_id = '$id'");
        if($stmt){
            echo json_encode(array('statusCode' => 'deleted'));
        }
    }
}

//  =============================== MANAGE USER DASHLET ===============================
if(isset($_POST['manageUserDashletTrig']) == true){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $countTotalUsers = mysqli_query($conn, "SELECT * FROM users WHERE role_id = 2");
        $totalUsers = mysqli_num_rows($countTotalUsers);

        $countTotalActive = mysqli_query($conn, "SELECT * FROM users WHERE status = 'Active' AND role_id = 2");
        $totalActive = mysqli_num_rows($countTotalActive);

        $countTotalDeact = mysqli_query($conn, "SELECT * FROM users WHERE status = 'Deactivated'");
        $totalDeact = mysqli_num_rows($countTotalDeact);

        echo json_encode(array(
                    'totUsers' => $totalUsers,
                    'totActive' => $totalActive,
                    'totDeact' => $totalDeact
        ));
    }
}




//  =============================== ADD PRODUCTS ===============================

if(isset($_POST['addProdTrig']) == true){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $prodName = $_POST['prodName'];
        $prodCateg = $_POST['prodCateg'];
        $prodQuantity = $_POST['prodQuantity'];

        $select = mysqli_query($conn, "SELECT * FROM product WHERE product_name = '$prodName'");
        if(mysqli_num_rows($select) > 0){
            $upd = mysqli_query($conn, "UPDATE product SET quantity = quantity + '$prodQuantity' WHERE product_name = '$prodName'");
            if($upd){
                echo json_encode(array('statusCode' => 'prodAdded'));
            }
        }else{
            $stmt = mysqli_query($conn, "INSERT INTO product (product_name, categ_id, quantity) VALUES ('$prodName','$prodCateg','$prodQuantity')");

            if($stmt){
                echo json_encode(array('statusCode' => 'prodAdded'));
            }
        }
        

    }
}


//  =============================== ADD QUANTITY ===============================
if(isset($_POST['qtyFldTrig']) == true){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $qtyFld = $_POST['qtyFld'];
        $upd = mysqli_query($conn, "UPDATE product SET quantity = quantity + '$qtyFld' WHERE product_id = '$id'");
        if($upd){
            echo json_encode(array('statusCode' => 'quantAdded'));
        }
      
    }
}


//  =============================== STOCKS DASHLET ===============================
if(isset($_POST['stocksDashletTrig']) == true){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // COUNT TOTAL STOCKS
        $totStocksCount = mysqli_query($conn, "SELECT * FROM product");
        $totStocks = mysqli_num_rows($totStocksCount);
      
        // COUNT TOTAL IN STOCKS
        $totInStocksCount = mysqli_query($conn, "SELECT * FROM product WHERE quantity != 0");
        $totInStocks = mysqli_num_rows($totInStocksCount);


        // COUNT TOTAL OUT OF STOCKS
        $totOutOfStocksCount = mysqli_query($conn, "SELECT * FROM product WHERE quantity = 0");
        $totOutOfStocks = mysqli_num_rows($totOutOfStocksCount);

        echo json_encode(array(
                    'totStocks' => $totStocks,
                    'totInStocks' => $totInStocks,
                    'totOutOfStocks' => $totOutOfStocks
        ));
    }
}



//  =============================== ACCEPT RESERVATION ===============================
if(isset($_POST['acceptRes']) == true){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $resID = $_POST['resID'];
        $stmt = mysqli_query($conn, "UPDATE reservation_info SET res_status = 'Accepted' WHERE res_id = '$resID'");
       
        if($stmt){
            $selUser = mysqli_query($conn, "SELECT * FROM reservation_info WHERE res_id = '$resID'");
            $row = mysqli_fetch_assoc($selUser);
            $res_date = $row['res_date'];
            $userID = $row['user_id'];
            $status = $row['res_status'];
            mysqli_query($conn, "INSERT INTO notification (user_id, res_status, res_date) VALUES ('$userID', '$status', '$res_date')");

            echo json_encode(array('statusCode' => 'resAccepted'));
        }
        

    }
}


//  =============================== REJECT RESERVATION ===============================
if(isset($_POST['rejectRes']) == true){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $resID = $_POST['resID'];
        $stmt = mysqli_query($conn, "UPDATE reservation_info SET res_status = 'Rejected' WHERE res_id = '$resID'");
       
        if($stmt){
            $selUser = mysqli_query($conn, "SELECT * FROM reservation_info WHERE res_id = '$resID'");
            $row = mysqli_fetch_assoc($selUser);
            $res_date = $row['res_date'];
            $userID = $row['user_id'];
            $status = $row['status'];
            mysqli_query($conn, "INSERT INTO notification (user_id, res_status, res_date) VALUES ('$userID', '$status', '$res_date')");

            echo json_encode(array('statusCode' => 'resRejected'));
        }
        
    }
}


//  =============================== RESERVATION INFO DASHLETS ===============================
if(isset($_POST['resInfoDashletTrig']) == true){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $currDate = date('m/d/Y');
       
        // COUNT TOTAL PENDING RESERVATION
        $totPendingResCount = mysqli_query($conn, "SELECT * FROM reservation_info WHERE res_status = 'Pending'");
        $totPendingRes = mysqli_num_rows($totPendingResCount);
        
        // COUNT TOTAL RESERVATION
        $totResCount = mysqli_query($conn, "SELECT * FROM reservation_info WHERE res_status = 'Accepted' AND res_date > '$currDate'");
        $totRes = mysqli_num_rows($totResCount);
       

        // COUNT TOTAL REJECTED
        $totRejectedResCount = mysqli_query($conn, "SELECT * FROM reservation_info WHERE res_status = 'Rejected'");
        $totRejectedRes = mysqli_num_rows($totRejectedResCount);

        echo json_encode(array(
                    'totRes' => $totRes,
                    'totPendingRes' => $totPendingRes,
                    'totRejectedRes' => $totRejectedRes
        ));
    }
}





// =============================================================================== USERS ===============================================================================


//  =============================== CHECKING DATE AVAILABILITY ===============================
if(isset($_POST['checkDateAvlblty']) == true){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $check = mysqli_query($conn, "SELECT * FROM reservation_info WHERE res_status = 'Pending' GROUP BY res_date HAVING COUNT(res_date) = 10");
        
        $data = array();
        while($row = mysqli_fetch_assoc($check)){
            // $subArr = array();
            $data[] = date('m/d/Y', strtotime($row['res_date']));
        }
        
        echo json_encode($data);

    }
}


//  =============================== CHECKING TIME AVAILABILITY ===============================
if(isset($_POST['checkTimeAvlblty']) == true){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $resDate = $_POST['resDate'];
       
        $check = mysqli_query($conn, "SELECT * FROM reservation_info WHERE res_status = 'Pending' AND res_date = '$resDate' GROUP BY res_date, res_hour HAVING COUNT(res_hour) = 5");
        $data = array();
        while($row = mysqli_fetch_assoc($check)){
            $data[] = $row['res_hour'];
        }
        
        echo json_encode($data);

    }
}







//  =============================== AUTO POPULATE DROPDOWN DETERGENT AND FABCON ===============================
if(isset($_POST['populateTrig']) == true){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // FETCH ALL IN-STOCK DETERGENTS
        $detergentDropdown = '<option value="">Select Detergent</option>';
        $detergent = mysqli_query($conn, "SELECT * FROM product WHERE categ_id = 1 AND quantity > 0");
        if(mysqli_num_rows($detergent) > 0){
            while($row1 = mysqli_fetch_assoc($detergent)){
                $detergentDropdown .= '<option value="'.$row1['product_name'].'">'.$row1['product_name'].'</option>';
            }
        }


        // FETCH ALL IN-STOCK FABCON
        $fabConDropdown = '<option value="">Select FabCon</option>';
        $fabCon = mysqli_query($conn, "SELECT * FROM product WHERE categ_id = 2 AND quantity > 0");
        if(mysqli_num_rows($fabCon) > 0){
            while($row2 = mysqli_fetch_assoc($fabCon)){
                $fabConDropdown .= '<option value="'.$row2['product_name'].'">'.$row2['product_name'].'</option>';
            }
        }

        echo json_encode(array(
                    'detergentDropdown' => $detergentDropdown,
                    'fabConDropdown' => $fabConDropdown
        ));
    }
}




//  =============================== SUBMIT RESERVATION INFO ===============================
if(isset($_POST['submitWashDryBtnTrig']) == true){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $srvType = $_POST['srvType'];
        $userID = $_POST['userID'];
        $washDryKilo = $_POST['washDryKilo'];
        $selDetergent = $_POST['selDetergent'];
        $detergentQty = $_POST['detergentQty'];
        $selFabCon = $_POST['selFabCon'];
        $fabConQty = $_POST['fabConQty'];
        $washDryResDate = $_POST['washDryResDate'];
        $washDryResTime = $_POST['washDryResTime'];
        $washDryPN = $_POST['washDryPN'];
        $washDryNote = $_POST['washDryNote'];
        
        
        
        $stmt = mysqli_query($conn, "INSERT INTO reservation_info (user_id, srvc_id, kilo, detergent_name, detertgent_qty, fabcon_name, fabcon_qty, res_date, res_hour, phone_num, note) VALUES ('$userID', '$srvType', '$washDryKilo', '$selDetergent', '$detergentQty', '$selFabCon', '$fabConQty', '$washDryResDate', '$washDryResTime', '$washDryPN', '$washDryNote')");
        
            if($stmt){
                $upd1 = mysqli_query($conn, "UPDATE product SET quantity = quantity - '$detergentQty' WHERE product_name = '$selDetergent'");
                $upd2 = mysqli_query($conn, "UPDATE product SET quantity = quantity - '$fabConQty' WHERE product_name = '$selFabCon'");
                
                echo json_encode(array('statusCode' => 'reserved'));
            }
       
        
    }
}


if(isset($_POST['submitDryBtnTrig']) == true){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $srvType = $_POST['srvType'];
        $userID = $_POST['userID'];
        $dryKilo = $_POST['dryKilo'];
        $dryResDate = $_POST['dryResDate'];
        $dryResTime = $_POST['dryResTime'];
        $dryPN = $_POST['dryPN'];
        $dryNote = $_POST['dryNote'];
        
        
        $stmt = mysqli_query($conn, "INSERT INTO reservation_info (user_id, srvc_id, kilo, detergent_name, detertgent_qty, fabcon_name, fabcon_qty, res_date, res_hour, phone_num, note) VALUES ('$userID', '$srvType', '$dryKilo', DEFAULT, DEFAULT, DEFAULT, DEFAULT, '$dryResDate', '$dryResTime', '$dryPN', '$dryNote')");
        
            if($stmt){
                echo json_encode(array('statusCode' => 'reserved2'));
            }
       
        
    }
}



//  =============================== FETCH RESRVATION INFO ===============================

if(isset($_POST['fetchResInfo']) == true){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $resID = $_POST['resID'];
        $stmt = mysqli_query($conn, "SELECT * FROM reservation_info INNER JOIN services ON reservation_info.srvc_id = services.srvc_id WHERE res_id = '$resID'");
        $row = mysqli_fetch_assoc($stmt);
  

        echo json_encode(array(
            'srvcType' => $row['srvc_type'],
            'kg' => $row['kilo'],
            'detrgntType' => $row['detergent_name'],
            'detrgntQty' => $row['detertgent_qty'],
            'fabConType' => $row['fabcon_name'],
            'fabConQty' => $row['fabcon_qty'],
            'dateRes' => $row['res_date'],
            'hourRes' => $row['res_hour'],
            'notee' => $row['note'],
            'stats' => $row['res_status'],
            'amntPaid' => $row['srvc_price']
        ));
       

    }
}


//  =============================== UPDATE NOTIF STATUS ===============================
if(isset($_POST['paidTrig']) == true){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $resID = $_POST['resID'];
        $stmt = mysqli_query($conn, "UPDATE reservation_info SET isPaid = 'Yes' WHERE res_id = '$resID'");
        echo json_encode(array('isPaid' => 'Yes'));
    }
}


//  =============================== FETCH NOTIFICATION IF RESERVATION HAS BEEN ACCEPTED BY THE ADMIN ===============================

if(isset($_POST['notif']) == true){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $userID = $_POST['userID'];
        $stmt = mysqli_query($conn, "SELECT * FROM notification WHERE user_id = '$userID' AND notif_status = 'Unread'");
        $row = mysqli_fetch_assoc($stmt);
        $count = mysqli_num_rows($stmt);

        echo json_encode(array('notifCount' => $count, 'resDate' => $row['res_date'], 'resStatus' => $row['res_status']));
       

    }
}


//  =============================== UPDATE NOTIF STATUS ===============================
if(isset($_POST['updNotifStats']) == true){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $userID = $_POST['userID'];
        $stmt = mysqli_query($conn, "UPDATE notification SET notif_status = 'Read' WHERE user_id = '$userID'");
        echo json_decode($stmt);
    }
}







// ============================================= CHARTS ==================================================

if(isset($_POST['weeklyDynamicReportTrig']) == true){
        
        $firstMonday = new DateTime('first Monday of this month');

        $getDaysOFWeeks = array();
        
        for($i = 0; $i < 4; $i++){
            $getDaysOFWeeks[] = $firstMonday->format('m/d/Y');
            $firstMonday->modify('next Monday');
        }
        
       
        $week1Freq = array();
        $week1Rev = array();
        $getDays1stWeek = array();

        $week2Freq = array();
        $week2Rev = array();
        $getDays2ndWeek = array();

        $week3Freq = array();
        $week3Rev = array();
        $getDays3rdWeek = array();

        $week4Freq = array();
        $week4Rev = array();
        $getDays4thWeek = array();
        
        for($j = 0; $j < 7; $j++){
           
            $getDays1stWeek[] = date('m/d/Y',strtotime($getDaysOFWeeks[0] . "+$j day"));
            $day1stmt = mysqli_query($conn, "SELECT SUM(srvc_price) as totRevWeek1 FROM reservation_info INNER JOIN services ON reservation_info.srvc_id = services.srvc_id WHERE res_date = '$getDays1stWeek[$j]' AND isPaid = 'Yes'");
            
            while($row = mysqli_fetch_assoc($day1stmt)){
                $week1Rev[] = $row['totRevWeek1'];
            }
            
            $getDays2ndWeek[] = date('m/d/Y',strtotime($getDaysOFWeeks[1] . "+$j day"));
            $day2stmt = mysqli_query($conn, "SELECT SUM(srvc_price) as totRevWeek2 FROM reservation_info INNER JOIN services ON reservation_info.srvc_id = services.srvc_id WHERE res_date = '$getDays2ndWeek[$j]' AND isPaid = 'Yes'");

            while($row2 = mysqli_fetch_assoc($day2stmt)){
    
                $week2Rev[] = $row2['totRevWeek2'];
            }
            
            $getDays3rdWeek[] = date('m/d/Y',strtotime($getDaysOFWeeks[2] . "+$j day"));
            $day3stmt = mysqli_query($conn, "SELECT SUM(srvc_price) as totRevWeek3 FROM reservation_info INNER JOIN services ON reservation_info.srvc_id = services.srvc_id WHERE res_date = '$getDays3rdWeek[$j]' AND isPaid = 'Yes'");
            
            while($row3 = mysqli_fetch_assoc($day3stmt)){
    
                $week3Rev[] = $row3['totRevWeek3'];
            }
            
            $getDays4thWeek[] = date('m/d/Y',strtotime($getDaysOFWeeks[3] . "+$j day"));
            $day4stmt = mysqli_query($conn, "SELECT SUM(srvc_price) as totRevWeek4 FROM reservation_info INNER JOIN services ON reservation_info.srvc_id = services.srvc_id WHERE res_date = '$getDays4thWeek[$j]' AND isPaid = 'Yes'");
           
            while($row4 = mysqli_fetch_assoc($day4stmt)){
    
                $week4Rev[] = $row4['totRevWeek4'];
            }
            
            
        }
        

        echo json_encode(array(
                            'totRevWeek1'=> array_sum($week1Rev),
                            'totRevWeek2'=> array_sum($week2Rev),
                            'totRevWeek3'=> array_sum($week3Rev),
                            'totRevWeek4'=> array_sum($week4Rev)
                        )
            );
    
}


if(isset($_POST['monthlyDynamicReportTrig']) == true){

      
        $totMonthlyRev = array();
        
        for($i = 1; $i <= 12; $i++){
            $totDayInMonths = cal_days_in_month(CAL_GREGORIAN,$i,2021);
            $month = sprintf("%02d", $i);
            $firstDay = $month.'/01/2021';
            $lastDay = $month.'/'.$totDayInMonths.'/2021';
         
            $stmt = mysqli_query($conn, "SELECT SUM(srvc_price) as totMonthlyRev FROM reservation_info INNER JOIN services ON reservation_info.srvc_id = services.srvc_id WHERE res_date >= '$firstDay' AND res_date <= '$lastDay' AND isPaid = 'Yes'");
       
            foreach($stmt as $row){
                $totMonthlyRev[] = $row['totMonthlyRev'];
            }
           
        }

        echo json_encode(array('totMonthlyRev' => $totMonthlyRev));
    
}



if(isset($_POST['yearlyDynamicReportTrig']) == true){

        $totYearlyRev = array();

        $years = array();
       
        for($i = 5; $i >= 0; $i--){
            $years[] = date('Y', strtotime("-$i year"));
        }


        for($k=0; $k<=5; $k++){
            $stmt = mysqli_query($conn, "SELECT SUM(srvc_price) as totYearlyRev FROM reservation_info INNER JOIN services ON reservation_info.srvc_id = services.srvc_id WHERE res_date LIKE 
            '%$years[$k]' AND isPaid = 'Yes'");
            foreach($stmt as $row){
                $totYearlyRev[] = $row['totYearlyRev'];
            }
        }

        echo json_encode(array(
            'years' => $years,
            'totYearlyRev' => $totYearlyRev
        ));
    
}