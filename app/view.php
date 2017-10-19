<?php
	class View {

		static function generate($content_view, $data = null, $template_view = 'template.html.php'){
			if (isset($data)){
				extract($data, EXTR_PREFIX_SAME, "tt");
			}

			include $_SERVER['DOCUMENT_ROOT'] . '/app/views/' . $template_view;
		}
	}
?>