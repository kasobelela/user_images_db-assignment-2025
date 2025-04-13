<?php
    require_once("./connect/connect.php");
    $sql = "SELECT * FROM `user`;";
    $pictures = [];
    $results = $mysqli->query($sql);
    if($results->num_rows > 0){
        while($row = $results->fetch_assoc()){
            array_push($pictures,$row);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pictures</title>
    <link rel="stylesheet" href="./styles/fontawesome/css/all.css">
    <link rel="stylesheet" href="./styles/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="./styles/styles.css" />
</head>
<body>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 justify-content-row mt-5 mt-*-0">
                    <h4>Your Pictures</h4>
                    <a href="./index.php" class="btn btn-sm btn-primary"><i class="fa fa-image"></i> Upload Pictures</a>
                </div>
            </div>
            <div class="row">
            <?php
                foreach($pictures as $picture){
                    echo '<div class="col-xs-12 col-sm-3 col-md-3 col-xl-3 mt-5 mt-*-0">
                        <div class="card shadow" style="width: 100%;">
                            <img class="card-img-top" src="./uploads/'.$picture["image_name"].'" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">My Collection</h5>
                                <p class="card-text">Hellow, this is one of the pictures I uploaded recently, I think its quiet cool.</p>
                            </div>
                            <div class="card-body">
                                <button type="button" onclick="Delete('.$picture["id"].');"; class="btn btn-sm btn-block btn-danger" style="width:100%;"><i class="fa fa-trash"></i> Delete</button>
                            </div>
                        </div>
                    </div>';
                }
            ?>
        </div>
    </main>
</body>
<script src="./jquery.js"></script>
<script>
    function Delete(id){
        let c = confirm("Are you sure, you want to delete this picture?");
        if(c==true){
            $(function(){
                $.ajax({
                    type: "POST",
                    url: "./mw/h_delete.php",
                    data:{"id":id},
                    success: function(s){
                        let res = JSON.parse(s);
                        if(res["status"]==200){
                            window.location.reload();
                        } else alert("Delete failed");
                    }
                });
            });
        } else alert("Delete operation stopped");
    }
</script>
</html>