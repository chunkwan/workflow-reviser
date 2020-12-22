# Workflow Reviser

The WorkflowReviser integrates simple transition conditions into the Symfony Workflow component. This means
easy-to-implement and feature-rich transition checks in your Symfony application!

## Example:

```phpt
// config/packages/workflow.php
// Reknil\WorkflowReviser\Component\TransitionRule\CountEqual;
// Reknil\WorkflowReviser\Component\TransitionRule\NotNull;
// Reknil\WorkflowReviser\Component\WorkflowReviser;

$container->loadFromExtension('framework', [
    // ...
    'workflows' => [
        'blog_publishing' => [
            'supports' => [BlogPost::class],
            // ...
            'places' => [
                'draft',
                'reviewed',
                'rejected',
                'published',
            ],
            'transitions' => [
                'to_review' => [
                    'from' => 'draft',
                    'to' => 'review',
                    'metadata' => [
                        # The transition is allowed only if the all check is success:
                        # Title and Short Description is filled - NotNull
                        # Quantity of images for post equal two - CountEqual
                        # Comments for post more then 5 - CountMore
                        WorkflowReviser::class => [
                            NotNull::class => [
                                // you can pass one or more property (field) of entity class
                                'title' => "Title cannot be blank",
                                'shortDescription' => "Short Description must be filled",
                            ],
                            CountEqual::class => [
                                'images' => [2, ' Quantity of images for post must be two'],
                            ],
                            CountMore::class => [
                                'comments' => [5, ' Comments for post must be more then 5'],
                            ],
                        ],
                    ],
                ],
                // ...
            ],
        ],
    ],
]);
```

## TransitionRule List:

#### DateTime:

````phpt
// ...
DateTimeEqual::class => [
    'createdAt' => [new \DateTime('2020-12-15T15:03:00'), 'Datetime must be equal!'],
],
DateTimeUntil::class => [
    'createdAt' => [new \DateTime('2020-12-15T15:03:00'), 'Datetime must be untill!'],
],
DateTimeBefore::class => [
    'createdAt' => [new \DateTime('2020-12-15T15:03:00'), 'Datetime must be before!'],
],
// ...
````