    </div>

<!--
    <div data-role="footer" data-theme="b" data-position="fixed">
	<a href="logout.php" data-role="button" data-icon="delete" data-iconpos="notext">Logout</a>
        <a href="logout.php" data-icon="logout" data-iconpos="notext" data-transition="fade">Logout</a>
        <a href="add.php" data-icon="add" data-iconpos="notext" data-transition="fade">Add</a>
    </div>
-->

   <?php
       function form_edit_url () {
           $obj_val = $_SESSION['obj'];
           return "edit.php?opt=$xxx&obj=$obj_val";
       }
   ?>
   <div data-role="footer" data-theme="b" data-id="mainFooter" data-position="fixed">
    <div data-role="navbar" data-grid="c">
      <ul class="apple-navbar-ui comboSprite">
        <li><a href="add.php" data-iconpos="notext" data-icon="add">Add</a></li>
  <?php
        echo "<li><a href=";
        echo form_edit_url();
        echo " data-iconpos='top' data-icon='edit'>Edit</a></li>\n";
  ?>
        <li><a href="#about" class="ui-btn-active ui-state-persist" data-iconpos="top" data-icon="about">About Us</a></li>
        <li><a href="logout.php" data-iconpos="notext" data-icon="logout">Logout</a></li>
      </ul>
    </div>
  </div> 



</div>

</body>
</html>


