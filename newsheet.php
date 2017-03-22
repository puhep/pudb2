<html>
<head>
<title>Submit New Sheet</title>

<body>
<h1>Submit New Sheet</h1>


<form action="newsheet_proc.php" method="post" enctype="multipart/form-data">
    <div style="width:300px;">
    Sheet Name: <input name="name" type="text" style="float:right" required><br><br>
</div>
<input type="submit" name="submit" value="Submit">  
    </form>
<br><br>
<input type=button onClick="location.href='index.php'" value='Index'>
     </body>
     </html>