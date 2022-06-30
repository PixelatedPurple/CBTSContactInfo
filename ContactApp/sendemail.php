<!DOCTYPE html>
<html>
    <head>
        <title>Send mail</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
    <body>
        <?php
            require_once 'Mail.php'; 
            require_once 'Mail/RFC822.php'; 

            $dbc = mysqli_connect('localhost','root','aeroplane105','customerdb') or die('Error connecting to MySQL server.'); 

            $from = 'tj@cursedbots.xyz'; 
            $subject =$_POST['subject'];
            $text= $_POST['messege']; 

            $smtp = array(); 
            $smtp['host'] = 'ssl://smtp.porkbun.com'; 
            $smtp['port'] = 465; 
            $smtp['auth'] = true; 
            $smtp['username'] = 'CursedBots'; 
            $smtp['password'] = 'tlowth88889'; 

            $mailer = Mail::factory('smtp', $smtp); 
            $recipients = array(); 

            // Set the headers 
            $headers = array(); 
            $headers['From'] = 'tj@cursedbots.xyz'; 
            
            $query = "SELECT * FROM contacts"; 
            $result = mysqli_query($dbc, $query) or die('Error querying database.'); 

            while ($row = mysqli_fetch_array($result)) { 

            $to = $row['email_address']; 
            $first_name = $row['first_name']; 
            $last_name = $row['last_name']; 
            $msg = "Dear $first_name $last_name,\n$text"; 
            $headers['To'] = $to; 
            $headers['Subject'] = $subject; 

            $mailer->send($to, $headers, $msg); 

            echo 'Email sent to: ' . $to . '<br />'; 
            }   
            mysqli_close($dbc);
        ?>
    </body>
</html>
