

<?php $__env->startSection('title', 'Tambah Peraturan Baru'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .card-form {
        background: #ffffff;
        border-radius: 1.2rem;
        padding: 3rem;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 3rem auto;
        border: 1px solid #f1f1f1;
    }

    .card-form h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 2rem;
        color: #333;
        text-align: center;
    }

    .card-form h2 i {
        margin-right: 0.5rem;
        color: #28c76f;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 0.8rem;
        color: #444;
    }

    .form-control {
        border-radius: 1rem;
        padding: 0.8rem 1.2rem;
        font-size: 1.1rem;
        border: 1px solid #dcdfe1;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #28c76f;
        box-shadow: 0 0 0 0.2rem rgba(40, 199, 111, 0.2);
    }

    .btn-primary {
        background-color: #28c76f;
        border: none;
        padding: 0.8rem 1.6rem;
        font-weight: 600;
        font-size: 1.1rem;
        border-radius: 1rem;
        width: 100%;
        transition: background-color 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-primary:hover {
        background-color: #22b861;
        transform: translateY(-2px);
    }

    .btn-primary i {
        margin-right: 0.5rem;
    }
</style>

<div class="container">
    <div class="card-form">
        <h2><i class="bi bi-file-earmark-plus-fill"></i> Tambah Peraturan Baru</h2>
        <form action="<?php echo e(route('admin.peraturan.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label for="isi_peraturan" class="form-label">Isi Peraturan</label>
                <input type="text" class="form-control" id="isi_peraturan" name="isi_peraturan" required placeholder="- Dilarang merokok di kamar">
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\pengabdian\homestay-bumdes\resources\views/admin/peraturan/create.blade.php ENDPATH**/ ?>