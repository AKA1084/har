<?php

    header("Content-Type:application/json");

    require_once "lib/main.php";

    if(isset($_POST["query"])){

        $query = json_decode($_POST["query"], true);
        [ "id" => $id, "options" => $options ] = $query;

        $res = customer($id, $options);
        $res = json_encode($res, JSON_PRETTY_PRINT);

        echo $res;

    }

?>