#!/usr/bin/php
<?php

$graph = new Graph(9);

$graph->printGraph();

class Graph
{
	public $vertices;

	public function __construct($n) {
		$this->vertices = [];
		$rows = sqrt($n);

		for ($i = 0; $i < $n; $i++) {
			$this->vertices[] = new Vertex($i);

			if ($i+1 < $n) {
				if (($i+1) % $rows !== 0) {
					$this->vertices[$i]->addEdge(new Edge($i+1));
				}

				if ($i+3 < $n) {
					$this->vertices[$i]->addEdge(new Edge($i+3));
				}
			}
		}
	}

	public function printGraph()
	{
		foreach ($this->vertices as $vertex) {
			print "Vertex: $vertex->name\n";	
			print "Edges:\n";
			$this->printEdges($vertex, $vertex->firstEdge);
			print PHP_EOL;
		}
	}

	private function printEdges($vertex, $edge)
	{
		if (empty($edge)) {
			return;
		} else {
			print "$vertex->name ---> $edge->destination\n";
			$this->printEdges($vertex, $edge->next);
		}
	}
}

class Edge {
	public $destination;
	public $next;

	public function __construct($destination)
	{
		$this->destination = $destination;
	}
}

class Vertex {
	public $name;
	public $firstEdge;

	public function __construct($name)
	{
		$this->name = $name;
	}


	public function addEdge($edge)
	{
		if (empty($this->firstEdge)) {
			$this->firstEdge = $edge;
			return;
		}

		$current = $this->firstEdge;

		while ($current->next !== null) {
			$current = $current->next;
		}

		$current->next = $edge;
	}
}
