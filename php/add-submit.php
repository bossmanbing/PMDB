<?php
  require_once('../include/init.inc.php');

  $region = $_SESSION['region'];
  $user = mysqli_real_escape_string($db, $_POST['name']);
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

// Check if user name is in use
  $check_qry = "SELECT user_region.user_id, user_region.region_id
                  FROM user
                  JOIN user_region
                    ON user.user_id = user_region.user_id
                  WHERE user_name = '$user'
                  AND region_id = $region LIMIT 1";
  $check_res = $db->query($check_qry);
  $user_cnt = $check_res->num_rows;

  if ($user_cnt > 0){
    $results = $user." is already registered.";
  }
  else{
    $results = $user." has been added.";

// Add to USER table
    $user_ins_qry = "INSERT INTO user
                  (user_name, user_dateJoined, user_affiliation, user_placings, user_bio)
                VALUES
                  ('$user','$date','$affiliate','$placings','$bio')";
    $db->query($user_ins_qry);
    $user_id = $db->insert_id;

// Set default rank for each game
    $rank_ins_qry = "INSERT INTO ranking
                        (user_id, game_id)
                      VALUES
                      ($user_id, 3)";
    $db->query($rank_ins_qry);

// Set player to TO's region
  $reg_qry = "INSERT INTO user_region
                (user_id,region_id)
              VALUES
                ($user_id, $region)";
  $db->query($reg_qry);
  }

// Add Sets
  $setQry = "INSERT INTO sets
              (user_id, set_key)
            VALUES
              ('$user_id','$set1'),
              ('$user_id','$set2'),
              ('$user_id','$set3')";
  $db->query($setQry);
  $setDel = "DELETE FROM sets WHERE set_key = ''";
  $db->query($setDel);

// Add Characters
  $chrQry = "INSERT INTO user_characters
              (user_id, char_id, is_main)
            VALUES
              ('$user_id','$charMain',1),
              ('$user_id','$char2',0),
              ('$user_id','$char3',0)";
  $db->query($chrQry);
  $chrDel = "DELETE FROM user_characters WHERE char_id = 0";
  $db->query($chrDel);

header("Location:/player-view.php?player=".$user_id);
?>
