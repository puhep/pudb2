<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Contact/Issue</title>
  </head>
  <body>
    <a href="index.php">
      <div class="header">
        <img src="../phase_2/pics/pu_logo.jpg" width="200" height="100" alt="Purdue University Logo">
        <img src="../phase_2/pics/CMS_logo_col.gif" width="100" height="100" alt="CMS Logo">
      </div>
    </a>
    <nav>
      <a href="part_list.php">Part List</a>
      <a href="https://docs.google.com/document/d/1zDu6hiUR7r6qumQPcKdV3OXh7vLpGjodTjLopjbufKQ/edit?usp=sharing">Project Logbook</a>
      <a href="https://drive.google.com/drive/folders/0B04OIAGnMDYxbXBkTWJmMm5hN0E?usp=sharing">Project Google Drive</a>
      <a href="contact.php">Contact/Issues</a>
    </nav>
    <h2>Send Issue</h2>
    <a href="https://github.com/puhep/pudb2/issues">GitHub Issues</a>
    <h2>Email</h2>
    <form action:"mailto:nelso312@purdue.edu" method="post" enctype="text/plain">
      <label for="name">Name: <br></label>
      <input type="text" name="name" placeholder="Your name.."><br>
      <label for="mail">E-Mail: <br></label>
      <input type="email" name="mail"><br>
      <label for="subject">Subject: <br></label>
      <textarea name="subject" rows="8" cols="80" placeholder="Write something.."></textarea><br><br>
      <input type="submit" value="Send">
      <input type="reset" value="Reset">
    </form>
  </body>
</html>
