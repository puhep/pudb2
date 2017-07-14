<!DOCTYPE html>
<?php
  require_once("database.php");
  require_once("functions.php");
  $id=$_GET['id'];
  $db= new Database();
  $sql = "SELECT notetext FROM notes where part_id=$id and part_type=\"sheet\"";
  $db->query($sql);
  $db->singleRecord();
  $notes=$db->Record['notetext'];
  $sql = "SELECT name FROM sheet WHERE id=$id";
  $result = $db->db_query($sql);
  $result = $result[0];
  $name   = $result['name'];
?>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.min.css">
    <title><?php echo $name; ?> Summary</title>
  </head>
  <body>
    <div id="wrapper">
      <header>
        <a href="index.php">
          <img src="../phase_2/pics/pu_logo.jpg" width="200" height="100" alt="Purdue University Logo">
          <img src="../phase_2/pics/CMS_logo_col.png" width="100" height="100" alt="CMS Logo">
        </a>
      </header>
      <nav>
        <a href="part_list.php">Part List</a>
        <br>
        <a href="test_list.php">Test List</a>
        <br>
        <a href="https://docs.google.com/document/d/1zDu6hiUR7r6qumQPcKdV3OXh7vLpGjodTjLopjbufKQ/edit?usp=sharing" target="_blank"> Project Logbook</a>
        <br>
        <a href="https://drive.google.com/drive/folders/0B04OIAGnMDYxbXBkTWJmMm5hN0E?usp=sharing" target="_blank">Project Google Drive</a>
        <br>
        <a href="contact.php">Contact/Issues</a>
      </nav>
      <main>
        <h1><?php echo $name; ?> Summary</h1>
        <div id="container"></div>
        <form method="get" action="sheet_edit.php">
          <?php echo "<input type='hidden' name='id' value='".$_GET['id']."'>"; ?>
          <input class="button" type="submit" value="Edit Part">
        </form>
        <?php
          echo "<h2>Notes</h2>";
          if ($notes!="") {
            echo "<p>".nl2br($notes)."</p>";
          } else {
            echo "No notes found";
          }
          echo "<h2>Pictures</h2>";
          show_pictures("sheet",$id);
          if (file_exists("../phase_2/files/sheet/$id/ThicknessContour.csv")) {
            echo "<h2>Graphs</h2>"
                ."<h4><a href=\"./graphs/sheetContour.php?id=$id\" target=\"_blank\">Sheet Thickness Contour</a></h4>";
            echo "<div>
                    <object type=text/html data=\"graphs/sheetContour.php?id=$id\" width=\"800px\" height=\"470px\" style=\"overflow:auto;\">
                    </object>
                  </div>";
            echo "<h4><a href=\"./graphs/sheetMesh.php?id=$id\" target=\"_blank\">Sheet Mesh</a></h4>";
            echo "<div>
                    <object type=text/html data=\"./graphs/sheetMesh.php?id=$id\" width=\"800px\" height=\"470px\" style=\"overflow:auto;\">
                    </object>
                  </div>";
          }
          echo "<h2>Misc Files</h2>";
          show_files("sheet",$id);
        ?>
        <br>
      </main>
    </div>
    <script src="./node_modules/jquery/dist/jquery.min.js" charset="utf-8"></script>
    <script src="./js/getSheetInfo.min.js" charset="utf-8"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/es6-shim/0.11.0/es6-shim.min.js"></script>
    <script src="http://fb.me/react-with-addons-0.11.0.min.js"></script>
    <script src="http://fb.me/JSXTransformer-0.11.0.js"></script>
    <script type="text/jsx;harmony=true">/** @jsx React.DOM */
      var id = <?php echo $id; ?>;
      $.ajax({
        url: './php/getSheetData.php?id=' + id,
        success: react,
      });
      function react(response) {
        JSONtoArray(response);
        var localArray = dbArray;
        var Comment = React.createClass({
          getInitialState: function() {
            return {editing: false, textVal: ''}
          },
          handleChange: function(evt) {
            this.setState({textVal: evt.target.value});
          },
          edit: function() {
            this.setState({editing: true});
          },
          cancel: function() {
            this.setState({editing: false});
          },
          save: function() {
            var val = this.state.textVal;
            this.props.updateCommentText(val, this.props.index);
            var field = this.props.field;
            var time = new Date();
            var h = time.getHours();
            var m = time.getMinutes();
            var s = time.getSeconds();
            var dd = time.getDate();
            var mm = time.getMonth() + 1;
            var yyyy = time.getFullYear();
            if (dd<10) dd='0'+dd;
            if (mm<10) mm='0'+mm;
            time = mm+'-'+dd+'-'+yyyy+' '+h+':'+m+':'+s;
            $(function() {
              $.ajax({
                url: './php/updatePart.php?id='+id+'&partType=sheet&field='+field+'&value='+val,
              });
              $.ajax({
                url: './php/updatePart.php?id='+id+'&partType=sheet&field=lastEdit&value='+time,
              })
            });
            this.setState({editing: false});
          },
          renderNormal: function() {
            return (
              <div className="commentContainer">
                <table>
                  <tr>
                    <td>
                      <div className="commentText">{this.props.children}</div>
                    </td>
                    <td>
                      <button onClick={this.edit} className="button-primary">Edit</button>
                    </td>
                  </tr>
                </table>
              </div>
            );
          },
          renderForm: function() {
            var type;
            var step = '0.0001';
            var min  = '0';
            switch (this.props.index) {
              /**
              * type = text
              */
              case 0:
              case 1:
              case 5:
              case 7:
              case 10:
              case 11:
              case 14:
              case 16:
              case 18:
              case 20:
              case 22:
              case 36:
                type = 'text';
                break;
              /**
              * type = date
              */
              case 2:
              case 6:
                type = 'date';
                break;
              /**
              * type = number
              */
              case 3:
              case 8:
              case 9:
                type = 'number';
                step = '1';
                break;
              case 4:
              case 27:
              case 31:
              case 32:
              case 33:
              case 34:
                type = 'number';
                step = '0.001';
                break;
              case 23:
              case 24:
              case 25:
              case 26:
              case 28:
              case 29:
              case 30:
              case 35:
                type = 'number';
                step = '0.00001'
                break;
              /**
              * type = time
              */
              case 12:
              case 13:
              case 15:
              case 17:
              case 19:
              case 21:
                type = 'time';
                break;
              default:
                type = 'text';
            }
            return (
              <div className="commentContainer">
                <input placeholder={this.props.children} value={this.props.textVal} onChange={this.handleChange} type={type} step={step} min={min}></input>
                <br/>
                <button onClick={this.save} className="button-save">Save</button>
                <button onClick={this.cancel} className="button-cancel">Cancel</button>
              </div>
            );
          },
          render: function() {
            if (this.state.editing) {
              return this.renderForm();
            } else {
              return this.renderNormal();
            }
          },
        });

        var Board = React.createClass({
          getInitialState: function() {
            return {
              comments: localArray
            }
          },
          updateComment: function(newText, i) {
            var arr = this.state.comments;
            arr[i] = newText;
            this.setState({comments: arr});
          },
          eachComment: function(text, i) {
            return (
              <tr>
                <td>
                  {keyArray[i]}
                </td>
                <td>
                  <Comment key={i} index={i} field={fieldArray[i]} updateCommentText={this.updateComment}>
                    {text}
                  </Comment>
                </td>
              </tr>
            );
          },
          render: function() {
            return (
              <div className="board">
                <table>
                  <tr>
                    <td>Last Edit</td>
                    <td>{dbJSON.lastEdit}</td>
                  </tr>
                  <tr>
                    <td>Object Type</td>
                    <td>Sheet</td>
                  </tr>
                  <tr>
                    <td>Name</td>
                    <td>{dbJSON.name}</td>
                  </tr>
                  {this.state.comments.map(this.eachComment)}
                </table>
              </div>
            );
          },
        });
        React.renderComponent(
          <Board />,
          document.getElementById('container')
        );
      }
    </script>
  </body>
</html>
