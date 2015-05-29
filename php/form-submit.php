<?php
  require_once('../include/init.inc.php');

  $player1val = $_POST['player1'][0];
  $player1text = $_POST['player1'][1];
  $player2val = $_POST['player2'][0];
  $player2text = $_POST['player2'][1];
  $game = $_POST['game'];
  $winner = $_POST['winner'];

  $loser;

// Player A will bet he winner
// Player B will be the loser

  if ($winner === $player1val){
    $loser = $player2val;
  }
  else{
    $loser = $player1val;
  }

// Get Current Ratings
  $Ra;
  $Rb;

  $score_qry = "SELECT score FROM ranking
                WHERE user_id = $winner
                AND game_id = $game
                LIMIT 1";
  $score_res = $db->query($score_qry);
  $scoreA = $score_res->fetch_assoc();
  $Ra = $scoreA['score'];

  $score_qry = "SELECT score FROM ranking
                WHERE user_id = $loser
                AND game_id = $game
                LIMIT 1";
  $score_res = $db->query($score_qry);
  $scoreB = $score_res->fetch_assoc();
  $Rb = $scoreB['score'];

//weight
  $K = 15;
//Win chance
  $Ea;
  $Eb;
//New Ratings
  $Rna;
  $Rnb;

// Get the chance of winning
  $Ea = 1/(1+pow(10,(($Rb-$Ra)/400)));
  $Eb = 1/(1+pow(10,(($Ra-$Rb)/400)));

// Get the updated scores
  $Rna = round($Ra + 15*(1-$Ea));
  $Rnb = round($Rb + 15*(0-$Eb));

// Update the database
  $upd_qry = "UPDATE ranking
                SET score = $Rna
                WHERE user_id = $winner
                AND game_id = $game LIMIT 1";
  $db->query($upd_qry);

  $upd_qry = "UPDATE ranking
                SET score = $Rnb
                WHERE user_id = $loser
                AND game_id = $game LIMIT 1";
  $db->query($upd_qry);

// Insert match into records
  $ins_qry = "INSERT INTO matches
                  VALUES ($winner, $loser, $Rna, $Rnb, $game)";
  $db->query($ins_qry);

// Prepare return values

  $user_qry = "SELECT user_name FROM user
                WHERE user_id = $winner LIMIT 1";
  $user_res = $db->query($user_qry);
  $userA = $user_res->fetch_assoc();
  $userA = $userA['user_name'];

  $user_qry = "SELECT user_name FROM user
                WHERE user_id = $loser LIMIT 1";
  $user_res = $db->query($user_qry);
  $userB = $user_res->fetch_assoc();
  $userB = $userB['user_name'];

  echo "<div id='winner'>".$userA.": New Score: ".$Rna."</div><div id='loser'>".$userB.": New Score: ".$Rnb."</div>";
?>
