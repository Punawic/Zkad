
<?php $__env->startSection('header'); ?>
Return Percent By Page
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-body">
    <div class="container-fluid">

        <div class="card  bg-white mt-1 ml-2">
            <div class="card-header">
                <h6 class="card-title">Choose the page and input the number below</h6>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="<?php echo e(route('percent.update',$percentPage->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('put'); ?>
                        <div class="row justify-content-around">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="date" class="form-control" name="date"  value="<?php echo e($percentPage->date); ?>" placeholder="day/month/year">
                                </div>
                            </div>

                            <div class="col-lg-7">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label>PAGE = CAMPAIGN NAME = PRODUCT NAME</label>
                                            <select id="inputState" name="page_campaign_name"  class="form-control default-select">
                                                <?php $__currentLoopData = $campaign; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $page = \App\Models\Page::where('id',$item->page_id)->first();
                                                    ?>
                                                    <?php if(!empty($page)): ?> 
                                                    <option <?php echo e($percentPage->page_campaign_name == $page->id.' = ' . $item->campaign_name . ' = ' .$item->product_name ? 'selected' : ''); ?> value="<?php echo e($page->id); ?> = <?php echo e($item->campaign_name); ?> = <?php echo e($item->product_name); ?>"><?php echo e($page->name); ?> = <?php echo e($item->campaign_name); ?> = <?php echo e($item->product_name); ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="form-row justify-content-between align-items-center mt-4">
                                            <label class="col-3 col-form-label">
                                            <strong class="text-dark">Total Delivery</strong>
                                            </label>
                                            <div class="col-4">
                                                <input type="number" class="form-control text-center" value="<?php echo e($percentPage->total_delivery); ?>" name="total_delivery" placeholder="Total Delivery">
                                            </div>
                                            <label class="col-2 col-form-label">PCS</label>
                                        </div>

                                        <div class="form-row justify-content-between align-items-center mt-3">
                                            <label class="col-3 col-form-label">
                                            <strong class="text-dark">Recieved</strong>
                                            </label>
                                            <div class="col-4">
                                                <input type="number" class="form-control text-center" value="<?php echo e($percentPage->recieved); ?>" name="recieved" placeholder="Recieved">
                                            </div>
                                            <label class="col-2 col-form-label">PCS</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3 align-self-end">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>                    
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/zkads/domains/zkads.com/public_html/resources/views/admin/percent/percent-by-page/create.blade.php ENDPATH**/ ?>