<?php

require_once 'dbconfig.php';
$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');

if(isset($_GET['LOADDATA']))
{
    $data = array();

    $q = "SELECT `sno`,`date`,
            CASE `title`
                WHEN 1 THEN 'Saturday'
                WHEN 2 THEN 'Sunday' 
                WHEN 3 THEN 'Public Holiday'
            END AS `title`
            FROM settings_holidays 
            -- WHERE MONTH(date) = MONTH(CURRENT_DATE()) 
            -- AND YEAR(date) = YEAR(CURRENT_DATE()) 
            ORDER BY sno";

    $r = mysqli_query($con, $q);

    foreach($r as $row)
    {
        $data[] = array(
        'id'   => $row["sno"],
        'title'   => $row["title"],
        'start'   => $row["date"],
        'className' => 'bg-danger calHoliday'
        );
    }

    echo json_encode($data);
}
elseif(isset($_GET['INSERTDATA']))
{
    //$updatedDate = date('Y-m-d H:i:s');

    if(isset($_POST["title"]) && isset($_POST["start"]))
    {
        $title = $_POST["title"];
        $start = date("Y-m-d", strtotime($_POST["start"]));

        $q = " INSERT INTO settings_holidays (`title`, `date`) VALUES ($title, '$start')";

        if (!mysqli_query($con, $q)) 
        {
            echo("Error description: " . mysqli_error($con));
        } 
        else 
        {
            echo "success";
		}
        // $statement = $con->prepare($query);
        // $statement->execute(
        //     array(
        //     ':title'  => $_POST['title'],
        //     ':date' => $_POST['start'],
        //     ':updated_date' => $updatedDate,
        //     )
        // );
     }
     else
     {
        echo "failed";
    }
}
elseif(isset($_GET['DELETEDATA']))
{
    if(isset($_POST["id"]))
    {
        $sno = $_POST["id"];
        $q = " DELETE FROM settings_holidays WHERE `sno` =  $sno";
        if (!mysqli_query($con, $q)) 
        {
            echo("Error description: " . mysqli_error($con));
        } 
        else 
        {
            echo "success";
		}
    }
   else
    {
        echo "failed";
    }
}
elseif(isset($_GET['UPDATEDATA']))
{
    if(isset($_POST["title"]))
    {
        $query = "
        INSERT INTO events 
        (title, start_event) 
        VALUES (:title, :start_event)
        ";
        $statement = $con->prepare($query);
        $statement->execute(
            array(
            ':title'  => $_POST['title'],
            ':start_event' => $_POST['start']
            )
        );
    }
}
?>