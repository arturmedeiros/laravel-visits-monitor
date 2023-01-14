<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function tracking_github($username, $webhook)
    {
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $url = "https://";
        else
            $url = "http://";
        // Append the host(domain name, ip) to the URL.
        $url.= $_SERVER['HTTP_HOST'];

        // Append the requested resource location to the URL
        $url.= $_SERVER['REQUEST_URI'];

        //dd($_SERVER['REQUEST_URI']);

        $url = "https://hooks.slack.com/services/" . $webhook;
        $response = null;

        $data = [
            "username" => "GitHub Visits Monitor",
            "icon_url" => "https://www.webfx.com/wp-content/themes/fx/assets/img/tools/emoji-cheat-sheet/graphics/emojis/octocat.png",
            "blocks"=> [
                [
                    "type" => "header",
                    "text" => [
                    "type" => "plain_text",
                        "text" => "Congratulations!"
                    ]
                ],
                [
                    "type" => "section",
                    "text" => [
                    "type" => "plain_text",
                        "text" => "You have a new visit on GitHub: @" . $username,
                        "emoji" => true
                    ]
                ],
                [
                    "type" => "section",
                    "fields" => [
                        [
                            "type" => "mrkdwn",
                            "text" => "*Time:*\n" . now()->format('H:i') . " UTC"
                        ],
                        [
                            "type" => "mrkdwn",
                            "text" => "*Date:*\n" . now()->format('d/m/Y')
                        ],
                    ]
                ],
                [
                    "type" => "section",
                    "fields" => [
                        [
                            "type" => "mrkdwn",
                            "text" => "*Hosting by:*\n<https://github.arjos.com.br/|ARJOS - Web Development>"
                        ],
                        [
                            "type" => "mrkdwn",
                            "text" => "*Developer by:*\n<https://github.com/arturmedeiros/laravel-visits-monitor|@arturmedeiros>"
                        ],
                    ]
                ],
            ]
        ];

        dd($webhook, $url);
        try {

            Http::retry(3, 1000)->post($url, $data);

        }

        catch (RequestException $exception) {

            Log::critical("Erro Webhook!", [$exception->getCode(), $exception->response->json(), $url]);

        }

        /*return json_decode($response);*/

        $pixel = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z/C/HgAGgwJ/lK3Q6wAAAABJRU5ErkJggg==";

        return '<img width="1px" height="1px" src="'. $pixel .'"/>';
    }
}
