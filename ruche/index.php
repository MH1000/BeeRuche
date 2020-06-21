<?php
// On démarre une session
session_start();

// On inclut la connexion à la base
require_once('connect.php');

header('Location: ruche.php');
