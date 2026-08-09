<?php
$dest = __DIR__;
$parts = [];
for($i=1; $i<=15; $i++){
    $parts[] = "part" . $i . ".zip";
}
$allSuccess = true;
foreach($parts as $part) {
    if(!file_exists($part)) continue;
    $zip = new ZipArchive;
    if ($zip->open($part) === TRUE) {
        $zip->extractTo($dest);
        $zip->close();
        unlink($part);
    } else {
        echo "Extract failed for $part<br>";
        $allSuccess = false;
    }
}
if($allSuccess) {
    $safeHtaccess = "<IfModule mod_rewrite.c>\nRewriteEngine On\nRewriteCond %{REQUEST_URI} !^/public/\nRewriteCond %{REQUEST_URI} !^/import_db\.php\nRewriteRule ^(.*)$ public/$1 [L]\n</IfModule>";
    file_put_contents(__DIR__ . "/.htaccess", $safeHtaccess);
    echo "Extracted successfully and .htaccess secured!";
}
// Removed unlink(__FILE__); so deploy.php stays for debugging
?>
