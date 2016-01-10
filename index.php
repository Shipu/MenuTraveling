<?php

function menuTree($dataset) {
	$tree = array();
	foreach ($dataset as $id=>&$node) {

		if ($node['parent'] === null) {
			$tree[$id]=&$node;

		} else {
			if (!isset($dataset[$node['parent']]['child']))
				$dataset[$node['parent']]['child'] = array();

			$dataset[$node['parent']]['child'][$id] = &$node;
		}

	}

	return $tree;
}


$dataset[0] = array(
		'name'=>'Menu 1 ',
		'parent'=>null
	);
$dataset[1] = array(
		'name'=>'Menu 2',
		'parent'=>null
	);
$dataset[2] = array(
		'name'=>'Menu 3',
		'parent'=>null
	);

$dataset[3] = array(
		'name'=>'Menu 4 (2.1)',
		'parent'=>1
	);

$dataset[4] = array(
		'name'=>'Menu 5 (1.1)',
		'parent'=>0
	);
$dataset[5] = array(
		'name'=>'Menu 6 (2.1.1)',
		'parent'=>3
	);
$dataset[6] = array(
		'name'=>'Menu 7 (1.1.1)',
		'parent'=>4
	);

$dataset[7] = array(
		'name'=>'Menu 8 (3.1)',
		'parent'=>2
	);

$dataset[8] = array(
		'name'=>'Menu 9 (2.2)',
		'parent'=>1
	);

$dataset[9] = array(
		'name'=>'Menu 10',
		'parent'=>null
	);



$tree = menuTree($dataset);


print '<h2>Tree</h2>';
display_menu($tree);


print '<h2>Dataset</h2>';
print '<pre>';
print_r($dataset);
print '<pre>';



function display_menu($nodes, $indent=0) {
	
	foreach ($nodes as $node) {
		print str_repeat('&nbsp;',$indent*4);
		print $node['name'];
		print '<br/>';
		if (isset($node['child']))
			display_menu($node['child'],$indent+1);
	}
}