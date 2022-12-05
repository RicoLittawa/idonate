<?php 
require_once 'connection.php';
//accept request
if (isset($_POST['acceptBtn'])){
    
        $donateRefId= $_POST['donateRefId'];
        $request_id= $_POST['request_id'];
        $req_reference= $_POST['req_reference'];
        $req_name= $_POST['req_name'];
        $req_region= $_POST['req_region'];
        $req_province= $_POST['req_province'];
        $req_municipality= $_POST['req_municipality'];
        $req_barangay= $_POST['req_barangay'];
        $req_email= $_POST['req_email'];
        $req_contact= $_POST['req_contact'];
        $req_date= date('Y-m-d', strtotime($_POST['req_date']));
        $variant= $_POST['variant'];
        $quantity= $_POST['quantity'];
        $Category= $_POST['category_arr'];
        $ItemName= $_POST['itemName_arr'];
        $valid_id =$_POST['valid_id'];
        
    
    
        $sql1 = "INSERT INTO donation_items (Reference,donor_name,donor_region,donor_province,donor_municipality,donor_barangay,donor_email,donor_contact,donationDate)
        VALUES (?,?,?,?,?,?,?,?,?)" ;
            $stmt= mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql1)){
               echo'Sql error';
                exit();
              
            }
            else {
                mysqli_stmt_bind_param($stmt,"sssssssss",$donateRefId,$req_name,$req_region,$req_province,$req_municipality,$req_barangay,$req_email,$req_contact,$req_date);
                mysqli_stmt_execute($stmt);
            }
            $variantSQL= "INSERT into categ_varianttotal(donor_reference,variant,quantity) values(?,?,?)";
            $stmt= mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$variantSQL)){
                echo ''. $mysqli -> connect_list;
                   exit();
                  
               }
            else{
                mysqli_stmt_bind_param($stmt,"sss",$donateRefId,$variant,$quantity);
                mysqli_stmt_execute($stmt);
            }
            
            $count = 0;
            $resultCount = 0;
            foreach($Category as $item){
                $sql2= "INSERT INTO donation_items10 (Reference,category,name_items,variantCode) Values (?,?,?,?)";
                $stmt=mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql2)){
                    
                }
                else{
                    mysqli_stmt_bind_param($stmt, 'ssss', $donateRefId, $item,$ItemName[$count],$variant);
                    $result = mysqli_stmt_execute($stmt);
                    if($result) {
                        $resultCount = $resultCount + 1;
                        $count=$count+1;
                    }
                }
            }
           
            
            $donateRefId=$donateRefId+1;
           $sql3="UPDATE donation_items_picking  set reference_id=? "; 
           $stmt=mysqli_stmt_init($conn);
           if(!mysqli_stmt_prepare($stmt,$sql3)){
            
        } else{
            mysqli_stmt_bind_param($stmt, 'i', $donateRefId);
            $result2= mysqli_stmt_execute($stmt);
            if ($result2){
                
                
                $sql4= "DELETE from set_request where request_id= $request_id";
                if ($conn->query($sql4) === TRUE) {
                    $valid_id = $_POST['valid_id'];
                    $validPath= '../../donors/ValidId/'.$valid_id;
                    unlink($validPath);
                    
                  } else {
                    echo "Error deleting record: " . $conn->error;
                  }
                $sql5="DELETE from set_request10 where req_reference =  $req_reference";
                if ($conn->query($sql5) === TRUE) {
                    
                  } else {
                    echo "Error deleting record: " . $conn->error;
                  }
            }echo 'Data-submitted';
        }
        
     }