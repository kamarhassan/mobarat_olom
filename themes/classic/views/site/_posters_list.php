<div class="posters-list">
    <?php if (empty($posters)): ?>
        <div class="empty">No posters found matching your criteria.</div>
    <?php else: ?>
        <?php foreach ($posters as $poster): ?>
            <div class="poster-item">
                <h3><?php echo CHtml::encode($poster['project_name']); ?></h3>
                <p class="school"><?php echo CHtml::encode($poster['school_name']); ?> (<?php echo CHtml::encode($poster['mobarat_year']); ?>)</p>
                <p><?php echo CHtml::encode($poster['project_description']); ?></p>
                <div class="attachment">
                    <?php echo CHtml::link('View Attachment', $poster['project_attachment']); ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="<?php echo $this->createUrl('allPoster', ['page' => $page - 1]); ?>" class="prev">Previous</a>
    <?php endif; ?>
    
    <span class="page-info">Page <?php echo $page; ?> of <?php echo $totalPages; ?></span>
    
    <?php if ($page < $totalPages): ?>
        <a href="<?php echo $this->createUrl('allPoster', ['page' => $page + 1]); ?>" class="next">Next</a>
    <?php endif; ?>
</div>