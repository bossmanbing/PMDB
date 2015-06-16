<?php
  require_once('../include/init.inc.php');

  $region = $_SESSION['region'];
  $user = mysqli_real_escape_string($db, $_POST['name']);

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
                  (user_name)
                VALUES
                  ('$user')";
    $db->query($user_ins_qry);
    $user_id = $db->insert_id;

// Set default rank for each game
    $rank_ins_qry = "INSERT INTO ranking
                        (user_id, game_id)
                      VALUES ($user_id, 1),
                      ($user_id, 2),
                      ($user_id, 3),
                      ($user_id, 4),
                      ($user_id, 5),
                      ($user_id, 6)";
    $db->query($rank_ins_qry);

// Set player to TO's region
  $reg_qry = "INSERT INTO user_region
                (user_id,region_id)
              VALUES
                ($user_id, $region)";
  $db->query($reg_qry);
  }

echo $results;
?>
