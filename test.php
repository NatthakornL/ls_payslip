<?php
/*
$db_conn = mysqli_connect("localhost", "root", "", "dbase");
$user_data  = array(
    "0" => array("123456789012", "test test1", "0", "0"),
    "1" => array("123456789012", "test test2", "0", "0"),
    "2" => array("123456789012", "test test3", "0", "0"),
);
if (is_array($user_data)) {
    foreach ($user_data as $row) {
        $val1 = mysqli_real_escape_string($db_conn, $row[0]);
        $val2 = mysqli_real_escape_string($db_conn, $row[1]);
        $val3 = mysqli_real_escape_string($db_conn, $row[2]);
        $val4 = mysqli_real_escape_string($db_conn, $row[3]);
        $query = "INSERT INTO randname (idno, nname, chk_in,chk_coupon) VALUES ( '" . $val1 . "','" . $val2 . "','" . $val3 . "', '" . $val4 . "' )";
        mysqli_query($db_conn, $query);
    }
}
*/
?>


<?php
function mysqli_insert_array($table, $data, $exclude = array())
{
    $con =  mysqli_connect("localhost", "root", "", "dbase");
    $fields = $values = array();
    if (!is_array($exclude)) $exclude = array($exclude);
    foreach (array_keys($data) as $key) {
        if (!in_array($key, $exclude)) {
            $fields[] = "`$key`";
            $values[] = "'" . mysqli_real_escape_string($con, $data[$key]) . "'";
        }
    }
    $fields = implode(",", $fields);
    $values = implode(",", $values);
    if (mysqli_query($con, "INSERT INTO randname ($fields) VALUES ( $values )")) {
        return array(
            "mysql_error" => false,
            "mysql_insert_id" => mysqli_insert_id($con),
            "mysql_affected_rows" => mysqli_affected_rows($con),
            "mysql_info" => mysqli_info($con)
        );
    } else {
        return array("mysql_error" => mysqli_error($con));
    }
}

$user_data  = array(
    "0" => array("123456789012", "test test1", "0", "0"),
    "1" => array("123456789012", "test test2", "0", "0"),
    "2" => array("123456789012", "test test3", "0", "0"),
);

$result = mysqli_insert_array('registration', $user_data, 'abc');
if ($result['mysql_error']) {
    echo "Query Failed: " . $result['mysql_error'];
} else {
    echo "Query Succeeded! <br />";
    echo "<pre>";
    print_r($result);
    echo "</pre>";
}
?>