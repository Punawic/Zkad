<?php $__env->startSection('header'); ?>
Page / เพจ
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


<div class="content-body ">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
           
            <div class="col-xl-12">
                <form action="<?php echo e(isset($page) ? route('page.update',$page->id) : route('page.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php if(isset($page)): ?>
                    <?php echo method_field('put'); ?>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><?php echo e(isset($page) ? 'Update' : 'Create'); ?> Page / สร้างเพจใหม่</h4>
                    </div>
                    <div class="card-body">
                      
                        <div class="basic-form">
                            <form>
                                <div class="form-group">
                                    <input type="text" class="form-control input-default" name="name" value="<?php echo e(isset($page) ? $page->name : ''); ?>" required placeholder="Enter page name / ใส่ชื่อเพจ">
                                </div>
                                <?php if(isset($page)): ?>
                                  <img src="<?php echo e(asset('storage/'.$page->image)); ?>" width="100px" alt="">  
                                <?php endif; ?>
                                <div class="form-group">
                                    <input type="file" class="form-control input-rounded" <?php echo e(!isset($page) ? 'required' : ''); ?> name="image">
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="active" name="status" <?php echo e(isset($page) && $page->status=='1' ? 'checked' : ''); ?>>
                                    <label for="active">Avariable / ติ๊กเพื่อเปิดเพจ</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="reset" class="btn btn-danger">Reset / รีเซตใหม่</button>
                                        <button type="submit" class="btn btn-primary"><?php echo e(isset($page) ? 'Update' : 'Create'); ?> / สร้าง</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                           
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/zkads/domains/zkads.com/public_html/resources/views/admin/pages/create.blade.php ENDPATH**/ ?>