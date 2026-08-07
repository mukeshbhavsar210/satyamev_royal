<?php
    $floatingTips = [
        [
            'id' => 'completed-projects',
            'title' => 'Completed Projects',
            'projects' => [
                'Satyamev Royal Parisar',
                'Satyamev Aawaass Strawberry',
                'Satyamev Femosa',
                'Satyamev Riviera',
                'Satyamev Riviera',
                'Satyamev Chhavni 5',                
                'Satyamev Chhavni 7',
                'Satyamev Royal Parisar',
                'Satyamev Aawaass Strawberry',
                'Satyamev Femosa',
                'Satyamev Riviera',
                'Satyamev Riviera',
                'Satyamev Chhavni 5',                
                'Satyamev Chhavni 7'
            ]
        ],
        [
            'id' => 'ongoing-projects',
            'title' => 'Ongoing Projects',
            'projects' => [
                'Satyamev S-Cube',
                'Satyamev S-Cube',
                'Satyamev S-Cube',
                'Satyamev S-Cube',
            ]
        ],
        [
            'id' => 'upcoming-projects',
            'title' => 'Upcoming Projects',
            'projects' => [
                'Satyamev Royal 6',
            ]
        ],
    ];
?>

<div class="floating-tips w-dyn-list">
    <div role="list" class="floating-tips_list w-dyn-items">
        <?php foreach ($floatingTips as $tip): ?>
            <div floating-tip="<?= $tip['id']; ?>" role="listitem" class="floating-tip w-dyn-item">
                <div class="floating-tip-card">
                    <div class="floating-tip-card_t">
                        <h1 class="h5"><?= $tip['title']; ?></h1>
                    </div>

                    <div class="floating-tip-card_b">
                        <ul class="p1">
                            <?php foreach ($tip['projects'] as $project): ?>
                                <li><?= htmlspecialchars($project); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- <div class="floating-tips w-dyn-list">
    <div role="list" class="floating-tips_list w-dyn-items">
        <div floating-tip="completed-projects" role="listitem" class="floating-tip w-dyn-item">
            <div class="floating-tip-card">
                <div class="floating-tip-card_t">
                    <h1 class="h5">Completed Projects</h1>
                </div>
                <div class="floating-tip-card_b">
                    <ul class="p1">
                        <li>Satyamev Royal Parisar</li>
                        <li>Satyamev S-Cube</li>
                        <li>Satyamev S-Cube</li>
                        <li>Satyamev S-Cube</li>
                    </ul>
                </div>
            </div>
        </div>

        <div floating-tip="ongoing-projects" role="listitem" class="floating-tip w-dyn-item">
            <div class="floating-tip-card">
                <div class="floating-tip-card_t">
                    <h1 class="h5">Ongoing Projects</h1>
                </div>
                <div class="floating-tip-card_b">
                    <ul class="p1">
                        <li>Satyamev S-Cube</li>
                        <li>Satyamev S-Cube</li>
                        <li>Satyamev S-Cube</li>
                        <li>Satyamev S-Cube</li>
                    </ul>
                </div>
            </div>
        </div>
            
        <div floating-tip="upcoming-projects" role="listitem" class="floating-tip w-dyn-item">
            <div class="floating-tip-card">
                <div class="floating-tip-card_t">
                    <h1 class="h5">Upcoming Projects</h1>
                </div>
                <div class="floating-tip-card_b">
                    <ul class="p1">
                        <li>Satyamev Royal 6</li>                        
                    </ul>
                </div>                    
            </div>
        </div>
    </div>
</div> -->