<?php
session_start();
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$dbname="sis";
$conn=mysqli_connect("$dbhost","$dbuser","$dbpass") or die("could not connect to mysql");

mysqli_select_db($conn,$dbname);
//mysqli_select_db($conn,$dbname);
$subcode=$_GET["subcode"];
$result = mysqli_query($conn,"SELECT * FROM sub_tbl where subject_code='$subcode'");
$sql1="select distinct(teacher_name) from teacher";
$result1=mysqli_query($conn,$sql1);

  while ($row = mysqli_fetch_array ($result))
  {
    $sub_code=$row['subject_code'];
    $sub_name=$row['subject_name'];
    $sub_credit=$row['sub_credit'];
    //$teacher_name=$row['teacher_name'];
    $dept_name=$row['dept_name'];
    $semester=$row['semester'];
  }

?>

<?php
$pagetitle="student data";
include "include/header.php"; ?>


        <div class="content">

          <div class="text-center">
              <hr class="team_hr team_hr_left hr_gray"/><span class="span_blog txt_darkgrey txt_orange">Updating Students</span>
              <hr class="team_hr team_hr_right hr_gray" />
          </div>  <!-- text-center -->


          <?php
          //session_start();
          if(isset($_SESSION['error']))
          {
          echo '<p>'.$_SESSION['error']['credit'].'</p>';
          // echo "<script type='text/javascript'>
                
          //         alert('Credit cannot be more than three');
          //     </script>";

          unset($_SESSION['error']);
          }

          if(isset($_SESSION['error_2']))
          {
          echo '<p>'.$_SESSION['error_2']['credit'].'</p>';
          // echo "<script type='text/javascript'>
                
          //         alert('Credit Limit is over for this Teacher');
          //     </script>";

          unset($_SESSION['error_2']);
          }
          ?>
 
          <br><br><br>

          <form method="POST" action="subject_update_action_2.php?subcode=<?php echo $subcode;?>" name="reg" onSubmit="return validate()">

              <center>
 
              <table bgcolor="" width="80%"> 

            </center>  <!-- center -->

              <tr>
                <td>SUBJECT ID:</td>
                <td><input type="text" name="subjid" class="form-control" value="<?php echo $sub_code; ?>" required/></td>
              </tr>

              <tr>
                <td>SUBJECT NAME:</td>
                <td><input type="text" name="subjname" class="form-control" value="<?php echo $sub_name; ?>" required /></td>
              </tr>

              <tr>
                <td>SUBJECT CREDIT:</td>
                <td><input type="text" name="subjcd" class="form-control" value="<?php echo $sub_credit; ?>" required/></td>
              </tr>

               <tr>
                <td>TEACHER NAME:</td>
              <td><select class='form-control' name='tname' required> <option >select teacher_name</option>   
                <?php

            while($row=mysqli_fetch_array($result1))
            {
            ?>
                  <option value="<?php echo $row['teacher_name']; ?>"><?php echo $row['teacher_name']; ?></option>

                <?php } ?>

              </select></td>
              </tr>

              <!-- <tr>
                <td>DEPARTMENT:</td>
                <td><input type="text" name="dept" class="form-control" value="<?php echo $row['dept_name']; ?>" required /></td>
              </tr> -->

               <tr>
                  <td>DEPARTMENT</td>
                  <td>
                  <select name="dept" class="form-control" required>
                  <option ><?php echo $dept_name; ?></option>
                  <option value="CSE">CSE</option>
                  <option value="ET&T">ET&T</option>
                  <option value="CIVIL">CIVIL</option>
                  <option value="MECHNICAL">MECHNICAL</option>
                  <option value="EEE">EEE</option>
                  </select>
                  </td>
                </tr>

              <tr>
                  <td>SEMESTER:</td>
                  <td>
                  <select name="semester" class="form-control" required>
                  <option ><?php echo $semester; ?></option>
                  <option value="FIRST">FIRST</option>
                  <option value="SECOND">SECOND</option>
                  <option value="THIRD">THIRD</option>
                  <option value="FOURTH">FOURTH</option>
                  <option value="FIFTH">FIFTH</option>
                  <option value="SIX">SIX</option>
                  <option value="SEVENTH">SEVENTH</option>
                  <option value="EIGHT">EIGHT</option>
                  <option value="NINETH">NINETH</option>
                  <option value="TENTH">TENTH</option>
                  <option value="ELEVENTH">ELEVENTH</option>
                  <option value="TWELVETH">TWELVETH</option>
                  </select>
                  </td>
                </tr>

              <tr>
                <td>&nbsp;</td>
                <td><input class="mini_green_button" type="submit" name="update" value="Update" />&nbsp;<input class="mini_red_button" type="submit" name="back" value="Cancel" /></td>
              </tr>
            </table><br><br>

              </form>

        </div> <!-- content -->

  
<?php include "include/footer.php"; ?>  
