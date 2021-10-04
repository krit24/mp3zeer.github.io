<?php

class ListsFormatter {

	public static function _run( $rs, $id, $select = array() ){

		$rowArr = array();

		if( empty($rs) ) return $rs;

		foreach ($rs as $row){

			$cell = self::_compile_cell($row, $select);

			$rowArr[] = array(
				'id' => $row->id,
				'cell' => $cell
			); 

		}

		return $rowArr;

	}

	public static function _compile_cell( $row, $select = array() ){

		$cell = array();

		foreach ($select as $key => $value) {
			$cell[] = $row->$value;
		}

		return $cell;

	}

}