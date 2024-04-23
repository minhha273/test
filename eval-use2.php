<?php

$user_input = $_GET['input'];

$result = eval($user_input);

echo "Result: $result";
?>