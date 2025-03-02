<?php
$correct_password = "jcnvs";
$dictionary_file = "1000000-password-seclists.txt";

$username = isset($_POST['username']) ? $_POST['username'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";

function dictionary_attack($password, $dictionary_file, $correct_password) {
  $file = fopen($dictionary_file, "r");
  while (($word = fgets($file)) !== false) { 
      $word = trim($word);
      if ($word === $correct_password) {
          fclose($file);
          return "Password found using dictionary attack: <strong>$word</strong>";
      }
  }
  fclose($file);
  return false;
}

function brute_force_attack($correct_password) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $char_array = str_split($chars);
    foreach ($char_array as $c1) {
        foreach ($char_array as $c2) {
            foreach ($char_array as $c3) {
                foreach ($char_array as $c4) {
                    foreach ($char_array as $c5) {
                        $guess = $c1 . $c2 . $c3 . $c4 . $c5;
                        if ($guess === $correct_password) {
                            return "Password found using brute force attack: <strong>$guess</strong>";
                        }
                    }
                }
            }
        }
    }
    return "Password not found.";
}
$result = dictionary_attack($password, $dictionary_file, $correct_password);
if (!$result) {
    $result = brute_force_attack($correct_password);
}
echo "<h2>Result</h2>";
echo "<p>$result</p>";
echo "<a href='index.html'>Try Again</a>";
?>
