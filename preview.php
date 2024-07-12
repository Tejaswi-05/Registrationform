<?php 
require_once("config.php");
$name = $_GET['id'];

// Validate the input to prevent SQL injection
if (!$name) {
    die('Invalid request');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Application Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <style type="text/css">
        @page { size: auto;  margin: 10mm; margin-right: -70px; margin-left: -70px; }
        @media print {
            a[href]:after {
                content: none !important;
            }
            #printbtn {
                display: none !important;
            }
            .main-heading {
                font-size: 30px !important;
            }
            .underline {
                line-height: 27px !important;
                text-decoration-style: dotted !important;
            }
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <?php 
    $sql = "SELECT count(*) FROM application WHERE name = :name"; 
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    
    if ($count == 0) {
        echo 'Name is not found. <a href="form.php">Application form</a>.';
    } else {
        $sql = "SELECT * FROM application WHERE name = :name"; 
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        ?>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10" style="border: 2px solid black; padding: 10px;">
                <?php foreach ($rows as $row) { ?>
                    <div class="row">
                        <div class="col-sm-12"><hr class="hrcls"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8" style="text-align: center; padding-bottom: 5px;">
                            <h3><u>Application Form</u></h3>
                        </div>
                        <div class="col-sm-2"></div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group row">
                                <div class="col-4"><label class="label">Full Name</label></div>
                                <div class="col-8"><?php echo $row['name']; ?></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4"><label class="label">Address</label></div>
                                <div class="col-8"><?php echo $row['address']; ?></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4"><label class="label">Email</label></div>
                                <div class="col-8"><?php echo $row['email']; ?></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4"><label class="label">Relation</label></div>
                                <div class="col-8"><?php echo $row['relation']; ?></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4"><label class="label">Person Name</label></div>
                                <div class="col-8"><?php echo $row['personname']; ?></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4"><label class="label">Income Source</label></div>
                                <div class="col-8"><?php echo $row['source']; ?></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4"><label class="label">Income</label></div>
                                <div class="col-8"><?php echo $row['income']; ?></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-1"></div>
        </div>
        <br>
        <center><button type="button" class="btn btn-warning" id="printbtn" onclick="window.print()">Print Form</button></center>
        <br>
    <?php } ?>
</div>
</body>
</html>
