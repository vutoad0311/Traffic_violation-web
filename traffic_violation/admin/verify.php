<?php

$password = "123456";

$hash = '$2y$10$KmRb8aIxJmWfpjzen8Wjwei53VCUBjblmozyoH4zzkcz4Lfj7fsaO';

var_dump(password_verify($password, $hash));