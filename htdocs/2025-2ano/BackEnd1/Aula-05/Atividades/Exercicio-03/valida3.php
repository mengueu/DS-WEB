<meta charset="UTF-8">
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $site = filter_input(INPUT_POST, 'site', FILTER_VALIDATE_URL);
        if ($site) {
            echo "Site válido: <a href=\"$site\">$site</a>";
        } else {
            echo "URL inválida, verifique o formato.";
        }
    }
?>