<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$email = filter_input(INPUT_GET, "email");
echo $email."<br>";
$password = filter_input(INPUT_GET, "mdp");
echo $password."<br>";
$readOnly = filter_input(INPUT_GET, "ro");
echo $readOnly."<br>";
$disabled = filter_input(INPUT_GET, "di");
echo $disabled."<br>";