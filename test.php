<?php 

require 'config.php';

$base_url = BASE_DIR;

if(!empty($_REQUEST))
{
    if(isset($_GET['response']))
        $response = $_GET['response'];
    else
        header('Location: http://swapi.com/endpoints/movies.php?filter=' . $_REQUEST['filter']);
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
            <form action="/test.php">
                <label for="cars">Choose Param</label>
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