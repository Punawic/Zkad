<?php $__env->startSection('header'); ?>

Delivery / &#3605;&#3636;&#3604;&#3605;&#3633;&#3657;&#3591;&#3588;&#3656;&#3634;&#3626;&#3656;&#3591;

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="content-body">

    <div class="container-fluid">



        <div class="card  bg-white mt-1 ml-2">

            <div class="card-header">

                <h6 class="card-title">Create these cost of running page only one time<br>&#3651;&#3626;&#3656;&#3605;&#3657;&#3609;&#3607;&#3640;&#3609;&#3588;&#3619;&#3633;&#3657;&#3591;&#3648;&#3604;&#3637;&#3618;&#3623;</h6>

            </div>

            <div class="card-body">

                <div class="basic-form">

                    <form action="<?php echo e(route('delivery.store')); ?>" method="POST">

                        <?php echo csrf_field(); ?>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>PAGE = CAMPAIGN NAME = PRODUCT NAME<br>&#3594;&#3639;&#3656;&#3629;&#3648;&#3614;&#3592;=&#3594;&#3639;&#3656;&#3629;&#3649;&#3588;&#3617;&#3648;&#3611;&#3597;=&#3594;&#3639;&#3656;&#3629;&#3626;&#3636;&#3609;&#3588;&#3657;&#3634;</label>

                                    <select id="inputState" name="page_campaign_name" required class="form-control default-select">
                                        <?php $__currentLoopData = $campaign; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $page = \App\Models\Page::where('id',$item->page_id)->first();
                                                $exist = false;
                                            ?>
                                            <?php $__currentLoopData = $delivery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(!empty($page) && $value->page_campaign_name == $page->id .' = '. $item->campaign_name .' = '. $item->product_name ): ?>
                                                    <?php
                                                        $exist = true;
                                                    ?>
                                                <?php endif; ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                <?php if(!empty($page) && !$exist): ?> 

                                                  <option value="<?php echo e($page->id); ?> = <?php echo e($item->campaign_name); ?> = <?php echo e($item->product_name); ?>"><?php echo e($page->name); ?> = <?php echo e($item->campaign_name); ?> = <?php echo e($item->product_name); ?></option>

                                                <?php endif; ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>

                                </div>



                                <div class="form-row justify-content-between align-items-center mt-4">

                                    <label class="col-3 col-form-label">COST<br>&#3605;&#3657;&#3609;&#3607;&#3640;&#3609;&#3626;&#3636;&#3609;&#3588;&#3657;&#3634;</label>

                                    <div class="col-6">

                                        <input type="number" class="form-control text-center" required name="cost" placeholder="&#3594;&#3636;&#3657;&#3609;">

                                    </div>

                                    <label class="col-2 col-form-label">PER PCS</label>

                                </div>



                                <div class="form-row justify-content-between align-items-center mt-3">

                                    <label class="col-3 col-form-label">DELIVERY FEES<br>&#3588;&#3656;&#3634;&#3626;&#3656;&#3591;</label>

                                    <div class="col-6">

                                        <input type="number" class="form-control text-center" required name="delivery_fee" placeholder="&#3594;&#3636;&#3657;&#3609;">

                                    </div>

                                    <label class="col-2 col-form-label">PER PCS</label>

                                </div>



                                <div class="form-row justify-content-between align-items-center mt-3">

                                    <label class="col-3 col-form-label">COD</label>

                                    <div class="col-6">

                                        <input type="number" class="form-control text-center" required name="cod" placeholder="&#3594;&#3636;&#3657;&#3609;">

                                    </div>

                                    <label class="col-2 col-form-label">PER PCS</label>

                                </div>

                            </div>



                            <div class="col-md-6 align-self-end">

                                <button type="submit" class="btn btn-success">ADD / &#3648;&#3614;&#3636;&#3656;&#3617;</button>

                            </div>                    

                        </div>

                    </form>

                </div>

            </div>

        </div>



        <div class="card bg-white mt-1 ml-2">

            <div class="card-header">

                <h4 class="card-title">All Delivery</h4>



                

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-responsive-md">

                        <thead>

                            <tr>

                                <th style="width:50px;">

                                    <div class="custom-control custom-checkbox checkbox-success check-lg mr-3">

                                        <input type="checkbox" class="custom-control-input" id="checkAll" required="">

                                        <label class="custom-control-label" for="checkAll"></label>

                                    </div>

                                </th>

                                <th class="text-muted">PAGE NAME<br>&#3594;&#3639;&#3656;&#3629;&#3648;&#3614;&#3592;</th>

                                <th class="text-muted">CAMPAIGN NAME = PRODUCT NAME<br>&#3649;&#3588;&#3617;&#3648;&#3611;&#3597;=&#3626;&#3636;&#3609;&#3588;&#3657;&#3634;</th>

                                <th class="text-muted">COST<br>&#3605;&#3657;&#3609;&#3607;&#3640;&#3609;&#3626;&#3636;&#3609;&#3588;&#3657;&#3634;</th>

                                <th class="text-muted">DELIVERY FEES<br>&#3588;&#3656;&#3634;&#3626;&#3656;&#3591;</th>

                                <th class="text-muted">COD FEES<br> </th>

                                <th class="text-muted">TOTAL COST<br>&#3619;&#3623;&#3617;</th>

                                <th class="text-muted">DATE<br>&#3623;&#3633;&#3609;&#3605;&#3636;&#3604;&#3605;&#3633;&#3657;&#3591;&#3588;&#3656;&#3634;&#3626;&#3656;&#3591;</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php $__empty_1 = true; $__currentLoopData = $delivery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <?php

                                $arr = explode('=',$value->page_campaign_name);

                                $page = \App\Models\Page::where('id',$arr[0])->first();

                                //  $total = 0;



                            ?>

                            <?php if(isset($page)): ?>

                                

                            

                            <tr>

                                <td>

                                    <div class="custom-control custom-checkbox checkbox-success check-lg mr-3">

                                        <input type="checkbox" class="custom-control-input" id="customCheckBox1" required="">

                                        <label class="custom-control-label" for="customCheckBox1"></label>

                                    </div>

                                </td>

                                <td><div class="d-flex align-items-center">

                                    <?php if(!empty($page->image)): ?>

                                       <img src="<?php echo e(!empty($page->image) ? asset('storage/'.$page->image) : '/assets/images/avatar/1.jpg'); ?> " class="rounded-lg mr-2" width="24" alt=""/> 

                                    <?php endif; ?>

                                    <span class="w-space-no"><?php echo e($page->name); ?></span></div></td>

                                <td><strong><?php echo e(explode('=',$value->page_campaign_name)[1]); ?> = <?php echo e(explode('=',$value->page_campaign_name)[2]); ?></strong></td>

                                <td><strong class="text-dark"><?php echo e($value->cost); ?></strong></td>

                                <td><strong class="text-dark"><?php echo e($value->delivery_fee); ?></strong></td>

                                <td><strong class="text-dark"><?php echo e($value->cod); ?></strong></td>

                                <td><strong class="text-dark"><?php echo e($value->cost+$value->delivery_fee+$value->cod); ?></strong></td>

                                

                                <td><?php echo e(date_format($value->created_at,'d M Y')); ?></td>

                                <td>

                                    <div class="d-flex">

                                        <a href="<?php echo e(route('delivery.edit',$value->id)); ?>" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>

                                        <a href="<?php echo e(route('delivery.destroy',$value->id)); ?>" onclick="return confirm('Are you Sure?')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>

                                    </div>

                                </td>

                            </tr>

                             

                            <?php endif; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                <tr>

                                    <td colspan="7" class="text-center">Not Available</td>

                                </tr>

                            <?php endif; ?>

                    

                        </tbody>

                    </table>

                </div>

                

            </div>

        </div>



    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/zkads/domains/zkads.com/public_html/resources/views/admin/delivery/index.blade.php ENDPATH**/ ?>