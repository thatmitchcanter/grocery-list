<?php
  // Constants
  $servername = "devkinsta_db";
  $username = "root";
  $password = "gAFXKZkXCIUUPvOx";
  $database = "mitch_grocery";

  // Create connection
  $mysqli = new mysqli($servername, $username, $password, $database);

  // Check connection
  if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
  }
