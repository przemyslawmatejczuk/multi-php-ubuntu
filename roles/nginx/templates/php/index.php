<?php

$phpVersions =  explode("\n", shell_exec('ls -1 /etc/systemd/system/php-fpm-*'));
$phpVersions = array_filter($phpVersions);

array_walk($phpVersions, function(&$php) {
    $php = str_replace(['/etc/systemd/system/php-fpm-', '.service'], '', $php);
});

if (isset($_SERVER['DOCUMENT_URI']) && $_SERVER['DOCUMENT_URI'] !== '/') {
    ob_start();
    phpinfo();
    $phpinfo = ob_get_contents();
    ob_end_clean();


    $button = <<<HTML
    <div id="top" style="position:fixed;">
        <a href="/">Go back</a>
    </div>
HTML;

    $phpinfo = str_replace('<body>', '<body>'.$button, $phpinfo);

    echo $phpinfo;
    die;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>PHP List</title>
</head>
<body>
<ul>
    <?php

    foreach($phpVersions as $v) {
        preg_match('#^([0-9]+\.[0-9]+)\.#', $v, $major);
        $major = $major[1];
        $socket = '/var/run/php/php'.$major.'-fpm.sock';
        echo sprintf('<li><a href="%s">%s</a> (socket: %s)</li>', '/'.$v, $v, $socket);
        if(version_compare($v, '7.0', '>=')) {
            echo sprintf('<li><a href="%s/opcache">%s - opcache</a></li>', '/'.$v, $v);
        }
    }
    ?>
</ul>
</body>
</html>