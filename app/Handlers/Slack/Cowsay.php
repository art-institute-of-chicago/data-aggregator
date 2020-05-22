<?php

namespace App\Handlers\Slack;

use Spatie\SlashCommand\Request;
use Spatie\SlashCommand\Response;
use Spatie\SlashCommand\Handlers\BaseHandler;

class Cowsay extends BaseHandler
{
    /**
     * If this function returns true, the handle method will get called.
     *
     * @param \Spatie\SlashCommand\Request $request
     *
     * @return bool
     */
    public function canHandle(Request $request): bool
    {
        return true;
    }

    /**
     * Handle the given request. Remember that Slack expects a response
     * within three seconds after the slash command was issued. If
     * there is more time needed, dispatch a job.
     *
     * @param \Spatie\SlashCommand\Request $request
     *
     * @return \Spatie\SlashCommand\Response
     */
    public function handle(Request $request): Response
    {
        $text = $request->text;

        $ret = "```\n";
        $ret .= " ________________________________________\n";
        $textArray = explode( "\n", wordwrap( $text, 40));

        foreach ($textArray as $key => $txt) {
            reset($textArray);
            if ($key === key($textArray)) {
                $ret .= "/ " . str_pad($txt, 40) . " \\\n";
                continue;
            }
            end($textArray);
            if ($key === key($textArray)) {
                $ret .= "\\ " . str_pad($txt, 40) . " /\n";
                continue;
            }
            $ret .= "| " . str_pad($txt, 40) . " |\n";
        }
        $ret .= " ----------------------------------------\n";
        $ret .= "        \   ^__^\n";
        $ret .= "         \  (oo)\_______\n";
        $ret .= "            (__)\       )\\/\\\n";
        $ret .= "                ||----w |\n";
        $ret .= "                ||     ||\n";
        $ret .= "```\n";

        return $this
            ->respondToSlack("{$ret}")
            ->displayResponseToEveryoneOnChannel();
    }
}
