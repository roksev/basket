<?php
namespace Rok\BasketBundle\Entity;

class Pridem
{
	protected $pridem;
	
	protected $termin;
	
	public function getPridem()
	{
		return $this->pridem;
	}
	public function setPridem($task)
	{
		$this->pridem = $task;
	}
	
	public function getTermin()
	{
		return $this->termin;
	}
	public function setTermin($dueDate = null)
	{
		$this->termin = $dueDate;
	}
}