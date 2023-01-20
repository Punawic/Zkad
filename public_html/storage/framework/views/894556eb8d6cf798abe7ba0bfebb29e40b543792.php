<?php $__env->startSection('header'); ?>
Dashboard
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>



<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
           
            <div class="col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row mx-0">
                            <div class="col-sm-12 col-lg-4 px-0">
                                <h2 class="fs-40 text-black font-w600"><?php echo e($todayProfitLose); ?> <small class="fs-18 ml-2 font-w600 mb-1">THB</small></h2>
                                <p class="font-w100 fs-20 text-black">Total Profit/Lose Today</p>
                                <div class="justify-content-between border-0 d-flex fs-14 align-items-end">
                                    <a href="javascript:void(0);" class="text-primary">View more <i class="las la-long-arrow-alt-right scale5 ml-2"></i></a>
                                    <div class="text-right">
                                        <span class="peity-primary" data-style="width:100%;">0,2,1,4</span>
                                        <?php
                                            $yesterdays = !empty($yesterdaySale->sale) ? $yesterdaySale->sale : 0;
                                        ?>
                                        <h3 class="mt-2 mb-1"><?php echo e(round(($yesterdays/(($totalSale == 0) ? 1 : $totalSale)) * 100 )); ?>%</h3>
                                        <span>than last day</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-8 px-0">
                                <canvas id="ticketSold" height="200"></canvas>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="">
                    <div class="card shadow-none rounded-0 bg-white h-auto mb-0">
                        <div class="card-body text-center event-calender pb-2">
                            <input type='text' class="form-control d-none" id='datetimepicker1' />
                        </div>
                    </div>
                   
                </div>
            </div>

            <div class="col-xl-12">
                <div class="card border-radius-none">
                    <div class="card-body">
                        <form action="" method="GET">
                            
                                <div class="row">
                                    <div class="col-md-5">
                                        <input type="search" placeholder="Search by" name="search" class="form-control" >
    
                                    </div>
                                    <div class="col-md-7 text-right border-radius">
                                        <button class="btn btn-primary border-radius-50"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                          </svg> FIND</button>
                                    </div>

                                </div>
                            
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-12">
                <div class="row">
                    <?php $__empty_1 = true; $__currentLoopData = $campaign; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                     <?php
                         $page = \App\Models\Page::where('id',$value->page_id)->first();
                         $user = \App\Models\User::where('id',$value->user_id)->first();
                        //  $sale = \App\Models\Sale::where('page_compaign_name', $page->name .' = ' . )
                         $today = new \App\Http\Controllers\HomeController();
                         $totalProfileLoss = $today->todayProfite($value->id);
                         $todayProfileLoss = $today->todayProfite(null, $value->id)['todayProfitLose'];
                     ?>
                     <?php if(!empty($page) && !empty($user)): ?>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p><?php echo e($user->name); ?></p>
                                         <h4><?php echo e($page->name); ?> #<?php echo e($key+1); ?></h4>
                                         
                                         <p class="font-12">Total Profit/Loss = <?php echo e(number_format((float)$totalProfileLoss['totalProfitLoss'], 2, '.', '')); ?> THB</p>
                                         <p class="font-12">Today Profit/Loss = <?php echo e($todayProfileLoss); ?> THB</p>
                                    </div>
                                    <div class="col-md-4">
                                        <img src="<?php echo e(!empty($value->image) ? asset('storage/'.$value->image) : asset('assets/images/user-1.png')); ?>" width="100px" alt="">
                                    </div>
                                </div>
                                <div class="rowmt-2">
                                    <div class="col-md-12">

                                        <span><?php echo e($value->keyword); ?></span>
                                        
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-5">
                                        <p><span class="color-blue">SALE</span> <?php echo e($totalProfileLoss['total_sale']); ?> PCS</p>
                                        <a href="<?php echo e(route('campaign.edit',$value->id)); ?>" class="btn btn-rounded btn-outline-dark px-2">See more</a>
                                    </div>
                                    <div class="col-md-7">
                                        <p><span class="color-blue">RETURN</span> <?php echo e(number_format((float)$totalProfileLoss['return_percent'], 2, '.', '')); ?>%</p>
                                        
                                        
                                        
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <?php endif; ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        
                    <?php endif; ?>
                    
                   
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <?php echo $__env->make('include.dashboard-chart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/zkads/domains/zkads.com/public_html/resources/views/admin/index.blade.php ENDPATH**/ ?>