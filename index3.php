<html>

<head>
  <title>Twitcap</title>
</head>

<body>
  <?php
  function twitcap()
  {
    // Set your username and password
    $user = 'osoleve';
    $pass = '********';

    $ch = curl_init("https://twitter.com/statuses/friends_timeline.xml");

    curl_setopt($ch, CURLOPT_HEADER, 0); // We want to see the header
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Set timeout to 30s
    curl_setopt($ch, CURLOPT_USERPWD, $user . ':' . $pass); // Set uname/pass


    $xml = new SimpleXMLElement(curl_exec($ch));
    curl_close($ch);

    return $xml;
  }

  $content = twitcap();
  print_r($content);
  ?>
</body>

</html>