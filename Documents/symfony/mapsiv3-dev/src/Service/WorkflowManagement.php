<?php
use App\Entity\Flux;
use Symfony\Component\Workflow\WorkflowInterface;
use Symfony\Component\Workflow\StateMachineInterface;

class MyClass
{
    private $blogPublishingWorkflow;

    // this injects the blog_publishing workflow configured before
    public function __construct(WorkflowInterface $blogPublishingWorkflow)
    {
        $this->blogPublishingWorkflow = $blogPublishingWorkflow;
    }

    public function toReview(BlogPost $post)
    {
        // Update the currentState on the post
        try {
            $this->blogPublishingWorkflow->apply($post, 'to_review');
        } catch (LogicException $exception) {
            // ...
        }
        // ...
    }
}