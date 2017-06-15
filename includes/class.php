<?php

// main class to operate on json string

class JsonEdit {

  // write the JSON file on the server

  function writeFile($config_file){

    $myfile = fopen($config_file, "w") or die("Unable to open file: " . $config_file);

  	fwrite($myfile, $_POST['config']);

  	fclose($myfile);

  }

  // create the tabs based off the $json input

  function makeTabs($json){

    $t = 0;

    echo '<ul class="nav nav-tabs account-tabs">';

    foreach($json as $tabname => $ar){

      $tactive = "";
      $texp    = " aria-expanded='false'";

      if($t == 0){

        $tactive = "active";
        $texp    = " aria-expanded='true'";

      }

      echo '<li class="'.$tactive.'"><a data-toggle="tab" href="#'.$tabname.'"'.$texp.'>'.ucwords(str_replace("_", " ", $tabname)).'</a></li>';

      $t++;

    }

    echo '</ul>';

  }

  // create the tab content based off the $json input

  function tabContent($json){

    $s=0;
    foreach($json as $section => $arr){

      $x=0;
      $activein = "";
      if($s == 0){
        $activein = " active in";
      }
      echo '<div id="'.$section.'" class="tab-pane fade'.$activein.'">';
      echo  "<h2>" . ucwords(str_replace("_", " ", $section)) . "</h2>";
      echo "<div class='node' data-name='$section'>";

      foreach($arr as $k => $v){

        if(is_array($v)){

          echo "<div class='form-group well'>";

          foreach($v as $k1 => $v1){


            $k1d = ucwords(str_replace("_", " ", $k1));

            echo "
            <div class='form-group'>
            <label class='col-sm-2 control-label'>$k1d</label>";

            if( is_array($v1) || $k1 == "bio" && $k1 != "featured_products"){

              if( is_array($v1) ){
                $ta = implode("\r", $v1);
                $r = 4;
                $type = "array";
              } else {
                $ta = $v1;
                $r = 6;
                $type = "string";
              }

              if($k1 == "bio"){
                $type = "string";
              }

              echo "<div class='col-sm-10'><textarea class='form-control home-config $section' name='$k1' rows='$r' data-type='$type'>$ta</textarea></div>";
            } else {
              echo "<div class='col-sm-10'><input class='form-control home-config $section' name='$k1' value='$v1' data-type='string'></div>";
            }

            echo "</div>
            ";
          }

          echo "</div>";

        } else {

          if($x == 0){
            echo "<div class='form-group well'>";
          }

          echo "
          <div class='form-group'>
          <label class='col-sm-2 control-label'>".($x+1)."</label>
          <div class='col-xs-10'><input class='form-control home-config' name='$k' value='$v'></div>
          </div>
          ";

          if( $x == count($arr)-1 ){
            echo "</div>";
          }

        }

        $x++;

      }
      echo "</div>";
      echo "</div>";

      $s++;

    }

  }

}
?>
