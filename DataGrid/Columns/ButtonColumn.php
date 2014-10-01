<?php

namespace DataGrid;

use \Nette\Utils\Html,
    \Nette\Application\UI\Presenter;

/**
 * Description of \DataGrid\ButtonColumn
 *
 * @author mesour <matous.nemec@mesour.com>
 * @package DataGrid
 */
class ButtonColumn extends BaseColumn {

	/**
	 * Possible option key
	 */
	const TEXT = 'text',
	    	BUTTONS_OPTION = 'buttons_option';

	/**
	 * @param \Nette\Application\UI\Presenter
	 * @param array $option
	 */
	public function __construct(Presenter $presenter, array $option = array()) {
		parent::__construct($presenter, $option);
	}
	
	public function setText($text) {
		$this->option[self::TEXT] = $text;
		return $this;
	}

	public function setButtons(array $buttons_option) {
		$this->option[self::BUTTONS_OPTION] = $buttons_option;
		return $this;
	}

	/**
	 * Create HTML header
	 * 
	 * @return \Nette\Utils\Html
	 * @throws \DataGrid\Grid_Exception
	 */
	public function createHeader() {
		parent::createHeader();

		if (array_key_exists(self::BUTTONS_OPTION, $this->option) === FALSE) {
			throw new Grid_Exception('Option \DataGrid\ButtonColumn::BUTTONS_OPTION is required.');
		}
		if (is_array($this->option[self::BUTTONS_OPTION]) === FALSE) {
			throw new Grid_Exception('Option \DataGrid\ButtonColumn::BUTTONS_OPTION must be an array.');
		}
		if (array_key_exists(self::TEXT, $this->option) === FALSE) {
			throw new Grid_Exception('Option \DataGrid\ButtonColumn::TEXT is required.');
		}
		$th = Html::el('th', array('class' => 'act buttons-count-' . count($this->option[self::BUTTONS_OPTION])));
		$th->setText($this->option[self::TEXT]);
		return $th;
	}

	/**
	 * Create HTML body
	 *
	 * @param mixed $data
	 * @param string $container
	 * @return Html|void
	 */
	public function createBody($data, $container = 'td') {
		parent::createBody($data);

		$span = Html::el($container, array('class' => 'right-buttons'));
		$count = count($this->option[self::BUTTONS_OPTION]);
		$container = Html::el('div', array('class' => 'thumbnailx buttons-count-' . $count));

		foreach ($this->option[self::BUTTONS_OPTION] as $button) {
			$button = new Button($button, $this->presenter, $this->data);
			$container->add($button->create() . ' ');
		}
		$span->add($container);
		return $span;
	}

}