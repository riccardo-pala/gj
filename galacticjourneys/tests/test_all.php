<?php

require 'test_login.php';
require 'test_register.php';
require 'test_show.php';
require 'test_update.php';
require 'test_search.php';
require 'utils.php';

$baseurl =  'http://localhost/galacticjourneys/galacticjourneys';

echo "[+] Testing Registration - Login - Show Profile<br>";

echo "[*] Generating random user<br>";

echo "---<br>";
$email = generate_random_email();
$pass = generate_random_password();
$first_name = generate_random_name();
$last_name = generate_random_name();
echo "Email: $email<br>";
echo "Pass: $pass<br>";
echo "First name: $first_name<br>";
echo "Last name: $last_name<br>";
echo "---<br>";



echo "[-] Calling register.php<br>";

register($email, $pass, $first_name, $last_name, $baseurl);

echo "[-] Calling login.php<br>";

echo login($email, $pass, $baseurl);

echo "[-] Calling show_profile.php<br>";

echo check_correct_user($email, $first_name, $last_name, show_logged_user($baseurl))
    ? "[*] Success!<br>"
    : "[*] Failed<br>";

echo "------------------------<br>";

echo "[+] Testing Update - Show Profile<br>";

echo "[*] Generating new random user<br>";
$first_name = generate_random_name();
$last_name = generate_random_name();

echo "---<br>";
echo "First name: $first_name<br>";
echo "Last name: $last_name<br>";
echo "---<br>";

echo "[-] Calling update_profile.php<br>";
update($first_name, $last_name, $baseurl);

echo "[-] Calling show_profile.php<br>";

echo check_correct_user($email, $first_name, $last_name, show_logged_user($baseurl))
    ? "[*] Success!<br>"
    : "[*] Failed<br>";


echo "------------------------<br>";

echo "---<br>";
$departure = "Napoli";
$destination = "Saturno";
$date = "2020-02-19";
echo "Departure: $departure<br>";
echo "Destination: $destination<br>";
echo "Date: $date<br>";
echo "---<br>";

echo "[-] Calling search.php<br>";

echo check_search_found($departure, $destination, $date, search($departure, $destination, $date, $baseurl))
    ? "[*] Success!<br>"
    : "[*] Failed<br>";
