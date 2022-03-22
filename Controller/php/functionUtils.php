<?php

//Basic security function
function sanitize($data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return addslashes($data);
}
