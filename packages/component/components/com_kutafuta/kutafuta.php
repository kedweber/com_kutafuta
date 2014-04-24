<?php

KService::setAlias('com://site/kutafuta.model.terms', 'com://admin/kutafuta.model.terms');
KService::setAlias('com://site/kutafuta.database.row.term', 'com://admin/kutafuta.database.row.term');

echo KService::get('com://site/kutafuta.dispatcher')->dispatch();