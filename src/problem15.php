<?php


var_dump(memory_get_usage());
$n = 400;	//note: only built for n as a perfect sq. could easily change,
$root = sqrt($n); //but too lazy atm. Will fix in future graph implementations.

$graph = new Graph($n);

//$graph->printGraph();

//$paths = $graph->countTraversals2($graph->vertices[0], $n-1);
$paths = $graph->countTraversals();

print "On a $root x $root grid, there are $paths unique paths from the top left corner to the bottom left corner.\n";
var_dump(memory_get_usage());

class Graph
{
	public $vertices;

	public function __construct($n) 
	{
		$this->vertices = [];
		$rows = sqrt($n);

		if ($rows !== floor($rows)) {
			throw new Exception('Only accepts perfect squares');
		}

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

	/**
	 * maxes out memory when using grids larger than 5x5 (max mem 137 megs)
	 */
	public function countTraversals2($vertex, $destination) //, $moves = [], $count = 0)
	{
		static $moves = [];
		static $count = 0; 

		var_dump(memory_get_usage());

		//if (272184 < memory_get_usage()) {
		//	print_r([$vertex, $destination, $moves, $count]);
		//}

		if (empty($vertex)) {
			return $count;
		}

		if ($vertex->name == $destination) { //retreat
			$count++;
			return $this->countTraversals2(array_pop($moves), $destination);//, $moves, $count);
		} elseif ($vertex->hasUnvisitedEdges()) { //advance
			array_push($moves, $vertex);
			return $this->countTraversals2($this->getUnvisitedVertex($vertex), $destination);//, $moves, $count);
		} else { //retreat
			$vertex->cleanEdges();
			return $this->countTraversals2(array_pop($moves), $destination);//, $moves, $count);
		}
	}

	/**
	 * barely uses a meg on 20x20 grid
	 */
	public function countTraversals()
	{
		//var_dump(memory_get_usage());
		$visited = [];

		for ($i = 0; $i < count($this->vertices); $i++) {
			if (empty($visited[$i])) {
				$count = $this->traverseDepthFirst($i, $visited);
			}
		}

		var_dump($count);
	}

	private function traverseDepthFirst($i, &$visited)
	{
		//var_dump(memory_get_usage());
		static $count = 0;

		$visited[$i] = true;
		for ($edge = $this->vertices[$i]->firstEdge; $edge !== null; $edge = $edge->next) {
			if (empty($visited[$edge->destination])) {
				print "{$this->vertices[$i]->name} --> {$this->vertices[$edge->destination]->name}\n";
				$this->traverseDepthFirst($edge->destination, $visited);
			} else {
				$count += $this->vertices[$i]->getEdgeCount();
			}
		}	

		return $count;
	}

	private function getUnvisitedVertex(Vertex $vertex)
	{
		$edge = $vertex->getUnvisitedEdge();

		return $this->vertices[$edge->destination];
	}
}

class Edge
{
	public $destination;
	public $next;
	public $visited;

	public function __construct($destination)
	{
		$this->destination = $destination;
		$this->visited = false;
	}
}

class Vertex
{
	public $name;
	public $firstEdge;

	public function __construct($name)
	{
		$this->name = $name;
	}

	public function getEdgeCount()
	{
		$count = 0;
		$current = $this->firstEdge;

		while ($current !== null) {
			$current = $current->next;
			$count++;
		}

		return $count;
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

	public function getUnvisitedEdge()
	{
		$current = $this->firstEdge;

		while ($current !== null) {
			if ($current->visited == false) {
				$current->visited = true;
				return $current;
			}
			$current = $current->next;
		}

		return false;
	}

	public function cleanEdges()
	{
		$current = $this->firstEdge;

		while ($current !== null) {
			$current->visited = false;
			$current = $current->next;
		}
	}

	public function hasUnvisitedEdges()
	{
		$current = $this->firstEdge;

		while ($current !== null) {
			if ($current->visited == false) {
				return true;
			}
			$current = $current->next;
		}

		return false;
	}
}
