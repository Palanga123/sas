<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
</head>
<body>
    <?php
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            echo $id;
        }else{
            echo "Error: Mising data";
        }
    ?>
    <script src=""></script>
</body>
</html>