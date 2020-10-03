<?php 

require 'config.php';

$base_url = BASE_DIR;

if(!empty($_REQUEST))
{
    require __DIR__ . '/vendor/autoload.php';

    try
    {
        $movies = new \ClientSide\Movies();

        $movies->verbose(false);

        $movies->filter($_REQUEST['filter']);

        $response = $movies->get();
    }
    catch(Exception $e)
    {
        die($e->getMessage());
    }
}
$html = <<<HTML

    <!DOCTYPE html>
    <html>
        <head>
            <title>Rede Vistorias - Test</title>
            <base href="{$base_url}">
            <style>
                div, p, label, h1 {
                    color : #fff;
                }
                form {
                    color : #000;
                }
                body {
                    text-align: center;
                    background-image: url('/assets/background.jpg');
                }
            </style>
        </head>
        <body>
        <h1>Rede Vistorias Test </h1>
        <form action="/index.php">
            <label for="cars">Escolha seu destino:</label>
            <select name="filter">
                <option value="lucas">Lucas</option>
                <option value="release">Release</option>
                <option value="machete">Machete</option>
                <option value="magnotta">Magnota</option>
                <option value="rinster">Rinster</option>
                <option value="lee">Lee</option>
            </select>
            <br><br>
            <input type="submit" value="Submit">
        </form>
        </body>
    </html>

HTML;

echo $html;