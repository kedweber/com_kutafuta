<?php

class ComKutafutaModelTerms extends ComDefaultModelDefault
{
	public function __construct(KConfig $config) {
		parent::__construct($config);

		$this->_state
			->insert('table', 'string')
            ->insert('row'  , 'int')
			->insert('lang' , 'string', substr(JFactory::getLanguage()->getTag(), 0, 2));
	}

	protected function _buildQueryWhere(KDatabaseQuery $query) {
		$state = $this->_state;
		$i = 1;

		parent::_buildQueryWhere($query);

		if($state->table) {
			$query->where('tbl.table', '=', $state->table);
		}

        if($state->row) {
			$query->where('tbl.row', '=', $state->row);
		}

		if($state->lang) {
			$query->where('tbl.lang', '=', $state->lang);
		}

        if($state->search) {
            $query->where($this->_matchAgainst(), null, null);
        }
	}

	protected function _buildQueryGroup(KDatabaseQuery $query) {
		$state = $this->_state;

		parent::_buildQueryGroup($query);

		if($state->search) {
			$query->group('tbl.table');
			$query->group('tbl.row');
		}
	}

	protected function _buildQueryColumns(KDatabaseQuery $query) {
		$state = $this->_state;

		parent::_buildQueryColumns($query);

		if($state->search) {
            $query->select($this->_matchAgainst() . ' AS relevance');
		}
	}

    protected function _buildQueryOrder(KDatabaseQuery $query) {
        $state = $this->_state;

        parent::_buildQueryOrder($query);

        if($state->search) {
            $query->order('relevance', 'DESC');
        }
    }

    private function _matchAgainst() {
        $state = $this->_state;

        if($state->search) {
            $sql = '';
            $terms = '';
            foreach(explode(' ',$state->search) as $term) :
                $terms .= '+' . $term . ' ';
            endforeach;
            $sql .= 'MATCH(tbl.value) AGAINST (\''. strtoupper($terms) .'*\')';
        }

        return $sql;
    }
}