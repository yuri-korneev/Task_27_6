<?php

namespace App\core;

class View
{
	public function generate($content_view, $template_view = null, $data = null, $data1 = null)
	{

		if ($template_view) {
		include_once VIEW . $template_view;
		}

		if ($content_view) {
			include_once VIEW . $content_view;
			}
	}
}

?>