<?php $__env->startSection('header'); ?>

Return Percent By Page / เปอร์เซ็นต์คืนแยกเพจ

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="content-body">

    <div class="container-fluid">



        <div class="card  bg-white mt-1 ml-2">

            <div class="card-header row">

                

                    <div class="col-md-6">

                        <h6 class="card-title">Choose the page and input the number below</h6>

                    </div>




                    <div class="col-md-6">

                        <form action="<?php echo e(route('percent_pages.export_excel')); ?>" class="form form-inline" method="POST">

                        <?php echo csrf_field(); ?>

                            <input class="form-control input-daterange-datepicker" type="text" name="daterange" value="11/01/2022 - 12/31/2022">

                            <input type="submit" class="btn btn-sm btn-info ml-2" value="EXPORT EXCEL">

                        </form>

                    </div>

                

            </div>


            <div class="card-body">

                <div class="basic-form">

                    <form action="<?php echo e(route('percent.page.store')); ?>" method="POST">

                        <?php echo csrf_field(); ?>

                        <div class="row justify-content-around">

                            <div class="col-lg-4">

                                <label>Choose The Date / เลือกวันที่</label>

                                <div class="form-group">

                                    <input type="date" class="form-control" name="date" required placeholder="day/month/year">

                                </div>

                            </div>



                            <div class="col-lg-7">

                                <div class="row">

                                    <div class="col-md-9">

                                        <div class="form-group">

                                            <label>PAGE = CAMPAIGN NAME = PRODUCT NAME<br>ชื่อเพจ=ชื่อแคมเปญ=ชื่อสินค้า</label>

                                            <select id="inputState" name="page_campaign_name" required class="form-control default-select">

                                                <?php $__currentLoopData = $campaign; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <?php

                                                        $page = \App\Models\Page::where('id',$item->page_id)->first();

                                                    ?>

                                                    <?php if(!empty($page)): ?> 

                                                      <option value="<?php echo e($page->id); ?> = <?php echo e($item->campaign_name); ?> = <?php echo e($item->product_name); ?>"><?php echo e($page->name); ?> = <?php echo e($item->campaign_name); ?> = <?php echo e($item->product_name); ?></option>

                                                    <?php endif; ?>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </select>

                                        </div>



                                        <div class="form-row justify-content-between align-items-center mt-4">

                                            <label class="col-3 col-form-label">

                                            <strong class="text-dark">Total Delivery<br>ยอดส่งรวม</strong>

                                            </label>

                                            <div class="col-4">

                                                <input type="number" class="form-control text-center" required name="total_delivery" placeholder="ชิ้น">

                                            </div>

                                            <label class="col-2 col-form-label">PCS</label>

                                        </div>



                                        <div class="form-row justify-content-between align-items-center mt-3">

                                            <label class="col-3 col-form-label">

                                            <strong class="text-dark">Recieved<br>เซ็นรับแล้ว</strong>

                                            </label>

                                            <div class="col-4">

                                                <input type="number" class="form-control text-center" required name="recieved" placeholder="ชิ้น">

                                            </div>

                                            <label class="col-2 col-form-label">PCS</label>

                                        </div>

                                    </div>



                                    <div class="col-md-3 align-self-end">

                                        <button type="submit" class="btn btn-success">ADD / เพิ่ม</button>

                                    </div>                    

                                </div>

                            </div>

                        </div>



                    </form>

                </div>

            </div>

        </div>



        <div class="card bg-white mt-1 ml-2">

            <div class="card-header row">

                <div class="col-md-3  mb-3">

                    <h4 class="card-title">All Page Return Percentage</h4>  

                </div>

                <div class="col-md-5">

                    <div class="basic-form">

                        <form class="form-inline">

                            <div class="form-group mb-2">

                                <label class="mr-2">From:</label>

                                <input type="date" value="<?php echo e(isset($_GET['from']) ? $_GET['from'] : ''); ?>" class="form-control from-date">

                            </div>

                            <div class="form-group mx-sm-3 mb-2">

                                <label class="mr-2">To:</label>

                                <input type="date" value="<?php echo e(isset($_GET['to']) ? $_GET['to'] : ''); ?>" class="form-control to-date">

                            </div>

                            <button type="button" class="btn btn-info btn-sm mb-2 search-btn">Search</button>

                        </form>

                    </div>

                </div>

                <div class="col-md-4">


                <div class="basic-form">

                        <form class="form-inline" action="<?php echo e(route('percent.page.search')); ?>" method="GET">

                            <div class="form-group mx-sm-3 mb-2">

                                <label class="mr-2">From:</label>

                                <input type="search" name="search"  class="form-control" wire:model="search" >

                            </div>


                             <button type="submit" class="btn btn-info btn-sm mb-2">Search</button>

                        </form>

                </div>


                

                    

                </div>

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

                                <th class="text-muted">DATE<br>วันที่</th>

                                <th class="text-muted">PAGE NAME<br>ชื่อเพจ</th>

                                <th class="text-muted">CAMPAIGN NAME = PRODUCT NAME<br>แคมเปญ = ชื่อสินค้า</th>

                                <th class="text-muted">Total Delivery<br>ยอดส่งรวม</th>

                                <th class="text-muted">Recieved<br>เซ็นรับแล้ว</th>

                                <th class="text-muted">%Return<br>% ตีคืน</th>

                                <th class="text-muted">Action</th>

                            </tr>

                        </thead>

                        <tbody>



                            
  
                           <?php $__empty_1 = true; $__currentLoopData = $percentPage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <?php

                                $arr = explode('=',$value->page_campaign_name);

                                 $page = \App\Models\Page::where('id',$arr[0])->first();

                            ?>

                            <?php if(isset($page)): ?>

                                

                            <tr>

                                <td>

                                    <div class="custom-control custom-checkbox checkbox-success check-lg mr-3">

                                        <input type="checkbox" class="custom-control-input" id="customCheckBox1" required="">

                                        <label class="custom-control-label" for="customCheckBox1"></label>

                                    </div>

                                </td>

                                <td><?php echo e(date_format(date_create($value->date),'d M Y')); ?></td>

                                <td><div class="d-flex align-items-center">

                                    <?php if(!empty($page->image)): ?>

                                       <img src="<?php echo e(!empty($page->image) ? asset('storage/'.$page->image) : '/assets/images/avatar/1.jpg'); ?> " class="rounded-lg mr-2" width="24" alt=""/> 

                                    <?php endif; ?>

                                    <span class="w-space-no"><?php echo e($page->name); ?></span></div></td>

                                <td><strong><?php echo e(explode('=',$value->page_campaign_name)[1]); ?> = <?php echo e(explode('=',$value->page_campaign_name)[2]); ?></strong></td>  

                                <td><strong class="text-dark"><?php echo e($value->total_delivery); ?></strong></td>

                                <td><strong class="text-dark"><?php echo e($value->recieved); ?></strong></td>

                                <td><strong class="text-dark"><?php echo e(number_format((float) ($value->recieved/$value->total_delivery) - 1, 2, '.', '')); ?>%</strong></td>

                                <td>

                                    <div class="d-flex">

                                        <a href="<?php echo e(route('percent.edit',$value->id)); ?>" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>

                                        <a href="<?php echo e(route('percent.destroy',$value->id)); ?>" onclick="return confirm('Are you Sure?')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>

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



                <p>Page 1 of 1</p>

            </div>

        </div>



    </div>

</div>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/zkads/domains/zkads.com/public_html/resources/views/admin/percent/percent-by-page/index.blade.php ENDPATH**/ ?>