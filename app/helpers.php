<?php

function gravatar_url($email)
{
    $email = md5($email);
    $query = http_build_query([
        's' => 60,
        'd' => 'https://s3.amazonaws.com/laracasts/images/default-square-avatar.jpg'
    ]);

    return "https://gravatar.com/avatar/{$email}${query}";
}
