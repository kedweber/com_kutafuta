<?php

class ComKutafutaModelTerms extends ComDefaultModelDefault
{
	public function __construct(KConfig $config) {
		parent::__construct($config);

		$this->_state
			->insert('route_id', 'int')
			->insert('lang', 'string', substr(JFactory::getLanguage()->getTag(), 0, 2));
	}

	protected function _buildQueryWhere(KDatabaseQuery $query) {
		$state = $this->_state;
		$i = 1;

		parent::_buildQueryWhere($query);

		if($state->route_id) {
			$query->where('tbl.route_id', '=', $state->route_id);
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
			$query->group('tbl.route_id');
		}
	}

	protected function _buildQueryJoins(KDatabaseQuery $query) {
		$state = $this->_state;

		parent::_buildQueryJoins($query);

		if($state->search) {
			$query->join('inner', '#__routes AS searches', 'tbl.route_id = searches.id');
		}
	}

	protected function _buildQueryColumns(KDatabaseQuery $query) {
		$state = $this->_state;

		parent::_buildQueryColumns($query);

		if($state->search) {
			$query->select('searches.*');
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