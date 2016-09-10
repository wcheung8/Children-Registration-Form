<!DOCTYPE html>
    
    <script>
    function goBack() {
        window.history.back()
    }
    </script>
        
    <body>

    Registration result for <br>
    <?php 
        
        $valid = 1;
        
        for($i = 1; isset($_POST["child_first_name".$i]); $i++) {
            
            $valid = 0;
           
            echo "'";
            echo $_POST["child_first_name".$i]; 
            echo " ";
            echo $_POST["child_last_name".$i]; 
            echo "'<br>";
            
        }
        
        if($valid) {
            die("Error in form: please refresh or try again ");
        }
            
        if($_POST["english_speaking"] != "Y") {
            $_POST["english_speaking"] = "N";
        }
        if($_POST["mandarin_speaking"] != "Y") {
            $_POST["mandarin_speaking"] = "N";
        }
        if($_POST["cantonese_speaking"] != "Y") {
            $_POST["cantonese_speaking"] = "N";
        }
        
    ?>
    <P>

    <?php
    $servername = "<server ip>";
    $username = "<username";
    $password = "<password>";
    $dbname = "<databaseName>";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $period_registered = "15-16";
    $family_name = $_POST["family_name"];
    $mom_name = $_POST["mom_name"];
    $mom_phone = $_POST["mom_phone"]; 
    $dad_name = $_POST["dad_name"];
    $dad_phone = $_POST["dad_phone"];
    $guardian_name = $_POST["guardian_name"];
    $guardian_phone = $_POST["guardian_phone"];
    $guardian_relationship = $_POST["guardian_phone"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $english_speaking = $_POST["english_speaking"];
    $mandarin_speaking = $_POST["mandarin_speaking"];
    $cantonese_speaking = $_POST["cantonese_speaking"];
    $service = $_POST["service"];
    $custodial_info = $_POST["custodial_info"]; 
    $emergency_name = $_POST["emergency_name"];
    $emergency_phone = $_POST["emergency_phone"];
    $emergency_relationship = $_POST["emergency_relationship"];
    
    for($i = 1; isset($_POST["child_first_name".$i]); $i++) {
        
        $child_first_name = $_POST["child_first_name".$i];
        $child_last_name = $_POST["child_last_name".$i];
        $child_birthdate = $_POST["child_birthdate".$i];
        $child_grade = $_POST["child_grade".$i];
        $child_gender = $_POST["child_gender".$i];
        $child_allergies = $_POST["child_allergies".$i];
        $child_special_needs = $_POST["child_special_needs".$i];
        $child_snacks = $_POST["child_snacks".$i];
        $child_potty = $_POST["child_potty".$i];

        $sql = "INSERT INTO registration
            VALUES ('counter',
                    '$period_registered',
                    '$family_name',
                    '$mom_name',
                    '$mom_phone',
                    '$dad_name',
                    '$dad_phone',
                    '$guardian_name',
                    '$guardian_phone',
                    '$guardian_relationship',
                    '$address',
                    '$email',
                    '$english_speaking',
                    '$mandarin_speaking',
                    '$cantonese_speaking',
                    '$service',
                    '$custodial_info',
                    '$emergency_name',
                    '$emergency_phone',
                    '$emergency_relationship',
                    '$child_first_name',
                    '$child_last_name',
                    '$child_birthdate',
                    '$child_grade',
                    '$child_gender',
                    '$child_allergies',
                    '$child_special_needs',
                    '$child_snacks',
                    '$child_potty');";
        
        
        if ($conn->query($sql) === TRUE) {
            echo $child_first_name."'s registration was successful! <br>";
        } else {
            echo "     Your registration FAILED\n";
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
            
    }
        
    $conn->close();
    
    ?> 

    <P>
    <HR>
    <P>
    
    <button onclick="goBack()">Register more children</button>
    <BR>
    <button onclick="window.location.href='register.html'">Done</button>

    </body>
</html> 