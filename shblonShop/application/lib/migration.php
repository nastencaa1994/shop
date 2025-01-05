<?php
use application\lib\MigrationExecFilesInDB;

$migrate = new MigrationExecFilesInDB();

$migrate->run();
