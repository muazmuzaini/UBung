<?php include '../header.php'; ?>
<?php CheckRole(DESPATCHER) ?>
<?php
$submit = '';
if (isset($_POST['submit'])) {
    $submit = $_POST["submit"];
}

if ($submit != '' && isset($_SESSION['UserId'])) {
    $uid = $_SESSION['UserId'];
    //Collect and save updateed information
    $Name = "";
    if (isset($_POST['name'])) {
        $Name = $_POST["name"];
    }

    $strSQL = "insert into service (Name, DispatcherId) values 
                ('$Name', $uid)"
        or die(mysqli_connect_error());

    $result = mysqli_query($link, $strSQL);
    if ($result) {
        SuccessMessage("Data Inserted successfully");
    } else {
        die("Update failed" . mysqli_error($link));
    }
} else if (!isset($_SESSION['UserId'])){
    ErrorMessage("please login with valid dispatcher");
}

?>
<div class="container my-auto">

    <h3>Add New Service</h3>
    <form action="addService.php" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>
                    <h5>Service Name:</h5>
                </td>
                <td><input type="text" name="name" class="form-control"></td>
            </tr>
            <tr>
                <td></td>
                <td><input style="width: 100%" class="btn btn-primary" type="submit" name="submit" value="Save"></td>
            </tr>
        </table>
    </form>
</div>
<?php include '../footer.php'; ?>