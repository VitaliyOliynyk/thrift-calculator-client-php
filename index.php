<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<form method="get">
    <div>
        arg1: <input type="text" name="arg1"/> arg2:<input type="text" name="arg2"/>
    </div>
    <select name="operation">
        <option name="add">add</option>
        <option name="remove">remove</option>
        <option name="multiply">multiply</option>
        <option name="divide">divide</option>
    </select>
    <div>
        <input type="submit" value="calculate"/>
    </div>
    <?php
    if($_GET['arg1']) {
        echo "Result:" ;
    }
    ?>
</form>

</body>
</html>