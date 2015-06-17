<?php
  require_once('../include/init.inc.php');

  $region = $_SESSION['region'];
  $user = mysqli_real_escape_string($db, $_POST['name']);
  $playerID = mysqli_real_escape_string($db, $_POST['playerID']);
  $affiliate = mysqli_real_escape_string($db, $_POST['affiliate']);
  $bio = mysqli_real_escape_string($db, $_POST['bio']);
  $placings = mysqli_real_escape_string($db, $_POST['placings']);
  $set1 = mysqli_real_escape_string($db, $_POST['set1']);
  $set2 = mysqli_real_escape_string($db, $_POST['set2']);
  $set3 = mysqli_real_escape_string($db, $_POST['set3']);
  $charMain = mysqli_real_escape_string($db, $_POST['charMain']);
  $char2 = mysqli_real_escape_string($db, $_POST['char2']);
  $char3 = mysqli_real_escape_string($db, $_POST['char3']);
  $date = date("Y-m-d");

  $results;

  // Validate POST data exists in database. Do we have a single entry for
  // // this player in the user_region table with the mod's region?
  $valid_qry = "SELECT region_id FROM user_region
  							WHERE region_id = $region AND user_id = $playerID";
  $valid_res = $db->query($valid_qry);
  $valid_cnt = $valid_res->num_rows;

  if ($valid_cnt != 1){
  	header('location:/index.php');
  }
// Check if user name is in use for this region
  $check_qry = "SELECT user_region.user_id, user_region.region_id
                  FROM user
                  JOIN user_region
                    ON user.user_id = user_region.user_id
                  WHERE user_name = '$user'
                  AND user.user_id != $playerID
                  AND region_id = $region LIMIT 1";
  $check_res = $db->query($check_qry);
  $user_cnt = $check_res->num_rows;

  if ($user_cnt > 0){
    $results = $user." is already registered.";
  }
  else{
    $results = $user." has been added.";

// Update USER table
  $user_upd_qry = "UPDATE user
                      SET user_name = '$user',
                        user_affiliation = '$affiliate',
                        user_placings = '$placings',
                        user_bio = '$bio'
                      WHERE user_id = $playerID
                      LIMIT 1";
    $db->query($user_upd_qry);


// Add Sets

// // First clear sets for this player
  $set_del_qry = "DELETE FROM sets WHERE user_id = $playerID";
  $db->query($set_del_qry);

// // Now add the entered sets
  $setQry = "INSERT INTO sets
              (user_id, set_key)
            VALUES
              ('$playerID','$set1'),
              ('$playerID','$set2'),
              ('$playerID','$set3')";
  $db->query($setQry);

// // Remove blank entries
  $setDel = "DELETE FROM sets WHERE set_key = ''";
  $db->query($setDel);

// Add Characters

// // First clear characters for this player
  $chr_del_qry = "DELETE FROM user_characters WHERE user_id = $playerID";
  $db->query($chr_del_qry);

// // Now add entered characters
  $chrQry = "INSERT INTO user_characters
              (user_id, char_id, is_main)
            VALUES
              ('$playerID','$charMain',1),
              ('$playerID','$char2',0),
              ('$playerID','$char3',0)";
  $db->query($chrQry);

// // Remove blank entries
  $chrDel = "DELETE FROM user_characters WHERE char_id = 0";
  $db->query($chrDel);

// Go to player's profile
header("Location:/player-view.php?player=".$playerID);
}
?>
