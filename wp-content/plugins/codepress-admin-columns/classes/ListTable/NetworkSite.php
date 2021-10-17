<?php

namespace AC\ListTable;

use AC\ListTable;
use WP_MS_Sites_List_Table;

class NetworkSite implements ListTable {

	use WpListTableTrait;

	public function __construct( WP_MS_Sites_List_Table $table ) {
		$this->table = $table;
	}

	public function get_column_value( $column, $id ) {
		ob_start();

		$method = 'column_' . $column;

		$blog = get_site( $id );

		if ( ! $blog ) {
			return null;
		}

		if ( method_exists( $this->table, $method ) ) {
			call_user_func( [ $this->table, $method ], $blog->to_array() );
		} else {
			$this->table->column_default( $blog->to_array(), $column );
		}

		return ob_get_clean();
	}

}