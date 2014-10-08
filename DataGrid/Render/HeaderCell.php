<?php

namespace DataGrid\Render;

use \DataGrid\Column;

/**
 * Description of \DataGrid\Render\HeaderCell
 *
 * @author mesour <matous.nemec@mesour.com>
 * @package DataGrid
 */
abstract class HeaderCell{

	/**
	 * @var \DataGrid\Column\IColumn
	 */
	protected $column;

	public function __construct(Column\IColumn $column) {
		$this->column = $column;
	}

	abstract public function create();

}