<?php
//Receive the RAW post data
$content = trim(file_get_contents("php://input")); // Catch the JSON
$decoded = json_decode($content);       

// Read the data from JSON Post
$type = $mysqli->real_escape_string(trim($decoded->{'Type'})); 
$email = $mysqli->real_escape_string(trim($decoded->{'Email'})); 

// Webhook URL provided for my channel
$webhook = "https://hooks.slack.com/services/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";

// The message payload to send
$payload = array(
    'text' => $email." is shining like a crazy diamond!",
    'username' => 'WizardDylan'   
);

if ($type == "SpamNotification"){
  // Use cURL to send a POST request with JSON data 
    $ch = curl_init($webhook_url); // Init
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    
    $result = curl_exec($ch); // execute
    curl_close($ch); // close curl

    // Check the result
    if ($result == 'ok') {
        echo "Message sent successfully!";
    } else {
        echo "Error: $result";
    }  
}
?>