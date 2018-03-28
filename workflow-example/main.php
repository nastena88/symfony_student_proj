<?php
require dirname(__DIR__).'/vendor/autoload.php';
use Symfony\Component\Workflow\DefinitionBuilder;
use Symfony\Component\Workflow\Transition;
use Symfony\Component\Workflow\Workflow;
use Symfony\Component\Workflow\MarkingStore\SingleStateMarkingStore;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\Workflow\Dumper\GraphvizDumper;

class Leave {
	public $applied_by;
	public $leave_on;
	public $status;
}

$builder = new DefinitionBuilder();
$builder->addPlaces(['applied','in_process','approved','rejected']);

$builder->addTransition(new Transition('to_process','applied','in_process'));
$builder->addTransition(new Transition('approve','in_process','approved'));
$builder->addTransition(new Transition('reject', 'in_process', 'rejected'));

$definition = $builder->build();

// $dumper = new GraphvizDumper();
// echo $dumper->dump($definition);

$marking = new SingleStateMarkingStore('status');

$leaveWorkflow = new Workflow($definition, $marking);

$registry = new Registry();
$registry->add($leaveWorkflow, Leave::class);

$leave = new Leave();
$leave->applied_by = "Jon";
$leave->leave_on = "1998-12-12";
$leave->status = 'applied';

$workflow = $registry->get($leave);

echo "Can we approve the leave now? ". $workflow->can($leave, 'approve'). "\r\n";
echo "Can we approve the start process now? ".$workflow->can($leave, 'to_process'). "\r\n";

$workflow->apply($leave, 'to_process');
echo "Can we approve the leave now? ". $workflow->can($leave, 'approve'). "\r\n";
echo $leave->status."\r\n";

$workflow->apply($leave, 'approve');
echo $leave->status."\r\n";
