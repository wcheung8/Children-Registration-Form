<html>
<head>
<title> Church Registration</title>
</head>
<body>
	  
    <H3>
        <HR>
        Content of the registration database
        <HR>
    </H3>

    <form method="get" action="registration.csv">
    <button type="submit">Download Registration Spreadsheet</button>
    </form>

    <UL>
	  
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

            
    $query = "select * from registration order by " .
               "child_last_name, child_first_name"  ;

    print("<TR> <TD><FONT color=\"blue\"><B><PRE>\n");
    print("</PRE></B></FONT></TD></TR></TABLE></UL>\n");
    print("<P><HR><P>\n");
          
    if ( ! ( $result = mysqli_query($conn, $query)) )      # Execute query
    {      
       printf("Error: %s\n", mysqli_error($conn));
       exit(1);
    }      
          
    print("<UL>\n");
    print("<TABLE bgcolor=\"lightyellow\" BORDER=\"5\">\n");
          
    $printed = false;

    while ( $row = mysqli_fetch_assoc( $result ) )
    {      
       if ( ! $printed )
       {   
         $printed = true;                 # Print header once...
          
         print("<TR bgcolor=\"lightcyan\">\n");
         foreach ($row as $key => $value)
         {
            print ("<TH>" . $key . "</TH>");             # Print attr. name
         }
         print ("</TH>\n");
       }   
          
          
       print("<TR>\n");
       foreach ($row as $key => $value)
       {   
         print ("<TD>" . $value . "</TD>");
       }   
       print ("</TR>\n");
    }      
    print("</TABLE>\n");
    print("</UL>\n");
    print("<P>\n");

    #create a csv of the database
    $myfile = fopen("registration.csv", "w") or die("Unable to open file!");
    $query = "select * from registration order by " .
           "child_last_name, child_first_name"  ;
    $csv = "";       
    
    if ( ! ( $result = $conn->query($query)) )      # Execute query
    {      
       printf("Error: %s\n", $conn->error);
       exit(1);
    }      
    
    $printed = false;
    
    while ( $row = mysqli_fetch_assoc( $result ) )
    {
       if ( ! $printed )
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
    
    #write to the csv
    fwrite($myfile, $csv);
        
    $conn->close();
          
    mysqli_free_result($result);
          
    mysqli_close($conn);

?>     
	  
      
    <a href="registration.csv" download>
      
</UL>