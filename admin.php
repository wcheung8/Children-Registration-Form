<!DOCTYPE html>
<head>
    <title> Church Registration</title>
</head>
<body>
    <H3>
        <HR>
        Content of the Registration Table
        <HR>
    </H3>

<?php

    echo '<form method="get" action="registration.csv">';
    echo '<button type="submit">Download Registration Spreadsheet</button>';
    echo '</form>';

    
    echo '<form action="viewRegistration.php" method="post">';
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
    
    //delete rows if necessary
    if(isset($_POST)){
        foreach($_POST as $key=>$value){

            $query= "DELETE from registration WHERE id = ".$value;
            if (!($result = mysqli_query($conn, $query)))      # Execute query
            {
                printf("Error: %s\n", mysqli_error($conn));
                exit(1);
            }
        }
    }   

    //select table to view
    $query = "select * from registration order by id";

    if (!($result = mysqli_query($conn, $query)))      # Execute query
    {
       printf("Error: %s\n", mysqli_error($conn));
       exit(1);
    }

    print("<UL>\n");
    print("<TABLE bgcolor='lightyellow' BORDER='5'>\n");

    $printed = false;

    $counter = 0;
    while ( $row = mysqli_fetch_assoc($result))
    {
        if ( ! $printed )
        {
            $printed = true;                 # Print header once...

            print("<TR align=\"center\" bgcolor=\"lightcyan\">\n");
            print("<TH align=\"center\">");
            print("del");
            print("</TH>");
            foreach ($row as $key => $value)
            {
                print ("<TH>" . $key . "</TH>");             # Print attr. name
            }
            
        }


        print("<TR>\n");
        print("<TD align=\"center\">");
        $counter++;
        print('<input type="checkbox" name='. $counter.' value='.$row["id"].'>');
        print("</TD>"); 
        
        foreach ($row as $key => $value)
        {
            print ("<TD align=\"left\">" . $value . "</TD>");
        }
        print ("</TR>\n");
    }

        print("</TABLE>\n");
        print("</UL>\n");
        print("<P>\n");
        
        
    
    //updating the csv file
    $myfile = fopen("registration.csv", "w") or die("Unable to open file!");
    $csv = "";
    $query = "select * from registration order by id";
    $printed = false;
    
    if (!($result = mysqli_query($conn, $query)))      # Execute query
    {
        printf("Error: %s\n", mysqli_error($conn));
        exit(1);
    }

    while ($row = mysqli_fetch_assoc($result))
    {
        if (!$printed)
        {
            $printed = true;                 # Print header once...

            foreach ($row as $key => $value)
            {
                $csv = $csv . $key . ",";             # Print attr. name
            }
            $csv = $csv . "\n";
        }

        foreach ($row as $key => $value)
        {
            $csv = $csv . $value . ",";
        }
        $csv = $csv . "\n";
    }

    fwrite($myfile, $csv);
    // print("<input type='hidden' name='authorization_token' value='2517' display='none'>");
    print("<button type='submit'>Submit to delete checked row(s)</button>");
    print("</form>");
    
    $conn->close();

    mysqli_free_result($result);

    mysqli_close($conn);

?>
</html>