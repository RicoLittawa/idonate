<?php 
require_once 'connection.php';

if (isset($_POST['submitProcess'])){
    $request_id= $_POST['request_id'];
    $checkIfSave= false;

    //Check if array of can/noodles exists
    if (array_key_exists('CanNoodlesPn', $_POST)) {
        $CanNoodlesPn= $_POST['CanNoodlesPn'];
        $CanNoodlesQ= $_POST['CanNoodlesQ'];
        $count= 0;
        $resultCount=0;
    
        foreach ($CanNoodlesPn as $cn){
            $submitProcess= "INSERT INTO on_process (reciept_number,productName,quantity) VALUES(?,?,?)";
            $stmt= $conn->prepare($submitProcess);
            try{
              if (!$stmt){
                throw new Exception("There are problem while executing query.");
              }
              else{
                $stmt->bind_param('iss',$request_id,$cn,$CanNoodlesQ[$count]);
                $result= $stmt->execute();
                if(!$result){
                  throw new Exception("There are problem saving your data.");
                }
                else{
                  $count++;
                  $resultCount++;
                  $checkIfSave= true;
                }
              }
            }
            catch(Exception $e){
              echo $e->getMessage();
            }
        }   
      }

    //Check if array of hygine essentials exists

    if (array_key_exists('HyginePn', $_POST)) {
        $HyginePn= $_POST['HyginePn'];
        $HygineQ= $_POST['HygineQ'];
        $count= 0;
        $resultCount=0;
        
        foreach ($HyginePn as $hy){
            $submitProcess= "INSERT INTO on_process (reciept_number,productName,quantity) VALUES(?,?,?)";
             $stmt= $conn->prepare($submitProcess);
            try{
              if (!$stmt){
                throw new Exception("There are problem while executing query.");
              }
              else{
                $stmt->bind_param('iss',$request_id,$hy,$HygineQ[$count]);
                $result= $stmt->execute();
                if(!$result){
                  throw new Exception("There are problem saving your data.");
                }
                else{
                  $count++;
                  $resultCount++;
                  $checkIfSave= true;
                }
              }
            }
            catch(Exception $e){
              echo $e->getMessage();
            }
        }   
      }

    //Check if array of infant items exists

      if (array_key_exists('InfantPn', $_POST)) {
        $InfantPn= $_POST['InfantPn'];
        $InfantQ= $_POST['InfantQ'];
        $count= 0;
        $resultCount=0;
        
        foreach ($InfantPn as $ii){
            $submitProcess= "INSERT INTO on_process (reciept_number,productName,quantity) VALUES(?,?,?)";
            $stmt= $conn->prepare($submitProcess);
            try{
              if (!$stmt){
                throw new Exception("There are problem while executing query.");
              }
              else{
                $stmt->bind_param('iss',$request_id,$ii,$InfantQ[$count]);
                $result= $stmt->execute();
                if(!$result){
                  throw new Exception("There are problem saving your data.");
                }
                else{
                  $count++;
                  $resultCount++;
                  $checkIfSave= true;
                }
              }
            }
            catch(Exception $e){
              echo $e->getMessage();
            }
        }   
      }

    //Check if array of drinking water exists

      if (array_key_exists('DrinkingWaterPn', $_POST)) {
        $DrinkingWaterPn= $_POST['DrinkingWaterPn'];
        $DrinkingWaterQ= $_POST['DrinkingWaterQ'];
        $count= 0;
        $resultCount=0;
        
        foreach ($DrinkingWaterPn as $dw){
            $submitProcess= "INSERT INTO on_process (reciept_number,productName,quantity) VALUES(?,?,?)";
            $stmt= $conn->prepare($submitProcess);
            try{
              if (!$stmt){
                throw new Exception("There are problem while executing query.");
              }
              else{
                $stmt->bind_param('iss',$request_id,$dw,$DrinkingWaterQ[$count]);
                $result= $stmt->execute();
                if(!$result){
                  throw new Exception("There are problem saving your data.");
                }
                else{
                  $count++;
                  $resultCount++;
                  $checkIfSave= true;
                }
              }
            }
            catch(Exception $e){
              echo $e->getMessage();
            }
        }   
      }
    
    //Check if array of meat and Grains exists

      if (array_key_exists('MeatGrainsPn', $_POST)) {
        $MeatGrainsPn= $_POST['MeatGrainsPn'];
        $MeatGrainsQ= $_POST['MeatGrainsQ'];
        $count= 0;
        $resultCount=0;

        
        foreach ($MeatGrainsPn as $mg){
            $submitProcess= "INSERT INTO on_process (reciept_number,productName,quantity) VALUES(?,?,?)";
            $stmt= $conn->prepare($submitProcess);
            try{
              if (!$stmt){
                throw new Exception("There are problem while executing query.");
              }
              else{
                $stmt->bind_param('iss',$request_id,$mg,$MeatGrainsQ[$count]);
                $result= $stmt->execute();
                if(!$result){
                  throw new Exception("There are problem saving your data.");
                }
                else{
                  $count++;
                  $resultCount++;
                  $checkIfSave= true;
                }
              }
            }
            catch(Exception $e){
              echo $e->getMessage();
            }
        }   
      }

     //Check if array of medicine exists

      if (array_key_exists('MedicinePn', $_POST)) {
        $MedicinePn= $_POST['MedicinePn'];
        $MedicineQ= $_POST['MedicineQ'];
        $count= 0;
        $resultCount=0;

        
        foreach ($MedicinePn as $me){
            $submitProcess= "INSERT INTO on_process (reciept_number,productName,quantity) VALUES(?,?,?)";
            $stmt= $conn->prepare($submitProcess);
            try{
              if (!$stmt){
                throw new Exception("There are problem while executing query.");
              }
              else{
                $stmt->bind_param('iss',$request_id,$me,$MedicineQ[$count]);
                $result= $stmt->execute();
                if(!$result){
                  throw new Exception("There are problem saving your data.");
                }
                else{
                  $count++;
                  $resultCount++;
                  $checkIfSave= true;
                }
              }
            }
            catch(Exception $e){
              echo $e->getMessage();
            }
        }   
      }

      //Check if array of others exists

      if (array_key_exists('OthersPn', $_POST)) {
        $OthersPn= $_POST['OthersPn'];
        $OthersQ= $_POST['OthersQ'];
        $count= 0;
        $resultCount=0;

        
        foreach ($OthersPn as $ot){
            $submitProcess= "INSERT INTO on_process (reciept_number,productName,quantity) VALUES(?,?,?)";
            $stmt= $conn->prepare($submitProcess);
            try{
              if (!$stmt){
                throw new Exception("There are problem while executing query.");
              }
              else{
                $stmt->bind_param('iss',$request_id,$ot,$OthersQ[$count]);
                $result= $stmt->execute();
                if(!$result){
                  throw new Exception("There are problem saving your data.");
                }
                else{
                  $count++;
                  $resultCount++;
                  $checkIfSave= true;
                }
              }
            }
            catch(Exception $e){
              echo $e->getMessage();
            }
        }   
      }

  if ($checkIfSave){
    $status= "Request has been proccessed";
    $updateStatus = "UPDATE request set status=? where request_id=? ";
    $stmt=$conn->prepare($updateStatus);
    $stmt->bind_param('si',$status,$request_id);
    $stmt->execute();

    echo  "success";
  }

   
}