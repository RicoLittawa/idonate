<?php

    require_once 'connection.php';

        if (isset($_POST["saveBtn"]))
    {
   

        $reference_id= $_POST['ref_id'];
        $Fname= $_POST['fname'];
        $Province= $_POST['province'];
        $Municipality= $_POST['municipality'];
        $Barangay= $_POST['barangay'];
        $Region = $_POST['region'];
        $Email= $_POST['email'];
        $Date= date('Y-m-d', strtotime($_POST['donation_date']));
        $Contact= $_POST['contact'];
        $pnCN_arr= $_POST['pnCN_arr'];
        $qCN_arr= $_POST['qCN_arr'];
        $pnHY_arr= $_POST['pnHY_arr'];
        $qHY_arr= $_POST['qHY_arr'];
        $pnII_arr= $_POST['pnII_arr'];
        $qII_arr= $_POST['qII_arr'];
        $pnDW_arr= $_POST['pnDW_arr'];
        $qDW_arr= $_POST['qDW_arr'];
        $pnMG_arr=$_POST['pnMG_arr'];
        $typeMG_arr=$_POST['typeMG_arr'];
        $qMG_arr=$_POST['qMG_arr'];
        $unitMG_arr=$_POST['unitMG_arr'];
        $pnME_arr=$_POST['pnME_arr'];
        $typeME_arr=$_POST['typeME_arr'];
        $qME_arr=$_POST['qME_arr'];
        $unitME_arr=$_POST['unitME_arr'];
        $pnOT_arr=$_POST['pnOT_arr'];
        $typeOT_arr=$_POST['typeOT_arr'];
        $qOT_arr=$_POST['qOT_arr'];
        $unitOT_arr=$_POST['unitOT_arr'];
        $checkRes=$_POST['result'];
        
     



         $sql1 = "INSERT INTO donation_items (Reference,donor_name,donor_region,donor_province,donor_municipality,donor_barangay,donor_email,donor_contact,donationDate)
         VALUES (?,?,?,?,?,?,?,?,?)" ;
         $stmt= mysqli_stmt_init($conn);
         if(!mysqli_stmt_prepare($stmt,$sql1)){
          echo ''. $mysqli -> connect_list;
             exit();
           
         }
         else {
             mysqli_stmt_bind_param($stmt,"sssssssss",$reference_id,$Fname,$Region,$Province,$Municipality,$Barangay,$Email,$Contact,$Date);
             mysqli_stmt_execute($stmt);
         }
         foreach ($checkRes as $res){
            if ($res=='cannoodles'){
                $can = "INSERT INTO categdump (referenceID, productName, ptype,quantity,unit) VALUES (?,?,?,?,?)";
               $stmt= $conn->prepare($can);
               $stmt->bind_param("sssss", $reference_id, $null1, $null2, $null3, $null4);
               $stmt->execute();
               echo"save";
           }
           else if($res=='hygine'){
               $count = 0;
               $resultCount = 0;
               foreach($pnHY_arr as $hy){
                   $hygine = "INSERT INTO categhygineessential (referenceID, productName,quantity) VALUES (?,?,?)";
                   $stmt=mysqli_stmt_init($conn);
                   if(!mysqli_stmt_prepare($stmt,$hygine)){
                       
                   }
                   else{
                       mysqli_stmt_bind_param($stmt, 'sss', $reference_id,  $hy, $qHY_arr[$count],);
                       $result = mysqli_stmt_execute($stmt);
                       if($result) {
                           $resultCount = $resultCount + 1;
                           $count=$count+1;
                       }
                   }
               }
             
               echo"this is for hygine";
           }
           
           else{
               echo"not in the category";
           }
        }
          
     
           

      
      return;
          
                
          

        $reference_id=$reference_id+1;
       $sql3="UPDATE donation_items_picking  set reference_id=? "; 
       $stmt=mysqli_stmt_init($conn);
       if(!mysqli_stmt_prepare($stmt,$sql3)){
        
    } else{
        mysqli_stmt_bind_param($stmt, 'i', $reference_id);
         mysqli_stmt_execute($stmt);
    }
    echo "Data added";
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    }
    
    