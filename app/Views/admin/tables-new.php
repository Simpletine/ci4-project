 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-2 text-gray-800"><?= $title = ucfirst($action ?? '') ?> record</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary"><?= $title ?? '' ?> Record</h6>
         </div>
         <form action="/admin/table/<?= $action . '/' . $id ?? 'new' ?>" method="POST">
             <div class="card-body">
                 <?php if (isset($message)) echo '<div class="alert alert-info">' . $message . '</div>'; ?>
                 <?php if ($action == 'delete') : ?>
                     <input class="btn btn-danger float-right mb-3" value="delete" type="submit">
                 <?php else : ?>
                     <input class="btn btn-primary float-right mb-3" type="submit">
                 <?php endif; ?>
                 <div class="table-responsive">
                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                         <thead>
                             <tr>
                                 <th>Name</th>
                                 <th>Position</th>
                                 <th>Office</th>
                                 <th>Age</th>
                                 <th>Start date</th>
                                 <th>Salary</th>
                             </tr>
                         </thead>
                         <tbody>
                             <tr>
                                 <th><?= form_input('name', $edit->name ?? '', 'class="form-control" ' . $action == "delete" ? 'disabled' : '') ?></th>
                                 <th><?= form_input('position', $edit->position ?? '', 'class="form-control" ' . $action == "delete" ? 'disabled' : '') ?></th>
                                 <th><?= form_input('office', $edit->office ?? '', 'class="form-control" ' . $action == "delete" ? 'disabled' : '') ?></th>
                                 <th><?= form_input('age', $edit->age ?? '', 'class="form-control" ' . $action == "delete" ? 'disabled' : '', 'number') ?></th>
                                 <th><?= form_input('start_date', $edit->start_date ?? '', 'class="form-control" ' . $action == "delete" ? 'disabled' : '', 'date') ?></th>
                                 <th><?= form_input('salary', $edit->salary ?? '', 'class="form-control" ' . $action == "delete" ? 'disabled' : '', 'number') ?></th>
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
         </form>
     </div>

 </div>
 <!-- /.container-fluid -->