<?php
require_once(__DIR__ . "/routes.php");
require_once(__DIR__ . '/../controllers/AuthController.php');
require_once(__DIR__ . '/../controllers/CategoryController.php');
require_once(__DIR__ . '/../controllers/ProductController.php');
require_once(__DIR__ . '/../controllers/ShoppingCartController.php');

$parsed_url = parse_url($_SERVER['REQUEST_URI']);
$requested_path = $parsed_url['path'];

foreach ($routes as $route) {

    // Verrify that used parameters are allowed by requested resource
    // Note.. A POST request can also contain GET parameters
    //        since they are included in the URL
    //        We therefor verrify both parameter types.
    if (isset($route['get_parms'])) {
        handle_parameters($route['get_parms'], $_GET);
    }
    if (isset($route['post_parms'])) {
        handle_parameters($route['post_parms'], $_POST);
    }

    // Check if the route is recognized
    if (isset($route['url'])) {
        if ($route['url'] !== $requested_path) {
            continue;
        }
    } else {
        // If required a parameter was missing (string or pattern)
        throw new Exception("Missing required parameter (string or pattern) in route.");
    }

    // Check that the request method is supported
    if (!in_array($_SERVER['REQUEST_METHOD'], $route['methods'])) {
        respond(
            405,
            '<h1>405 Method Not Allowed</h1>',
            ['allow' => implode(', ', $route['methods'])]
        );
    }

    // If everything was ok, try to call the related feature
    if (isset($route['handler'])) {

        // Make sure the route handler is callable
        if (!is_callable($route['handler'])) {
            $content = '<h1>500 Internal Server Error</h1>';
            $content .= '<p>Specified route-handler does not exist.</p>';
            $content .= '<pre>' . htmlspecialchars($route['handler']) . '</pre>';
            respond(500, $content);
        }

        // If we got any matches
        call_user_func($route['handler']);
        return;
    } else {
        throw new Exception("Missing required parameter (handler) in route.");
    }
}

// If the route was not recognized by the router
respond(404, '<h1>404 Not Found</h1><p>Page not recognized...</p>');


function respond($code, $html, $headers = [])
{
    $default_headers = ['content-type' => 'text/html; charset=utf-8'];
    $headers = $headers + $default_headers;
    http_response_code($code);
    foreach ($headers as $key => $value) {
        header($key . ': ' . $value);
    }
    echo $html;
    exit();
}

function handle_parameters($allowed_parameters, $post_or_get_parameters)
{

    $invalid_parameters = [];
    foreach ($post_or_get_parameters as $parm_name => $parm_value) {
        if (!in_array($parm_name, $allowed_parameters)) {
            $invalid_parameters[] = $parm_name;
        }
    }


    if ($invalid_parameters !== []) {
        echo '<p><b>Invalid request:</b> parameters not allowed.</p>';
        echo '<pre>';
        foreach ($invalid_parameters as $invalid_key => $invalid_name) {
            echo $invalid_key . ': ' . $invalid_name . "\n";
        }
        echo '</pre>';
        exit();
    }

    return true;
}
