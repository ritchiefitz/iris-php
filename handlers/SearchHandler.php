<?php 

include_once('handlers/HandlerInterface.php');
include_once('modules/IrisModel.php');

class SearchHandler implements IrisHandler {

	public function handleAction() {
		$jid = filter_input(INPUT_POST, 'jid', FILTER_VALIDATE_INT);
		$search = filter_input(INPUT_POST, 'q', FILTER_SANITIZE_STRING);

		// Validate
		$model = new IrisModel();
		$user = $_SESSION['user'];

		$html = '<div class="matched-results">';

		if ($jid == NULL || $jid == FALSE ||
		    $search == NULL || $search == FALSE) {

			$html .= "<h2>No Results</h2>";
		}
		else {
			$matched_pages = $model->searchContent($user['uid'], $jid, $search);
		
			if ($matched_pages) {
				$html .= "<h2>Results</h2>";

				foreach ($matched_pages as $page) {
					$html .= '<div class="matched-result">';
					$html .= '<div class="row">';
					$html .= '<div class="col-sm-4 title">'.$page['title'].'</div>';
					$html .= '<div class="col-sm-4 date">'.$page['event_date'].'</div>';
					$html .= '<div class="col-sm-4 number">'.$page['page_number'].'</div>';
					$html .= '</div>';
					$html .= '</div>';
				}
			}
			else {
				$html .= "<h2>No Results</h2>";
			}
		}

		$html .= '</div>';

		echo $html;
	}
}

?>