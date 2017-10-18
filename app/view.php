<?php
	class View {

		function generate($content_view, $template_view = 'template.html.php', $data = null){
			if (!isset($data)){
				extract($data, EXTR_PREFIX_SAME);
			}

			include $_SERVER['DOCUMENT_ROOT'] . '/views/' . $template_view;
		}
	}
?>