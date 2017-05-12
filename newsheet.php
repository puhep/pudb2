<!--
This is a fairly simple page that simply asks for a sheet name.
    On submission. the query is processed by the newsheet_proc page
    The user is then redirected to the sheet editing page for the new sheet
    -->
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