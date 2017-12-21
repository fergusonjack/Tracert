<?php
$valid = filter_var($_GET["info"], FILTER_VALIDATE_IP);

if ($valid){
    set_time_limit ( 300 );
    exec("java -jar target/Tracert-0.0.1-SNAPSHOT-jar-with-dependencies.jar google.com", $output);

    $returnString = "";

    foreach ($output as $ip){
        $cSession = curl_init();
        //step2
        curl_setopt($cSession,CURLOPT_URL,"https://ipapi.co/" . $ip . "/json/");
        curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($cSession,CURLOPT_HEADER, false);
        //step3
        $result = curl_exec($cSession);
        //step4
        curl_close($cSession);
        //step5

        $parser = json_decode($result);

        $returnString = $returnString . $parser->latitude . ",";
        $returnString = $returnString . $parser->longitude . ":";
    }

    echo $returnString;
} else {
    echo "nope";
}
?>