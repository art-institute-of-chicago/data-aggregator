<?php

namespace App\Http\Controllers;

use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Storage;

class DocsController extends Controller
{

    protected $filename;
    protected $title = 'API Documentation';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $content = Storage::get($this->filename);
        $markup = Markdown::parse($content);

        // Create left sidebar
        preg_match_all('/<h[23]>([\w ]+)<\/h[23]>/i', $markup, $matches);
        $leftSidebarContent = '';
        $previousHeading = '';
        foreach ($matches[0] as $key => $heading) {
            $title = $matches[1][$key];
            if (preg_match('/<h2>/i', $heading)) {
                if ($previousHeading == 'h3') {
                    $leftSidebarContent .= "</ul>\n";
                }
                if ($previousHeading == 'h2') {
                    $leftSidebarContent .= "</li>\n";
                }
            }
            elseif (preg_match('/<h3>/i', $heading)) {
                if ($previousHeading == 'h2') {
                    $leftSidebarContent .= "<ul class=\"m-link-list__sub-list\">\n";
                }
            }

            if (preg_match('/<h2>/i', $heading)) {
                $leftSidebarContent .= "<li class=\"m-link-list__item\">\n"
                                    . "<a class=\"m-link-list__trigger f-module-title-1\" href=\"#" .strtolower($title) ."\">"
                                    . "<span class=\"m-link-list__label\">" .$title ."</span>"
                                    . "</a>\n";
                $previousHeading = 'h2';
            }
            elseif (preg_match('/<h3>/i', $heading)) {
                $leftSidebarContent .= "<li class=\"m-link-list__item\">\n"
                                    . "<a class=\"m-link-list__trigger f-secondary\" href=\"#" .strtolower($title) . "\">"
                                    . "<span class=\"m-link-list__label\">" .$title ."</span>"
                                    . "</a>"
                                    . "</li>\n";
                $previousHeading = 'h3';
            }
        }
        if ($previousHeading == 'h3') {
            $leftSidebarContent .= "</ul></li>\n";
        }
        if ($previousHeading == 'h2') {
            $leftSidebarContent .= "</li>\n";
        }

        $leftSidebar = "<div class=\"o-collapsing-nav\" data-behavior=\"dropdown\" data-dropdown-breakpoints=\"medium-\">\n"
                     . "<ul class=\"m-link-list m-link-list--quiet\">\n"
                     . $leftSidebarContent
                     . "</ul>\n"
                     . "</div>\n";

        // Add anchor link to all h2s and h3s
        $markup = preg_replace_callback('/<h([23])>([\w ]+)<\/h[23]>/i', function ($title) {
            return '<h' .$title[1] .'>' . $title[2] . '</h' .$title[1] .'><div class="anchor"><a name="target" id="' . strtolower($title[2]) . '"> </a></div>';
        }, $markup);

        return view('docs', ['content' => $markup, 'leftSidebar' => $leftSidebar, 'title' => $this->title]);
    }
}
