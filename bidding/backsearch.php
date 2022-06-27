<?php
$link= mysqli_connect("localhost", "root", "", "bidding_db");
if($link === false){
    die("ERROR: oculd not connect.". mysqli_connect_error());
}
if (isset($_request["term"])){
    $sql = "select * from categories where name like '%search%'";
    if ($stmt = mysqli_prepare($link, $cat)){
        mysqli_stmt_blind_param($stmt, "s", $param_term);
        $param_term = $_request["term"] . '%';
        if(mysqli_start_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_array($result, mysqli_assoc)){
                    echo "<p>" .$row["name"]. "</p>";
                }
            }else{
                echo "<p>No matches founr</p>";
            }
        }else{
            echo "ERROR: Couldnot able to execute $cat." . mysqli_error($link);
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($link);
?>