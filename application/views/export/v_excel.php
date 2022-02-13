<?php
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$file_name.'.xlsx"');
header('Cache-Control: max-age=0');

$Writer = PHPExcel_IOFactory::createWriter($PHPExcel,'Excel2007');
$Writer->save('php://output');
?>