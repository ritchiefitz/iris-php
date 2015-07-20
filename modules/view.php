<?php

class IrisView {
	public function displayJournalSidebar($journals) {
		foreach ($journals as $journal) {
			echo '<h2>'.$journal['title'].'</h2>';
			echo '<ul>';
			echo '<li><a href="pages/add_page.php?jid='.$journal['jid'].'">Add Page</a></li>';
			echo '<li><a href="pages/view_journal.php?jid='.$journal['jid'].'">Read Journal</a></li>';
			echo '<li><a href="pages/edit_journal.php?jid='.$journal['jid'].'">Edit Journal</a></li>';
			echo '</ul>';
		}
	}

	public function displayJournals($journals) {

		echo '<div class="journals">';
		foreach ($journals as $journal) {
			echo '<a class="journal" href="pages/view_journal.php?jid='.$journal['jid'].'">';
			echo '<div class="title">'.$journal['title'].'</div>';
			echo '</a>';
		}
		echo '</div>';
	}

	public function displayJournal($journal, $pages) {
		
		echo '<div id="flipbook">';
		echo '<div class="hard">';
		echo '<div class="title">'.$journal['title'].'</div>';
		echo '</div>';
		echo '<div class="hard"></div>';

		foreach ($pages as $page) {
			// $date = date_create_from_format('j-M-Y', );
			$date = DateTime::createFromFormat('Y-m-d', $page['event_date']);

			echo '<div class="journal-page-wrapper">';
			echo '<div class="journal-page">';
			echo '<div class="title">'.$page['title'].'</div>';
			echo '<div class="date">'.$date->format('F j, Y').'</div>';
			echo '<div class="page-number">'.$page['page_number'].'</div>';
			echo '<div class="journal-content">'.$page['content'].'</div>';
			echo '</div> <!-- End of Journal Page -->';
			?>
				<form id="edit-form" action="edit_page.php" method="get">
					<input type="hidden" name="jid" value="<?php echo $page['jid']; ?>">
					<input type="hidden" name="pid" value="<?php echo $page['pid']; ?>">
					<input type="submit" id="edit-submit" class="btn btn-default" value="Edit Page">
				</form>
			<?php
			echo '</div> <!-- End of Journal Page Wrapper -->';
		}

		echo (count($pages) % 2 == 0) ? '' : '<div></div>';
		echo '<div class="hard"></div>';
		echo '<div class="hard last"></div>';
		echo '</div> <!-- End of flipbook -->';
	}

	public function displaySearchResults($matched_pages) {
		$html = '<div class="matched-results">';
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

		$html .= '</div>';

		return $html;
	}
}

?>