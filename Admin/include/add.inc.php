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
       $null1='';
       $null2='';
         foreach ($checkRes as $res){
             if ($res=='cannoodles'){
                  $count = 0;
                  $resultCount = 0;
                  foreach($pnCN_arr as $cn){
                        $list_items="INSERT INTO donation_items10 (Reference,productName,type,unit,quantity) VALUES (?,?,?,?,?)";
                        $stmt= mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt,$list_items)){
                        
                        }
                        else {
                            mysqli_stmt_bind_param($stmt,"sssss",$reference_id,$cn,$null1,$null2,$qCN_arr[$count]);
                         mysqli_stmt_execute($stmt);
                   
                        }
                         $can = "INSERT INTO categcannoodles (referenceID, productName,quantity) VALUES (?,?,?)";
                         $stmt=mysqli_stmt_init($conn);
                         if(!mysqli_stmt_prepare($stmt,$can)){
                           
                         }
                         else{
                             mysqli_stmt_bind_param($stmt, 'sss', $reference_id,  $cn, $qCN_arr[$count]);
                             $result = mysqli_stmt_execute($stmt);
                             if($result) {
                                 $resultCount = $resultCount + 1;
                                 $count=$count+1;                 
                        }
                        
                     }
                 }           
            }
            if($res=='hygine'){
                 $count = 0;
                 $resultCount = 0;
                 foreach($pnHY_arr as $hy){
                        $list_items="INSERT INTO donation_items10 (Reference,productName,type,unit,quantity) VALUES (?,?,?,?,?)";
                        $stmt= mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt,$list_items)){
                        
                        }
                        else {
                            mysqli_stmt_bind_param($stmt,"sssss",$reference_id,$hy,$null1,$null2,$qHY_arr[$count]);
                         mysqli_stmt_execute($stmt);
                   
                        }
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
             }
            if($res=='infant'){
             $count = 0;
             $resultCount = 0;
             foreach($pnII_arr as $ii){
                $list_items="INSERT INTO donation_items10 (Reference,productName,type,unit,quantity) VALUES (?,?,?,?,?)";
                $stmt= mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$list_items)){
                
                }
                else {
                    mysqli_stmt_bind_param($stmt,"sssss",$reference_id,$ii,$null1,$null2,$qII_arr[$count]);
                 mysqli_stmt_execute($stmt);
           
                }
                $infant = "INSERT INTO categinfant (referenceID, productName,quantity) VALUES (?,?,?)";
                 $stmt=mysqli_stmt_init($conn);
                 if(!mysqli_stmt_prepare($stmt,$infant)){   
                 }
                 else{
                     mysqli_stmt_bind_param($stmt, 'sss', $reference_id,  $ii, $qII_arr[$count],);
                     $result = mysqli_stmt_execute($stmt);
                     if($result) {
                         $resultCount = $resultCount + 1;
                         $count=$count+1;
                     }
                 }
             }      
         }
         if($res=='drink'){
             $count = 0;
             $resultCount = 0;
             foreach($pnDW_arr as $dw){
                $list_items="INSERT INTO donation_items10 (Reference,productName,type,unit,quantity) VALUES (?,?,?,?,?)";
                        $stmt= mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt,$list_items)){
                        
                        }
                        else {
                            mysqli_stmt_bind_param($stmt,"sssss",$reference_id,$dw,$null1,$null2,$qDW_arr[$count]);
                         mysqli_stmt_execute($stmt);
                   
                        }
                 $drink = "INSERT INTO categdrinkingwater (referenceID, productName,quantity) VALUES (?,?,?)";
                 $stmt=mysqli_stmt_init($conn);
                 if(!mysqli_stmt_prepare($stmt,$drink)){     
                 }
                 else{
                     mysqli_stmt_bind_param($stmt, 'sss', $reference_id,  $dw, $qDW_arr[$count],);
                     $result = mysqli_stmt_execute($stmt);
                     if($result) {
                         $resultCount = $resultCount + 1;
                         $count=$count+1;
                     }
                 }
             }       
         }
         if($res=='meat'){
             $count = 0;
             $resultCount = 0;
             foreach($pnMG_arr as $mg){
                $list_items="INSERT INTO donation_items10 (Reference,productName,type,unit,quantity) VALUES (?,?,?,?,?)";
                        $stmt= mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt,$list_items)){
                        
                        }
                        else {
                            mysqli_stmt_bind_param($stmt,"sssss",$reference_id,$mg,$typeMG_arr[$count],$unitMG_arr[$count],$qMG_arr[$count]);
                         mysqli_stmt_execute($stmt);
                   
                        }
                     $meat = "INSERT INTO categmeatgrains (referenceID, productName,type,quantity,unit) VALUES (?,?,?,?,?)";
                     $stmt=mysqli_stmt_init($conn);
                     if(!mysqli_stmt_prepare($stmt,$meat)){  
                     }
                     else{
                         mysqli_stmt_bind_param($stmt, 'sssss', $reference_id,  $mg,$typeMG_arr[$count], $qMG_arr[$count],$unitMG_arr[$count]);
                         $result = mysqli_stmt_execute($stmt);
                         if($result) {
                             $resultCount = $resultCount + 1;
                             $count=$count+1;
                     }
                 }
             }      
         }
         if($res=='meds'){
             $count = 0;
             $resultCount = 0;
             foreach($pnME_arr as $me){
                $list_items="INSERT INTO donation_items10 (Reference,productName,type,unit,quantity) VALUES (?,?,?,?,?)";
                        $stmt= mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt,$list_items)){
                        
                        }
                        else {
                            mysqli_stmt_bind_param($stmt,"sssss",$reference_id,$me,$typeME_arr[$count],$unitME_arr[$count],$qME_arr[$count]);
                         mysqli_stmt_execute($stmt);
                   
                        }
                     $meds = "INSERT INTO categmedicine (referenceID, productName,type,quantity,unit) VALUES (?,?,?,?,?)";
                     $stmt=mysqli_stmt_init($conn);
                     if(!mysqli_stmt_prepare($stmt,$meds)){      
                     }
                     else{
                         mysqli_stmt_bind_param($stmt, 'sssss', $reference_id,  $me,$typeME_arr[$count], $qME_arr[$count],$unitME_arr[$count]);
                         $result = mysqli_stmt_execute($stmt);
                         if($result) {
                             $resultCount = $resultCount + 1;
                             $count=$count+1;
                     }
                 } 
             }      
         }
         else if($res=='other'){
             $count = 0;
             $resultCount = 0;
             $list_items="INSERT INTO donation_items10 (Reference,productName,type,unit,quantity) VALUES (?,?,?,?,?)";
                        $stmt= mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt,$list_items)){
                        
                        }
                        else {
                            mysqli_stmt_bind_param($stmt,"sssss",$reference_id,$ot,$typeOT_arr[$count],$unitOT_arr[$count],$qOT_arr[$count]);
                         mysqli_stmt_execute($stmt);
                   
                        }
                     $other = "INSERT INTO categothers (referenceID, productName,type,quantity,unit) VALUES (?,?,?,?,?)";
                     $stmt=mysqli_stmt_init($conn);
                     if(!mysqli_stmt_prepare($stmt,$other)){  
                     }
                     else{
                         mysqli_stmt_bind_param($stmt, 'sssss', $reference_id,  $ot,$typeOT_arr[$count], $qOT_arr[$count],$unitOT_arr[$count]);
                         $result = mysqli_stmt_execute($stmt);
                         if($result) {
                             $resultCount = $resultCount + 1;
                             $count=$count+1;
                    }  
                }     
            }
        }
     
         //insert into donor info
           
            $sql1 = "INSERT INTO donation_items (Reference,donor_name,donor_region,donor_province,donor_municipality,donor_barangay,donor_email,donor_contact,donationDate)
            VALUES (?,?,?,?,?,?,?,?,?)" ;
            $stmt= mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql1)){
           
            }
            else {
                mysqli_stmt_bind_param($stmt,"sssssssss",$reference_id,$Fname,$Region,$Province,$Municipality,$Barangay,$Email,$Contact,$Date);
                mysqli_stmt_execute($stmt);
            }
            $reference_id=$reference_id+1;
            $sql3="UPDATE donation_items_picking  set reference_id=? "; 
            $stmt=mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql3)){
              
            } else{
                mysqli_stmt_bind_param($stmt, 'i', $reference_id);
                 mysqli_stmt_execute($stmt);
            }
       
          
           mysqli_stmt_close($stmt);
           mysqli_close($conn);
   
     }
   

    
    