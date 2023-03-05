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
        $checkRes=$_POST['result'];
         foreach ($checkRes as $res){
            
             if ($res=='cannoodles'){
                  $count = 0;
                  $resultCount = 0;
                  $pnCN_arr= $_POST['pnCN_arr'];
                  $qCN_arr= $_POST['qCN_arr'];
                  foreach($pnCN_arr as $cn){
                        $list= "INSERT INTO donation_items10 (Reference,productName,type,unit,quantity) VALUES (?,?,null,null,?)";
                        $stmt= $conn->prepare($list);
                        try{
                            if(!$stmt){
                                throw new Exception('There was a problem executing the query.');
                            }else{
                                $stmt->bind_param('sss',$reference_id,$cn,$qCN_arr[$count]);
                                if(!$result=$stmt->execute()){
                                    throw new Exception('There was a problem executing the query.');
                                }
                            }
                        }
                        catch(Exception $e){
                            http_response_code(500);
                            echo "Error: " . $e->getMessage();
                            exit();
                        }
                        $can = "INSERT INTO categcannoodles (productName,quantity) VALUES (?,?)";
                        $stmt= $conn->prepare($can);
                        try{
                            if(!$stmt){
                                throw new Exception('There was a problem executing the query.');
                            }else{
                                $stmt->bind_param('ss',$cn, $qCN_arr[$count]);
                                if(!$result=$stmt->execute()){
                                    throw new Exception('There was a problem executing the query.');
                                }else{
                                    $resultCount = $resultCount + 1;
                                    $count=$count+1;
                                }
                            }
                        }
                        catch(Exception $e){
                            http_response_code(500);
                            echo "Error: " . $e->getMessage();
                            exit();
                        }
                 }           
            }
             if($res=='hygine'){
                $pnHY_arr= $_POST['pnHY_arr'];
                $qHY_arr= $_POST['qHY_arr'];
                  $count = 0;
                  $resultCount = 0;
                  foreach($pnHY_arr as $hy){
                    $list= "INSERT INTO donation_items10 (Reference,productName,type,unit,quantity) VALUES (?,?,null,null,?)";
                    $stmt= $conn->prepare($list);
                    try{
                        if(!$stmt){
                            throw new Exception('There was a problem executing the query.');
                        }else{
                            $stmt->bind_param('sss',$reference_id,$hy,$qHY_arr[$count]);
                            if(!$result=$stmt->execute()){
                                throw new Exception('There was a problem executing the query.');
                            }
                        }
                    }
                    catch(Exception $e){
                        http_response_code(500);
                        echo "Error: " . $e->getMessage();
                        exit();
                    }
                    $hygine = "INSERT INTO categhygineessential (productName,quantity) VALUES (?,?)";
                    $stmt= $conn->prepare($hygine);
                    try{
                        if(!$stmt){
                            throw new Exception('There was a problem executing the query.');
                        }else{
                            $stmt->bind_param('ss',$hy, $qHY_arr[$count]);
                            if(!$result=$stmt->execute()){
                                throw new Exception('There was a problem executing the query.');
                            }else{
                                $resultCount = $resultCount + 1;
                                $count=$count+1;
                            }
                        }
                    }
                    catch(Exception $e){
                        http_response_code(500);
                        echo "Error: " . $e->getMessage();
                        exit();
                    }
                  }     
              }
             if($res=='infant'){
                $pnII_arr= $_POST['pnII_arr'];
                $qII_arr= $_POST['qII_arr'];
                $count = 0;
                $resultCount = 0;
              foreach($pnII_arr as $ii){
                $list= "INSERT INTO donation_items10 (Reference,productName,type,unit,quantity) VALUES (?,?,null,null,?)";
                $stmt= $conn->prepare($list);
                try{
                    if(!$stmt){
                        throw new Exception('There was a problem executing the query.');
                    }else{
                        $stmt->bind_param('sss',$reference_id,$ii,$qII_arr[$count]);
                        if(!$result=$stmt->execute()){
                            throw new Exception('There was a problem executing the query.');
                        }
                    }
                }
                catch(Exception $e){
                    http_response_code(500);
                    echo "Error: " . $e->getMessage();
                    exit();
                }
                $infant = "INSERT INTO categinfant (productName,quantity) VALUES (?,?)";
                $stmt= $conn->prepare($infant);
                try{
                    if(!$stmt){
                        throw new Exception('There was a problem executing the query.');
                    }else{
                        $stmt->bind_param('ss',$ii, $qII_arr[$count]);
                        if(!$result=$stmt->execute()){
                            throw new Exception('There was a problem executing the query.');
                        }else{
                            $resultCount = $resultCount + 1;
                            $count=$count+1;
                        }
                    }
                }
                catch(Exception $e){
                    http_response_code(500);
                    echo "Error: " . $e->getMessage();
                    exit();
                }
              }      
          }
          if($res=='drink'){
              $count = 0;
              $resultCount = 0;
              $pnDW_arr= $_POST['pnDW_arr'];
              $qDW_arr= $_POST['qDW_arr'];
              foreach($pnDW_arr as $dw){
                $list= "INSERT INTO donation_items10 (Reference,productName,type,unit,quantity) VALUES (?,?,null,null,?)";
                $stmt= $conn->prepare($list);
                try{
                    if(!$stmt){
                        throw new Exception('There was a problem executing the query.');
                    }else{
                        $stmt->bind_param('sss',$reference_id,$dw,$qDW_arr[$count]);
                        if(!$result=$stmt->execute()){
                            throw new Exception('There was a problem executing the query.');
                        }
                    }
                }
                catch(Exception $e){
                    http_response_code(500);
                    echo "Error: " . $e->getMessage();
                    exit();
                }
                $drinkingwater = "INSERT INTO categdrinkingwater (productName,quantity) VALUES (?,?)";
                $stmt= $conn->prepare($drinkingwater);
                try{
                    if(!$stmt){
                        throw new Exception('There was a problem executing the query.');
                    }else{
                        $stmt->bind_param('ss',$dw, $qDW_arr[$count]);
                        if(!$result=$stmt->execute()){
                            throw new Exception('There was a problem executing the query.');
                        }else{
                            $resultCount = $resultCount + 1;
                            $count=$count+1;
                        }
                    }
                }
                catch(Exception $e){
                    http_response_code(500);
                    echo "Error: " . $e->getMessage();
                    exit();
                }
              }       
          }
          if($res=='meat'){
            $pnMG_arr=$_POST['pnMG_arr'];
            $typeMG_arr=$_POST['typeMG_arr'];
            $qMG_arr=$_POST['qMG_arr'];
            $unitMG_arr=$_POST['unitMG_arr'];
            $count = 0;
            $resultCount = 0;
            foreach($pnMG_arr as $mg){
                $list= "INSERT INTO donation_items10 (Reference,productName,type,unit,quantity) VALUES (?,?,?,?,?)";
                $stmt= $conn->prepare($list);
                try{
                    if(!$stmt){
                        throw new Exception('There was a problem executing the query.');
                    }else{
                        $stmt->bind_param('sssss',$reference_id,$mg,$typeMG_arr[$count],$qMG_arr[$count],$unitMG_arr[$count]);
                        if(!$result=$stmt->execute()){
                            throw new Exception('There was a problem executing the query.');
                        }
                    }
                }
                catch(Exception $e){
                    http_response_code(500);
                    echo "Error: " . $e->getMessage();
                    exit();
                }
                $meatgrains = "INSERT INTO categmeatgrains (productName,type,quantity,unit) VALUES (?,?,?,?)";
                $stmt= $conn->prepare($meatgrains);
                try{
                    if(!$stmt){
                        throw new Exception('There was a problem executing the query.');
                    }else{
                        $stmt->bind_param('ssss',$mg,$typeMG_arr[$count],$qMG_arr[$count],$unitMG_arr[$count]);
                        if(!$result=$stmt->execute()){
                            throw new Exception('There was a problem executing the query.');
                        }else{
                            $resultCount = $resultCount + 1;
                            $count=$count+1;
                        }
                    }
                }
                catch(Exception $e){
                    http_response_code(500);
                    echo "Error: " . $e->getMessage();
                    exit();
                }     
              }      
          }
          if($res=='meds'){
            $pnME_arr=$_POST['pnME_arr'];
            $typeME_arr=$_POST['typeME_arr'];
            $qME_arr=$_POST['qME_arr'];
            $unitME_arr=$_POST['unitME_arr'];
            $count = 0;
            $resultCount = 0;
            foreach($pnME_arr as $me){
                $list= "INSERT INTO donation_items10 (Reference,productName,type,unit,quantity) VALUES (?,?,?,?,?)";
                $stmt= $conn->prepare($list);
                try{
                    if(!$stmt){
                        throw new Exception('There was a problem executing the query.');
                    }else{
                        $stmt->bind_param('sssss',$reference_id,$me,$typeME_arr[$count],$qME_arr[$count],$unitME_arr[$count]);
                        if(!$result=$stmt->execute()){
                            throw new Exception('There was a problem executing the query.');
                        }
                    }
                }
                catch(Exception $e){
                    http_response_code(500);
                    echo "Error: " . $e->getMessage();
                    exit();
                }
                $medicine = "INSERT INTO categmedicine (productName,type,quantity,unit) VALUES (?,?,?,?)";
                $stmt= $conn->prepare($medicine);
                try{
                    if(!$stmt){
                        throw new Exception('There was a problem executing the query.');
                    }else{
                        $stmt->bind_param('ssss',$me,$typeME_arr[$count],$qME_arr[$count],$unitME_arr[$count]);
                        if(!$result=$stmt->execute()){
                            throw new Exception('There was a problem executing the query.');
                        }else{
                            $resultCount = $resultCount + 1;
                            $count=$count+1;
                        }
                    }
                }
                catch(Exception $e){
                    http_response_code(500);
                    echo "Error: " . $e->getMessage();
                    exit();
                }     
              }      
          }
          else if($res=='other'){
              $count = 0;
              $resultCount = 0;
              $pnOT_arr=$_POST['pnOT_arr'];
              $typeOT_arr=$_POST['typeOT_arr'];
              $qOT_arr=$_POST['qOT_arr'];
              $unitOT_arr=$_POST['unitOT_arr'];
              foreach($pnOT_arr as $ot){
                $list= "INSERT INTO donation_items10 (Reference,productName,type,unit,quantity) VALUES (?,?,?,?,?)";
                $stmt= $conn->prepare($list);
                try{
                    if(!$stmt){
                        throw new Exception('There was a problem executing the query.');
                    }else{
                        $stmt->bind_param('sssss',$reference_id,$ot,$typeOT_arr[$count],$qOT_arr[$count],$unitOT_arr[$count]);
                        if(!$result=$stmt->execute()){
                            throw new Exception('There was a problem executing the query.');
                        }
                    }
                }
                catch(Exception $e){
                    http_response_code(500);
                    echo "Error: " . $e->getMessage();
                    exit();
                }
                $others = "INSERT INTO categothers (productName,type,quantity,unit) VALUES (?,?,?,?)";
                $stmt= $conn->prepare($others);
                try{
                    if(!$stmt){
                        throw new Exception('There was a problem executing the query.');
                    }else{
                        $stmt->bind_param('ssss',$ot,$typeOT_arr[$count],$qOT_arr[$count],$unitOT_arr[$count]);
                        if(!$result=$stmt->execute()){
                            throw new Exception('There was a problem executing the query.');
                        }else{
                            $resultCount = $resultCount + 1;
                            $count=$count+1;
                        }
                    }
                }
                catch(Exception $e){
                    http_response_code(500);
                    echo "Error: " . $e->getMessage();
                    exit();
                }
              }
            }
        }
     
         //insert into donor info
         $donor= "INSERT INTO donation_items (Reference,donor_name,donor_region,donor_province,donor_municipality,
         donor_barangay,donor_email,donor_contact,donationDate) VALUES (?,?,?,?,?,?,?,?,?)";
         $stmt= $conn->prepare($donor);
         try{
             if(!$stmt){
                 throw new Exception('Error: There was a problem executing the query.');
             }else{
                 $stmt->bind_param('sssssssss',$reference_id,$Fname,$Region,$Province,$Municipality,$Barangay,$Email,$Contact,$Date);
                 if(!$stmt->execute()){
                     throw new Exception('Error: There was a problem executing the query.');
                 }
             }
         }
         catch(Exception $e){
             http_response_code(500);
             echo "Error: " . $e->getMessage();
             exit();
         }
         //Add 1 for new reference id
         $reference_id=$reference_id+1;
         $ref= "UPDATE donation_items_picking  set reference_id=? ";
         $stmt= $conn->prepare($ref);
         try{
             if(!$stmt){
                 throw new Exception('Error: There was a problem executing the query.');
             }else{
                 $stmt->bind_param('i', $reference_id);
                 if(!$stmt->execute()){
                     throw new Exception('Error: There was a problem executing the query.');
                 }
             }
         }
         catch(Exception $e){
             http_response_code(500);
             echo "Error: " . $e->getMessage();
             exit();
         }
          
           mysqli_stmt_close($stmt);
           mysqli_close($conn);
   
     }
   

    
    