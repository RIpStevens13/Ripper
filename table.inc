<?php

echo <INPUT type="button" value="Add Row" onclick="addRow('dataTable')" />
<INPUT type="button" value="Delete Row" onclick="deleteRow('dataTable')" />    

    <table id="dataTable" class="table table-striped">
      <thead>
        <tr>
          <th><a>Product</a></th>
          <th><a>Username</a></th>
          <th><a>URL</a></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
    <select name="product[]">
      <?php
        $username = "root";
            $password = "letmein";
            $hostname = "localhost";

            //connection to the database
            $dbhandle = mysql_connect($hostname, $username, $password)
              or die("Unable to connect to MySQL");

            //select a database to work with
            $selected = mysql_select_db("dbAID",$dbhandle)
              or die("Could not select examples");

        $SQL = "SELECT * FROM tblProductListing";
        $result=mysql_query($SQL);

        $num=mysql_numrows($result);
        $i=0;
        while($i<$num) {
          $fieldname2 = mysql_result($result,$i, "ProductName");
          echo "<option value='$fieldname2'>$fieldname2</option>";
          $i++;
        }


      ?>
    </select>

     </td>
          <td><input type="text" name="username[]"></td>
          <td><input type="text" name="url[]"></td>
        </tr>
      </tbody>
    </table>;


?>