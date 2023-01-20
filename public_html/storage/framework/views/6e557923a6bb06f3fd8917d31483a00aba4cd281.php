<?php $__env->startSection('header'); ?>

Campaign / แคมเปญ

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>







<!--**********************************

    Content body start

***********************************-->

<div class="content-body ">

    <!-- row -->

    <div class="container-fluid">

        <div class="row">

           

            <div class="col-xl-9 col-lg-9">

                <form action="<?php echo e(isset($campaign) ? route('campaign.update',$campaign->id) : route('campaign.store')); ?>" method="POST" enctype="multipart/form-data">

                    <?php echo csrf_field(); ?>

                    <?php if(isset($campaign)): ?>

                        <?php echo method_field('put'); ?>

                    <?php endif; ?>

                <div class="card">

                    <div class="card-header">

                        <h4 class="card-title">Create New Campaign / สร้างแคมเปญใหม่</h4>

                    </div>

                    <div class="card-body">

                        <div class="basic-form">

                            

                                <div class="form-row">

                                    <div class="form-group col-md-6">

                                        <label>CAMPAIGN ID</label>

                                        <div class="input-group mb-3">

                                           <input type="text" class="form-control" readonly required name="campaign_id" value="<?php echo e(isset($campaign) ? $campaign->campaign_id : 'กดปุ่มสีน้ำเงินเพื่อสุ่มรหัสแคมเปญ'); ?>">

                                            <div class="input-group-append">

                                                <button class="btn btn-primary random-btn" type="button">random code</button>

                                            </div>

                                       </div>

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label>CAMPAIGN NAME</label>

                                        <input type="text" class="form-control" name="campaign_name" required value="<?php echo e(isset($campaign) ? $campaign->campaign_name : ''); ?>"  placeholder="ชื่อแคมเปญ">

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label>PAGE / เลือกเพจ</label>

                                        <select name="page_id" class="form-control" required>

                                            <?php $__currentLoopData = \App\Models\Page::orderBy('id','desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                               <option <?php echo e(isset($campaign) && $campaign->page_id == $item->id ? 'selected' : ''); ?> value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>        

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </select>

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label>Budget per day / งบประมาณต่อวัน</label>

                                        <input type="number" class="form-control" name="budget" required  value="<?php echo e(isset($campaign) ? $campaign->budget : ''); ?>">

                                    </div>

                                    <div class="form-group col-md-6">

                                        

                                        <label>Keyword / กลุ่มเป้าหมาย</label>

                                        <div id="box">



                                            <ul>

                                               <?php if(isset($campaign)): ?>

                                               <input type="text" id="type" class="form-control" name="" value="" placeholder="Keyword">

                                                <?php $__currentLoopData = explode(',',$campaign->keyword); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <?php if(!empty($item)): ?>

                                                        <li><span><?php echo e($item); ?><input type="hidden" name="key[]" value="<?php echo e($item); ?>" /><a href="javascript:void(0);" class="mt-1" onclick="closer()">x</a></span></li>

                                                    <?php endif; ?>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                <?php else: ?>

                                                    <li>

                                                        <input type="text" id="type" class="form-control" name="" required value="<?php echo e(isset($campaign) ? $campaign->keyword : ''); ?>" placeholder="Keyword">

                                                    </li>

                                                <?php endif; ?>

                                                

                                            </ul>

                                        </div>

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label>USER DUTIES / พนักงานดูแลเพจ</label>

                                        <input type="text" class="form-control" name="duty" required value="<?php echo e(isset($campaign) ? $campaign->duty : ''); ?>" placeholder="USER DUTIES">

                                        

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label>PRODUCT NAME / ชื่อสินค้า</label>

                                        <input type="text" class="form-control" name="product_name" required value="<?php echo e(isset($campaign) ? $campaign->product_name : ''); ?>" placeholder="PRODUCT NAME">

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label>LOCATION / จังหวัด</label>

                                        <input type="text" class="form-control" name="location" required value="<?php echo e(isset($campaign) ? $campaign->location : ''); ?>" placeholder="LOCATION">

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label>SALE PRICE / ราคาขายต่อออเดอร์</label>

                                        <input type="text" class="form-control" name="sale_price" required value="<?php echo e(isset($campaign) ? $campaign->sale_price : ''); ?>" placeholder="SALE PRICE">

                                    </div>

                                    <div class="form-group col-md-12">

                                        <div class="card">

                                            <div class="card-header">

                                                <h4 class="card-title">Description * / ใส่แคปชั่น รายละเอียด</h4>

                                            </div>

                                            <div class="card-body">

                                                <div class="summernote"></div>

                                                <textarea name="description" class="hidden text-area"><?php echo isset($campaign) ? $campaign->description : ''; ?></textarea>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-12 text-right">

                                        <button type="submit" class="btn btn-success description-save">Save</button>

                                    </div>

                                </div>                            

                        </div>

                    </div>

                </div>

            </div>



            <div class="col-xl-3 col-lg-3">

                <div class="" >

                 

                    <div class="card shadow-none rounded-0 bg-transparent h-auto mb-0">

                        <div class="row">

                           <div class="col-md-12 text-right">

                              <!-- Default switch -->

                              

                            <div class="custom-control custom-switch">

                                

                                <input type="checkbox" name="status" <?php echo e(isset($campaign) && $campaign->status == 1 ? 'checked' : ''); ?> class="custom-control-input" id="customSwitches">

                                <label class="custom-control-label" for="customSwitches">Active / Close <br> สถานะเปิด / ปิด</label>

                            </div>

                           </div>

                            <div class="col-md-12">

                                <div class="card">

                                    <div class="card-header d-flex justify-content-between">

                                        <p>Images<br>อัพโหลดวิดีโอ</p>

                                        <a href="javascript:void(0)" onclick="$('.image-campain').click()" class="text-success">+Upload</a>

                                        <input type="file" class="hidden image-campain" name="image">

                                    </div>

                                    <div class="card-body">

                                        <div class="form-group">

                                            <?php if(isset($campaign)): ?>

                                              <img src="<?php echo e(!empty($campaign->image) ? asset('storage/'.$campaign->image) : asset('assets/images/user-1.png')); ?>" width="100px" alt="">

                                                

                                            <?php endif; ?>

                                            

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <?php if(isset($campaign)): ?>

                            <div class="col-md-12">

                                <div class="card">

                                    <div class="card-header border-0 pb-0">

                                        <h4 class="card-title">Sales Summary</h4>

                                        

                                    </div>

                                    <div class="card-body pt-2">

                                        <div class="border p-3 d-flex justify-content-between fs-14 rounded-lg mb-4">

                                            <span class="text-black"><?php echo e(date_format($campaign->created_at,'D')); ?></span>

                                            <span class="text-black">$ <?php echo e($campaign->budget); ?></span>

                                        </div>

                                        

                                        <div class="text-center">

                                            <div id="polarAreaCharts"></div>

                                        </div>

                                        <div class="row mx-0">

                                            <div class="col-6 px-0 d-flex align-items-center mb-3">

                                                <div class="bg-primary rounded mr-3 d-block" style="width:25px; height:25px;"></div>

                                                <div>

                                                    <h5 class="mb-1 text-black">Budget</h5>

                                                    

                                                </div>

                                            </div>

                                            

                                        </div>

                                    </div>

                                </div>

                            </div>



                            <?php endif; ?>

                        </div>

                    </div>

                  

                </div>

            </div>

            

        </div>

    </div>

  </form>

</div>



<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>

<?php if(isset($campaign)): ?>

   <?php echo $__env->make('include.chart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 

<?php endif; ?>



<script>

    function closer(){

        $('#box a').on('click', function() {

            $(this).parent().parent().remove(); 

        });

    }



    function close(){

        $(this).parent().parent().remove(); 

    }



    let text = '';

    $('#type').keypress(function(e) {

        if(e.which == 32) {//change to 32 for spacebar instead of enter

            var tx = $(this).val();

            if (tx) {

                $(this).val('').parent().before('<li><span>'+tx+'<input type="hidden" name="key[]" value="'+ tx +'" /><a href="javascript:void(0);" class="mt-1">x</a></span></li>');

                closer();

            }

        }

    });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/zkads/domains/zkads.com/public_html/resources/views/admin/campaign/create.blade.php ENDPATH**/ ?>