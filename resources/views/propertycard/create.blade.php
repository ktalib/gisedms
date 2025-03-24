<?php
DB::connection('sqlsrv')->select("SELECT @@VERSION AS version");

?>